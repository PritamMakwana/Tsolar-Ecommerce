<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700;800;900&family=Jost:wght@400;500;600;700;800;900&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,500&family=Red+Rose:wght@400;500;600&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('frontend/home/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/Enquiry/style.css') }}">
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- Link to Bootstrap JavaScript (optional if you need Bootstrap JS functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{-- commented because giving issues in all-products page --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script> --}}

    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- slick sider --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    {{-- <title>TSolar - Home</title> --}}
    <title>@yield('title')</title>

    <style>
        /* home header and footer css */
        * {
            padding: 0%;
            margin: 0%;
        }

        a {
            text-decoration: none !important;
        }

        /* PROMO CODE */

        .promo-bar {
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        .promo-button {
            border-radius: 70px;
            background-color: #4DEAFF;
            padding: 1px 20px;
            border: none;
            color: #fff;

            cursor: pointer;
        }

        /* NAVBAR */
        .cart-number {

            background-color: #FFD233;
            color: white;
            border-radius: 50%;
            padding: 1px 5px;
            font-size: 12px;
        }

        .nav-link-cstm {
            font-family: Inter;
            font-weight: 500;


        }

        .navbar-custom-buttons-login {
            background-color: #F6FEFF;
            border: none;
            font-family: Inter;
            font-weight: 500;
            border-radius: 50px;
        }

        .navbar-custom-buttons-signup {
            border-radius: 50px;
            border: none;
            font-family: Inter;
            font-weight: 500;
            background-color: #4DEAFF;
            padding: 5px 10px;
        }

        /* Navbar End */

        /* Navbar Ends Here */

        .home-page-hero-container {
            background-image: url('{{ asset(' frontend/homepage/Images/image 32.png') }}');
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            height: 90vh;
        }

        .home-page-hero-content {
            padding-top: 5%;
            padding-left: 5%;

        }

        .home-page-hero-container h1 {
            font-weight: 700;
            font-size: 4.4vw;
            width: 55%;
            color: #FFFFFF;
            text-align: left;


        }

        @media(max-width:500px) {
            .home-page-hero-container h1 {
                font-size: 12.4vw;
                width: 65%;
            }

        }

        @media screen and (min-width: 500px) and (max-width: 950px) {

            .home-page-hero-container h1 {

                font-size: 8.4vw;
                width: 65%;
            }

            .home-page-hero-content {
                padding-top: 8%;
                padding-left: 5%;
            }
        }

        .btn-custom-hero {
            background-color: #4DEAFF;
            font-family: Poppins;
            font-weight: 500;
            padding: 1% 2%;
            border-radius: 999px;
            color: black;
            margin-top: 2%;
        }

        /* Product Categories Start Here */
        .products-container-main {
            padding: 2.5% 4%;
            background-image: url(./Images/image\ 4.png);
        }

        .mobile-carousel-cstm {
            display: none;
        }

        @media(max-width:755px) {
            .desktop-carousel-cstm {
                display: none;
            }

            .mobile-carousel-cstm {
                display: block;
            }
        }

        .custom-products-card {
            border-radius: 24px;
            height: 50vh;
            position: relative;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            margin-top: 5%;
        }

        .prod1 {
            background-image: url(./Images/Rectangle\ 6015.png);
        }

        .prod2 {
            background-image: url(./Images/Rectangle\ 6017\ \(1\).png);
        }

        .prod3 {
            background-image: url(./Images/image\ 50.png);
        }

        .prod4 {
            background-image: url(./Images/Rectangle\ 6022.png);
        }

        .prod5 {
            background-image: url(./Images/image\ 24.png);
        }

        .prod6 {
            background-image: url(./Images/Rectangle\ 6014.png);
        }

        /* Experimental Code */





        /* Experimental Code */





        .btn-products-custom {
            background-color: #4DEAFF;
            border-radius: 40px;
            font-family: Jost;
            font-weight: 600;
        }

        .card-body-custom {
            position: absolute;
            bottom: 25px;

            left: 50px;
        }

        .card-body-custom h5 {
            color: white;
            font-weight: 400;
            text-align: left;
            font-family: Red Rose;
        }


        /* Enquire Now Starts Here */
        .Enquire_Now-Container {
            background: linear-gradient(to bottom, #FFE76D 50%, black 50%);
            padding: 2.5% 5%;

        }

        .Enquire_Now_Content_Container {
            background-color: #f8f8f8f7;
            border-radius: 6px;
            padding: 2.5%;
        }

        .enquire-now-content h2 {
            font-weight: 700;
            font-size: 2.8rem;
            text-align: left;
        }

        .enquire-now-content p {
            font-weight: 500;
            font-family: Poppins;
            text-align: justified;
            padding-top: 2.5%;
            width: 85%;
        }

        .btn-enquire-now {
            background-color: #4DEAFF;
            border-radius: 40px;
            color: black;
            padding: 1.5% 3%;
            margin-top: 2.5%;
            margin-bottom: 2.5%;
        }



        /* Our Products Start Here */

        .our-products_Container-Main {
            padding: 2% 8%;
            background-image: url(./Images/Rectangle\ 6026.png);
            background-repeat: no-repeat;
            background-position: top;
            background-size: cover;
        }

        .our-product-text {
            padding: 2%;
        }

        .discount {
            border-radius: 20px;
            background-color: #008192;
            color: white;
            font-weight: 600;
            padding: 4px;
            margin-left: 2%;
        }

        .btn-our-pro-custom {
            background-color: #4DEAFF;
            border-radius: 4px;
            padding: 1% 3%;
        }

        /* Blogs Start Here */

        .blogs_container-main {
            background-color: #70EEFF12;
            padding: 2% 8%;
        }

        .blogs-text {
            margin-top: 5%;
        }

        .blogs-purple {
            color: #6941C6;
            font-family: Inter;

        }

        .blogs-text h6 {
            font-family: Inter;
            font-weight: 600;

        }

        .blogs-semi-info {
            font-family: Inter;
            font-weight: 400;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* Limit the text to three lines */
            -webkit-box-orient: vertical;
        }

        /* Testimonials Start Here */
        .testimonials_Container-Main {
            padding: 4% 8%;
        }

        .testimonials-backdrop {
            background: linear-gradient(99.33deg, #FFE1A7 1.26%, rgba(146, 189, 255, 0.22) 38.83%, rgba(166, 136, 231, 0.04) 97.44%);
            border-radius: 24px;
            padding: 2.5% 5%;
        }

        .testimonials-text h1 {
            font-family: Inter;
            font-weight: 500;


        }

        .testimonial-info-container {
            display: flex;
            justify-content: space-between;
            height: 45px;
            margin-top: 5%;
        }

        .testimonial-btn {
            border-radius: 28px;
            background-color: white;
            width: 40px;
            height: 40px;
            border: 1px solid #EAECF0;

        }

        .testimonial-name {
            font-family: Inter;
            font-weight: 600;
        }

        .testimonial-designation {
            font-family: Inter;
            font-weight: 400;
            color: #475467;

        }

        @media(max-width:768px) {
            .testimonials-image {
                margin-top: 5%;
            }

        }

        @media(max-width:378px) {
            .testimonials-image {
                margin-top: 10%;
            }

        }

        /* Contact Us Starts Here */

        .contact-us_Container-Main {
            background-color: #CECECE1C;
            padding: 2.5% 8%;
        }

        .contact-us-heading {
            font-family: Inter;
            font-weight: 600;
        }

        .contact-us-sub-heading {
            font-family: Inter;
            font-weight: 400;
        }

        .btn-contact-us-custom {
            background-color: #4DEAFF;
            width: 100%;
            text-align: center;
            border-radius: 50px;
            color: black;
        }







        /* Footer Code */

        footer a {
            color: #fff;
            text-decoration: none;
            /* Remove underline */
            font-family: Lato;

            font-weight: 400;
            line-height: 15%;
            text-align: left;

        }

        .footer-container {
            padding: 2%;
        }


        /* Footer Submit */

        .footer-search {
            position: relative;
            box-shadow: 0 0 40px rgba(51, 51, 51, .1);
            margin-top: 8%;
        }

        .footer-search input {
            height: 50px;
            text-indent: 25px;
            border-radius: 50px;
        }


        .footer-search input:focus {
            box-shadow: none;
            border: 2px solid #4DEAFF;
        }

        .footer-search .fa-search {

            position: absolute;
            top: 20px;
            left: 16px;

        }

        .footer-search button {
            position: absolute;
            top: 5px;
            right: 5px;
            border: none;
            height: 40px;
            width: 110px;
            background: #4DEAFF;
            border-radius: 50px;
        }


        @media (max-width: 960px) {
            .home-page-hero-container {
                height: 80vh;
            }
        }

        @media (max-width: 840px) {
            .home-page-hero-container {
                height: 70vh;
            }
        }


        @media (max-width: 720px) {
            .home-page-hero-container {
                height: 60vh;
            }
        }

        @media (max-width: 605px) {
            .home-page-hero-container {
                height: 50vh;
            }
        }

        @media (max-width: 490px) {
            .home-page-hero-container {
                height: 40vh;
            }
        }

        /* 605px */
        /* 490 768 */
    </style>

    @yield('style')
    @livewireStyles
</head>

<body>

    @include('frontend.layouts.header')

    @yield('content')

    @include('frontend.layouts.footer')


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    {{-- commented because giving issues in all-products page --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>

    {{-- slick sider --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script src="{{ asset('toastr/toastr.min.js') }}"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>

    @if (Session::has('error'))
    <script>
        toastr.error("{{ Session::get('error') }}");
    </script>
    @endif

    @livewireScripts
    @yield('script')

</body>



</html>
