<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Bonomali Mangrove Resort — a private resort on the edge of the Sundarbans at Dangmari, Khulna. Four AC couple cottages and a group pod, each with a balcony, a swing and a canal view.">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'Bonomali Mangrove Resort')</title>

  <link rel="shortcut icon" type="image/png" href="{{asset('assets/bonomali/logo/bonomali-logo.png')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  @vite(['resources/css/frontend.css'])
  @stack('styles')
</head>
<body>

  <header class="bm-header">
    <div class="bm-header-topbar">
      <div class="bm-container">
        <div>
          <a href="tel:01991505070"><i class="fas fa-phone-alt"></i> 01991 505070</a>
          &nbsp;&middot;&nbsp;
          <span>Dangmari, Khulna, Bangladesh</span>
        </div>
        <div class="bm-social">
          <a href="https://www.facebook.com" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>
          <a href="https://wa.me/8801991505070" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i></a>
          <a href="https://www.instagram.com" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </div>

    <div class="bm-header-bar">
      <a class="bm-logo" href="{{url('/')}}">
        <img src="{{asset('assets/bonomali/logo/bonomali-logo.png')}}" alt="Bonomali Mangrove Resort">
      </a>

      <button class="bm-mobile-toggle" type="button" onclick="document.getElementById('bmNav').classList.toggle('is-open')" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>

      <ul class="bm-nav" id="bmNav">
        <li><a href="{{url('/')}}" class="{{ request()->routeIs('home') ? 'is-active' : '' }}">Home</a></li>
        <li><a href="{{route('rooms')}}" class="{{ request()->routeIs('rooms') ? 'is-active' : '' }}">Cottages</a></li>
        <li><a href="{{route('services')}}" class="{{ request()->routeIs('services') ? 'is-active' : '' }}">Experience</a></li>
        <li><a href="{{route('packages')}}" class="{{ request()->routeIs('packages') ? 'is-active' : '' }}">Packages</a></li>
        <li><a href="{{route('gallery')}}" class="{{ request()->routeIs('gallery') ? 'is-active' : '' }}">Gallery</a></li>
        <li><a href="{{route('journal')}}" class="{{ request()->routeIs('journal*') ? 'is-active' : '' }}">Journal</a></li>
        <li><a href="{{route('about')}}" class="{{ request()->routeIs('about') ? 'is-active' : '' }}">About</a></li>
        <li><a href="{{route('contact')}}" class="{{ request()->routeIs('contact') ? 'is-active' : '' }}">Contact</a></li>
      </ul>

      <div class="bm-header-actions">
        <a href="{{route('rooms')}}#booking-widget" class="bm-btn bm-btn-primary bm-btn-sm">Book now</a>
      </div>
    </div>
  </header>
