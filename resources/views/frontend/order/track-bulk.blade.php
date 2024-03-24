@extends('frontend.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('frontend/Tracking/style.css') }}">
@endsection

@section('content')
    <div class="d-flex flex-column m-4 m-md-5 p-2">
        <div class="d-flex flex-column">
            <div class="d-flex flex-row justify-content-start  align-items-center">
                <h5 class="customheading ">My Orders</h5>

                <img src="{{ asset('frontend/Tracking/Chevron-Left.png') }}" style="width: 20px; height: 20px;"
                    class="img-fluid ms-1" alt="">
                <h5 class="customheading1 ms-1 ms-sm-3">Tracking and shipment</h5>
            </div>


        </div>
        <div class="d-flex flex-wrap justify-content-between align-items-center p-3 mt-4">
            <div class="d-flex justify-content-start align-items-center mb-2 mb-md-0 fontOrderid">
                Order ID : &nbsp<span class="font-black">{{ $order->order_id }}</span>
            </div>
            <div class="d-flex flex-wrap">
                <div class="border shadow-sm d-flex justify-content-center align-items-center p-2 me-1 rounded">
                    Total Amount to be paid : &nbsp <span class="font"> ${{ $order->total }}</span>
                </div>
                <div class="border shadow-sm d-flex justify-content-center align-items-center p-2 me-1 rounded">
                    Items included : <span class="font">&nbsp{{ $order->cart->count() }}</span>
                </div>
            </div>
        </div>
        <div cla></div>
        <div class="mt-3  border border-div shadow-sm">
            <div class="p-2 border border-div  border-light">
                <div class="p-2">
                    <!-- Table for Medium and Larger Screens -->
                    <div class="table-responsive d-none d-md-block">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th class="centered-text">Product Image</th>
                                    <th class="centered-text">Product Name</th>
                                    <th class="centered-text">QTY</th>
                                    <th class="centered-text">Price</th>
                                    <th class="centered-text">Product Details</th>
                                    <th class="centered-text">Action</th>
                                </tr>
                            </thead>
                            @foreach ($cart as $data)
                                <tbody>
                                    <tr>
                                        <td class="centered-text"><img
                                                src="{{ asset('Product_thumbnails/' . $data->products->image) }}"
                                                alt="Product Image" width="100"></td>
                                        <td class="centered-text">{{ $data->products->product_name }}</td>
                                        <td class="centered-text">{{ $data->quantity }}</td>
                                        <td class="centered-text">{{ $data->total }}</td>
                                        <td class="centered-text">{{ $data->products->specification }}</td>
                                        {{-- <td class="centered-text"><button
                                                onclick="window.open('{{ route('product', $data->products->product_id) }}');"
                                                class="custom-btn px-4 py-1 d-flex align-items-center ">
                                                <div class="d-flex flex-row align-items-center"></div><span
                                                    style="background-color:#4DEAFF;">Details</span><img
                                                    src="{{ asset('frontend/Tracking/arrow-up-sm.png') }}" alt=""
                                                    style="background-color:#4DEAFF; width: 22px; height: 20px;">
                    </div></button></td> --}}
                                        <td class="centered-text">
                                            <div class="d-flex justify-content-center">
                                                <button class="custom-btn px-4 py-1 d-flex align-items-center"
                                                    onclick="window.open('{{ route('product', $data->products->product_id) }}');">
                                                    <div class="d-flex  align-items-center"
                                                        style="background-color:#4DEAFF;">
                                                        <span class="d-flex align-items-center me-2"
                                                            style="background-color:#4DEAFF; font-size: 16px;">Details</span>
                                                        <div style="background-color:#4DEAFF;"><img
                                                                src="{{ asset('frontend/Tracking/arrow-up-sm.png') }}"
                                                                alt=""
                                                                style="background-color:#4DEAFF; width: 16px; height: 16px; object-fit: contain;">
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Add more rows as needed -->
                                </tbody>
                            @endforeach

                            {{-- <tbody>
                        <tr>
                            <td class="centered-text"><img src="/public/4-390x520.jpg.png" alt="Product Image"
                                    width="100"></td>
                            <td class="centered-text">Aton Solar Flexible ...</td>
                            <td class="centered-text">02</td>
                            <td class="centered-text">$29.12</td>
                            <td class="centered-text">Specially designed Nylon UV treated Bristles dust without causing...
                            </td>
                            <td class="centered-text"><button class="custom-btn px-4 py-1 d-flex align-items-center ">
                                    <div class="d-flex flex-row align-items-center"></div><span
                                        style="background-color:#4DEAFF;">Details</span><img src="/public/arrow-up-sm.png"
                                        alt="" style="background-color:#4DEAFF; width: 22px; height: 20px;">
                </div></button></td>
                </tr>
                <!-- Add more rows as needed -->
                </tbody>

                <tbody>
                    <tr>
                        <td class="centered-text"><img src="/public/4-390x520.jpg.png" alt="Product Image" width="100">
                        </td>
                        <td class="centered-text">Aton Solar Flexible ...</td>
                        <td class="centered-text">02</td>
                        <td class="centered-text">$29.12</td>
                        <td class="centered-text">Specially designed Nylon UV treated Bristles dust without causing...</td>
                        <td class="centered-text">
                            <button class="custom-btn px-4 py-1 d-flex align-items-center ">
                                <div class="d-flex flex-row align-items-center"></div>
                                <span style="background-color:#4DEAFF;">Details</span>
                                <img src="/public/arrow-up-sm.png" alt=""
                                    style="background-color:#4DEAFF; width: 22px; height: 20px;">
            </div>
            </button>
            </td>
            </tr>
            <!-- Add more rows as needed -->
            </tbody> --}}

                        </table>
                    </div>

                    <!-- these are for small screens -->
                    <div class="d-block d-md-none">
                        <table class="table">
                            @foreach ($cart as $ct)
                                <tr>
                                    <th>Product Name</th>
                                    <td>{{ $ct->products->product_name }}</td>
                                </tr>
                                <tr>
                                    <th>Product Image</th>
                                    <td><img src="{{ asset('Product_thumbnails/' . $ct->products->image) }}"
                                            alt="Product Image" width="100"></td>
                                </tr>
                                <tr>
                                    <th>QTY</th>
                                    <td>{{ $ct->quantity }}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>$ {{ $ct->total }}</td>
                                </tr>
                                <tr>
                                    <th>Product Details</th>
                                    <td>{{ $ct->products->specification }}</td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <td><button onclick="window.open('{{ route('product', $ct->products->product_id) }}');"
                                            class="custom-btn px-4 py-1">View details</button>
                                    <td>
                                </tr>
                            @endforeach
                            <!-- Add more rows as needed -->
                        </table>
                    </div>
                </div>

            </div>
        </div>

        {{-- <div class="d-flex flex-column mt-5">
        <h5>Order Status</h5>
        <div class="">
            <div class="container py-5">
                <div class="row">
                    <div class="col-12">
                        <div id="content">
                            <ul class="timeline-1 text-black">
                                <li class="event" data-date="11/10/23" data-day="Monday" data-time="6:30 PM">
                                    <h4 class="">Order Placed</h4>
                                    <p>Your Order #123232 has been packed on</p>
                                </li>
                                <li class="event" data-date="11/10/23" data-day="Monday" data-time="6:30 PM">
                                    <h4 class="">Processed</h4>
                                    <p>Your Order #123232 has been packed on</p>
                                </li>
                                <li class="event" data-date="11/10/23" data-day="Monday" data-time="6:30 PM">
                                    <h4 class="">Delivery</h4>
                                    <p>Your Order #123232 has been packed on</p>
                                </li>
                                <li class="event" data-date="11/10/23" data-day="Monday" data-time="6:30 PM">
                                    <h4 class="">Complete</h4>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> --}}

        <div class="d-flex flex-column mt-5">
            <h5>Order Status</h5>
            <div class="">
                <div class="container py-5">
                    <div class="row">
                        <div class="col-12">
                            <div id="content">
                                <ul class="timeline-1 text-black">
                                    @if ($order_status != null)
                                        @foreach ($order_status->status as $data)
                                            <li class="event" data-date="{{ $data['date'] }}" data-day=""
                                                data-time="">
                                                <h4 class="">{{ App\Models\Status::find($data['status'])->status }}
                                                </h4>
                                                <p>{{ $data['update'] }}</p>
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="event" data-date="" data-day="" data-time="">
                                            <h4 class="">No Status Yet</h4>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
