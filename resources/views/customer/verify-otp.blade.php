@extends('frontend.layouts.app')

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

        .otp-input {
            border: none;
            border-bottom: 2px solid transparent;
            border-radius: 0px;
            font-size: 1.1rem;
            padding: 5px;
            outline: none !important;
            font-weight: 600;
            text-align: center;


        }

        input:active,
        input:focus {
            outline: 0px !important;
            box-shadow: none !important;
            border-bottom: 2px solid red !important;
            outline: none !important;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }


        #OTP_Div {
            display: grid;
            grid-template-columns: repeat(5, 20%);
            grid-gap: 10px;
            padding: 5%;
        }
    </style>
@endsection

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
                    <h1>Enter your email</h1>
                    <p>So that we can send you an OTP to verify it's you!</p>

                    <section id="OTP_Section" class="text-center" style="margin-top: 10%">
                        <div class="container text-center bg-white rounded-lg shadow-lg p-3">
                            <div class="alert alert-danger" role="alert" style="display: none;" id='alert_box'>
                                All fields are required!
                            </div>
                            <form action="{{ route('verify-otp-post') }}" id="form" method="POST">
                                @csrf
                                <div id="OTP_Div" class="d-flex justify-content-center">
                                    <input style="background-color: rgba(122, 240, 255,0.1);" autofocus
                                        class="form-control otp-input" onkeyup="alter_box(this.id)" maxlength="1" required
                                        type="number" id="o1" name="otp1" />
                                    <input style="background-color: rgba(122, 240, 255,0.1);" class="form-control otp-input"
                                        required maxlength="1" type="number" id="o2"
                                        onkeyup="alter_box(this.id)" name="otp2" />
                                    <input style="background-color: rgba(122, 240, 255,0.1);" class="form-control otp-input"
                                        required maxlength="1" type="number" id="o3"
                                        onkeyup="alter_box(this.id)" name="otp3" />
                                    <input style="background-color: rgba(122, 240, 255,0.1);" class="form-control otp-input"
                                        required maxlength="1" type="number" id="o4"
                                        onkeyup="alter_box(this.id)" name="otp4" />
                                    <input style="background-color: rgba(122, 240, 255,0.1);" class="form-control otp-input"
                                        required maxlength="1" type="number" id="o5"
                                        onkeyup="alter_box(this.id)" name="otp5" />
                                    <input style="background-color: rgba(122, 240, 255,0.1);" class="form-control otp-input"
                                        required maxlength="1" type="number" id="o6"
                                        onkeyup="alter_box(this.id)" name="otp6"/>
                                </div>
                                <div class="container text-center">
                                    <button type="submit" class="btn btn-custom-login mt-4" id="sendOtpButton"
                                        onclick="verifyOTP()">Send OTP</button>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var otpSent = false;

        function alter_box(id) {
            var id_num = parseInt(id.split('')[1]);
            var key = event.keyCode || event.charCode;
            if (key === 8 || key === 46) {
                if (id_num != 1) {
                    var prev = 'o' + (id_num - 1).toString();
                    console.log(id_num, prev);
                    document.getElementById(prev).focus();
                }
            } else {
                var id_num = parseInt(id.split('')[1]);
                if (id_num != 6) {
                    var next = 'o' + (id_num + 1).toString();
                    document.getElementById(next).focus();
                }
            }
        }

        function verifyOTP() {
            // prevent form submission
            event.preventDefault();

            var o1 = document.getElementById('o1').value;
            var o2 = document.getElementById('o2').value;
            var o3 = document.getElementById('o3').value;
            var o4 = document.getElementById('o4').value;
            var o5 = document.getElementById('o5').value;
            var o5 = document.getElementById('o6').value;

            var alert_box = document.getElementById('alert_box');
            if (o1 != "" && o2 != "" && o3 != "" && o4 != "" && o5 != "" && o6 != "") {
                var otp = parseInt(o1 + o2 + o3 + o4 + o5 + o6);
                alert_box.style.display = 'none';
                // submit form now 
                document.getElementById('form').submit();
            } else {
                alert_box.style.display = 'block';
            }
        }
    </script>
@endsection
