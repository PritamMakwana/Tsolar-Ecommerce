<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Send OTP</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ route('login') }}" class="h2" style="white-space:nowrap;"><b>TSolar Web App</b></a>


                {{-- @if (session('message')) --}}

                <div style="display: none;" class="alert alert-danger alert-dismissible fade show m-2" role="alert"
                    id="message_error">
                    <span style="white-space:nowrap;" id="message_er"></span>

                </div>
                {{-- @endif --}}


                <div style="display: none" class="alert alert-success alert-dismissible fade show m-2" role="alert"
                    id="message_success" style="white-space:nowrap;font-size: 100px;">
                    <span style="white-space:nowrap;" id="message_s"></span>
                </div>

            </div>

            <div class="card-body">
                <p class="login-box-msg">Enter the OTP sent to your email here</p>
                <form method="post" id="verificationForm">
                    @csrf

                    {{-- <p id="message_error" style="color:red;"></p>
                    <p id="message_success" style="color:green;"></p> --}}

                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="input-group mb-2">
                        <input id="otp" type="number" class="form-control @error('otp') is-invalid @enderror"
                            name="otp" value="{{ old('otp') }}" autocomplete="otp" autofocus>
                        {{-- <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div> --}}


                        @error('otp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror



                    </div>
                    <div class="d-flex justify-content-end">
                        <p style="color:blue" class="time"></p>
                    </div>

                    {{-- <div class="input-group-append">
                        <div class="input-group-text text-primary ">
                        </div>
                    </div> --}}
                    <div class="row">
                        {{-- <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div> --}}
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block"
                                style="margin-left:115%;">Submit</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="d-flex justify-content-center mt-2">
                        <p class="text-primary" id="resendOtpVerification">Resend OTP</p>
                    </div>




                </form>


                {{-- <p class="mb-1">
                    <a href="{{ route('password.request') }}">I forgot my password</a>
                </p> --}}
                {{-- <p class="mb-0">
                    <a href="{{ route('login') }}" class="text-center">resend otp </a>
                </p> --}}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
</body>

</html>

<script>
    $(document).ready(function() {

        var error_mes = document.getElementById('message_error');
        var success_mes = document.getElementById('message_success');

        $('#verificationForm').submit(function(e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('send-otp-data') }}",
                type: "POST",
                data: formData,
                success: function(res) {
                    if (res.success) {
                        // Display a Toastr success message
                        toastr.success("OTP has been verified");

                        // Redirect the user to the next page after a delay
                        setTimeout(function() {
                            window.location.href = res.url;
                        }, 2000);
                    } else {
                        error_mes.style.display = 'block';
                        $('#message_er').text(res.msg);
                        setTimeout(() => {
                            $('#message_er').text('');
                            error_mes.style.display = 'none';

                        }, 3000);
                    }
                }
            });

        });

        $('#resendOtpVerification').click(function() {
            $(this).text('Wait...');
            var userMail = @json($email);

            $.ajax({
                url: "{{ route('resend-otp-data') }}",
                type: "GET",
                data: {
                    email: userMail
                },
                success: function(res) {
                    $('#resendOtpVerification').text('Resend OTP');
                    if (res.success) {
                        timer();
                        success_mes.style.display = 'block';
                        $('#message_s').text(res.msg);
                        setTimeout(() => {
                            $('#message_s').text('');
                            success_mes.style.display = 'none';
                        }, 3000);
                    } else {
                        error_mes.style.display = 'block';
                        $('#message_er').text(res.msg);
                        setTimeout(() => {
                            $('#message_er').text('');
                            error_mes.style.display = 'none';

                        }, 3000);
                    }
                }
            });

        });
    });

    function timer() {
        var seconds = 30;
        var minutes = 1;

        var timer = setInterval(() => {

            if (minutes < 0) {
                $('.time').text('');
                clearInterval(timer);
            } else {
                let tempMinutes = minutes.toString().length > 1 ? minutes : '0' + minutes;
                let tempSeconds = seconds.toString().length > 1 ? seconds : '0' + seconds;

                $('.time').text(tempMinutes + ':' + tempSeconds);
            }

            if (seconds <= 0) {
                minutes--;
                seconds = 59;
            }

            seconds--;

        }, 1000);
    }

    timer();
</script>
