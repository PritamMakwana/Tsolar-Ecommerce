@extends('frontend.layouts.app')
@section('style')
    <style>
        .slick-prev,
        .slick-next {
            display: none !important;
        }

        .slick-prev-blog,
        .slick-next-blog {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: transparent;
            color: white;
            border-radius: 50%;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 20px;
        }

        .slick-prev-blog {
            left: 30px;
            z-index: 10;
            top: 120px;
        }

        .slick-next-blog {
            right: 30px;
            top: 120px;
        }

        .list-group-item-action:hover {
            background-color: #8f8f8f;
        }


        @media (max-width: 755px) {
            .Ttitle {
                margin-bottom: 10px !important;
            }
        }
    </style>
@endsection


@section('title', 'Tsolar - Home')
@section('content')

    <!-- Navbar Ends Here -->

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">

            @foreach ($banner as $key => $b)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}"
                    class="{{ $key === 0 ? 'active' : '' }}" aria-current="true"
                    aria-label="Banner {{ $key }}"></button>
            @endforeach

        </div>


        <div class="carousel-inner">
            @foreach ($banner as $key => $b)
                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}"
                    style="transition: transform 3s ease, opacity .5s ease-out">
                    @if ($key === 0)
                        @php
                            $c = 'visible';
                        @endphp
                    @else
                        @php
                            $c = 'hidden';
                        @endphp
                    @endif

                    {{-- @if ($key === 0) --}}
                    <livewire:search :b="$b" :visible="$c" />
                    {{-- <div class="home-page-hero-container"
                style="background-image: url('{{ asset('banner_images/' . $b->image) }}') ">
                <div class="home-page-hero-content">
                    <h1>Go solar and make a difference for the planet.</h1>
                    <a href="#ourProduct" class="btn btn-custom-hero">Start Shopping</a>
                    <form action="#" method="GET">
                        <div class="hero-search">
                            <input type="text" id="productSearch" name="query" class="form-control"
                                placeholder="Search for Product">
                            <div id="suggestions"></div>
                            <button class="btn">SEARCH</button>
                        </div>
                    </form>
                </div>
            </div> --}}
                    {{-- @else
            <img src="{{ asset('banner_images/' . $b->image) }}" class="d-block w-100" alt="...">
            @endif --}}

                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <!-- Hero Ends Here -->

    <!-- Product Categories Start Here -->
    <div class="products-container-main">
        <div style="display: flex;justify-content: center;">
            <h1 style="font-weight: 700;
        ">Product Categories</h1>
        </div>

        <section class="pt-5 pb-5">
            <!-- The code below is the same code for 2 different resolutions -->
            <!-- This is for Desktop View -->
            <div class="container desktop-carousel-cstm">
                <div class="row">

                    @php
                        $first = true;
                        $count = 0;
                        $i = 0;
                    @endphp

                    <div class="col-12">
                        <div id="carouselExampleIndicators2" class="carousel slide" data-bs-ride="carousel">

                            <div class="carousel-inner">

                                @while ($i < count($category))
                                    @if ($count == 0 )
                                        <div
                                            class="carousel-item @if ($first) active @php $first = false ; @endphp @endif">
                                            <div class="row">
                                    @endif
                                    <div class="col mb-3">
                                        <div class="card shadow-sm" style="border-radius: 10px;">
                                            <img class="card-img-top" alt="100%x280" height="300px" width="100%"
                                                src="{{ asset('category_thumbnails/' . $category[$i]->image) }}">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $category[$i]->name }}</h5>
                                                <a href="{{ route('all-products-page', ["category[{$category[$i]->id}]" => 'true']) }}"
                                                    class="btn btn-products-custom">Shop Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $count++;
                                    @endphp
                                    @if ($count == 4)
                                            </div>
                                        </div>
                                    @endif

                                    @php
                                        $count = $count % 4 ;
                                        $i++;
                                    @endphp
                                @endwhile

                                @if ($count != 0)
                                        </div>
                                    </div>   
                                @endif
                    </div>
                </div>
            </div>
            @if (count($category) > 4)
                <div class="col-12 text-center">
                    <a class="btn btn-primary mb-3 me-1" href="#carouselExampleIndicators2" role="button"
                        data-bs-slide="prev">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                    <a class="btn btn-primary mb-3" href="#carouselExampleIndicators2" role="button" data-bs-slide="next">
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            @endif
    </div>
    </div>
    <!-- This is for Mobile View -->
    <div class="container mobile-carousel-cstm">
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            @php
                $first = true;
            @endphp
            <div class="carousel-inner">
                @foreach ($category as $cat)
                    <div class="carousel-item @if($first) active @php $first = false; @endphp @endif">
                        <div class="card">
                            <img src="{{ asset('category_thumbnails/' . $cat->image) }}" height="300px"
                                class="card-img-top" alt="Image 1">
                            <div class="card-body">
                                <h5 class="card-title">{{ $cat->name }}</h5>
                                <a href="{{ route('all-products-page', ["category[{$cat->id}]" => 'true']) }}"
                                    class="btn btn-products-custom">Shop Now</a>
                            </div>  
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($category->count() > 1)
                <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            @endif
        </div>
    </div>
    </section>



    </div>

    <!-- Product Categories Ends Here -->
    <!-- Enquire Now -->

    <div class="Enquire_Now-Container">

        <div class="Enquire_Now_Content_Container">
            <div class="row">
                <div class="col-md-8 enquire-now-content">
                    <h2>Power your home with the sun and save money on your energy bill.</h2>
                    <p>Looking for a way to save money on your energy bill? Enquire today about solar panels and learn how
                        you can power your home with the sun.</p>
                    <a class="btn btn-enquire-now" href="{{ route('enquiry-page') }}">Enquire Now</a>
                </div>
                <div class="col-md-4">
                    <img style="border-top-right-radius: 24px; border-bottom-right-radius: 24px;" width="100%"
                        src="{{ asset('frontend/homepage/Images/enquire-now.png') }}" />
                </div>
            </div>
        </div>

    </div>

    <div class="our-products_Container-Main" id="ourProduct">

        <div style="display: flex;justify-content: center;">
            <h1 style="font-weight: 700;
            ">Our Products</h1>
        </div>

        <div class="row ">

            {{-- <div class="col-lg-3 col-md-6 col-sm-12 our-products_content-div">
            <img width="100%" src="./Images/ourpro-1.png" />
            <div class="our-product-text">
                <p>20 V Pv Solar Module</p>
                <p> <strong>$89.00</strong> </p>
            </div>
        </div> --}}

            @foreach ($product as $p)
                <div class="col-lg-3 col-md-6 col-sm-12 our-products_content-div">
                    <a style="text-decoration:none;color:black;" href="{{ route('product', $p->product_id) }}">
                        <img width="100%" height="300" style="border: 1px solid black;border-radius: 10px;"
                            src="{{ asset('Product_thumbnails/' . $p->image) }}" />
                        <div class="our-product-text ">
                            <p>{{ $p->product_name }}</p>
                            <p> <strong>${{ $p->price }}</strong>
                                @if ($p->discount)
                                    <span class="discount"> {{ $p->discount }}
                                        %OFF</span>
                                @endif
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div style="display: flex;justify-content: center;">
            <a href="{{ route('all-products-page') }}" class="btn btn-our-pro-custom">View More -></a>
        </div>

    </div>


    <!-- Products Ends Here -->
    <!-- Blogs Start Here -->

    <div class="blogs_container-main">
        <div style="display: flex;justify-content: center;margin-top: 2.5%;">
            <h1 style="font-weight: 700;
            ">Latest blogs</h1>
        </div>

        <div style="display: flex;justify-content: center;margin-top: 2.5%;">
            <h5 style="font-family: Poppins;font-weight: 500;text-align: left;margin-bottom: 5%;">Take look at these tricks
                & Tips To install panels & security </h5>
        </div>



        <div class="row">
            {{-- <div class="col-md-4 blogs_content-div">
            <img width="100%" src="{{ asset('frontend/homepage/Images/blog1.png')}}" />
            <div class="blogs-text">
                <p class="blogs-purple">How To Install?</p>
                <h6> Review it to add solar panel<button class="">⬈</button></h6>
                <p class="blogs-semi-info">Step by step guide to installing commercial solar panels</p>
            </div>
        </div>
        <div class="col-md-4  blogs_content-div">
            <img width="100%" src="{{ asset('frontend/homepage/Images/blog2.png')}}" />
            <div class="blogs-text">
                <p class="blogs-purple">How to identify solar installer ?</p>
                <h6> Get to know more about installing<button class="">⬈</button></h6>
                <p class="blogs-semi-info">Linear helps streamline software projects, sprints, tasks, and bug tracking.
                    Here’s how to get started.</p>
            </div>
        </div>
        <div class="col-md-4  blogs_content-div">
            <img width="100%" src="{{ asset('frontend/homepage/Images/blog3.png')}}" />
            <div class="blogs-text">
                <p class="blogs-purple">Solar farming</p>
                <h6> What is actually Solar farming?<button class="">⬈</button></h6>
                <p class="blogs-semi-info">Linear helps streamline software projects, sprints, tasks, and bug tracking.
                    Here’s how to get started.</p>
            </div>
        </div> --}}
            <div class="responsiveA">

                @foreach ($blog as $b)
                    <div class="col-md-4  blogs_content-div me-3">
                        <a target="_blank" href="{{ $b->hyperlink }}">
                            <img width="100%" style="height: 200px;border-radius: 15px;
                    "
                                src="{{ asset('blogs_images/' . $b->image) }}" />
                            <div class="blogs-text">
                                {{-- <p class="blogs-purple">{{$b->title}}</p> --}}

                                <h6 class="blogs-purple">{{ $b->title }}</h6>
                                <p class="blogs-semi-info" style="color: black">{{ $b->description }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>



    </div>



    <!-- Blogs End Here -->
    <div class="d-flex justify-content-center mt-3 Ttitle" style="margin-bottom:-35px;">
        <h1>Testimonials</h1>
    </div>
    <!-- Testimonials Start Here -->
    <div class="testimonials-slider ">
        @foreach ($testimonial as $t)
            <div class="testimonial-item">
                <div class="testimonials_Container-Main">
                    <div class="testimonials-backdrop">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 testimonials-text">
                                <h5 class="text-wrap text-break">
                                    {{ $t->description }}
                                    {{-- Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                    dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                    nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,
                                    sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec,
                                    vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                                    Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibu --}}
                                </h5>
                                <div class="testimonial-info-container">
                                    <div style="display: flex; justify-content: space-around">
                                        {{-- <img src="./Images/testimonial-avatar1.png" />
                                <div> --}}
                                        <h4 class="testimonial-name" style="margin-bottom: 0">
                                            -{{ $t->username }}
                                        </h4>
                                        {{-- <p class="testimonial-designation">
                                        Ux Ui designer, India
                                    </p>
                                </div> --}}
                                    </div>
                                    <div style="display: flex; gap: 15%">
                                        <button class="testimonial-btn prev">⇠</button>
                                        <button class="testimonial-btn next">⇢</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 d-flex justify-content-center align-items-center">
                                {{-- style="height: 408px;" --}}
                                <img class="testimonials-image img-fluid" style="width:90%;border-radius:10px"
                                    src="{{ asset('testimonial_images/' . $t->image) }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- <div class="testimonial-item">
        <div class="testimonials_Container-Main">
            <div class="testimonials-backdrop">
                <div class="row">
                    <div class="col-md-6 col-sm-12 testimonials-text">
                        <h1>
                            "Solar panels were the best decision I ever made. I'm saving
                            money every month, and I know I'm helping the planet."
                        </h1>
                        <div class="testimonial-info-container">
                            <div style="display: flex; justify-content: space-around">
                                <img src="./Images/testimonial-avatar1.png" />
                                <div>
                                    <p class="testimonial-name" style="margin-bottom: 0">
                                        AJ Patil
                                    </p>
                                    <p class="testimonial-designation">
                                        Ux Ui designer, India
                                    </p>
                                </div>
                            </div>
                            <div style="display: flex; gap: 15%">
                                <button class="testimonial-btn prev">⇠</button>
                                <button class="testimonial-btn next">⇢</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <img class="testimonials-image" width="100%" src="./Images/testimonial.png" />
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    </div>

    <!-- Contact Us Start Here -->

    <div class="contact-us_Container-Main">
        <div class="row" id="contact-us">
            <div class="col-md-6">
                <h2 class="contact-us-heading">Contact Us</h2>
                <p class="contact-us-sub-heading">Our friendly team would love to hear from you.</p>
                <div class="container mt-5">
                    <form action="{{ route('contact.us') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control" id="firstname" name="firstname"
                                    placeholder="First Name" value="{{ old('firstname') }}">
                                @error('firstname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname"
                                    placeholder="Last Name" value="{{ old('lastname') }}">
                                @error('lastname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 4%;">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Email" value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <!-- <div class="form-group col-md-4">
                                                                                                                            <label for="phoneCode">Phone Code</label>
                                                                                                                            <select class="form-control" id="phoneCode">
                                                                                                                                <option>+91</option>
                                                                                                                                <option>US+1</option>
                                                                                                                            </select>
                                                                                                                        </div> -->
                            <div class="form-group col-md-8" style="margin-top: 4%;">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="Phone Number" value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 4%;">
                            <label for="address">Your Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Your Address" value="{{ old('address') }}">
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-top: 4%;">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="4" placeholder="Leave us a Message">{{ old('message') }}</textarea>
                            @error('message')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group form-check" style="margin-top: 2%;">
                            <input type="checkbox" class="form-check-input" id="privacyPolicy" name="privacyPolicy">
                            <label class="form-check-label" for="privacyPolicy">You agree to our friendly privacy
                                policy.</label>
                            @error('privacyPolicy')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button style="margin-top: 2%;" type="submit" class="btn btn-contact-us-custom">Send
                            Message</button>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d2601.899601590985!2d6.794083576489784!3d49.29724497139496!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNDnCsDE3JzUwLjEiTiA2wrA0Nyc0OC4wIkU!5e0!3m2!1sen!2sin!4v1695117480420!5m2!1sen!2sin"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>

    <!-- Contact Us Ends Here -->
@endsection

@section('script')

    @if ($errors->any())
        <script>
            // scroll to contact us section
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('contact-us').scrollIntoView();
            });
        </script>
    @endif

    @if (session('getIntouch'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('contact-us').scrollIntoView();
            });
        </script>
    @endif

    @if (session('successContact'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('successContact') }}',
                    text: 'You will hear from us soon',
                    showConfirmButton: false,
                    timer: 5000 // Set the time duration for the alert to automatically close (in milliseconds)
                });
            });
        </script>
    @endif

    @if (session('successReturnProduct'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('successReturnProduct') }}',
                    text: 'You will hear from us soon',
                    showConfirmButton: false,
                    timer: 5000 // Set the time duration for the alert to automatically close (in milliseconds)
                });
            });
        </script>
    @endif


    {{-- <script>
    $('#productSearch').on('input', function () {
        let query = $(this).val();
        if (query !== '') {
            $.get("/search", { query: query }, function (data) {
                $("#suggestions").html(data);
            });
        } else {
            $("#suggestions").html('');
        }
    });
</script> --}}

    <script>
        //blog
        $('.responsiveA').slick({
            dots: false,
            infinite: true,
            speed: 1000,
            slidesToShow: 3,
            slidesToScroll: 3,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object

            ],
            prevArrow: '<button type="button" class="slick-prev-blog"><i class="fas fa-chevron-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next-blog"><i class="fas fa-chevron-right"></i></button>'
        });
        $(document).ready(function() {
            $('.testimonials-slider').slick({
                dots: false,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                slidesToScroll: 1,
            });

            // Add event handlers for the prev and next buttons using the same class selector
            $('.prev').on('click', function() {
                $('.testimonials-slider').slick('slickPrev');
            });

            $('.next').on('click', function() {
                $('.testimonials-slider').slick('slickNext');
            });
        });
    </script>


@endsection
