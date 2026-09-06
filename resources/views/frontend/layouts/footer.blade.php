  <footer class="bm-footer">
    <div class="bm-container">
      <div class="bm-footer-grid">
        <div>
          <div class="bm-footer-logo">
            <img src="{{asset('assets/bonomali/logo/bonomali-logo-reversed.png')}}" alt="Bonomali Mangrove Resort">
          </div>
          <p>A private resort on the edge of the Sundarbans. West Dhangmari, Banishanta, Dacope, Khulna, Bangladesh.</p>
          <p>
            <a href="tel:01991505070">01991 505070</a><br>
            <a href="mailto:bonomalimangroveresort@gmail.com">bonomalimangroveresort@gmail.com</a>
          </p>
        </div>

        <div>
          <h5>Visit</h5>
          <ul>
            <li><a href="{{route('rooms')}}">Cottages</a></li>
            <li><a href="{{route('rooms')}}?type=pod">The pod for groups</a></li>
            <li><a href="{{route('services')}}">Experience</a></li>
            <li><a href="{{route('gallery')}}">Gallery</a></li>
            <li><a href="{{route('contact')}}">Getting here</a></li>
          </ul>
        </div>

        <div>
          <h5>Bonomali</h5>
          <ul>
            <li><a href="{{route('about')}}">Our story</a></li>
            <li><a href="{{route('journal')}}">The Journal</a></li>
            <li><a href="{{route('faq')}}">FAQ</a></li>
            <li><a href="{{route('contact')}}">Contact</a></li>
            <li><a href="{{route('terms')}}">Terms &amp; Conditions</a></li>
          </ul>
        </div>

        <div>
          <h5>Book</h5>
          <ul>
            <li><a href="{{route('contact')}}">Book online</a></li>
            <li><a href="https://wa.me/8801991505070" target="_blank" rel="noopener">WhatsApp us</a></li>
            <li><a href="tel:01991505070">Call</a></li>
            <li><a href="mailto:bonomalimangroveresort@gmail.com">Email us</a></li>
          </ul>
        </div>
      </div>

      <div class="bm-footer-bottom">
        <span class="bm-footer-tagline">Love it from here.</span>
        <span class="bm-footer-copy">&copy; {{ date('Y') }} Bonomali Mangrove Resort</span>
      </div>
    </div>
  </footer>

  @vite(['resources/js/app.js'])
  @stack('scripts')
</body>
</html>
