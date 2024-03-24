@extends('frontend.layouts.app')
@section('content')
    {{-- <div class="Login-Section_Container">
        <div class="row">
            <!-- Left column for the image (60% width) -->
            <div class="col-lg-7 Login-Hero-Backdrop">
                <h1>We delivered more than 4000+ panels succesfully</h1>
            </div>
            <!-- Right column for content (40% width) -->
            <div class="col-lg-5">
                <div class="login_content">
                    <h1>Sign Up</h1>
                    <p>Sign up for free to access to in any of our products</p>
                    <form method="POST" action="{{ route('customer-signup-data') }}" id="registerForm"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3 login-inputs">
                            <label for="name" class="form-label">Enter your name</label>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name"
                                placeholder="Your full name" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="mb-3 login-inputs">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                placeholder="user@gmail.com" name="email" value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="mb-3 login-inputs">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" placeholder="Enter your password" name="password"
                                value="{{ old('password') }}">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 login-inputs">
                            <label for="password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="password_confirmation" name="password_confirmation"
                                value="{{ old('password_confirmation') }}" placeholder="Enter your password again">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="Submit" class="btn btn-custom-login">Continue</button>

                    </form>

                    <div class="mt-3">
                        <p>Already have an account <a style="text-decoration: none;"
                                href="{{ route('customer-login') }}">Log
                                in</a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="">
        <div class="row">
            <!-- Left column for the image (60% width) -->
            <div class="col-lg-7 Login-Hero-Backdrop">
                <h1>We delivered more than 4000+ panels succesfully</h1>
            </div>
            <!-- Right column for content (40% width) -->
            <div class="col-lg-5">
                <div class="login_content">
                    <h1>Sign Up</h1>
                    <p>Sign up for free to access to in any of our products</p>
                    <form method="POST" action="{{ route('customer-signup-data') }}" id="registerForm"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3 login-inputs">
                            <label for="name" class="form-label">Enter your name</label>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name"
                                placeholder="Your full name" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 login-inputs">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                placeholder="user@gmail.com" name="email" value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="mb-3 login-inputs">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" placeholder="Enter your password" name="password"
                                value="{{ old('password') }}">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 login-inputs">
                            <label for="password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="password_confirmation" name="password_confirmation"
                                value="{{ old('password_confirmation') }}" placeholder="Enter your password again">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Login Button (full width) -->
                        <button type="submit" class="btn btn-custom-login">Continue</button>
                    </form>
                    <div class="mt-3">
                        <p>Already have an account <a style="text-decoration: none;"
                                href="{{ route('customer-login') }}">Log in</a> </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        * {
            padding: 0%;
            margin: 0%;
            font-family: 'Inter', sans-serif;
        }

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

        .custom-navbar {
            background-color: #fff;
            border: 1px solid #e5e5e5;
        }

        .custom-navbar .navbar-brand {
            color: #000;
        }

        .custom-navbar .nav-item {
            padding: 0 15px;
        }

        .custom-navbar .btn-signup {
            border-radius: 50px;
            background-color: #4DEAFF;
            color: #fff;
        }

        .custom-navbar .btn-login {
            border-radius: 50px;
            background-color: transparent;
            color: #000;
        }

        /* Navbar Ends Here */

        .Login-Section_Container {
            height: 100vh;
        }

        .login_content {
            padding: 5%;
        }

        .login_content h1 {
            font-weight: 700;
            text-align: left;

        }

        .login_content p {
            font-weight: 500;
            text-align: left;

        }

        .Login-Hero-Backdrop {
            background-image: url("{{ asset('frontend/Login/Rectangle 6065.png') }}");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
        }

        .Login-Hero-Backdrop h1 {
            margin-top: 35%;
            margin-left: 18%;
            font-size: 2.8rem;
            font-family: Red Rose;
            font-weight: 700;
            text-align: left;
            color: white;
            width: 65%;

        }

        .login-inputs label {
            font-weight: 600;
            text-align: left;

        }

        .login-inputs input {
            border-radius: 50px;
            background-color: #FAFAFC;
        }

        .btn-custom-login {
            border-radius: 50px;
            width: 100%;
            color: black;
            background-color: #4DEAFF;
        }

        /* Additional styles for OR line and Google button */
        .or-line {
            margin-top: 20px;
            text-align: center;
        }

        .or-line hr {
            border: none;
            height: 1px;
            background-color: #7E8B9E;
            width: 40%;
            display: inline-block;
        }

        .or-text {
            font-weight: 600;
            margin: 0 10px;
            color: #4D4D4D;
        }

        .google-button {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50px;
            background-color: #fff;
            border: 1px solid #00111A;
            margin-top: 20px;
            padding: 10px;
            cursor: pointer;
        }

        .google-button img {
            margin-right: 10px;
            width: 20px;
            height: 20px;
        }
    </style>
@endsection
