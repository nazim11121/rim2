@extends('frontend.layouts.master')

@section('title', 'Contact | Bonomali Mangrove Resort')

@section('content')
<section class="bm-hero" style="background-image: url({{ asset('assets/bonomali/imagery/jetty-deck.jpg') }});">
  <div class="bm-hero-inner">
    <span class="t-eyebrow">Contact</span>
    <h1>Come and stay.</h1>
    <p class="t-deck">Reserve online, message us on WhatsApp, or simply call. We'll write back ourselves.</p>
    <ul class="bm-breadcrumb">
      <li><a href="{{url('/')}}">Home</a></li>
      <li>Contact</li>
    </ul>
  </div>
</section>

<section class="bm-section">
  <div class="bm-container bm-split">
    <div>
      <div class="bm-facility">
        <div class="bm-icon"><i class="fa-solid fa-location-dot"></i></div>
        <div>
          <h4>Address</h4>
          <p>West Dhangmari, Banishanta, Dacope, Khulna, Bangladesh</p>
        </div>
      </div>
      <div class="bm-facility">
        <div class="bm-icon"><i class="fa-solid fa-envelope"></i></div>
        <div>
          <h4>Email</h4>
          <p><a href="mailto:bonomalimangroveresort@gmail.com">bonomalimangroveresort@gmail.com</a></p>
        </div>
      </div>
      <div class="bm-facility">
        <div class="bm-icon"><i class="fa-solid fa-phone"></i></div>
        <div>
          <h4>Phone</h4>
          <p><a href="tel:01991505070">01991 505070</a></p>
        </div>
      </div>

      <div style="display:flex; gap: var(--space-3); flex-wrap:wrap; margin: var(--space-6) 0 var(--space-7);">
        <a href="tel:01991505070" class="bm-btn bm-btn-primary">Call us</a>
        <a href="https://wa.me/8801991505070" target="_blank" rel="noopener" class="bm-btn bm-btn-dark">WhatsApp us</a>
      </div>

      <h3>Getting here</h3>
      <div class="bm-facility">
        <div class="bm-icon"><i class="fa-solid fa-ship"></i></div>
        <div>
          <h4>By boat from Mongla</h4>
          <p>About 30 minutes by boat from Mongla jetty. Bonomali's own boat brings you in.</p>
        </div>
      </div>
      <div class="bm-facility">
        <div class="bm-icon"><i class="fa-solid fa-road"></i></div>
        <div>
          <h4>From Khulna</h4>
          <p>Roughly 2 hours by road to Mongla, then the canal does the rest.</p>
        </div>
      </div>
      <div class="bm-facility">
        <div class="bm-icon"><i class="fa-solid fa-umbrella"></i></div>
        <div>
          <h4>Arrival</h4>
          <p>We'll be the ones with the umbrella. Check-in is unhurried, like everything here.</p>
        </div>
      </div>
    </div>

    <div class="bm-card">
      <div class="bm-card-body">
        <h3 class="bm-card-title">Send an enquiry</h3>

        @if(session('success'))
          <div class="bm-alert bm-alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
          <div class="bm-alert bm-alert-error">
            <ul style="margin:0; padding-left: 18px;">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('contact.submit') }}">
          @csrf
          <div class="bm-field">
            <label for="name">Your name</label>
            <input type="text" id="name" name="name" placeholder="Who shall we welcome?" value="{{ old('name') }}">
          </div>
          <div class="bm-field">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}">
          </div>
          <div class="bm-field">
            <label for="subject">When are you thinking?</label>
            <input type="text" id="subject" name="subject" placeholder="e.g. first week of December" value="{{ old('subject') }}">
          </div>
          <div class="bm-field">
            <label for="message">Anything you'd like us to know?</label>
            <textarea id="message" name="message" rows="4" placeholder="A quiet anniversary, a first visit, a question&hellip;">{{ old('message') }}</textarea>
          </div>
          <button type="submit" class="bm-btn bm-btn-primary">Send enquiry</button>
        </form>
      </div>
    </div>
  </div>
</section>

<section class="bm-section bm-section-alt">
  <iframe width="100%" height="500" style="display:block; border:0;" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14749.793766407845!2d89.52880806839424!3d22.44977648318565!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a002fa68326af57%3A0x5db37101a180e135!2z4Kas4Kao4Kau4Ka-4Kay4KeAIOCmruCnjeCmr-CmvuCmqOCml-CnjeCmsOCni-CmrSDgprDgpr_gprjgp4vgprDgp43gpp8!5e0!3m2!1sbn!2sbd!4v1748029273809!5m2!1sbn!2sbd"></iframe>
</section>

<section class="bm-section">
  <div class="bm-container">
    <div style="text-align:center; max-width: 700px; margin: 0 auto var(--space-7);">
      <h2 class="bm-heading">Before you come</h2>
    </div>
    <div class="bm-grid bm-grid-3">
      <div class="bm-card">
        <div class="bm-card-body">
          <h3 class="bm-card-title">How do we book?</h3>
          <p>Use the booking bar, send the enquiry form, message us on WhatsApp, or call. We reply ourselves within a day.</p>
        </div>
      </div>
      <div class="bm-card">
        <div class="bm-card-body">
          <h3 class="bm-card-title">What is included in the rate?</h3>
          <p>Three meals a day, the boat transfer from Mongla both ways, and a canal cruise.</p>
        </div>
      </div>
      <div class="bm-card">
        <div class="bm-card-body">
          <h3 class="bm-card-title">What time is check-in and check-out?</h3>
          <p>Check in at one in the afternoon, check out at eleven in the morning.</p>
        </div>
      </div>
      <div class="bm-card">
        <div class="bm-card-body">
          <h3 class="bm-card-title">Can we drive all the way to the resort?</h3>
          <p>No. The road ends at Mongla and the last leg is on the water.</p>
        </div>
      </div>
      <div class="bm-card">
        <div class="bm-card-body">
          <h3 class="bm-card-title">Is there wifi?</h3>
          <p>Electricity yes, rooms are air-conditioned. Wifi is not guaranteed.</p>
        </div>
      </div>
      <div class="bm-card">
        <div class="bm-card-body">
          <h3 class="bm-card-title">Can we bring children?</h3>
          <p>Yes &mdash; a cottage takes up to three guests, or the pod suits a family better.</p>
        </div>
      </div>
    </div>
    <div style="text-align:center; margin-top: var(--space-7);">
      <a href="{{ route('faq') }}" class="bm-btn bm-btn-primary">See all questions</a>
    </div>
  </div>
</section>
@endsection
