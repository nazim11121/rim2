@extends('frontend.layouts.master')

@section('title', 'Cottages & Rates | Bonomali Mangrove Resort')

@push('scripts')
  @vite(['resources/js/booking/main.jsx'])
@endpush

@section('content')
<section class="bm-hero" style="background-image: url({{ asset('assets/bonomali/imagery/cottages-night.jpg') }});">
  <div class="bm-hero-inner">
    <span class="t-eyebrow">Cottages</span>
    <h1>Named for the forest that keeps them.</h1>
    <p class="t-deck">Set far apart so none looks into another. And the Pod, for a party of six to ten.</p>
    <ul class="bm-breadcrumb">
      <li><a href="{{url('/')}}">Home</a></li>
      <li>Cottages</li>
    </ul>
  </div>
</section>

<section class="bm-section">
  <div class="bm-container">
    <p class="bm-lede" style="margin: 0 auto var(--space-7); text-align:center; max-width: 760px;">
      Every stay is priced by the person and includes the boat from Mongla, three meals a day, and a canal cruise.
    </p>

    <div class="bm-grid bm-grid-3">
      @forelse ($stays as $stay)
        @php $fromRate = $stay->rateTiers->sortByDesc('from_guests')->first(); @endphp
        <div class="bm-card">
          <img class="bm-card-img" src="{{ $stay->hero_image ? asset($stay->hero_image) : asset('assets/bonomali/imagery/cottage-canal-dusk.jpg') }}" alt="{{ $stay->name }}">
          <div class="bm-card-body">
            <span class="bm-card-tag">{{ $stay->whole_unit_only ? 'For groups' : 'Couple cottage' }}</span>
            <h3 class="bm-card-title">{{ $stay->name }}@if($stay->meaning)<span style="font-weight:400;color:var(--text-muted);font-size:var(--fs-small);"> &middot; {{ $stay->meaning }}</span>@endif</h3>
            @if($stay->description)
              <p>{{ $stay->description }}</p>
            @endif
            <ul class="bm-amenities">
              <li><i class="fas fa-users"></i>{{ $stay->min_guests }}&ndash;{{ $stay->max_guests }} guests</li>
            </ul>
            @if($fromRate)
              <p class="bm-card-price">from ৳{{ number_format($fromRate->weekday_rate) }} <span style="font-weight:400;color:var(--text-muted);font-size:var(--fs-caption);">/ person / night</span></p>
            @endif
            <a href="#booking-widget" class="bm-btn bm-btn-primary bm-btn-sm bm-stay-pick" data-stay="{{ $stay->slug }}">Check availability</a>
          </div>
        </div>
      @empty
        <div class="bm-empty" style="grid-column: 1 / -1;">Cottages will be published here shortly.</div>
      @endforelse
    </div>
  </div>
</section>

<section class="bm-section bm-section-alt">
  <div class="bm-container">
    <div style="text-align:center; max-width: 700px; margin: 0 auto var(--space-7);">
      <span class="t-eyebrow">Every rate includes</span>
      <h2 class="bm-heading">Priced by the person. Nothing hidden.</h2>
    </div>
    <div class="bm-grid bm-grid-4">
      <div class="bm-facility" style="flex-direction:column; text-align:center; align-items:center;">
        <div class="bm-icon"><i class="fas fa-ship"></i></div>
        <div><h4>The boat from Mongla</h4><p>Bonomali's own boat, about 30 minutes each way.</p></div>
      </div>
      <div class="bm-facility" style="flex-direction:column; text-align:center; align-items:center;">
        <div class="bm-icon"><i class="fas fa-utensils"></i></div>
        <div><h4>All meals</h4><p>From the village kitchen: rice, fish, whatever the day brought.</p></div>
      </div>
      <div class="bm-facility" style="flex-direction:column; text-align:center; align-items:center;">
        <div class="bm-icon"><i class="fas fa-water"></i></div>
        <div><h4>A dawn boat on the canal</h4><p>One slow morning ride while the water is still glass.</p></div>
      </div>
      <div class="bm-facility" style="flex-direction:column; text-align:center; align-items:center;">
        <div class="bm-icon"><i class="fas fa-fire"></i></div>
        <div><h4>Barbecue by the canal</h4><p>The grill at nine, a long table, the forest gone to sound.</p></div>
      </div>
    </div>
  </div>
</section>

<section class="bm-section" id="booking-widget">
  <div class="bm-container">
    <div style="text-align:center; max-width: 700px; margin: 0 auto var(--space-7);">
      <span class="t-eyebrow">Reserve</span>
      <h2 class="bm-heading">Check dates and see your price.</h2>
      <p class="bm-lede" style="margin:0 auto;">The same numbers our office would quote you &mdash; net rate, weekday saving, promo, VAT.</p>
    </div>
    <div
      data-bonomali-booking
      data-stays="{{ $stays->map(fn($s) => ['slug' => $s->slug, 'name' => $s->name, 'min' => $s->min_guests, 'max' => $s->max_guests])->toJson() }}"
      data-quote-url="{{ url('/api/quote') }}"
      data-availability-url="{{ url('/api/availability') }}"
      data-reserve-url="{{ url('/api/reservations') }}"
    ></div>
  </div>
</section>

<script>
  document.querySelectorAll('.bm-stay-pick').forEach(function (btn) {
    btn.addEventListener('click', function () {
      document.dispatchEvent(new CustomEvent('bonomali:pick-stay', { detail: btn.dataset.stay }));
    });
  });
</script>
@endsection
