      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="{{url('/dashboard')}}" class="logo">
              <img
                src="{{asset('uploads/frontend/logo.jpg')}}"
                alt="navbar brand"
                class="navbar-brand"
                height="20"
              />
              <h5 class="mx-3 mt-3 text-white">Bornomala</h5>
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item active">
                <a
                  data-bs-toggle="collapse"
                  href="#dashboard"
                  class="collapsed"
                  aria-expanded="false"
                >
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Components</h4>
              </li>

              <li class="nav-item {{ Request::is('checkIn*','admin.checkIn.index','checkIn.create','checkIn.edit','checkIn.page1.create','checkIn.page2.create') ? 'active' : '' }}">
                  <a data-bs-toggle="collapse" href="#checkIn" aria-expanded="{{ Request::is('checkIn*') ? 'true' : 'false' }}">
                      <i class="fas fa-layer-group"></i>
                      <p>Booking Management</p>
                      <span class="caret"></span>
                  </a>
                  <div class="collapse {{ Request::is(['checkIn*','admin.checkIn.index','admin.checkIn.create','admin.checkIn.edit','admin.checkIn.page1.create','admin.checkIn.page2.create']) ? 'show' : '' }}" id="checkIn">
                      <ul class="nav nav-collapse">
                          <li class="{{ Request::routeIs(['admin.checkIn.index','admin.checkIn.create','admin.checkIn.edit']) ? 'active' : '' }}">
                              <a href="{{ route('admin.checkIn.index') }}">
                                  <span class="sub-item">CheckIn List</span>
                              </a>
                          </li>
                          <li class="{{ Request::routeIs(['admin.checkout.list','admin.checkIn.create']) ? 'active' : '' }}">
                              <a href="{{ route('admin.checkout.list') }}">
                                  <span class="sub-item">CheckOut List</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>

              <li class="nav-item {{ Request::is('package*') ? 'active' : '' }}">
                  <a data-bs-toggle="collapse" href="#package" aria-expanded="{{ Request::is('package*') ? 'true' : 'false' }}">
                      <i class="fas fa-layer-group"></i>
                      <p>Package Management</p>
                      <span class="caret"></span>
                  </a>
                  <div class="collapse {{ Request::is(['package*','admin.package.index','admin.package.create','admin.package.edit']) ? 'show' : '' }}" id="package">
                      <ul class="nav nav-collapse">
                          <li class="{{ Request::routeIs(['admin.package.index','admin.package.create','admin.package.edit']) ? 'active' : '' }}">
                              <a href="{{ route('admin.package.index') }}">
                                  <span class="sub-item">All</span>
                              </a>
                          </li>
                          <li class="{{ Request::routeIs(['admin.package.category.index','package.category.create','package.category.edit']) ? 'active' : '' }}">
                              <a href="{{ route('admin.package-category.index') }}">
                                  <span class="sub-item">Category</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>

              <li class="nav-item {{ Request::is('room*') ? 'active' : '' }}">
                  <a data-bs-toggle="collapse" href="#room" aria-expanded="{{ Request::is('room*') ? 'true' : 'false' }}">
                      <i class="fas fa-layer-group"></i>
                      <p>Room Management</p>
                      <span class="caret"></span>
                  </a>
                  <div class="collapse {{ Request::is(['room*','admin.room.index','admin.room.create','admin.room.edit','admin.type.index','admin.type.create','admin.type.edit','admin.amenities.index','admin.amenities.create','admin.amenities.edit']) ? 'show' : '' }}" id="room">
                      <ul class="nav nav-collapse">
                          <li class="{{ Request::routeIs(['admin.room.index','admin.room.create','admin.room.edit']) ? 'active' : '' }}">
                              <a href="{{ route('admin.room.index') }}">
                                  <span class="sub-item">Room List</span>
                              </a>
                          </li>
                          <li class="{{ Request::routeIs(['admin.type.index','admin.type.create','admin.type.edit']) ? 'active' : '' }}">
                              <a href="{{ route('admin.type.index') }}">
                                  <span class="sub-item">Room Type List</span>
                              </a>
                          </li>
                          <li class="{{ Request::routeIs(['admin.amenities.index','admin.amenities.create','admin.amenities.edit']) ? 'active' : '' }}">
                              <a href="{{ route('admin.amenities.index') }}">
                                  <span class="sub-item">Amenities List</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>

              <li class="nav-item {{ Request::is('house-keeping*') ? 'active' : '' }}">
                  <a data-bs-toggle="collapse" href="#house-keeping" aria-expanded="{{ Request::is('house-keeping*') ? 'true' : 'false' }}">
                      <i class="fas fa-layer-group"></i>
                      <p>House Keeping</p>
                      <span class="caret"></span>
                  </a>
                  <div class="collapse {{ Request::is(['house-keeping*','admin.house-keeping.index','admin.house-keeping.create','admin.house-keeping.edit']) ? 'show' : '' }}" id="house-keeping">
                      <ul class="nav nav-collapse">
                          <li class="{{ Request::routeIs(['admin.house-keeping.index','admin.house-keeping.create','admin.house-keeping.edit']) ? 'active' : '' }}">
                              <a href="{{ route('admin.house-keeping.index') }}">
                                  <span class="sub-item">All</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>

              <li class="nav-item {{ Request::is('laundry*') ? 'active' : '' }}">
                  <a data-bs-toggle="collapse" href="#laundry" aria-expanded="{{ Request::is('laundry*') ? 'true' : 'false' }}">
                      <i class="fas fa-layer-group"></i>
                      <p>Laundry</p>
                      <span class="caret"></span>
                  </a>
                  <div class="collapse {{ Request::is(['laundry*','admin.laundry.index','admin.laundry.create','admin.laundry.edit']) ? 'show' : '' }}" id="laundry">
                      <ul class="nav nav-collapse">
                          <li class="{{ Request::routeIs(['admin.laundry.index','admin.laundry.create','admin.laundry.edit']) ? 'active' : '' }}">
                              <a href="{{ route('admin.laundry.index') }}">
                                  <span class="sub-item">All</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>

              <li class="nav-item {{ Request::is('food-management*') ? 'active' : '' }}">
                  <a data-bs-toggle="collapse" href="#food-management" aria-expanded="{{ Request::is('food-management*') ? 'true' : 'false' }}">
                      <i class="fas fa-layer-group"></i>
                      <p>Food Management</p>
                      <span class="caret"></span>
                  </a>
                  <div class="collapse {{ Request::is(['food-management*','admin.food-management.index','admin.food-management.create','admin.food-management.edit','admin.food-management.dining.list','admin.dining.create']) ? 'show' : '' }}" id="food-management">
                      <ul class="nav nav-collapse">
                          <li class="{{ Request::routeIs(['admin.food-management.index','admin.food-management.create','admin.food-management.edit']) ? 'active' : '' }}">
                              <a href="{{ route('admin.food-management.index') }}">
                                  <span class="sub-item">Food List</span>
                              </a>
                          </li>
                          <li class="{{ Request::routeIs(['admin.food-management.dining.list','admin.dining.create','admin.dining.edit']) ? 'active' : '' }}">
                              <a href="{{ route('admin.food-management.dining.list') }}">
                                  <span class="sub-item">Dining</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>

              <li class="nav-item {{ Request::is('vendors*') ? 'active' : '' }}">
                  <a data-bs-toggle="collapse" href="#vendor" aria-expanded="{{ Request::is('vendors*') ? 'true' : 'false' }}">
                      <i class="fas fa-layer-group"></i>
                      <p>Vendors</p>
                      <span class="caret"></span>
                  </a>
                  <div class="collapse {{ Request::is(['vendors*','admin.vendors.index','admin.vendors.create','admin.vendors.edit']) ? 'show' : '' }}" id="vendor">
                      <ul class="nav nav-collapse">
                          <li class="{{ Request::routeIs(['admin.vendors.index','admin.vendors.create','admin.vendors.edit']) ? 'active' : '' }}">
                              <a href="{{ route('admin.vendors.index') }}">
                                  <span class="sub-item">All</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>

              <li class="nav-item {{ Request::is('account*') ? 'active' : '' }}">
                  <a data-bs-toggle="collapse" href="#account" aria-expanded="{{ Request::is('account*') ? 'true' : 'false' }}">
                      <i class="fas fa-layer-group"></i>
                      <p>Account</p>
                      <span class="caret"></span>
                  </a>
                  <div class="collapse {{ Request::is(['account*','admin.expense.index']) ? 'show' : '' }}" id="account">
                      <ul class="nav nav-collapse">
                          <li class="{{ Request::routeIs(['admin.expense.index']) ? 'active' : '' }}">
                              <a href="{{ route('admin.expense.index') }}">
                                  <span class="sub-item">Expense</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>

              <li class="nav-item {{ Request::is('report*','admin.report.index','admin.report.expense') ? 'active' : '' }}">
                  <a data-bs-toggle="collapse" href="#reports" aria-expanded="{{ Request::is('report*') ? 'true' : 'false' }}">
                      <i class="fas fa-layer-group"></i>
                      <p>Report</p>
                      <span class="caret"></span>
                  </a>
                  <div class="collapse {{ Request::is(['report*','admin.report.index','admin.report.expense']) ? 'show' : '' }}" id="reports">
                      <ul class="nav nav-collapse">
                          <li class="{{ Request::routeIs(['admin.report.income']) ? 'active' : '' }}">
                              <a href="{{ route('admin.report.income') }}">
                                  <span class="sub-item">Income</span>
                              </a>
                          </li>
                          <li class="{{ Request::routeIs(['admin.report.expense']) ? 'active' : '' }}">
                              <a href="{{ route('admin.report.expense') }}">
                                  <span class="sub-item">Expense</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>

              <li class="nav-item {{ Request::is('frontend*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#frontend" aria-expanded="{{ Request::is('frontend*') ? 'true' : 'false' }}">
                  <i class="fas fa-layer-group"></i>
                  <p>Frontend</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse {{ Request::is(['frontend*','slider*','admin.slider.index','admin.slider.create','admin.slider.edit']) ? 'show' : '' }}" id="frontend">
                  <ul class="nav nav-collapse">
                    <!-- <li>
                      <a href="{{route('menu.index')}}">
                        <span class="sub-item">Menu</span>
                      </a>
                    </li> -->
                    <li class="{{ Request::routeIs(['admin.slider.index','admin.slider.create','admin.slider.edit']) ? 'active' : '' }}">
                      <a href="{{route('admin.slider.index')}}">
                        <span class="sub-item">Slider</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                  <i class="fas fa-layer-group"></i>
                  <p>Logout</p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->