@extends('frontend.layouts.app')
@section('content')
    <div class="">
        <div class="row">
            <!-- Left column for the image (60% width) -->
            <div class="col-lg-7 Login-Hero-Backdrop">
                <h1>We delivered more than 4000+ panels succesfully</h1>
            </div>
            <!-- Right column for content (40% width) -->
            <div class="col-lg-5">
                <div class="login_content">
                    <h1>Hey,</h1>
                    <h1>Welcome Back!</h1>
                    <p>We are very happy to see you back!</p>
                    <form method="POST" action="{{ route('customer-login-data') }}">
                        @csrf
                        <!-- Email Input -->
                        <div class="mb-3 login-inputs">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="Enter your email">
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <!-- Password Input -->
                        <div class="mb-3 login-inputs">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter your password"
                                name="password">
                        </div>

                        <!-- Forgot Password Link -->
                        <div class="mb-3" style="display: flex;justify-content: flex-end;">
                            <a style="text-decoration: none;color: #4D4D4D;" href="{{route('customer-forgot-password')}}">Forgot Password?</a>
                        </div>

                        <!-- Login Button (full width) -->
                        <button type="submit" class="btn btn-custom-login">Login</button>

                        <!-- Remember Me Checkbox -->
                        {{-- <div class="form-check mt-3">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div> --}}

                        <div class="mt-3">
                            <p>Don’t have an account <a style="text-decoration: none;"
                                    href="{{ route('customer-signup') }}">Create new</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('style')
    <style>
        /*sing in */
        .Login-Section_Container {
            height: 90vh;
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
            height: 90vh;
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
