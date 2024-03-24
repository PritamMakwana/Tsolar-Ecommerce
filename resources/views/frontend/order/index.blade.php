@extends('frontend.layouts.app')

@section('style')
    <style>
        * {
            padding: 0;
            margin: 0;

        }

        /* Navbar Start */
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
            padding: 5px 10px;
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
        }

        /* Navbar End */

        /* ORDERS CODE */
        .order-items-container-main {
            margin-bottom: 2.5%;
        }

        .orders-container {
            padding: 0% 8%;
        }

        .orders-data-card {
            border-radius: 12px;
            padding: 2%;
            border: 0.5px solid #0000006B;
        }

        .orders-custom-btn-yellow {
            font-family: Jost;
            font-weight: 500;
            color: #111111;
            background-color: #FFD233;
            border-radius: 50px;
            padding: 2.5% 5%;
            margin-left: 8%;
            margin-top: 5%;
            border: none;
        }

        .orders-custom-btn-blue {
            font-family: Jost;
            font-weight: 500;
            color: #111111;
            background-color: #4DEAFF;
            border-radius: 50px;
            padding: 2.5% 5%;
            margin-top: 5%;
            margin-left: 8%;
            border: none;
        }

        .orders-product-item-num {
            font-family: Jost;
            color: #3C4242;
            font-weight: 600;

        }

        .orders-product-item-subtotal {
            font-family: Jost;
            color: #807D7E;
            font-weight: 600;
            margin-top: 5%;

        }

        .orders-product-name {
            font-family: Jost;
            color: #3C4242;
            font-weight: 600;


        }

        .orders-product-specifications {
            font-family: Jost;
            color: #7B7B7B;
            font-weight: 600;


        }

        @media(max-width:768px) {
            .orders-product-name {
                margin-top: 5%;
            }
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

        /* MODAL */

        .modal-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        /* Style the success message */


        .modal-custom-button {
            background-color: #4DEAFF;
            border-radius: 50px;
            width: 100%;
            border: none;
            padding: 2% 4%;
            color: black;
            margin-top: 5%;
            font-family: Jost;
            font-weight: 500;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('order/style.css') }}">
@endsection

@section('title', 'My Orders')

@section('content')
    <div class="d-flex flex-column m-3 m-md-5 ">

        <div class="d-flex flex-column">
            <h2 class="custom-text-color">Your Orders</h2>
            <p class="custom-p-text mt-2">Each details about your orders is listed below</p>
        </div>

        {{-- <div class="d-flex flex-column mt-5 border  Order-details custom-rounded-div">
            <div class="d-flex flex-wrap justify-content-between align-items-center p-3">
                <div class="d-flex justify-content-start align-items-center mb-2 mb-md-0 fontOrderid">
                    Order ID : &nbsp;<span class="font-black">Tsolar 2323</span>
                </div>
                <div class="d-flex flex-wrap">
                    <div class="border shadow-sm d-flex justify-content-center align-items-center p-2 me-1 rounded">
                        Total Amount to be paid : &nbsp <span class="font"> $234.21</span>
                    </div>
                    <div class="border shadow-sm d-flex justify-content-center align-items-center p-2 me-1 rounded">
                        Items included : <span class="font">&nbsp03</span>
                    </div>
                </div>
            </div>

            <div class="border-bottom ms-4 me-4">
            </div>

            <div class="d-flex flex-column m-3">

                <div class="d-flex flex-column flex-md-row justify-content-between">
                    <div class="item-container-1">
                        <h4 class="m-2"> #1 </h4>
                        <div class="">
                            <img src="/public/4-390x520.jpg.png" alt="" style="width: 150px; height: 150px;"
                                class="custom-rounded-image p-1">
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-start ms-2">
                            <h6 class="m-0 p-0">Solar panel Cleaning brushes</h6>
                            <p class="m-0 p-0 detailsbold">kenbrook</p>
                            <p class="m-0 p-0 detailsbold">Brush material: <span class="detailsnormal">Nylon</span></p>
                            <p class="m-0 p-0 detailsbold">Qauntity <span class="detailsnormal">2 At</span></p>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-end justify-content-center px-3">
                        <p class="detailspriceinfo">Item Number : <span class="detailsprice">21212334</span></p>
                        <p class="detailsprice">Subtotal : <span class="font">$64.00</span></p>
                    </div>
                </div>
                <div class="d-flex flex-column flex-md-row justify-content-between">
                    <div class="item-container-1">
                        <h4 class="m-2"> #1 </h4>
                        <div class="">
                            <img src="/public/4-390x520.jpg.png" alt="" style="width: 150px; height: 150px;"
                                class="custom-rounded-image p-1">
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-start ms-2">
                            <h6 class="m-0 p-0">Solar panel Cleaning brushes</h6>
                            <p class="m-0 p-0 detailsbold">kenbrook</p>
                            <p class="m-0 p-0 detailsbold">Brush material: <span class="detailsnormal">Nylon</span></p>
                            <p class="m-0 p-0 detailsbold">Qauntity <span class="detailsnormal">2 At</span></p>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-end justify-content-center px-3">
                        <p class="detailspriceinfo">Item Number : <span class="detailsprice">21212334</span></p>
                        <p class="detailsprice">Subtotal : <span class="font">$64.00</span></p>
                    </div>
                </div>
                <div class="d-flex flex-column flex-md-row justify-content-between">
                    <div class="item-container-1">
                        <h4 class="m-2"> #1 </h4>
                        <div class="">
                            <img src="/public/4-390x520.jpg.png" alt="" style="width: 150px; height: 150px;"
                                class="custom-rounded-image p-1">
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-start ms-2">
                            <h6 class="m-0 p-0">Solar panel Cleaning brushes</h6>
                            <p class="m-0 p-0 detailsbold">kenbrook</p>
                            <p class="m-0 p-0 detailsbold">Brush material: <span class="detailsnormal">Nylon</span></p>
                            <p class="m-0 p-0 detailsbold">Qauntity <span class="detailsnormal">2 At</span></p>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-end justify-content-center px-3">
                        <p class="detailspriceinfo">Item Number : <span class="detailsprice">21212334</span></p>
                        <p class="detailsprice">Subtotal : <span class="font">$64.00</span></p>
                    </div>
                </div>




                <div class="d-flex justify-content-end align-items-end">
                    <div
                        class="border m-2 py-2 px-4 custom-rounded-full y d-flex justify-content-center align-items-center">
                        Track Order</div>
                    <div
                        class="border m-2 py-2 px-4 custom-rounded-full b d-flex justify-content-center align-items-center">
                        Return</div>
                </div>

            </div>
        </div> --}}

        @foreach ($orders as $ord)
            <div>
                <div class="d-flex flex-column mt-5 border  Order-details custom-rounded-div">

                    <div class="d-flex flex-wrap justify-content-between align-items-center p-3">
                        <div class="d-flex justify-content-start align-items-center mb-2 mb-md-0 fontOrderid">
                            Order ID : &nbsp<span class="font-black">{{ $ord->order_id }}</span>
                        </div>
                        <div class="d-flex flex-wrap">
                            <div class="border shadow-sm d-flex justify-content-center align-items-center p-2 me-2 rounded">
                                Total Amount : &nbsp <span class="font"> ${{ $ord->total }}</span>
                            </div>
                            <div class="border shadow-sm d-flex justify-content-center align-items-center p-2 me-2 rounded">
                                Items : <span class="font">&nbsp;{{ $ord->cart()->count() }}</span>
                            </div>
                        </div>
                    </div>
                    @if ($ord->bunch)
                        @foreach ($ord->cart as $data)
                            <div class="d-flex flex-column m-3">
                                <div class="d-flex flex-column flex-md-row justify-content-between">
                                    <div class="item-container-1">
                                        <h4 class="m-2"> #{{ $loop->iteration }} </h4>
                                        <div class="">
                                            <img src="{{ asset('Product_thumbnails/' . $data->products->image) }}"
                                                alt="" style="width: 150px; height: 150px;"
                                                class="custom-rounded-image p-1">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center align-items-start ms-2">
                                            <h6 class="m-0 p-0">{{ $data->products->product_name }}</h6>
                                            <p class="m-0 p-0 detailsbold">{{ $data->products->brand->brand_name }}</p>
                                            <p class="m-0 p-0 detailsbold">material: <span
                                                    class="detailsnormal">{{ $data->products->material }}</span>
                                            </p>
                                            <p class="m-0 p-0 detailsbold">Quantity <span
                                                    class="detailsnormal">{{ $data->quantity }}</span></p>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column align-items-end justify-content-center px-3">
                                        {{-- <p class="detailspriceinfo">Item Number : <span class="detailsprice">21212334</span></p> --}}
                                        <p class="detailsprice">Subtotal : <span class="font">${{ $data->total }}</span>
                                        </p>
                                        <a href="{{ route('return-products', $data->id) }}"
                                            class="btn border m-2 py-2 px-4 custom-rounded-full b d-flex justify-content-center align-items-center">
                                            Return</a>
                                    </div>

                                </div>
                                {{-- <div class="mt-2"><p class="detailsprice">Delivered to you on : 18/10/2023 at 7:23 pm</p></div> --}}

                            </div>
                        @endforeach
                        <div class="d-flex justify-content-end align-items-end">
                            <a href="{{ route('track-order', $ord->id) }}"
                                class="btn border m-2 py-2 px-4 custom-rounded-full y d-flex justify-content-center align-items-center">
                                Track Order</a>
                        </div>
                    @else
                        @foreach ($ord->cart as $data)
                            <div class="d-flex flex-column m-3">
                                <div class="d-flex flex-column flex-md-row justify-content-between">
                                    <div class="item-container-1">
                                        <h4 class="m-2"> #{{ $loop->iteration }} </h4>
                                        <div class="">
                                            <img src="{{ asset('Product_thumbnails/' . $data->products->image) }}"
                                                alt="" style="width: 150px; height: 150px;"
                                                class="custom-rounded-image p-1">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center align-items-start ms-2">
                                            <h6 class="m-0 p-0">{{ $data->products->product_name }}</h6>
                                            <p class="m-0 p-0 detailsbold">{{ $data->products->brand->brand_name }}</p>
                                            <p class="m-0 p-0 detailsbold">material: <span
                                                    class="detailsnormal">{{ $data->products->material }}</span>
                                            </p>
                                            <p class="m-0 p-0 detailsbold">Quantity <span
                                                    class="detailsnormal">{{ $data->quantity }}</span></p>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column align-items-end justify-content-center px-3">
                                        {{-- <p class="detailspriceinfo">Item Number : <span class="detailsprice">21212334</span></p> --}}
                                        <p class="detailsprice">Subtotal : <span class="font">${{ $data->total }}</span>
                                        </p>
                                        <a href="{{ route('return-products', $data->id) }}"
                                            class="btn border m-2 py-2 px-4 custom-rounded-full b d-flex justify-content-center align-items-center">
                                            Return</a>
                                    </div>
                                </div>
                                {{-- <div class="mt-2">
                                <p class="detailsprice">Delivered to you on : 18/10/2023 at 7:23 pm</p></div> --}}
                                <div class="d-flex justify-content-end align-items-end">
                                    <a href="{{ route('track-order', [$ord->id, $data->id]) }}"
                                        class="btn border m-2 py-2 px-4 custom-rounded-full y d-flex justify-content-center align-items-center">
                                        Track Order</a>
                                </div>

                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        @endforeach

    </div>

    @if (session('successPayment'))
        <!-- Modal for success message -->
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="margin-top: 25%;padding: 8%;">
                    <!-- Green tick icon -->
                    <i class="fas fa-check-circle fa-5x mt-3" style="color: #28a745;"></i>
                    <!-- Success message -->
                    <h1 style="margin-top: 4%;" class="modal-main-message">Your Order has been placed successfully</h1>
                    <h4 style="margin-top: 4%;" class="">Your order is currently pending.</h4>
                    <button class="modal-custom-button" onclick="window.open('{{ route('track-order', session('link') ) }}');"> Order
                        Status</button>
                </div>
            </div>
        </div>
    @endif

@endsection

@section('script')
    <script>
        // show success modal
        $(document).ready(function() {
            @if (session('successPayment'))
                $('#successModal').modal('show');
            @endif
        });
    </script>
@endsection
