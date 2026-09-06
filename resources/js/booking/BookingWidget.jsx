import { useEffect, useMemo, useState } from 'react';

const PROBLEM_MESSAGES = {
  check_in_past: 'That check-in date has already passed.',
  check_out_before_check_in: 'Check-out must be after check-in.',
  below_whole_unit_minimum: 'This stay is booked as a whole unit and needs at least its minimum guest count.',
  over_stay_capacity: 'That many guests is over this stay’s capacity.',
  dates_taken: 'Those dates are already booked for this cottage.',
  property_at_capacity: 'The whole property is full on one or more of those nights.',
};

function money(n) {
  return '৳' + Number(n || 0).toLocaleString('en-US');
}

export default function BookingWidget({ stays = [], quoteUrl, availabilityUrl, reserveUrl }) {
  const [stay, setStay] = useState(stays[0]?.slug || '');
  const [checkIn, setCheckIn] = useState('');
  const [nights, setNights] = useState(1);
  const [guests, setGuests] = useState(stays[0]?.min || 1);
  const [promo, setPromo] = useState('');

  const [quote, setQuote] = useState(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);

  const [guestName, setGuestName] = useState('');
  const [guestPhone, setGuestPhone] = useState('');
  const [guestEmail, setGuestEmail] = useState('');
  const [guestNote, setGuestNote] = useState('');
  const [submitting, setSubmitting] = useState(false);
  const [reference, setReference] = useState(null);
  const [submitError, setSubmitError] = useState(null);

  const selectedStay = useMemo(() => stays.find((s) => s.slug === stay), [stays, stay]);

  useEffect(() => {
    const onPick = (e) => {
      setStay(e.detail);
      setQuote(null);
      setReference(null);
      document.getElementById('booking-widget')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    };
    document.addEventListener('bonomali:pick-stay', onPick);
    return () => document.removeEventListener('bonomali:pick-stay', onPick);
  }, []);

  useEffect(() => {
    if (selectedStay && guests < selectedStay.min) setGuests(selectedStay.min);
  }, [selectedStay]);

  useEffect(() => {
    if (!stay || !checkIn || !nights || !guests) {
      setQuote(null);
      return;
    }
    setError(null);
    setLoading(true);
    const controller = new AbortController();
    const params = new URLSearchParams({ stay, check_in: checkIn, nights, guests });
    if (promo.trim()) params.set('promo', promo.trim());

    const timer = setTimeout(() => {
      fetch(`${quoteUrl}?${params.toString()}`, { signal: controller.signal })
        .then((r) => r.json())
        .then((data) => {
          if (!data.ok) {
            setError(data.message || 'Could not price that stay.');
            setQuote(null);
          } else {
            setQuote(data);
          }
        })
        .catch((e) => {
          if (e.name !== 'AbortError') setError('Could not reach the booking service. Please try again.');
        })
        .finally(() => setLoading(false));
    }, 400);

    return () => { clearTimeout(timer); controller.abort(); };
  }, [stay, checkIn, nights, guests, promo, quoteUrl]);

  const canReserve = quote && quote.ok && quote.available;

  function submitReservation(e) {
    e.preventDefault();
    setSubmitting(true);
    setSubmitError(null);
    fetch(reserveUrl, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
      body: JSON.stringify({
        stay, check_in: checkIn, nights, guests,
        promo: promo.trim() || undefined,
        guest_name: guestName, guest_phone: guestPhone,
        guest_email: guestEmail || undefined, guest_note: guestNote || undefined,
      }),
    })
      .then(async (r) => {
        const data = await r.json();
        if (!r.ok || !data.ok) {
          throw new Error(data.message || (data.problems || []).map((p) => PROBLEM_MESSAGES[p] || p).join(' ') || 'Could not complete the reservation.');
        }
        return data;
      })
      .then((data) => setReference(data.reference))
      .catch((e) => setSubmitError(e.message))
      .finally(() => setSubmitting(false));
  }

  if (reference) {
    return (
      <div className="bm-card" style={{ maxWidth: 560, margin: '0 auto' }}>
        <div className="bm-card-body" style={{ textAlign: 'center' }}>
          <h3 className="bm-card-title">Thank you.</h3>
          <p>We&rsquo;ve got your enquiry &mdash; reference <strong>{reference}</strong>. We&rsquo;ll write back ourselves within a day to confirm your dates.</p>
        </div>
      </div>
    );
  }

  return (
    <div className="bm-card" style={{ maxWidth: 720, margin: '0 auto' }}>
      <div className="bm-card-body">
        <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: 16 }}>
          <div className="bm-field">
            <label>Stay</label>
            <select value={stay} onChange={(e) => setStay(e.target.value)}>
              {stays.map((s) => (
                <option key={s.slug} value={s.slug}>{s.name}</option>
              ))}
            </select>
          </div>
          <div className="bm-field">
            <label>Guests</label>
            <input
              type="number"
              min={selectedStay?.min || 1}
              max={selectedStay?.max || 20}
              value={guests}
              onChange={(e) => setGuests(Number(e.target.value))}
            />
          </div>
          <div className="bm-field">
            <label>Check-in</label>
            <input type="date" value={checkIn} onChange={(e) => setCheckIn(e.target.value)} />
          </div>
          <div className="bm-field">
            <label>Nights</label>
            <input type="number" min={1} max={30} value={nights} onChange={(e) => setNights(Number(e.target.value))} />
          </div>
          <div className="bm-field" style={{ gridColumn: '1 / -1' }}>
            <label>Promo code (optional)</label>
            <input type="text" value={promo} onChange={(e) => setPromo(e.target.value.toUpperCase())} placeholder="e.g. BONOMALI10" />
          </div>
        </div>

        {loading && <p style={{ color: 'var(--text-muted)' }}>Checking&hellip;</p>}
        {error && <div className="bm-alert bm-alert-error">{error}</div>}

        {quote && quote.ok && (
          <div style={{ marginTop: 16, borderTop: '1px solid var(--line)', paddingTop: 16 }}>
            {!quote.available && (
              <div className="bm-alert bm-alert-error">
                {quote.problems.map((p) => PROBLEM_MESSAGES[p] || p).join(' ')}
              </div>
            )}
            {quote.promo_problem && (
              <div className="bm-alert bm-alert-error">That promo code isn&rsquo;t valid for these dates.</div>
            )}
            <table style={{ width: '100%', fontSize: 'var(--fs-small)' }}>
              <tbody>
                <tr><td>Nightly rate</td><td style={{ textAlign: 'right' }}>{money(quote.quote.nightly)} / person</td></tr>
                <tr><td>{quote.quote.nights} night(s), {quote.quote.guests} guest(s)</td><td style={{ textAlign: 'right' }}>{money(quote.quote.gross)}</td></tr>
                {quote.quote.weekday_discount > 0 && (
                  <tr><td>Weekday saving</td><td style={{ textAlign: 'right', color: 'var(--positive)' }}>&minus;{money(quote.quote.weekday_discount)}</td></tr>
                )}
                {quote.quote.promo_discount > 0 && (
                  <tr><td>{quote.quote.promo_label}</td><td style={{ textAlign: 'right', color: 'var(--positive)' }}>&minus;{money(quote.quote.promo_discount)}</td></tr>
                )}
                <tr><td>VAT (15%)</td><td style={{ textAlign: 'right' }}>{money(quote.quote.vat)}</td></tr>
                <tr style={{ fontWeight: 700, fontSize: 'var(--fs-lead)' }}>
                  <td>Total</td><td style={{ textAlign: 'right', color: 'var(--gold)' }}>{money(quote.quote.total)}</td>
                </tr>
              </tbody>
            </table>
          </div>
        )}

        {canReserve && (
          <form onSubmit={submitReservation} style={{ marginTop: 24, borderTop: '1px solid var(--line)', paddingTop: 16 }}>
            <h4 style={{ marginBottom: 12 }}>Your details</h4>
            <div className="bm-field">
              <label>Your name</label>
              <input required value={guestName} onChange={(e) => setGuestName(e.target.value)} placeholder="Who shall we welcome?" />
            </div>
            <div className="bm-field">
              <label>Phone</label>
              <input required value={guestPhone} onChange={(e) => setGuestPhone(e.target.value)} />
            </div>
            <div className="bm-field">
              <label>Email (optional)</label>
              <input type="email" value={guestEmail} onChange={(e) => setGuestEmail(e.target.value)} />
            </div>
            <div className="bm-field">
              <label>Anything you&rsquo;d like us to know? (optional)</label>
              <textarea rows={3} value={guestNote} onChange={(e) => setGuestNote(e.target.value)} />
            </div>
            {submitError && <div className="bm-alert bm-alert-error">{submitError}</div>}
            <button type="submit" className="bm-btn bm-btn-primary" disabled={submitting} style={{ width: '100%', justifyContent: 'center' }}>
              {submitting ? 'Sending…' : 'Send enquiry'}
            </button>
          </form>
        )}
      </div>
    </div>
  );
}
