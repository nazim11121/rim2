@extends('frontend.layouts.master')

@section('title', 'Gallery | Bonomali Mangrove Resort')

@section('content')
<section class="bm-hero" style="background-image: url({{ asset('assets/bonomali/imagery/deck-night.jpg') }});">
  <div class="bm-hero-inner">
    <span class="t-eyebrow">Gallery</span>
    <h1>Gallery</h1>
    <p class="t-deck">The cottages, the canal, the forest, and the dark. As it actually looks.</p>
    <ul class="bm-breadcrumb">
      <li><a href="{{url('/')}}">Home</a></li>
      <li>Gallery</li>
    </ul>
  </div>
</section>

<section class="bm-section">
  <div class="bm-container">
    @if($items->isEmpty())
      <div class="bm-empty">Gallery images will be published here soon.</div>
    @else
      <ul class="bm-gallery-filters" id="bm-gallery-filters">
        <li><button type="button" class="is-active" data-filter="all">All</button></li>
        @foreach($categories as $category)
          <li><button type="button" data-filter="{{ $category }}">{{ ucfirst($category) }}</button></li>
        @endforeach
      </ul>

      <div class="bm-gallery-grid" id="bm-gallery-grid">
        @foreach($items as $item)
          <div class="bm-gallery-item" data-category="{{ $item->category }}">
            <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" loading="lazy">
            <span class="bm-gallery-caption">{{ $item->caption ?: $item->title }}</span>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>

<script>
(function () {
  var filterBar = document.getElementById('bm-gallery-filters');
  var grid = document.getElementById('bm-gallery-grid');
  if (!filterBar || !grid) return;

  var buttons = filterBar.querySelectorAll('button');
  var items = grid.querySelectorAll('.bm-gallery-item');

  filterBar.addEventListener('click', function (e) {
    var btn = e.target.closest('button');
    if (!btn) return;

    buttons.forEach(function (b) { b.classList.remove('is-active'); });
    btn.classList.add('is-active');

    var filter = btn.getAttribute('data-filter');
    items.forEach(function (item) {
      var show = filter === 'all' || item.getAttribute('data-category') === filter;
      item.style.display = show ? '' : 'none';
    });
  });
})();
</script>
@endsection
