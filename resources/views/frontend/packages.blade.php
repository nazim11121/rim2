@extends('frontend.layouts.master')

<title>  Packages | Bonomali</title>

@section('content')
    <main>
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-area d-flex align-items-center position-relative bg-img-center lazy1" style="background-image: url({{asset('uploads/frontend/slide1.jpg')}});" >
      <div class="container">
        <div class="breadcrumb-content text-center">
                      <h1>Packages</h1>
          
          <ul class="list-inline">
            <li><a href="{{url('/')}}">Home</a></li>
            <li><i class="fas fa-angle-double-right"></i></li>

                          <li>Packages</li>
                      </ul>
        </div>
      </div>
    </section>
    <!-- Breadcrumb Section End -->

    <section class="packages-area-v1">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <div class="packages-sidebar">
                                    <div class="widget search-widget">
                        <h4 class="widget-title">Categories</h4>
                        <div class="form_group">
                            <ul class="categories">
                                <li class=" active "><a href="#" data-category_id="">All</a></li>
                                                                <li class=""><a href="#" data-category_id="9">Holiday</a></li>
                                                                <li class=""><a href="#" data-category_id="10">Mountains &amp; Hills</a></li>
                                                                <li class=""><a href="#" data-category_id="11">Vacation</a></li>
                                                            </ul>
                        </div>
                    </div>
                              <div class="widget search-widget">
                <h4 class="widget-title">Search Here</h4>
                <div class="form_group">
                  <input
                    type="text"
                    id="searchInput"
                    placeholder="Search By Package Name"
                    value=""
                  >
                </div>
              </div>

              <div class="widget location-widget">
                <h4 class="widget-title">Location Search</h4>
                <div class="form_group">
                  <input
                    type="text"
                    id="locationSearchInput"
                    placeholder="Search By Location"
                    value=""
                  >
                </div>
              </div>

              <div class="widget sortby-widget">
                <h4 class="widget-title">Days</h4>
                <div class="form_group">
                  <select id="days" class="nice-select">
                    <option selected value="">All</option>
                                            <option value="1" >Up to 1 Day</option>
                                            <option value="2" >Up to 2 Days</option>
                                            <option value="3" >Up to 3 Days</option>
                                            <option value="4" >Up to 4 Days</option>
                                            <option value="5" >Up to 5 Days</option>
                                            <option value="6" >Up to 6 Days</option>
                                            <option value="7" >Up to 7 Days</option>
                                            <option value="8" >Up to 8 Days</option>
                                            <option value="9" >Up to 9 Days</option>
                                            <option value="10" >Up to 10 Days</option>
                                      </select>
                </div>
              </div>

              <div class="widget sortby-widget">
                <h4 class="widget-title">Persons</h4>
                <div class="form_group">
                  <select id="persons" class="nice-select">
                    <option selected value="">All</option>
                                            <option value="1" >1 Person &amp; More</option>
                                            <option value="2" >2 Persons &amp; More</option>
                                            <option value="3" >3 Persons &amp; More</option>
                                            <option value="4" >4 Persons &amp; More</option>
                                            <option value="5" >5 Persons &amp; More</option>
                                            <option value="6" >6 Persons &amp; More</option>
                                            <option value="7" >7 Persons &amp; More</option>
                                            <option value="8" >8 Persons &amp; More</option>
                                      </select>
                </div>
              </div>

              <div class="widget sortby-widget">
                <h4 class="widget-title">Sort By</h4>
                <div class="form_group">
                  <select id="sortType" class="nice-select">
                    <option
                      value="new-packages"
                      
                    >New Packages</option>
                    <option
                      value="old-packages"
                      
                    >Old Packages</option>
                    <option
                      value="price-asc"
                      
                    >Price: Ascending</option>
                    <option
                      value="price-desc"
                      
                    >Price: Descending</option>
                    <option
                      value="max-persons-asc"
                      
                    >Maximum Persons: Ascending</option>
                    <option
                      value="max-persons-desc"
                      
                    >Maximum Persons: Descending</option>
                    <option
                      value="days-asc"
                      
                    >Number of Days: Ascending</option>
                    <option
                      value="days-desc"
                      
                    >Number of Days: Descending</option>
                  </select>
                </div>
              </div>

              <div class="widget price_ranger_widget">
                <h4 class="widget-title">Filter By Price</h4>
                <div id="slider-range"></div>
                <label for="amount">Price :</label>
                <input type="text" id="amount" readonly>
              </div>
            </div>
          </div>

          <div class="col-lg-9">
                          <div class="packages-wrapper">
                                  <div class="packages-post-item">
                    <a class="post-thumbnail d-block" href="https://codecanyon8.kreativdev.com/hotelia/demo/package_details/23/fascinating-northeast-with-kalimpong---land-only">
                      <img class="lazy" data-src="https://codecanyon8.kreativdev.com/hotelia/demo/assets/img/packages/1623603327.jpg" alt="img">
                    </a>

                    <div class="entry-content">
                      <h3 class="title">
                        <a href="https://codecanyon8.kreativdev.com/hotelia/demo/package_details/23/fascinating-northeast-with-kalimpong---land-only">Fascinating Northeast with Kalimpong - Land Only</a>
                      </h3>
                      <div class="post-meta">
                        <ul>

                                                      <li><span><i class="fas fa-comment-dollar"></i><strong>Package Price:</strong> $ 200.00  (FIXED)</span></li>
                          
                          <li><span><i class="fas fa-calendar-alt"></i><strong>Number of Days:</strong> 7</span></li>

                          <li><span><i class="fas fa-users"></i><strong>Maximum Persons:</strong> 5</span></li>
                        </ul>
                      </div>
                    </div>

                                                                    <div class="rate">
                            <div class="rating" style="width:100%"></div>
                        </div>
                                      </div>
                                  <div class="packages-post-item">
                    <a class="post-thumbnail d-block" href="https://codecanyon8.kreativdev.com/hotelia/demo/package_details/22/los-angeles---a-la-carte">
                      <img class="lazy" data-src="https://codecanyon8.kreativdev.com/hotelia/demo/assets/img/packages/1623602860.jpg" alt="img">
                    </a>

                    <div class="entry-content">
                      <h3 class="title">
                        <a href="https://codecanyon8.kreativdev.com/hotelia/demo/package_details/22/los-angeles---a-la-carte">Los Angeles - A La Carte</a>
                      </h3>
                      <div class="post-meta">
                        <ul>

                                                      <li><span><i class="fas fa-comment-dollar"></i><strong>Package Price:</strong> $ 40.00  (PER-PERSON)</span></li>
                          
                          <li><span><i class="fas fa-calendar-alt"></i><strong>Number of Days:</strong> 1</span></li>

                          <li><span><i class="fas fa-users"></i><strong>Maximum Persons:</strong> 2</span></li>
                        </ul>
                      </div>
                    </div>

                                                                    <div class="rate">
                            <div class="rating" style="width:0%"></div>
                        </div>
                                      </div>
                                  <div class="packages-post-item">
                    <a class="post-thumbnail d-block" href="https://codecanyon8.kreativdev.com/hotelia/demo/package_details/21/washington---a-la-carte">
                      <img class="lazy" data-src="https://codecanyon8.kreativdev.com/hotelia/demo/assets/img/packages/1623603874.jpg" alt="img">
                    </a>

                    <div class="entry-content">
                      <h3 class="title">
                        <a href="https://codecanyon8.kreativdev.com/hotelia/demo/package_details/21/washington---a-la-carte">Washington - A La Carte</a>
                      </h3>
                      <div class="post-meta">
                        <ul>

                                                      <li><span><i class="fas fa-comment-dollar"></i><strong>Package Price:</strong> NEGOTIABLE</span></li>
                          
                          <li><span><i class="fas fa-calendar-alt"></i><strong>Number of Days:</strong> 10</span></li>

                          <li><span><i class="fas fa-users"></i><strong>Maximum Persons:</strong> 8</span></li>
                        </ul>
                      </div>
                    </div>

                                                                    <div class="rate">
                            <div class="rating" style="width:0%"></div>
                        </div>
                                      </div>
                                  <div class="packages-post-item">
                    <a class="post-thumbnail d-block" href="https://codecanyon8.kreativdev.com/hotelia/demo/package_details/20/san-francisco---a-la-carte">
                      <img class="lazy" data-src="https://codecanyon8.kreativdev.com/hotelia/demo/assets/img/packages/1623602478.jpg" alt="img">
                    </a>

                    <div class="entry-content">
                      <h3 class="title">
                        <a href="https://codecanyon8.kreativdev.com/hotelia/demo/package_details/20/san-francisco---a-la-carte">San Francisco - A La Carte</a>
                      </h3>
                      <div class="post-meta">
                        <ul>

                                                      <li><span><i class="fas fa-comment-dollar"></i><strong>Package Price:</strong> $ 20.00  (PER-PERSON)</span></li>
                          
                          <li><span><i class="fas fa-calendar-alt"></i><strong>Number of Days:</strong> 6</span></li>

                          <li><span><i class="fas fa-users"></i><strong>Maximum Persons:</strong> 4</span></li>
                        </ul>
                      </div>
                    </div>

                                                                    <div class="rate">
                            <div class="rating" style="width:0%"></div>
                        </div>
                                      </div>
                                  <div class="packages-post-item">
                    <a class="post-thumbnail d-block" href="https://codecanyon8.kreativdev.com/hotelia/demo/package_details/19/miami---a-la-carte">
                      <img class="lazy" data-src="https://codecanyon8.kreativdev.com/hotelia/demo/assets/img/packages/1623600032.jpg" alt="img">
                    </a>

                    <div class="entry-content">
                      <h3 class="title">
                        <a href="https://codecanyon8.kreativdev.com/hotelia/demo/package_details/19/miami---a-la-carte">Miami - A La Carte</a>
                      </h3>
                      <div class="post-meta">
                        <ul>

                                                      <li><span><i class="fas fa-comment-dollar"></i><strong>Package Price:</strong> $ 30.00  (PER-PERSON)</span></li>
                          
                          <li><span><i class="fas fa-calendar-alt"></i><strong>Number of Days:</strong> 1</span></li>

                          <li><span><i class="fas fa-users"></i><strong>Maximum Persons:</strong> 3</span></li>
                        </ul>
                      </div>
                    </div>

                                                                    <div class="rate">
                            <div class="rating" style="width:0%"></div>
                        </div>
                                      </div>
                                  <div class="packages-post-item">
                    <a class="post-thumbnail d-block" href="https://codecanyon8.kreativdev.com/hotelia/demo/package_details/18/orlando---ala-carte">
                      <img class="lazy" data-src="https://codecanyon8.kreativdev.com/hotelia/demo/assets/img/packages/1623599575.jpg" alt="img">
                    </a>

                    <div class="entry-content">
                      <h3 class="title">
                        <a href="https://codecanyon8.kreativdev.com/hotelia/demo/package_details/18/orlando---ala-carte">Orlando - Ala Carte</a>
                      </h3>
                      <div class="post-meta">
                        <ul>

                                                      <li><span><i class="fas fa-comment-dollar"></i><strong>Package Price:</strong> $ 180.00  (FIXED)</span></li>
                          
                          <li><span><i class="fas fa-calendar-alt"></i><strong>Number of Days:</strong> 5</span></li>

                          <li><span><i class="fas fa-users"></i><strong>Maximum Persons:</strong> 5</span></li>
                        </ul>
                      </div>
                    </div>

                                                                    <div class="rate">
                            <div class="rating" style="width:0%"></div>
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
                                                                                                <li><a href="https://codecanyon8.kreativdev.com/hotelia/demo/packages?page=2">2</a></li>
                                                                        
            
                            <li class="text-white">
                    <a href="https://codecanyon8.kreativdev.com/hotelia/demo/packages?page=2" rel="next" aria-label="Next &raquo;">&rsaquo;</a>
                </li>
                    </ul>
    </nav>

                </div>
              </div>
                      </div>
        </div>
      </div>
    </section>

    
    <form class="d-none" action="https://codecanyon8.kreativdev.com/hotelia/demo/packages" method="GET">
                <input type="hidden" id="categoryKey" name="category" value="">
        
      <input type="hidden" id="searchKey" name="packageName" value="">

      <input type="hidden" id="daysKey" name="daysValue" value="">

      <input type="hidden" id="personsKey" name="personsValue" value="">

      <input type="hidden" id="sortKey" name="sortValue" value="">

      <input type="hidden" id="locationKey" name="locationName" value="">

      <input type="hidden" id="minPriceKey" name="minPrice" value="">

      <input type="hidden" id="maxPriceKey" name="maxPrice" value="">

      <button type="submit" id="submitBtn"></button>
    </form>
    
  </main>
@endsection