@extends('frontend.layouts.master')

@section('title', 'Packages | Bonomali Mangrove Resort')

@section('content')
<section class="bm-hero" style="background-image: url({{ asset('assets/bonomali/imagery/balcony-desk-canal.jpg') }});">
  <div class="bm-hero-inner">
    <span class="t-eyebrow">Packages</span>
    <h1>Stay, priced by the person.</h1>
    <p class="t-deck">Each stay is a package: boat, bed, and board, counted per guest.</p>
    <ul class="bm-breadcrumb">
      <li><a href="{{url('/')}}">Home</a></li>
      <li>Packages</li>
    </ul>
  </div>
</section>

<section class="bm-section">
  <div class="bm-container">
    <div style="display:grid; grid-template-columns: 280px 1fr; gap: var(--space-6);">
      <aside>
        <div class="bm-card">
          <div class="bm-card-body">
            <h3 class="bm-card-title" style="font-size: var(--fs-h4);">Filters</h3>
            <form method="GET" action="{{ url()->current() }}">
              <div class="bm-field">
                <label>Category</label>
                <select name="category" class="bm-field-select">
                  <option value="all" {{ request('category', 'all') == 'all' ? 'selected' : '' }}>All Categories</option>
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="bm-field">
                <label>Price Range</label>
                <select id="price_range" onchange="updatePriceInputs()">
                  <option value="all" {{ ( !request('price_min') && !request('price_max') ) ? 'selected' : '' }}>All Prices</option>
                  <option value="0-1000" {{ (request('price_min') == 0 && request('price_max') == 1000) ? 'selected' : '' }}>৳0 - ৳1000</option>
                  <option value="1001-5000" {{ (request('price_min') == 1001 && request('price_max') == 5000) ? 'selected' : '' }}>৳1001 - ৳5000</option>
                  <option value="5001-10000" {{ (request('price_min') == 5001 && request('price_max') == 10000) ? 'selected' : '' }}>৳5001 - ৳10000</option>
                  <option value="10001-20000" {{ (request('price_min') == 10001 && request('price_max') == 20000) ? 'selected' : '' }}>৳10001 - ৳20000</option>
                  <option value="20001-25000" {{ (request('price_min') == 20001 && request('price_max') == 25000) ? 'selected' : '' }}>৳20001 - ৳25000</option>
                </select>
                <input type="hidden" id="price_min" name="price_min" value="{{ request('price_min') }}">
                <input type="hidden" id="price_max" name="price_max" value="{{ request('price_max') }}">
              </div>

              <div class="bm-field">
                <label>No. of Person</label>
                <select name="persons">
                  <option value="" {{ !request('persons') ? 'selected' : '' }}>Any</option>
                  @for($i=1;$i<=5;$i++)
                    <option value="{{ $i }}" {{ request('persons') == $i ? 'selected' : '' }}>{{ $i }}</option>
                  @endfor
                </select>
              </div>

              <div class="bm-field">
                <label>Days</label>
                <select name="days">
                  <option value="" {{ !request('days') ? 'selected' : '' }}>Any</option>
                  <option value="1" {{ request('days') == 1 ? 'selected' : '' }}>1-3</option>
                  <option value="4" {{ request('days') == 4 ? 'selected' : '' }}>4-7</option>
                  <option value="8" {{ request('days') == 8 ? 'selected' : '' }}>8+</option>
                </select>
              </div>

              <button type="submit" class="bm-btn bm-btn-primary" style="width:100%; justify-content:center;">Apply Filters</button>
            </form>
          </div>
        </div>
      </aside>

      <div>
        <div class="bm-grid" style="grid-template-columns: 1fr;">
          @forelse($packages as $package)
            <div class="bm-card" style="flex-direction: row;">
              <img src="{{ $package->image ? asset($package->image) : asset('assets/bonomali/imagery/cottage-interior.jpg') }}" alt="{{ $package->name }}" style="width: 220px; object-fit: cover;">
              <div class="bm-card-body">
                <h3 class="bm-card-title">{{ $package->name }}</h3>
                <p><i class="fas fa-coins" style="color:var(--gold);"></i> <strong>Package Price:</strong> ৳{{ number_format($package->price, 2) }} @if($package->price_for) ({{ strtoupper($package->price_for) }}) @endif</p>
                <p><i class="fas fa-calendar-alt" style="color:var(--gold);"></i> <strong>Number of Days:</strong> {{ $package->no_of_day }}</p>
                <p><i class="fas fa-users" style="color:var(--gold);"></i> <strong>Maximum Persons:</strong> {{ $package->no_of_person }}</p>
                <a href="{{route('contact')}}" class="bm-btn bm-btn-primary bm-btn-sm">Enquire</a>
              </div>
            </div>
          @empty
            <div class="bm-empty">No packages found matching your criteria.</div>
          @endforelse
        </div>
        <div style="margin-top: var(--space-6);">
          {{ $packages->links() }}
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  function updatePriceInputs() {
    const select = document.getElementById('price_range');
    const val = select.value;
    const [min, max] = val === 'all' ? ['', ''] : val.split('-');
    document.getElementById('price_min').value = min;
    document.getElementById('price_max').value = max;
  }
</script>
@endsection
