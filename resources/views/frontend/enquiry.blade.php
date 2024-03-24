@extends('frontend.layouts.app')
@section('title', 'Tsolar - Solar Carports')
@section('style')
    <style>
        /* HERO CODE STARTS HERE */

    .hero-backdrop {
        background-image: url('{{asset('frontend/Enquiry/Images/Rectangle 6069.png')}}');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }

        .hero_container {
            padding: 8% 4%;
        }

        .hero_container h1 {
            font-family: Red Rose;
            font-weight: 700;
            font-size: 3.8rem;
            width: 90vw;
            text-align: left;
            color: #ccffda;
        }

        .hero_container h5 {
            font-family: Poppins;
            font-weight: 400;
            padding-top: 2.5%;
            font-size: 1.4rem;
            width: 80vw;
            text-align: left;
            color: #ffffff;
        }

        .hero_container a {
            background-color: #ffffff00;
            border-radius: 4px;
            border: 1px solid #4deaff;
            padding: 5px 10px;
            margin-top: 3%;
            color: #4deaff;
        }

        /* BELOW HERO */

        .below-hero-backdrop {
            background-color: #312a23;
            padding: 2.5%;
        }

        .custom-box {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2%;
            width: 280px;
        }

        .custom-center {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .custom-box h3 {
            font-family: Red Rose;
            font-weight: 700;
        }

        .custom-box p {
            font-family: Red Rose;
            font-weight: 400;
        }

        .yellow-box-card {
            background-color: #ffd249;
        }

        .white-box-card {
            margin-top: 2%;
            background-color: #e5e5e5;
        }

        .green-box-card {
            background-color: #d1ffde;
            margin-top: 2%;
        }

        .below-box-content h1 {
            color: white;
            font-family: Red Rose;
            font-weight: 700;
            text-align: left;
        }

        /* Enquire Now */

        .enquire-now-backdrop {
            padding: 2% 5%;
        }

        .enquire-now-content h1 {
            font-family: Red Rose;
            font-weight: 700;
        }

        .form-heading h3 {
            font-family: Inter;
            font-weight: 600;
        }

        .form-heading h5 {
            font-family: Inter;
            font-weight: 400;
            color: #475467;
        }

        .fill-out h4 {
            font-family: Red Rose;
            font-weight: 400;
            margin-top: 2.5%;
            margin-bottom: 2.5%;
        }

        .white-enquire-form {
            box-shadow: 0px 4px 82px 0px #00000014;
            padding: 2.5%;
            margin-top: 2.5%;
            border-radius: 12px;
        }

        .btn-custom-send {
            width: 90%;
            background-color: #4deaff;
            color: #111111;
            font-family: Jost;
            font-weight: 500;
            border-radius: 50px;
        }

        /* Our Movements */
        .our-moments_Container {
            padding: 2.5% 8%;
        }

        .our-moments_Container h1 {
            font-family: Red Rose;
            font-weight: 700;
        }

        .mov {
            width: 100%;
        }
    </style>
@endsection
@section('content')

    <div class="hero-backdrop">
        <div class="hero_container">
            <h1>A clean, renewable energy source that's good for your wallet and the planet</h1>
            <h5>Enquire now and learn how you can harness the power of the sun and save money on your energy bill</h5>
            <a href="#enquiry-us-form1">Enquiry Now</a>
        </div>
    </div>


    <div class="below-hero-backdrop" style="margin-top: 2.5%;">
        <div class="row">
            <div class="col-md-8 below-box-content">
                <h1>
                    Do Something Incredible Now...! "Donate today, make a difference tomorrow"
                </h1>
                <div style="display: flex; flex-direction: column; align-items: flex-end;">
                    <div class="yellow-box-card custom-box">
                        <h3>20k+</h3>
                        <p>Children are back to school</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 custom-center">
                <div class="white-box-card custom-box">
                    <h3>20k+</h3>
                    <p>Children are back to school</p>
                </div>
                <div class="green-box-card custom-box">
                    <h3>20k+</h3>
                    <p>Children are back to school</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Enquire Now -->

<div class="enquire-now-backdrop" id="enquiry-us-form1">
    <div class="enquire-now-content custom-center">
        <h1>Enquiry Now</h1>
        <div class="white-enquire-form">
            <div class="form-heading custom-center">
                <h3>Having some requirements ? Reach out to us </h3>
                <h5>Our team will get in touch with you.</h5>
            </div>
            <div class="fill-out">
                <h4>Fill out this form</h4>
            </div>
            <form action="{{ route('enquiry-data') }}" method="POST" id="enquiry-us-form">
                @csrf
                <div class="row">
                    <div class=" col-md-6 mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" placeholder="Enter your first name"
                            name="firstname" value="{{old('firstname')}}">
                        @error('firstname')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Enter your last name"
                            name="lastname" value="{{old('lastname')}}">
                        @error('lastname')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email"
                            name="email" value="{{ old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phoneNumber" placeholder="Enter your phone number"
                            name="phone" value="{{ old('phone') }}">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Your Address</label>
                        <input type="text" class="form-control" id="address" placeholder="Enter your address"
                            name="address" value="{{ old('address') }}">
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="4" placeholder="Enter your message" name="message">{{ old('message') }}</textarea>
                        @error('message')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="privacyPolicyCheck" name="privacyPolicy">
                        <label class="form-check-label" for="privacyPolicyCheck">You agree to our friendly <span
                                style="text-decoration: underline;">privacy policy</span> </label>

                        @error('privacyPolicy')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="custom-center">
                        <button type="submit" class="btn btn-custom-send">Send Message</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

<!-- Our Movements -->

<div class="our-moments_Container custom-center">
    <h1>Our Movements</h1>
    <div class="row">
        @foreach ($gallery as $g)
        <div class="col-md-4 col-sm-6">
            <img class="mov p-1" style="height: 300px;border-radius: 15px;" src="{{asset('gallery_images/'. $g->image)}}" />
        </div>
        @endforeach
    </div>
</div>


@endsection

@section('script')

    @if ($errors->any())
        <script>
            // scroll to contact us section
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('enquiry-us-form').scrollIntoView();
            });
        </script>
    @endif




    @if (session('successEnquiry'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('successEnquiry') }}',
                    text: 'You will hear from us soon',
                    showConfirmButton: false,
                    timer: 5000 // Set the time duration for the alert to automatically close (in milliseconds)
                });
            });
        </script>
    @endif
@endsection
