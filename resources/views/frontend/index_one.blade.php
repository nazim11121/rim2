@extends('frontend.layouts.master')

@section('title', 'Bonomali Mangrove Resort | Private Sundarbans Cottages')

@section('content')
<section class="bm-hero bm-hero-tall" style="background-image: url({{ $sliders->first() && $sliders->first()->image ? asset($sliders->first()->image) : asset('assets/bonomali/imagery/swing-deck-wide.jpg') }});">
  <div class="bm-hero-inner">
    <span class="t-eyebrow">A private resort on the edge of the Sundarbans</span>
    <h1>Wake up to the Sundarbans.</h1>
    <p class="t-deck">Just the two of you. And the forest.</p>
    <div style="margin-top: var(--space-5); display:flex; gap: var(--space-3); flex-wrap: wrap;">
      <a href="{{route('rooms')}}" class="bm-btn bm-btn-primary">See the cottages</a>
      <a href="{{route('contact')}}" class="bm-btn bm-btn-outline">Reserve your stay</a>
    </div>
  </div>
</section>

@if($stays->count())
<section class="bm-section">
  <div class="bm-container">
    <div style="text-align:center; max-width: 700px; margin: 0 auto var(--space-7);">
      <span class="t-eyebrow">Named for the forest that keeps them</span>
      <h2 class="bm-heading">Our cottages.</h2>
      <p class="bm-lede" style="margin: 0 auto;">Set far apart for privacy, each with a balcony, a swing, and a canal that quiets when you do.</p>
    </div>
    <div class="bm-grid bm-grid-3">
      @foreach($stays as $stay)
        @php $fromRate = $stay->rateTiers->sortByDesc('from_guests')->first(); @endphp
        <div class="bm-card">
          <img class="bm-card-img" src="{{ $stay->hero_image ? asset($stay->hero_image) : asset('assets/bonomali/imagery/cottage-canal-dusk.jpg') }}" alt="{{ $stay->name }}">
          <div class="bm-card-body">
            <span class="bm-card-tag">{{ $stay->whole_unit_only ? 'For groups' : 'Couple cottage' }}</span>
            <h3 class="bm-card-title">{{ $stay->name }}</h3>
            @if($fromRate)
              <p class="bm-card-price">from ৳{{ number_format($fromRate->weekday_rate) }} <span style="font-weight:400;color:var(--text-muted);font-size:var(--fs-caption);">/ person / night</span></p>
            @endif
            <ul class="bm-amenities">
              <li><i class="fas fa-users"></i>{{ $stay->min_guests }}&ndash;{{ $stay->max_guests }} guests</li>
            </ul>
            <a href="{{ route('rooms') }}?stay={{ $stay->slug }}#booking-widget" class="bm-btn bm-btn-primary bm-btn-sm">Check availability</a>
          </div>
        </div>
      @endforeach
    </div>
    <div style="text-align:center; margin-top: var(--space-7);">
      <a href="{{route('rooms')}}" class="bm-btn bm-btn-dark">See all cottages</a>
    </div>
  </div>
</section>
@endif

<section class="bm-section bm-section-alt">
  <div class="bm-container bm-split">
    <div>
      <span class="bm-eyebrow-num">01</span>
      <h2 class="bm-heading">The story.</h2>
    </div>
    <div>
      <p class="bm-pullquote">&ldquo;Bonomali, <em>boner mali</em>, is the one who tends the forest. The brand begins with the name, and the name begins with the Sundarbans.&rdquo;</p>
      <p>We sit in the village of Dangmari, on the quieter side of the world's largest mangrove forest. The cottages are set far apart, each with a balcony, a swing, and a canal that quiets when you do. The village is the host; the forest is the view.</p>
      <a href="{{route('about')}}" class="bm-btn bm-btn-primary bm-btn-sm">Read our story</a>
    </div>
  </div>
</section>

<section class="bm-section">
  <div class="bm-container bm-split">
    <div>
      <img src="{{ asset('assets/bonomali/imagery/jetty-deck.jpg') }}" alt="The jetty at Bonomali" style="border-radius: var(--radius-lg); width:100%; box-shadow: var(--shadow-md);">
    </div>
    <div>
      <span class="bm-eyebrow-num">03</span>
      <h2 class="bm-heading">The forest is the view.</h2>
      <p>You don't enter the Sundarbans here. You wake up to it. There is a half-hour, just after five, when the canal is still grey and the forest hasn't decided to wake. That half-hour is the reason to come.</p>
      <a href="{{route('services')}}" class="bm-btn bm-btn-primary bm-btn-sm">A day at Bonomali</a>
    </div>
  </div>
</section>

<section class="bm-section bm-section-alt">
  <div class="bm-container">
    <div style="text-align:center; max-width: 700px; margin: 0 auto var(--space-7);">
      <span class="t-eyebrow">What we keep, every stay</span>
      <h2 class="bm-heading">The facilities we offer.</h2>
    </div>
    <div class="bm-grid bm-grid-3">
      <div class="bm-facility">
        <div class="bm-icon"><i class="fas fa-water"></i></div>
        <div><h4>A private swing</h4><p>On every balcony, facing the canal and the forest beyond.</p></div>
      </div>
      <div class="bm-facility">
        <div class="bm-icon"><i class="fas fa-ship"></i></div>
        <div><h4>Boat transfer included</h4><p>Bonomali's own boat, from Mongla jetty.</p></div>
      </div>
      <div class="bm-facility">
        <div class="bm-icon"><i class="fas fa-house"></i></div>
        <div><h4>Architect-designed cottages</h4><p>Nothing generic: even the swing has a reason for being where it is.</p></div>
      </div>
      <div class="bm-facility">
        <div class="bm-icon"><i class="fas fa-fire"></i></div>
        <div><h4>Barbecue dinner by the canal</h4><p>The grill goes on at nine, at one long table.</p></div>
      </div>
      <div class="bm-facility">
        <div class="bm-icon"><i class="fas fa-leaf"></i></div>
        <div><h4>Honest village food</h4><p>Rice that tasted like this in a Dangmari kitchen yesterday.</p></div>
      </div>
      @if($packages->count())
      <div class="bm-facility">
        <div class="bm-icon"><i class="fas fa-suitcase"></i></div>
        <div><h4>Packages available</h4><p>Boat, bed and board, priced per guest. <a href="{{route('packages')}}" class="bm-link">See packages</a></p></div>
      </div>
      @endif
    </div>
  </div>
</section>

<section class="bm-section-forest bm-quote-band">
  <div class="bm-container">
    <p class="bm-pullquote">&ldquo;We didn't build it to take you into the Sundarbans. We built it so the Sundarbans could come to you. Privacy, we think, is the real luxury.&rdquo;</p>
    <p class="bm-attribution">Bonomali Mangrove Resort &middot; Dangmari, Khulna</p>
  </div>
</section>

@if($aboutUs)
<section class="bm-section">
  <div class="bm-container bm-split is-reversed">
    <div>
      <img src="{{ $aboutUs->image ? asset($aboutUs->image) : asset('assets/bonomali/imagery/walkway-palms.jpg') }}" alt="Bonomali Mangrove Resort" style="border-radius: var(--radius-lg); width:100%; box-shadow: var(--shadow-md);">
    </div>
    <div>
      <h2 class="bm-heading">About us</h2>
      <p>{{ $aboutUs->description }}</p>
      <a href="{{route('about')}}" class="bm-btn bm-btn-primary bm-btn-sm">Read more</a>
    </div>
  </div>
</section>
@endif

<section class="bm-section bm-section-alt">
  <div class="bm-container bm-split">
    <div>
      <span class="t-eyebrow">Come and stay</span>
      <h2 class="bm-heading">Reserve online, or write to us.</h2>
      <p>Message us on WhatsApp, or simply call. We'll write back ourselves: no call centre, no rush. Your boat leaves Mongla jetty; we'll be the ones with the umbrella.</p>
      <div style="display:flex; gap: var(--space-3); flex-wrap: wrap; margin-top: var(--space-4);">
        <a href="{{route('contact')}}" class="bm-btn bm-btn-primary">Send an enquiry</a>
        <a href="https://wa.me/8801991505070" target="_blank" rel="noopener" class="bm-btn bm-btn-dark"><i class="fab fa-whatsapp"></i> WhatsApp us</a>
      </div>
    </div>
    <div class="bm-card">
      <div class="bm-card-body">
        <h3 class="bm-card-title">Get in touch</h3>
        <p><i class="fas fa-map-marker-alt"></i> West Dhangmari, Banishanta, Dacope, Khulna</p>
        <p><i class="fas fa-phone"></i> <a href="tel:01991505070">01991 505070</a></p>
        <p><i class="fas fa-envelope"></i> <a href="mailto:bonomalimangroveresort@gmail.com">bonomalimangroveresort@gmail.com</a></p>
      </div>
    </div>
  </div>
</section>
@endsection
