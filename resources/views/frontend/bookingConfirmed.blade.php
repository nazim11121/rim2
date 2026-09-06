@extends('frontend.layouts.master')

@section('title', 'Thank You | Bonomali Mangrove Resort')

@section('content')
<section class="bm-hero" style="background-image: url({{ asset('assets/bonomali/imagery/jetty-deck.jpg') }});">
  <div class="bm-hero-inner">
    <h1>Thank you.</h1>
  </div>
</section>

<section class="bm-section">
  <div class="bm-container" style="text-align:center; max-width: 640px; margin: 0 auto;">
    <div class="bm-card">
      <div class="bm-card-body" style="align-items:center; text-align:center;">
        <h2 class="bm-card-title">Your enquiry is on its way.</h2>
        <p>We've received it, and we'll write back within a day to confirm your dates.</p>
        <a href="{{ url('/') }}" class="bm-btn bm-btn-primary" style="align-self:center; margin-top: var(--space-3);">Back to home</a>
      </div>
    </div>
  </div>
</section>
@endsection
