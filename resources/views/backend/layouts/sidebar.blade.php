<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">TSolar Web App</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->role->role_name }} Dashboard</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            {{-- <i class="right fas fa-angle-left"></i> --}}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('show-categories') }}"
                        class="nav-link {{ Request::is('category*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Category
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('show-products') }}"
                        class="nav-link {{ Request::is('product*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-inbox"></i>
                        <p>
                            Product
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('brand.show') }}"
                        class="nav-link @if (str_starts_with(Route::currentRouteName(), 'brand.')) active @endif">
                        <i class="nav-icon fas fa-industry"></i>
                        <p>
                            Brands
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('tags.index') }}"
                        class="nav-link @if (str_starts_with(Route::currentRouteName(), 'tags.')) active @endif">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>
                            Tags
                        </p>
                    </a>
                </li>

                @if (auth()->user()->role->role_name == 'Admin')
                    {{-- <li class="nav-item">
                        <a href="{{ route('show-user') }}"
                            class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                            </p>
                        </a>
                    </li> --}}
                @endif

                <li class="nav-item">
                    <a href="{{ route('show-customers') }}"
                        class="nav-link {{ Request::is('customers*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Customers
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('contactus.show') }}"
                        class="nav-link @if (str_starts_with(Route::currentRouteName(), 'contactus.')) active @endif">
                        <i class="nav-icon fas fa-phone"></i>
                        <p>
                            Contact Us
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('enquiry.show') }}"
                        class="nav-link @if (str_starts_with(Route::currentRouteName(), 'enquiry.')) active @endif">
                        <i class="nav-icon fas fa-address-book"></i>
                        <p>
                            Enquiry
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('order.show') }}"
                        class="nav-link @if (str_starts_with(Route::currentRouteName(), 'order.')) active @endif">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Orders
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('return-product.show') }}"
                        class="nav-link @if (str_starts_with(Route::currentRouteName(), 'return-product.')) active @endif">
                        <i class="nav-icon fas fa-undo"></i>
                        <p>
                           Return Product
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('news-letter.show') }}"
                        class="nav-link
                        @if (str_starts_with(Route::currentRouteName(), 'news-letter.')) active @endif">
                        <i class="nav-icon fas fa-adjust"></i>
                        <p>
                           News Letter
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('blog.show') }}"
                        class="nav-link
                        @if (str_starts_with(Route::currentRouteName(), 'blog')) active @endif">
                        <i class="nav-icon fas fa-address-card"></i>
                        <p>
                           Blog
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('testimonial.show') }}"
                        class="nav-link
                        @if (str_starts_with(Route::currentRouteName(), 'testimonial')) active @endif">
                        <i class="nav-icon fas fa-comment"></i>
                        <p>
                            Testimonial
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('gallery.show') }}"
                        class="nav-link
                        @if (str_starts_with(Route::currentRouteName(), 'gallery.')) active @endif">
                        <i class="nav-icon fas fa-image"></i>
                        <p>
                            Gallery
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('banner.show') }}"
                        class="nav-link
                        @if (str_starts_with(Route::currentRouteName(), 'banner.')) active @endif">
                        <i class="nav-icon fas fa-laptop"></i>
                        <p>
                            Banner
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('about-us.show') }}"
                        class="nav-link
                        @if (str_starts_with(Route::currentRouteName(), 'about-us.')) active @endif">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            About Us
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('privacy-policy.show') }}"
                        class="nav-link
                        @if (str_starts_with(Route::currentRouteName(), 'privacy-policy.')) active @endif">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Privacy Policy
                        </p>
                    </a>
                </li>


            </ul>

            <!-- Logout Link -->
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
