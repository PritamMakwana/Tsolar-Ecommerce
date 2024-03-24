@extends('frontend.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('frontend/checkout/style.css') }}">
    {{-- <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key=AIzaSyBmvEj5i825HG1V64SPjYv3-Zpz0nd2bpg&libraries=places"></script> --}}
@endsection

@section('content')
    <div class="Checkout_Container-Main">
        <h1 class="checkout-heading">Checkout</h1>
    </div>

    <div class="Checkout_Container-Main-Total">
        <div class="row">
            <div class="col-md-6">
                <h3>Checkout</h3>
                <p>Home / Solar Materials / Shopping Cart</p>

                <form action="{{ route('cart.payment') }}" method="POST" id="form1">
                    @csrf
                    <!-- First Name and Last Name -->
                    {{-- <div class="row">
                        <div class="col">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" >
                        </div>
                        <div class="col">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" >
                        </div>
                    </div> --}}

                    {{-- <div class="row mt-3">
                        <!-- Address -->
                        <div class="col">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="new_address" placeholder="Type your address"
                                class="form-control @error('address') is-invalid @enderror">
                            <input type="hidden" id="line1" name="line1">
                            <input type="hidden" id="line2" name="line2">
                            <input type="hidden" id="city" name="city">
                            <input type="hidden" id="state" name="state">
                            <input type="hidden" id="country" name="country">
                            <input type="hidden" id="zip" name="zip">
                            <input type="hidden" id="latitude" name="latitude">
                            <input type="hidden" name="longitude" id="longitude">
                            @error('address')
                                <span class="invalid-feedback text-danger d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @error('country')
                                <span class="invalid-feedback text-danger d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @error('longitude')
                                <span class="invalid-feedback text-danger d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> --}}

                    <div class="row mt-3">
                        <!-- Address -->
                        <div class="col">
                            <label for="address">Address</label>
                            <input type="text" value="{{ $address?->line1 }}" class="form-control" id="address"
                                name="address">
                            @error('address')
                                <span class="invalid-feedback text-danger d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Address 2 (optional) -->
                        <div class="col">
                            <label for="address2">Address 2 (Optional)</label>
                            <input type="text" value="{{ $address?->line2 }}" class="form-control" id="address2"
                                name="address2">
                            @error('address2')
                                <span class="invalid-feedback text-danger d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Country and State -->
                    <div class="row mt-3">
                        <div class="col">
                            <label for="country">Country</label>
                            <select class="form-select" id="country" name="country">
                                <option value="" disabled selected>Select Country</option>
                                @foreach ($countries as $data)
                                    <option value="{{ $data->name }}" @if ($address?->country == $data->name) selected @endif>
                                        {{ $data->name }}</option>
                                @endforeach
                            </select>
                            @error('country')
                                <span class="invalid-feedback text-danger d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="state">State</label>
                            <select class="form-select" id="state" name="state">
                                <option value="">Select State</option>
                                <!-- Add state options here -->
                            </select>
                            @error('state')
                                <span class="invalid-feedback text-danger d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Zip Code -->
                    <div class="form-group mt-3">
                        <label for="zipCode">Zip Code</label>
                        <input type="text" class="form-control" value="{{ $address?->zip }}" id="zipCode"
                            name="zipcode">
                        @error('zipcode')
                            <span class="invalid-feedback text-danger d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

            </div>
            <div class="col-md-6" style="padding: 2%;">
                <div class=" grandtotal-window-main">
                    <div class="">
                        @foreach ($cart as $data)
                            <div class="mb-3">
                                <div class="">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-row align-items-center">
                                            <div>
                                                <img src="{{ asset('Product_images/' . $data->products->image) }}"
                                                    class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                            </div>
                                            <div class="ms-3 check-pro-details">
                                                <h5>{{ $data->products->product_name }}</h5>
                                                <p class="small mb-0">{{ $data->products->brand->brand_name }}</p>
                                                <p class="small mb-0">material : {{ $data->products->material }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row ">
                                            <div style="width: 80px; " class="check-pro-details">
                                                <h4 class="mb-0">${{ $data->products->price }}</h4>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="cart[]" value="{{ $data->id }}">
                        @endforeach
                        <?php $total = 0; ?>
                        <hr>
                        <table class="table table-borderless custom-table d-none d-sm-block"
                            style="background-color: transparent;">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Shipping</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $data)
                                    <tr>
                                        <td>{{ $data->products->product_name }}</td>
                                        <td>{{ $data->quantity }}</td>
                                        <td>${{ $data->products->price }}</td>
                                        <td>${{ $data->products->shipping }}</td>
                                        <td>${{ $data->products->price * $data->quantity + $data->products->shipping }}
                                        </td>
                                    </tr>
                                    <?php $total += $data->products->price * $data->quantity + $data->products->shipping; ?>
                                @endforeach
                                <hr>
                                <tr style="border-top: 1px solid black;">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <th>Grand Total : </th>
                                    <th>${{ $total }}</th>
                                </tr>
                            </tbody>
                        </table>

                        <div class="border border-div">
                            <div class="border border-div ">
                                <div>

                                    <!-- these are for small screens -->
                                    <div class="d-block d-sm-none">
                                        <table class="table">
                                            <tr>
                                                <th>Item</th>
                                                @foreach ($cart as $data)
                                                    <td>{{ $data->products->product_name }}</td>
                                                @endforeach
                                            </tr>

                                            <tr>
                                                <th>QTY</th>
                                                @foreach ($cart as $data)
                                                    <td>{{ $data->quantity }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th>Shipping</th>
                                                @foreach ($cart as $data)
                                                    <td>{{ $data->products->shipping }}</td>
                                                @endforeach
                                            </tr>

                                            <tr>
                                                <th>Price</th>
                                                @foreach ($cart as $data)
                                                    <td>{{ $data->total }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th>Total Price</th>
                                                <th>{{ $total }}</th>
                                            </tr>
                                            <hr>

                                            <!-- Add more rows as needed -->
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="proceed-checkout" data-bs-toggle="modal"
                        data-bs-target="#successModal">Pay Now</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- <script src="{{ asset('frontend/checkout/address.js') }}"></script> --}}

    <script>
        $(document).ready(function() {

            var state = "{{ $address->state ?? '' }}";

            function country_change() {
                var countryID = $(this).val();
                if (countryID) {
                    $.ajax({
                        type: "GET",
                        headers: {
                            "Authorization": "Bearer {{ $auth }}",
                            "Accept": "application/json"
                        },
                        url: "https://www.universal-tutorial.com/api/states/" + countryID,
                        success: function(res) {
                            if (res) {
                                $("#state").empty();
                                $("#state").append('<option selected disabled >Select State</option>');

                                // for each loop
                                $.each(res, function(key, value) {
                                    console.log(value.state_name);

                                    if (value.state_name == state) {
                                        $("#state").append('<option value="' + value
                                            .state_name +
                                            '" selected>' + value.state_name + '</option>');
                                        state = null;
                                    } else {

                                        $("#state").append('<option value="' + value
                                            .state_name +
                                            '">' + value.state_name + '</option>');
                                    }
                                });

                            } else {
                                $("#state").empty();
                            }
                        }
                    });
                } else {
                    $("#state").empty();
                    $("#city").empty();
                }
            }

            $('#country').change(country_change);

            @if ($address?->country != null)
                $('#country').trigger('change');
            @endif

        });
    </script>
@endsection
