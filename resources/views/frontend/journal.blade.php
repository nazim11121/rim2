@extends('frontend.layouts.master')

@section('title', 'The Journal | Bonomali Mangrove Resort')

@section('content')
<section class="bm-hero" style="background-image: url({{ asset('assets/bonomali/imagery/walkway-palms.jpg') }});">
  <div class="bm-hero-inner">
    <span class="t-eyebrow">Journal</span>
    <h1>The Journal</h1>
    <p class="t-deck">Notes on the forest, the village, the seasons, and getting here.</p>
    <ul class="bm-breadcrumb">
      <li><a href="{{url('/')}}">Home</a></li>
      <li>Journal</li>
    </ul>
  </div>
</section>

<section class="bm-section">
  <div class="bm-container">
    @if($posts->isEmpty())
      <div class="bm-empty">Journal entries will be published here soon.</div>
    @else
      <div class="bm-grid bm-grid-3">
        @foreach($posts as $post)
          <div class="bm-card">
            <a href="{{ route('journal.show', $post->slug) }}" class="bm-card-link">
              <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="bm-card-img">
            </a>
            <div class="bm-card-body">
              @if($post->category)
                <span class="bm-card-tag">{{ $post->category }}</span>
              @endif
              <h3 class="bm-card-title">
                <a href="{{ route('journal.show', $post->slug) }}" class="bm-card-link">{{ $post->title }}</a>
              </h3>
              <p>{{ $post->excerpt }}</p>
              @if($post->published_at)
                <span style="font-size: var(--fs-caption); color: var(--text-muted);">{{ \Illuminate\Support\Carbon::parse($post->published_at)->format('d M Y') }}</span>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>
@endsection
