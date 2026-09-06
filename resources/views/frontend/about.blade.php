@extends('frontend.layouts.master')

@section('title', 'Our Story | Bonomali Mangrove Resort')

@section('content')
<section class="bm-hero" style="background-image: url({{ asset('assets/bonomali/imagery/walkway-palms.jpg') }});">
  <div class="bm-hero-inner">
    <span class="t-eyebrow">About Bonomali</span>
    <h1>A gardener of the forest.</h1>
    <p class="t-deck">The one who tends and keeps the forest. The name is the whole idea.</p>
    <ul class="bm-breadcrumb">
      <li><a href="{{url('/')}}">Home</a></li>
      <li>About Us</li>
    </ul>
  </div>
</section>

<section class="bm-section">
  <div class="bm-container bm-split">
    <div>
      <span class="bm-eyebrow-num">01</span>
      <h2 class="bm-heading">It begins with the name.</h2>
    </div>
    <div>
      <p class="bm-pullquote">&ldquo;Bonomali, <em>boner mali</em>, is the one who tends the forest. Not a visitor. Not an extractor. A keeper.&rdquo;</p>
      <p>We sit in the village of Dangmari, on the quieter side of the world's largest mangrove forest. Most Sundarbans tourism sells the chase: the boat tour, the deep-forest entry, the hope of a tiger. We sell presence: the forest as the view from your balcony at first light. We didn't build it to take you into the Sundarbans. We built it so the Sundarbans could come to you.</p>
      <p>The company was formed in 2024 and opened to guests on 21 February 2025.</p>
    </div>
  </div>
</section>

<section class="bm-section bm-section-alt">
  <div class="bm-container">
    <div style="text-align:center; max-width: 700px; margin: 0 auto var(--space-7);">
      <span class="t-eyebrow">02 &middot; What we keep</span>
      <h2 class="bm-heading">The promise.</h2>
    </div>
    <div class="bm-grid bm-grid-3">
      <div class="bm-card">
        <div class="bm-card-body">
          <h3 class="bm-card-title">Privacy is the luxury</h3>
          <p>Cottages set far apart, each holding two. None looks into another.</p>
        </div>
      </div>
      <div class="bm-card">
        <div class="bm-card-body">
          <h3 class="bm-card-title">The village is the host</h3>
          <p>Built with Dangmari: its kitchens, its boats, its people.</p>
        </div>
      </div>
      <div class="bm-card">
        <div class="bm-card-body">
          <h3 class="bm-card-title">We tell the truth</h3>
          <p>No invented founder stories, no claims we can't keep. If we're unsure, we say so.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="bm-section-forest bm-quote-band">
  <div class="bm-container">
    <p class="bm-pullquote">&ldquo;We didn't build it to take you into the Sundarbans. We built it so the Sundarbans could come to you. Privacy, we think, is the real luxury.&rdquo;</p>
    <p class="bm-attribution">Bonomali Mangrove Resort &middot; Dangmari, Khulna</p>
  </div>
</section>
@endsection
