@extends('frontend.layouts.master')

@section('title', 'The Experience | Bonomali Mangrove Resort')

@section('content')
<section class="bm-hero" style="background-image: url({{ asset('assets/bonomali/imagery/swing-deck-wide.jpg') }});">
  <div class="bm-hero-inner">
    <span class="t-eyebrow">The experience</span>
    <h1>The forest is the view.</h1>
    <p class="t-deck">You don't enter the Sundarbans here. You wake up to it.</p>
    <ul class="bm-breadcrumb">
      <li><a href="{{url('/')}}">Home</a></li>
      <li>Experience</li>
    </ul>
  </div>
</section>

<section class="bm-section">
  <div class="bm-container">
    <div style="text-align:center; max-width: 700px; margin: 0 auto var(--space-7);">
      <span class="t-eyebrow">01 &middot; A day at Bonomali</span>
      <h2 class="bm-heading">Check in at one. Check out at eleven.</h2>
      <p class="bm-lede">Everything between those two hours is yours. Here is roughly how it goes.</p>
    </div>

    <h3>The day you arrive</h3>
    <div class="bm-timeline">
      <div class="bm-timeline-item">
        <div class="bm-timeline-time">1:00 pm</div>
        <div>
          <h4 class="bm-timeline-title">Arrival and check-in</h4>
          <p class="bm-timeline-body">The boat brings you in from Mongla and ties up at our jetty. Keys, cold water, and very little paperwork.</p>
        </div>
      </div>
      <div class="bm-timeline-item">
        <div class="bm-timeline-time">2:00 pm</div>
        <div>
          <h4 class="bm-timeline-title">Lunch</h4>
          <p class="bm-timeline-body">Rice, fish, and whatever the morning boats brought in. Eaten slowly, by the canal.</p>
        </div>
      </div>
      <div class="bm-timeline-item">
        <div class="bm-timeline-time">4:00 pm</div>
        <div>
          <h4 class="bm-timeline-title">A boat on the canal</h4>
          <p class="bm-timeline-body">The afternoon cruise. Kingfishers, herons, the odd ripple, and the forest closing in on both banks.</p>
        </div>
      </div>
      <div class="bm-timeline-item">
        <div class="bm-timeline-time">9:00 pm</div>
        <div>
          <h4 class="bm-timeline-title">Barbecue dinner</h4>
          <p class="bm-timeline-body">The grill goes on by the canal. One long table, and the forest gone to sound.</p>
        </div>
      </div>
    </div>

    <h3 style="margin-top: var(--space-7);">The next morning</h3>
    <div class="bm-timeline">
      <div class="bm-timeline-item">
        <div class="bm-timeline-time">5:00 am</div>
        <div>
          <h4 class="bm-timeline-title">The grey half-hour</h4>
          <p class="bm-timeline-body">The canal is still grey and the forest hasn't decided to wake. Two cups, two chairs. This is the reason to come.</p>
        </div>
      </div>
      <div class="bm-timeline-item">
        <div class="bm-timeline-time">8:30 am</div>
        <div>
          <h4 class="bm-timeline-title">Breakfast</h4>
          <p class="bm-timeline-body">Hot, simple, and served when you surface. Nobody here will hurry you.</p>
        </div>
      </div>
      <div class="bm-timeline-item">
        <div class="bm-timeline-time">11:00 am</div>
        <div>
          <h4 class="bm-timeline-title">Check-out</h4>
          <p class="bm-timeline-body">Eleven in the morning, and the boat back to Mongla whenever you are ready.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="bm-section-forest bm-quote-band">
  <div class="bm-container">
    <p class="bm-pullquote">&ldquo;Light is golden. Things are slow. Nothing here is trying to be more than itself.&rdquo;</p>
    <p class="bm-attribution">Bonomali Mangrove Resort</p>
  </div>
</section>

<section class="bm-section">
  <div class="bm-container bm-split">
    <div>
      <img src="{{ asset('assets/bonomali/imagery/hariken-lantern.jpg') }}" alt="Hurricane lantern on a table at dusk" style="width:100%; border-radius: var(--radius-lg);">
    </div>
    <div>
      <span class="bm-eyebrow-num">02</span>
      <span class="t-eyebrow">From the village kitchen</span>
      <h2 class="bm-heading">Honest food, simply made.</h2>
      <p>Every meal comes from what Dhangmari grows and catches: rice from the fields, fish off the morning boats, greens from the plot behind the kitchen. No buffet, no menu of forty things. Two or three dishes, made well, eaten slowly by the canal.</p>
    </div>
  </div>
</section>

<section class="bm-section bm-section-alt">
  <div class="bm-container">
    <div style="text-align:center; max-width: 700px; margin: 0 auto var(--space-7);">
      <span class="t-eyebrow">03 &middot; Facilities</span>
      <h2 class="bm-heading">What we keep, every stay</h2>
    </div>
    <div class="bm-grid bm-grid-2">
      <div class="bm-facility">
        <div class="bm-icon"><i class="fa-solid fa-water"></i></div>
        <div>
          <h4>A private swing</h4>
          <p>On every balcony, facing the canal and the forest beyond.</p>
        </div>
      </div>
      <div class="bm-facility">
        <div class="bm-icon"><i class="fa-solid fa-water"></i></div>
        <div>
          <h4>Canal at your door</h4>
          <p>Quiet boat moments at first light and dusk.</p>
        </div>
      </div>
      <div class="bm-facility">
        <div class="bm-icon"><i class="fa-solid fa-ship"></i></div>
        <div>
          <h4>Boat transfer included</h4>
          <p>Bonomali's own boat, from Mongla jetty.</p>
        </div>
      </div>
      <div class="bm-facility">
        <div class="bm-icon"><i class="fa-solid fa-house"></i></div>
        <div>
          <h4>Architect-designed cottages</h4>
          <p>Nothing generic: even the swing has a reason for being where it is.</p>
        </div>
      </div>
      <div class="bm-facility">
        <div class="bm-icon"><i class="fa-solid fa-fire"></i></div>
        <div>
          <h4>Barbecue dinner by the canal</h4>
          <p>The grill goes on at nine, at one long table.</p>
        </div>
      </div>
      <div class="bm-facility">
        <div class="bm-icon"><i class="fa-solid fa-leaf"></i></div>
        <div>
          <h4>Honest village food</h4>
          <p>Rice that tasted like this in a Dangmari kitchen yesterday.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="bm-section">
  <div class="bm-container bm-split is-reversed">
    <div>
      <img src="{{ asset('assets/bonomali/imagery/walkway-palms.jpg') }}" alt="Walkway through palms at Bonomali" style="width:100%; border-radius: var(--radius-lg);">
    </div>
    <div>
      <span class="bm-eyebrow-num">04</span>
      <span class="t-eyebrow">The village is the host</span>
      <h2 class="bm-heading">Built with Dangmari, not beside it.</h2>
      <p>The kitchen is fed by local boats and fields. The staff and boatmen are neighbours. When you stay, the village stays too: that is the whole idea.</p>
      <a href="{{ route('journal') }}" class="bm-btn bm-btn-primary">Read more in the Journal</a>
    </div>
  </div>
</section>
@endsection
