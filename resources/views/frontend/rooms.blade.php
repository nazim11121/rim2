@extends('frontend.layouts.master')

<title>  Rooms | Bonomali</title>

@section('content')
    <main>
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-area d-flex align-items-center position-relative bg-img-center lazy1" style="background-image: url({{asset('uploads/frontend/slide1.jpg')}})">
      <div class="container">
        <div class="breadcrumb-content text-center">
                      <h1>Rooms</h1>
          
          <ul class="list-inline">
            <li><a href="https://codecanyon8.kreativdev.com/hotelia/demo">Home</a></li>
            <li><i class="fas fa-angle-double-right"></i></li>

                          <li>Rooms</li>
                      </ul>
        </div>
      </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- All Rooms Section Start -->
    <section class="rooms-warp list-view section-bg section-padding">
      <div class="container">

        <div class="row">
                        <div class="col-12">
              <div class="filter-view">
                <ul>
                    <li  class="active-f-view" ><a href="https://codecanyon8.kreativdev.com/hotelia/demo/rooms">All</a></li>
                                        <li ><a href="https://codecanyon8.kreativdev.com/hotelia/demo/rooms?category=9">Regular Room</a></li>
                                        <li ><a href="https://codecanyon8.kreativdev.com/hotelia/demo/rooms?category=10">Deluxe Room</a></li>
                                        <li ><a href="https://codecanyon8.kreativdev.com/hotelia/demo/rooms?category=11">Suite</a></li>
                                    </ul>
              </div>
            </div>
            
          <div class="col-lg-8">
      <div class="row">
              <div class="col-md-6">
          <!-- Single Room -->
          <div class="single-room">
            <a class="room-thumb d-block" href="https://codecanyon8.kreativdev.com/hotelia/demo/room_details/43/hotel-shalimar-motijheel---centre-of-city">
              <img class="lazy" data-src="https://codecanyon8.kreativdev.com/hotelia/demo/assets/img/rooms/1640079042.jpg" alt="room">
              <div class="room-price">
                <p>$ 20.00  / Night</p>
              </div>
            </a>

            <div class="room-desc">
                                <div class="room-cat">
                  <a class="d-block p-0" href="https://codecanyon8.kreativdev.com/hotelia/demo/rooms?category=10">Deluxe Room</a>
                </div>
                              <h4>
                <a href="https://codecanyon8.kreativdev.com/hotelia/demo/room_details/43/hotel-shalimar-motijheel---centre-of-city">Hotel Shalimar Motijheel - Centre of City</a>
              </h4>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
              <ul class="room-info">
                <li><i class="far fa-bed"></i>4 Beds</li>
                <li><i class="far fa-bath"></i>3 Baths</li>
                                <li><i class="far fa-users"></i>3 Guests</li>
                              </ul>
                                              <div class="rate">
                    <div class="rating" style="width:80%"></div>
                </div>
                          </div>

          </div>
        </div>
              <div class="col-md-6">
          <!-- Single Room -->
          <div class="single-room">
            <a class="room-thumb d-block" href="https://codecanyon8.kreativdev.com/hotelia/demo/room_details/40/radisson-hotel-new-york-times-square">
              <img class="lazy" data-src="https://codecanyon8.kreativdev.com/hotelia/demo/assets/img/rooms/1623651255.jpg" alt="room">
              <div class="room-price">
                <p>$ 80.00  / Night</p>
              </div>
            </a>

            <div class="room-desc">
                                <div class="room-cat">
                  <a class="d-block p-0" href="https://codecanyon8.kreativdev.com/hotelia/demo/rooms?category=10">Deluxe Room</a>
                </div>
                              <h4>
                <a href="https://codecanyon8.kreativdev.com/hotelia/demo/room_details/40/radisson-hotel-new-york-times-square">Radisson Hotel New York Times Square</a>
              </h4>
              <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some</p>
              <ul class="room-info">
                <li><i class="far fa-bed"></i>3 Beds</li>
                <li><i class="far fa-bath"></i>2 Baths</li>
                                <li><i class="far fa-users"></i>6 Guests</li>
                              </ul>
                                              <div class="rate">
                    <div class="rating" style="width:80%"></div>
                </div>
                          </div>

          </div>
        </div>
              <div class="col-md-6">
          <!-- Single Room -->
          <div class="single-room">
            <a class="room-thumb d-block" href="https://codecanyon8.kreativdev.com/hotelia/demo/room_details/39/hilton-garden-inn-nyc-financial-centermanhattan-downtown">
              <img class="lazy" data-src="https://codecanyon8.kreativdev.com/hotelia/demo/assets/img/rooms/1623650898.jpg" alt="room">
              <div class="room-price">
                <p>$ 120.00  / Night</p>
              </div>
            </a>

            <div class="room-desc">
                                <div class="room-cat">
                  <a class="d-block p-0" href="https://codecanyon8.kreativdev.com/hotelia/demo/rooms?category=9">Regular Room</a>
                </div>
                              <h4>
                <a href="https://codecanyon8.kreativdev.com/hotelia/demo/room_details/39/hilton-garden-inn-nyc-financial-centermanhattan-downtown">Hilton Garden Inn NYC Financial Center/Manhat...</a>
              </h4>
              <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some</p>
              <ul class="room-info">
                <li><i class="far fa-bed"></i>3 Beds</li>
                <li><i class="far fa-bath"></i>3 Baths</li>
                                <li><i class="far fa-users"></i>8 Guests</li>
                              </ul>
                                              <div class="rate">
                    <div class="rating" style="width:0%"></div>
                </div>
                          </div>

          </div>
        </div>
              <div class="col-md-6">
          <!-- Single Room -->
          <div class="single-room">
            <a class="room-thumb d-block" href="https://codecanyon8.kreativdev.com/hotelia/demo/room_details/38/cambria-hotel-new-york---chelsea">
              <img class="lazy" data-src="https://codecanyon8.kreativdev.com/hotelia/demo/assets/img/rooms/1623650701.jpg" alt="room">
              <div class="room-price">
                <p>$ 70.00  / Night</p>
              </div>
            </a>

            <div class="room-desc">
                                <div class="room-cat">
                  <a class="d-block p-0" href="https://codecanyon8.kreativdev.com/hotelia/demo/rooms?category=9">Regular Room</a>
                </div>
                              <h4>
                <a href="https://codecanyon8.kreativdev.com/hotelia/demo/room_details/38/cambria-hotel-new-york---chelsea">Cambria Hotel New York - Chelsea</a>
              </h4>
              <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</p>
              <ul class="room-info">
                <li><i class="far fa-bed"></i>4 Beds</li>
                <li><i class="far fa-bath"></i>2 Baths</li>
                                <li><i class="far fa-users"></i>10 Guests</li>
                              </ul>
                                              <div class="rate">
                    <div class="rating" style="width:0%"></div>
                </div>
                          </div>

          </div>
        </div>
              <div class="col-md-6">
          <!-- Single Room -->
          <div class="single-room">
            <a class="room-thumb d-block" href="https://codecanyon8.kreativdev.com/hotelia/demo/room_details/37/the-gallivant-times-square">
              <img class="lazy" data-src="https://codecanyon8.kreativdev.com/hotelia/demo/assets/img/rooms/1623650538.jpg" alt="room">
              <div class="room-price">
                <p>$ 100.00  / Night</p>
              </div>
            </a>

            <div class="room-desc">
                                <div class="room-cat">
                  <a class="d-block p-0" href="https://codecanyon8.kreativdev.com/hotelia/demo/rooms?category=11">Suite</a>
                </div>
                              <h4>
                <a href="https://codecanyon8.kreativdev.com/hotelia/demo/room_details/37/the-gallivant-times-square">The Gallivant Times Square</a>
              </h4>
              <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some</p>
              <ul class="room-info">
                <li><i class="far fa-bed"></i>5 Beds</li>
                <li><i class="far fa-bath"></i>3 Baths</li>
                                <li><i class="far fa-users"></i>1 Guest</li>
                              </ul>
                                              <div class="rate">
                    <div class="rating" style="width:0%"></div>
                </div>
                          </div>

          </div>
        </div>
              <div class="col-md-6">
          <!-- Single Room -->
          <div class="single-room">
            <a class="room-thumb d-block" href="https://codecanyon8.kreativdev.com/hotelia/demo/room_details/36/hilton-new-york-fashion-district">
              <img class="lazy" data-src="https://codecanyon8.kreativdev.com/hotelia/demo/assets/img/rooms/1623650331.jpg" alt="room">
              <div class="room-price">
                <p>$ 20.00  / Night</p>
              </div>
            </a>

            <div class="room-desc">
                                <div class="room-cat">
                  <a class="d-block p-0" href="https://codecanyon8.kreativdev.com/hotelia/demo/rooms?category=10">Deluxe Room</a>
                </div>
                              <h4>
                <a href="https://codecanyon8.kreativdev.com/hotelia/demo/room_details/36/hilton-new-york-fashion-district">Hilton New York Fashion District</a>
              </h4>
              <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout</p>
              <ul class="room-info">
                <li><i class="far fa-bed"></i>4 Beds</li>
                <li><i class="far fa-bath"></i>3 Baths</li>
                                <li><i class="far fa-users"></i>9 Guests</li>
                              </ul>
                                              <div class="rate">
                    <div class="rating" style="width:0%"></div>
                </div>
                          </div>

          </div>
        </div>
          </div>
    <div class="row">
      <div class="col-12">
          <nav class="pagination-wrap">
        <ul class="pagination">
            
                            <li class="disabled text-white" aria-disabled="true" aria-label="&laquo; Previous">
                    <a aria-hidden="true">&lsaquo;</a>
                </li>
            
            
                            
                
                
                                                                                        <li class="active text-white" aria-current="page"><a>1</a></li>
                                                                                                <li><a href="https://codecanyon8.kreativdev.com/hotelia/demo/rooms?page=2">2</a></li>
                                                                        
            
                            <li class="text-white">
                    <a href="https://codecanyon8.kreativdev.com/hotelia/demo/rooms?page=2" rel="next" aria-label="Next &raquo;">&rsaquo;</a>
                </li>
                    </ul>
    </nav>

      </div>
  </div>
</div>

          <div class="col-lg-4">
  <div class="sidebar-wrap">
    <div class="widget fillter-widget">
      <h4 class="widget-title">Filters</h4>
      <form action="https://codecanyon8.kreativdev.com/hotelia/demo/rooms" method="GET">
                <input type="hidden" name="category" value="">
                <div class="input-wrap">
          <label for=""><strong>Check In / Out Date</strong></label>
          <input type="text" placeholder="Dates" id="date-range" name="dates" value="" readonly>
        </div>

        <div class="input-wrap">
          <label for=""><strong>Beds</strong></label>
          <select class="nice-select" name="beds">
            <option selected value="">All</option>

                          <option value="1" >1</option>
                          <option value="2" >2</option>
                          <option value="3" >3</option>
                          <option value="4" >4</option>
                          <option value="5" >5</option>
                      </select>
        </div>

        <div class="input-wrap">
          <label for=""><strong>Baths</strong></label>
          <select class="nice-select" name="baths">
            <option selected value="">All</option>

                          <option value="1" >1</option>
                          <option value="2" >2</option>
                          <option value="3" >3</option>
                      </select>
        </div>

        <div class="input-wrap">
          <label for=""><strong>Guests</strong></label>
          <select class="nice-select" name="guests">
            <option selected value="">All</option>

                          <option value="1" >1</option>
                          <option value="2" >2</option>
                          <option value="3" >3</option>
                          <option value="4" >4</option>
                          <option value="5" >5</option>
                          <option value="6" >6</option>
                          <option value="7" >7</option>
                          <option value="8" >8</option>
                          <option value="9" >9</option>
                          <option value="10" >10</option>
                      </select>
        </div>

        <div class="input-wrap">
          <label for=""><strong>Sort By</strong></label>
          <select class="nice-select" name="sort_by">
            <option  value="desc">Latest Rooms</option>
            <option  value="asc">Oldest Rooms</option>
            <option  value="price-asc">Rent: Low to High</option>
            <option  value="price-desc">Rent: High to Low</option>
          </select>
        </div>

        <div class="input-wrap">
            <label for=""><strong>Rent / Night (USD)</strong></label>
          <div class="price-range-wrap">
            <div class="slider-range">
              <div id="price-range-slider"></div>
            </div>

            <div class="price-ammount">
              <input type="text" id="amount" name="rents" readonly/>
            </div>
          </div>
        </div>

        <div class="input-wrap">
          <div class="checkboxes">
                                          <p class="d-block">
                  <input type="checkbox" name="ammenities[]" value="10" id="amm10" >
                  <label for="amm10">Free Wifi</label>
                </p>
                                                        <p class="d-block">
                  <input type="checkbox" name="ammenities[]" value="11" id="amm11" >
                  <label for="amm11">Parking</label>
                </p>
                                                        <p class="d-block">
                  <input type="checkbox" name="ammenities[]" value="12" id="amm12" >
                  <label for="amm12">Family Rooms</label>
                </p>
                                                        <p class="d-none show-more">
                  <input type="checkbox" name="ammenities[]" value="13" id="amm13" >
                  <label for="amm13">Non Smoking Rooms</label>
                </p>
                                                        <p class="d-none show-more">
                  <input type="checkbox" name="ammenities[]" value="14" id="amm14" >
                  <label for="amm14">Gym / Fitness Centre</label>
                </p>
                                                        <p class="d-none show-more">
                  <input type="checkbox" name="ammenities[]" value="15" id="amm15" >
                  <label for="amm15">Pets Allowed</label>
                </p>
                                                        <p class="d-none show-more">
                  <input type="checkbox" name="ammenities[]" value="16" id="amm16" >
                  <label for="amm16">Tea/Coffee Maker in All Rooms</label>
                </p>
                          
                          <div class="more-ammenities">
                <a href="#">More Amenities...</a>
              </div>
                      </div>
        </div>

        <div class="input-wrap">
          <button type="submit" class="btn filled-btn btn-block">
            Filter Rooms <i class="far fa-long-arrow-right"></i>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

        </div>

      </div>
    </section>
    <!-- All Rooms Section Start -->
  </main>
@endsection