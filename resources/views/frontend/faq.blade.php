@extends('frontend.layouts.master')

@section('title', 'Questions Answered | Bonomali Mangrove Resort')

@section('content')
<section class="bm-hero" style="background-image: url({{ asset('assets/bonomali/imagery/walkway-palms.jpg') }});">
  <div class="bm-hero-inner">
    <span class="t-eyebrow">FAQ</span>
    <h1>Questions Answered</h1>
    <p class="t-deck">Everything guests ask us before they come, answered plainly.</p>
    <ul class="bm-breadcrumb">
      <li><a href="{{url('/')}}">Home</a></li>
      <li>FAQ</li>
    </ul>
  </div>
</section>

<section class="bm-section">
  <div class="bm-container">
    @if($faqs->isEmpty())
      <div class="bm-empty">FAQs will be published here soon.</div>
    @else
      @php
        $labels = [
          'booking' => 'Booking and rates',
          'journey' => 'Getting here',
          'stays' => 'The stays',
          'food' => 'Food',
          'forest' => 'The forest and the day',
          'practical' => 'Practical',
        ];
        $order = ['booking', 'journey', 'stays', 'food', 'forest', 'practical'];
        $categories = $faqs->keys()->sortBy(function ($cat) use ($order) {
          $i = array_search($cat, $order);
          return $i === false ? 999 : $i;
        });
      @endphp
      <div style="max-width: 800px; margin: 0 auto;">
        @foreach($categories as $category)
          <h2 class="bm-faq-group-title">{{ $labels[$category] ?? ucfirst($category) }}</h2>
          @foreach($faqs[$category] as $faq)
            <details class="bm-accordion-item">
              <summary>{{ $faq->question }}</summary>
              <p>{{ $faq->answer }}</p>
            </details>
          @endforeach
        @endforeach
      </div>
    @endif
  </div>
</section>
@endsection
