@extends('frontend.layouts.master')

@section('title', $post->title.' | Bonomali Mangrove Resort')

@section('content')
<section class="bm-hero" style="background-image: url({{ asset($post->image) }});">
  <div class="bm-hero-inner">
    @if($post->category)
      <span class="t-eyebrow">{{ $post->category }}</span>
    @endif
    <h1>{{ $post->title }}</h1>
    @if($post->excerpt)
      <p class="t-deck">{{ $post->excerpt }}</p>
    @endif
    <ul class="bm-breadcrumb">
      <li><a href="{{url('/')}}">Home</a></li>
      <li><a href="{{ route('journal') }}">Journal</a></li>
      <li>{{ $post->title }}</li>
    </ul>
  </div>
</section>

<section class="bm-section">
  <div class="bm-container">
    <article class="bm-article">
      {!! $post->body !!}
    </article>
  </div>
</section>

@if($related->isNotEmpty())
<section class="bm-section bm-section-alt">
  <div class="bm-container">
    <div style="text-align:center; max-width: 700px; margin: 0 auto var(--space-7);">
      <span class="t-eyebrow">Keep reading</span>
      <h2 class="bm-heading">More from the journal.</h2>
    </div>
    <div class="bm-grid bm-grid-3">
      @foreach($related as $item)
        <div class="bm-card">
          <a href="{{ route('journal.show', $item->slug) }}" class="bm-card-link">
            <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="bm-card-img">
          </a>
          <div class="bm-card-body">
            @if($item->category)
              <span class="bm-card-tag">{{ $item->category }}</span>
            @endif
            <h3 class="bm-card-title">
              <a href="{{ route('journal.show', $item->slug) }}" class="bm-card-link">{{ $item->title }}</a>
            </h3>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif
@endsection
