<div class="promo-bar">
    <div class="row" style="align-items: center;">
        <div class="col-12">
            <p style="display: inline;">Get Solar carports & Solar panels at 30% Off</p>
            <button class="promo-button" onclick="window.location='{{route('homepage') . '#contact-us'}}'">Get In Touch!</button>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg" style="background-color: #F6FEFF; margin-top: 1%;">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('homepage') }}">
            <img src="{{ asset('frontend/homepage/Images/logo.jpeg') }}" alt="Your Logo" width="100">
        </a>

        <div class="d-lg-none d-flex justify-content-end align-items-center" style="margin-right: 15px;">
            <!-- Cart Icon for Smaller Screens -->
            <ul class="navbar-nav">
                <li class="nav-item cart-icon">
                    <a class="nav-link pe-3" href="{{ route('cart.index') }}">
                        <i class="fas fa-shopping-cart"></i>
                        @auth('customer')
                            <span class="cart-number">{{ Auth::guard('customer')->user()->cart_count }}</span>
                        @else
                            <span class="cart-number">0</span>
                        @endauth
                    </a>
                </li>
            </ul>

            <!-- Navbar Toggler for Mobile -->
            <button style="border: none;" class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a @if (str_starts_with(Route::currentRouteName(), 'homepage')) style="color: #FFD233;" @endif style="color: black"
                        class="nav-link nav-link-cstm" href="{{ route('homepage') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a @if (str_starts_with(Route::currentRouteName(), 'about-us')) style="color: #FFD233;" @endif style="color: black"
                        class="nav-link nav-link-cstm" href="{{ route('about-us') }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a @if (str_starts_with(Route::currentRouteName(), 'privacy-policy')) style="color: #FFD233;" @endif style="color: black"
                        class="nav-link nav-link-cstm" href="{{ route('privacy-policy') }}">Privacy Policy</a>
                </li>
                <li class="nav-item">
                    <a @if (str_starts_with(Route::currentRouteName(), 'all-products-page')) style="color: #FFD233;" @endif style="color: black"
                        class="nav-link nav-link-cstm" href="{{ route('all-products-page') }}">Our Products</a>
                </li>
                <li class="nav-item">
                    <a @if (str_starts_with(Route::currentRouteName(), 'enquiry-page')) style="color: #FFD233;" @endif style="color: black"
                        class="nav-link nav-link-cstm" href="{{ route('enquiry-page') }}">Solar Carports Enquiry</a>
                </li>
                @auth('customer')
                    <li class="nav-item dropdown  d-lg-none">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> {{ Auth::guard('customer')->user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item"
                                    href="{{ route('profile', ['id' => Auth::guard('customer')->user()->id]) }}">My
                                    Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('order.index') }}">My Orders</a></li>
                            <li><a class="dropdown-item" href="{{ route('customer-logout') }}">Logout <i
                                        class="fas fa-sign-out-alt"></i></a></li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item d-lg-none">
                        <a class="nav-link nav-link-cstm" href="{{ route('customer-login') }}">Login</a>
                    </li>
                    <li class="nav-item d-lg-none">
                        <a class="nav-link nav-link-cstm" href="{{ route('customer-signup') }}">SignUp</a>
                    </li>
                @endauth
            </ul>
        </div>

        <!-- Cart Icon and John Doe for Larger Screens -->
        @auth('customer')
            <div class="d-none d-lg-block">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item cart-icon">
                        <a class="nav-link" href="{{ route('cart.index') }}">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-number">{{ Auth::guard('customer')->user()->cart_count }}</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> {{ Auth::guard('customer')->user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item"
                                    href="{{ route('profile', ['id' => Auth::guard('customer')->user()->id]) }}">My
                                    Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('order.index') }}">My Orders</a></li>
                            <li><a class="dropdown-item" href="{{ route('customer-logout') }}">Logout <i
                                        class="fas fa-sign-out-alt"></i></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        @else
            <div class="d-none d-lg-block">
                <ul class="navbar-nav ml-auto align-items-center">

                    <li class="nav-item cart-icon">
                        <a class="nav-link" href="#">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-number">0</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <button class="navbar-custom-buttons-login"
                            onclick="window.location='{{ route('customer-login') }}'">LOGIN</button>
                        <button class="navbar-custom-buttons-signup"
                            onclick="window.location='{{ route('customer-signup') }}'">SIGN UP</button>
                    </li>

                </ul>
            </div>
        @endauth

    </div>
</nav>
