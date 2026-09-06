@extends('frontend.layouts.master')

@section('title', 'Terms & Conditions | Bonomali Mangrove Resort')

@section('content')
<section class="bm-hero" style="background-image: url({{ asset('assets/bonomali/imagery/cottages-night.jpg') }});">
  <div class="bm-hero-inner">
    <h1>Terms &amp; Conditions</h1>
    <ul class="bm-breadcrumb">
      <li><a href="{{url('/')}}">Home</a></li>
      <li>Terms &amp; Conditions</li>
    </ul>
  </div>
</section>

<section class="bm-section">
  <div class="bm-container" style="text-align:center; max-width: 640px; margin: 0 auto;">
    <div class="bm-card">
      <div class="bm-card-body" style="align-items:center; text-align:center;">
        <h2 class="bm-card-title">This page is being finalised.</h2>
        <p>Our full terms and conditions will be published here shortly. For any questions about bookings, cancellations, or your stay, please contact us directly &mdash; we reply ourselves, usually within a day.</p>
        <a href="{{ route('contact') }}" class="bm-btn bm-btn-primary" style="align-self:center; margin-top: var(--space-3);">Contact us</a>
      </div>
    </div>
  </div>
</section>
@endsection
