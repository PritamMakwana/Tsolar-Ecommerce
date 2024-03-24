@extends('frontend.layouts.app')

@section('title', 'Tsolar - Profile')

@section('content')
    <div style="padding: 2% 5%;" class="">
        <h2 class="">My Profile</h2>
    </div>

    <!-- PROFILE CODE STARTS HERE -->
    <div class="">

        <div class="img"
            style="    background-image: linear-gradient(150deg, rgba(63, 174, 255, .3)15%, rgba(63, 174, 255, .3)70%, rgba(63, 174, 255, .3)94%), url({{ asset('frontend/userProfile/Images/image.png') }});
height: 350px;background-size: cover;">
        </div>
        <div class=" social-prof">
            <div class="card-body">
                <div class="wrapper123">

                    @if ($profile->image)
                        <img src="{{ asset('Profile_images/' . $profile->image) }}" alt="" class="user-profile">
                    @else
                        <img src="{{ asset('frontend/userProfile/Images/user612x612.jpg') }}" alt=""
                            class="user-profile">
                    @endif




                    <h3>{{ $profile->name }}</h3>
                    <p>{{ $profile->email }}</p>
                </div>
                <div class="profile-content-container">
                    <div class="nav-profile-options">
                        <ul class=" nav nav-tabs ">
                            <li><a id="profile-navitem" class="navvvv active" href="javascript:void(0);"
                                    onclick="showContent('profile')">My Profile</a></li>
                            <li style="margin-left: 2.5%;"><a id="password-navitem" class="navvvv" class=""
                                    href="javascript:void(0);" onclick="showContent('password')">Password</a></li>
                        </ul>
                    </div>
                    <div class="profile-content" data-toggle="profile">
                        <div class="personal-info-banner">
                            <h4>Personal Info</h4>
                            <p>Update your photo and personal details.</p>
                            <hr>
                        </div>
                    </div>
                    <div class="profile-content" data-toggle="profile" class="my-profile-card" style="padding: 1%;">
                        <div class="row card-profile-bx">
                            <div class="col-md-8">
                                <form method="POST" action="{{ route('profile-data') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $profile->id }}">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="Name" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="Full Name" name="name"
                                                value="{{ $profile->name }}" placeholder="Enter your Full name">
                                        </div>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        {{-- <div class="col">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lastName"
                                            placeholder="Enter your last name">
                                    </div> --}}
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="phone" class="form-label">Phone No.</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                <input type="text" class="form-control" id="phone" name="phone"
                                                    value="{{ $profile->phone }}" placeholder="Enter your phone number">
                                            </div>
                                        </div>
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="email" class="form-label">Email Address</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                <input type="email" class="form-control" id="email"
                                                    placeholder="Enter your email address" name="email"
                                                    value="{{ $profile->email }}">
                                            </div>
                                        </div>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="address" class="form-label">Your Address</label>
                                            <textarea class="form-control" id="address" rows="4" placeholder="Enter your address" name="address">{{ $profile->address }}</textarea>
                                        </div>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                            </div>
                            <div class="col-md-4" style="padding:0 4%;">
                                <!-- Upload Profile Pic -->
                                <div class="mb-3" style="text-align: center; align-items: center;">
                                    <p style="color: #344054;font-family: Inter;font-weight: 500;
      " class="mb-1">
                                        Upload Profile Pic</p>
                                    @if ($profile->image)
                                        <img src="{{ asset('Profile_images/' . $profile->image) }}" alt=""
                                            alt="Profile Picture" class="img-fluid rounded-circle" style="width: 150px;">
                                    @else
                                        <img src="{{ asset('frontend/userProfile/Images/user612x612.jpg') }}"
                                            alt="Profile Picture" class="img-fluid rounded-circle" style="width: 150px;">
                                    @endif


                                    {{-- <img src="{{ asset('frontend/userProfile/Images/user612x612.jpg')}}"
                                    alt="Profile Picture" class="img-fluid rounded-circle" style="width: 150px;"> --}}
                                </div>

                                <!-- Upload Box with Icon and Text -->
                                <div class="mb-3">
                                    <div class="d-flex flex-column align-items-center"
                                        style="border: 0.5px solid #0000003D;border-radius: 12px;padding: 5%;">
                                        <div class="mb-2">
                                            <img src="{{ asset('frontend/userProfile/Images/Featured icon.png') }}" />
                                        </div>
                                        <p class="mb-0">SVG, PNG, JPG or GIF (max. 800x400px)</p>
                                        <a>Click to upload</a>
                                        <input type="file" name="image" class="form-control">
                                        @error('image')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Upload Photo Button -->
                                {{-- <div style="display: flex; justify-content: center;">
                                    <button type="button" class="btn-custom-photo-upload">Upload Photo</button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="profile-content" data-toggle="profile">
                    <hr style="border-color: #F87C093D; border-width: 3px;">
                    <div style="display: flex; justify-content: center;margin-top: 2.5%;">
                        <div class="buttons-col">
                            <button class="my-profile-btn update-prof-btn">Update Profile</button>
                            <a href="{{ route('homepage') }}" class="my-profile-btn cancel-prof-btn">Cancel</a>
                        </div>
                    </div>
                </div>


                </form>

            </div>
        </div>
    </div>
    <div class="profile-content" data-toggle="password" style="display: none;">
        <div class="password-content-container">
            <div>
                <div class="personal-info-banner">
                    <h4>Password</h4>
                    <p>Please enter your current password to change your password.</p>
                    <hr>
                </div>
            </div>

            <div>
                <form method="POST" action="{{ route('reset-password-data') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Current Password Row -->
                    <input type="hidden" name="id" value="{{ $profile->id }}">
                    @if (!session()->has('resetPassword'))
                        <div class="form-row">
                            <label class="password-confirm-custom" for="currentPassword">Current Password</label>
                            <input class="password-confirm-custom-field" type="text" id="currentPassword"
                                name="currentPassword">
                        </div>
                        @error('currentPassword')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <hr>
                    @endif

                    <!-- New Password Row -->

                    <div class="form-row">
                        <label class="password-confirm-custom" for="newPassword">New Password</label>
                        <input class="password-confirm-custom-field" type="text" id="newPassword"
                            name="new_password">
                        <p class="pass-constraints" style="margin-left: 26%; width: 50%;">Your new password must be
                            more
                            than 8 characters.</p>
                    </div>
                    @error('new_password')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <hr>


                    <!-- Confirm Password Row -->
                    <div class="form-row">
                        <label class="password-confirm-custom" for="confirmPassword">Confirm Password</label>
                        <input class="password-confirm-custom-field" type="text" id="confirmPassword"
                            name="new_password_confirmation">
                    </div>
                    @error('new_password_confirmation')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <hr>

                    <!-- Submit Button -->
                    <div style="display: flex; justify-content: end;">
                        <a class="cancel-custom-btn-password " href="{{ route('homepage') }}">Cancel</a>
                        <button class="update-custom-btn-password" type="submit">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @if (session('successProfile'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('successProfile') }}',
                    text: 'This change is updated',
                    showConfirmButton: false,
                    timer: 5000 // Set the time duration for the alert to automatically close (in milliseconds)
                });
            });
        </script>
    @endif


    @if (session('successPassword'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('successPassword') }}',
                    text: 'This change is updated',
                    showConfirmButton: false,
                    timer: 5000 // Set the time duration for the alert to automatically close (in milliseconds)
                });
            });
        </script>
    @endif

    <script>
        function showContent(target) {
            if (target === 'profile') {
                document.getElementById('profile-navitem').classList.add('active');
                document.getElementById('password-navitem').classList.remove('active');
            } else {
                document.getElementById('profile-navitem').classList.remove('active');
                document.getElementById('password-navitem').classList.add('active');
            }
            const contentSections = document.querySelectorAll('.profile-content');
            contentSections.forEach(section => {
                const toggleValue = section.getAttribute('data-toggle');
                if (toggleValue === target) {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });
        }
    </script>
    @if (
        $errors->has('currentPassword') ||
            $errors->has('new_password') ||
            $errors->has('new_password_confirmation') ||
            session()->has('resetPassword'))
        <script>
            showContent('password');
        </script>
    @endif
@endsection

@section('style')
    <style>
        * {
            padding: 0;
            margin: 0;

        }

        /* Navbar Start */
        .active-field {
            color: #FFD233;
        }

        /* PROFILE CODE */

        /*social */

        .wrapper123 {
            color: #333;
            text-align: center;
        }

        .wrapper123 {
            width: 70%;
            margin: auto;
            margin-top: -100px;
        }

        .wrapper123 img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 20px;
            border: 5px solid #fff;
            /*border: 10px solid #70b5e6ee;*/
        }

        .wrapper123 h3 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 0;
        }

        .wrapper123 p {
            font-size: 18px;
        }

        .profile-content-container {
            padding: 1% 8%;

        }

        .password-content-container {
            padding: 1% 8%;

        }

        .card-body {
            border: none;
        }

        .my-profile-card {
            border-radius: 12px;
            border: 1px solid #EAECF0;

        }

        .navvvv {
            font-family: Inter;
            font-weight: 600;
            text-decoration: none;
            color: #9C9C9C;
        }

        .navvvv.active {
            color: #667085;
            border-bottom: 5px solid #4DEAFF;
        }

        .personal-info-banner h4 {

            font-family: Inter;
            color: #101828;
            font-weight: 600;


        }

        .personal-info-banner p {
            font-family: Inter;
            color: #475467;
            font-weight: 400;


        }

        .btn-custom-photo-upload {
            font-family: Inter;
            background-color: #4DEAFF3D;
            font-weight: 600;
            border: 0.5px solid #50EBFF;
            border-radius: 50px;
            padding: 3% 5%;

        }


        /* LAST BUTTONS */
        .buttons-col {
            display: flex;
            text-align: center;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 50%;
        }

        .my-profile-btn {
            width: 100%;
            border-radius: 50px;
            gap: 8px;
            padding: 2% 4%;
            border: none;
            margin-bottom: 5%;
            color: black;
            font-family: Inter;

            font-weight: 600;


        }

        .update-prof-btn {
            background-color: #4DEAFF;
        }

        .cancel-prof-btn {
            border: 1px solid #000000;
            background-color: white;
        }

        /* PASSWORD AREA */
        .form-row label {
            width: 25%;
            display: inline-block;
        }

        .password-confirm-custom {
            font-family: Inter;
            font-weight: 500;


        }

        .pass-constraints {
            color: #475467;
            font-family: Inter;
            font-weight: 400;
        }

        .password-confirm-custom-field {
            width: 50%;
            border: 1px solid #D0D5DD;
            border-radius: 8px;
            padding: 0.5% 1%;
            display: inline-block;
        }

        .cancel-custom-btn-password {
            background-color: white;
            border-radius: 8px;
            border: 1px solid #D0D5DD;
            padding: 1% 2%;
            font-family: Inter;
            font-weight: 600;
        }

        .update-custom-btn-password {
            background-color: #4DEAFF;
            border: 1px solid #4DEAFF;
            border-radius: 8px;
            padding: 1% 2%;
            margin-left: 2%;
            font-family: Inter;
            font-weight: 600;


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

        .continue-shopping-cart {
            margin-top: 2%;
            background-color: #4DEAFF;
            border-radius: 50px;
            color: black;
            border: none;
            padding: 1% 2%;
            font-family: Jost;
            font-weight: 500;
        }
    </style>
@endsection
