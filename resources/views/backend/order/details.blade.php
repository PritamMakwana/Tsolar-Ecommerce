@extends('backend.layouts.app')

@section('style')
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="margin-top: 2%;">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="">Order Details - {{ $order->order_id }}</h2>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="overflow-x: auto; max-width: 100%;">

                                {{-- Tabs --}}
                                <div class="nav-profile-options">
                                    <ul class="nav nav-tabs ">
                                        <li><a id="profile-navitem" class="navvvv active" href="javascript:void(0);"
                                                onclick="showContent('profile')">Order Details</a></li>
                                        <li style="margin-left: 2.5%;"><a id="password-navitem" class="navvvv"
                                                class="" href="javascript:void(0);"
                                                onclick="showContent('password')">Order Status</a></li>
                                    </ul>
                                </div>

                                {{-- Tab Content --}}
                                <div class="profile-content" data-toggle="profile" class="my-profile-card"
                                    style="padding: 1%;">
                                    <div class="row card-profile-bx">
                                        <div class="col-md-12">
                                            {{-- Order Details --}}
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Product Details</th>
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                            <th>Shipping</th>
                                                            <th>Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $total = 0;
                                                        @endphp
                                                        @foreach ($cart as $data)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>
                                                                    <div>
                                                                        <div>
                                                                            <a target="_blank"
                                                                                href="{{ route('product', $data->products->product_id) }}"><img
                                                                                    src="{{ asset('Product_thumbnails/' . $data->products->image) }}"
                                                                                    style="width: 50px;height: 50px;border-radius: 10px"></a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $data->quantity }}</td>
                                                                <td>${{ $data->products->price }}</td>
                                                                <td>${{ $data->products->shipping }}</td>
                                                                <td>${{ $data->products->price * $data->quantity + $data->products->shipping }}
                                                                    @php
                                                                        $total += $data->products->price * $data->quantity + $data->products->shipping;
                                                                    @endphp
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <tr style="border-bottom: 1px solid black;">
                                                            <th colspan="5" class="text-right">Total : </th>
                                                            <th>${{ $total }}</th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            {{-- Customer Details --}}
                                            <div>
                                                <h4 class="text-bold">Customer Details</h4>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Name</label>
                                                            <input type="text" class="form-control" id="name"
                                                                value="{{ $order->customer->name }}" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input type="text" class="form-control" id="email"
                                                                value="{{ $order->customer->email }}" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="phone">Phone</label>
                                                            <input type="text" class="form-control" id="phone"
                                                                value="{{ $order->customer->phone }}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label for="address">Country</label>
                                                                <input type="text" class="form-control" id="address"
                                                                    value="{{ $order->address->country }}" disabled>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="address">State</label>
                                                                <input type="text" class="form-control" id="address"
                                                                    value="{{ $order->address->state }}" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            {{-- <div class="form-group col-md-6">
                                                                <label for="address">City</label>
                                                                <input type="text" class="form-control" id="address"
                                                                    value="{{ $order->address->city }}" disabled>
                                                            </div> --}}
                                                            <div class="form-group col-md-12">
                                                                <label for="address">Zip</label>
                                                                <input type="text" class="form-control" id="address"
                                                                    value="{{ $order->address->zip }}" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            
                                                                <label for="">Address</label>
                                                                <textarea class="form-control" rows="2" disabled>{{ $order->address->line1 ." ".  $order->address->line2 }}</textarea>
                                                          
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="profile-content" data-toggle="password" style="display: none;">
                                    <div class="password-content-container">
                                        <div class="mb-4 mt-3">
                                            <div
                                                class="personal-info-banner d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h4>Product Status</h4>
                                                    {{-- <p>Please enter your current password to change your password.</p> --}}
                                                </div>
                                                <div>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="customSwitch1" onchange="order_bunch_status()"
                                                                @if ($order->bunch) checked @endif>
                                                            <label class="custom-control-label"
                                                                for="customSwitch1">Batch</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($order->bunch)
                                                    <button type="button" onclick="addTimeline()"
                                                        class="btn btn-primary"><i class="fas fa-plus"></i>
                                                        Timeline</button>
                                                @endif
                                            </div>
                                        </div>

                                        @if ($order->bunch)
                                            <div class="justify-content-between">

                                                <div class="mb-5">
                                                    <h4>Order - {{ $order->order_id }}</h4>
                                                    <h6>Total Products : <b>{{ $cart->count() }}</b></h6>
                                                </div>
                                                <form method="POST" action="{{ route('order.status.update') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="cart_id" value="{{ $cart[0]->id }}">
                                                    <div class="fields">

                                                        @if ($order_status != null)
                                                            @forelse ($order_status->status as $data)
                                                                {{-- @dd($data, $data['update'] , 1 == $data['status']) --}}
                                                                <div class="row update align-items-center">

                                                                    <div class="form-group mr-5">
                                                                        <label for="status">Status</label>
                                                                        <select name="update[]" id="">
                                                                            @foreach ($status as $st)
                                                                                @if ($st->id == $data['status'])
                                                                                    <option value="{{ $st->id }}"
                                                                                        selected>
                                                                                        {{ $st->status }}</option>
                                                                                @else
                                                                                    <option value="{{ $st->id }}">
                                                                                        {{ $st->status }}
                                                                                    </option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group mr-5">
                                                                        <input type="date" name="update[]"
                                                                            id="" value="{{ $data['date'] }}">
                                                                    </div>

                                                                    <div class="form-group mr-3">
                                                                        <input type="text" class="form-control"
                                                                            name="update[]" id="update"
                                                                            placeholder="update..."
                                                                            value="{{ $data['update'] }}">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <button type="button"
                                                                            id="deleteTimeline{{ $loop->iteration }}"
                                                                            onclick="deleteTimeline(this.id)"
                                                                            class="btn btn-danger"><i
                                                                                class="fas fa-trash"></i></button>
                                                                    </div>
                                                                </div>
                                                            @empty
                                                                <div class="row update align-items-center">
                                                                    <div class="form-group mr-5">
                                                                        <label for="status">Status</label>
                                                                        <select name="update[]" id="">
                                                                            @foreach ($status as $st)
                                                                                <option value="{{ $st->id }}">
                                                                                    {{ $st->status }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group mr-5">
                                                                        <input type="date" name="update[]"
                                                                            id="" value="{{ $data['date'] }}">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control"
                                                                            name="update[]" id="update"
                                                                            placeholder="update...">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <button type="button" id="deleteTimeline1"
                                                                            onclick="deleteTimeline(this.id)"
                                                                            class="btn btn-danger"><i
                                                                                class="fas fa-trash"></i></button>
                                                                    </div>
                                                                </div>
                                                            @endforelse
                                                        @else
                                                            <div class="row update align-items-center">

                                                                <div class="form-group mr-5">
                                                                    <label for="status">Status</label>
                                                                    <select name="update[]" id="">
                                                                        @foreach ($status as $st)
                                                                            <option value="{{ $st->id }}">
                                                                                {{ $st->status }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group mr-5">
                                                                    <input type="date" name="update[]" id=""
                                                                        value="{{ $data['date'] }}">
                                                                </div>

                                                                <div class="form-group mr-5">
                                                                    <input type="text" class="form-control"
                                                                        name="update[]" id="update"
                                                                        placeholder="update...">
                                                                </div>

                                                                <div class="form-group">
                                                                    <button type="button" id="deleteTimeline1"
                                                                        onclick="deleteTimeline(this.id)"
                                                                        class="btn btn-danger"><i
                                                                            class="fas fa-trash"></i></button>
                                                                </div>

                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="row">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                                {{-- <form action="{{ route('order.status.bunch') }}" method="post" class="row align-items-center"> --}}
                                                {{-- @csrf --}}
                                                {{-- <div class="row align-items-center">
                                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                    <div class="mr-4">
                                                        <div class="form-group">
                                                            <label for="status">Status</label>
                                                            <select name="status" id="">
                                                                @foreach ($status as $st)
                                                                    @if ($st->id == $cart->first()->status_id)
                                                                        <option value="{{ $st->id }}" selected>
                                                                            {{ $st->status }}</option>
                                                                    @else
                                                                        <option value="{{ $st->id }}">
                                                                            {{ $st->status }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                    </div>

                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div> --}}
                                                {{-- </form> --}}
                                            </div>
                                        @else
                                            @foreach ($cart as $products)
                                                <div class="row justify-content-between">

                                                    <div class="row mb-5">
                                                        <a href="{{ route('product', $products->products->product_id) }}"><img
                                                                src="{{ asset('Product_images/' . $products->products->image) }}"
                                                                style="width: 50px;height: 50px;border-radius: 10px"></a>

                                                        <div class="ml-3">
                                                            <h4>{{ $products->products->product_name }}</h4>
                                                            <span><em>Size:</em>{{ $products->size->size }}</span>
                                                        </div>
                                                    </div>
                                                    {{-- <form action="{{ route('order.status.single') }}" method="post"
                                                        class="row justify-content-around align-items-center">
                                                        @csrf --}}
                                                    <div class="row justify-content-around align-items-center">

                                                        <a href="{{ route('order.status.single', $products->id) }}"
                                                            class="btn btn-primary"><i class="fas fa-edit"></i>
                                                            Status</a>
                                                    </div>
                                                    {{-- </form> --}}
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>
@endsection

@section('script')
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

        function order_bunch_status() {
            // get the checkbox value
            var checkBox = document.getElementById("customSwitch1");

            if (checkBox.checked) {
                var status = 1;
            } else {
                var status = 0;
            }

            // make an ajax call to update the status
            $.ajax({
                url: "{{ route('order.bunch.status') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "order_id": "{{ $order->id }}",
                    "status": status
                },
                success: function(response) {
                    swal("Status Updated", "Status Updated Successfully", "success").then(function() {
                        location.reload();
                    });
                },
                error: function(response) {
                    toastr.error("Something went wrong");
                    console.log(response);
                }
            });


        }
    </script>
    <script>
        function addTimeline() {
            var number = document.getElementsByClassName("fields")[0].childElementCount + 1;

            // duplicate child element's html
            var html = document.getElementsByClassName("update")[0].outerHTML;

            // append html to parent element
            document.getElementsByClassName("fields")[0].innerHTML += html;

            // change the name of the input
            // document.getElementsByClassName("update")[number - 1].getElementsByClassName("form-group")[1]
            //     .getElementsByTagName("input")[0].setAttribute("name", "update" + number);

            // document.getElementsByClassName("update")[number - 1].getElementsByClassName("form-group")[0]
            //     .getElementsByTagName("select")[0].setAttribute("name", "status" + number);

            // change the id of the input
            // document.getElementsByClassName("update")[number - 1].getElementsByClassName("form-group")[1]
            //     .getElementsByTagName("input")[0].setAttribute("id", "update" + number);

            // document.getElementsByClassName("update")[number - 1].getElementsByClassName("form-group")[0]
            //     .getElementsByTagName("select")[0].setAttribute("id", "status" + number);

            // change the value of the input
            document.getElementsByClassName("update")[number - 1].getElementsByClassName("form-group")[1]
                .getElementsByTagName("input")[0].setAttribute("value", "");


            // change the id of the button
            document.getElementsByClassName("update")[number - 1].getElementsByClassName("form-group")[2]
                .getElementsByTagName("button")[0].setAttribute("onclick", "deleteTimeline(this.id)");

            document.getElementsByClassName("update")[number - 1].getElementsByClassName("form-group")[2]
                .getElementsByTagName("button")[0].setAttribute("id", "deleteTimeline" + number);

        }

        function deleteTimeline(id) {
            var number = id.slice(-1);
            var element = document.getElementById("deleteTimeline" + number);
            element.parentNode.parentNode.remove();
        }
    </script>
@endsection
