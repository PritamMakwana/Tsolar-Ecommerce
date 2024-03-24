@extends('backend.layouts.app')

@section('style')
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary" style="margin-top: 2%">
                            <div class="card-header">
                                <h3 class="card-title">Change Status</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('order.status.update') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="cart_id" value="{{$cart->id}}">
                                <div class="card-body">

                                    <div class="row justify-content-between mb-5">
                                        <h2>Order ID : {{ $cart->order->order_id }}</h2>
                                        <h2>Customer Name : {{ $cart->order->customer->name }}</h2>
                                    </div>

                                    {{-- <div class="row justify-content-between"> --}}
                                    <div class="row mb-5">
                                        <a href="{{ route('product', $cart->products->product_id) }}"><img
                                                src="{{ asset('Product_images/' . $cart->products->image) }}"
                                                style="width: 50px;height: 50px;border-radius: 10px"></a>

                                        <div class="ml-3">
                                            <h4>{{ $cart->products->product_name }}</h4>
                                            <span><em>Size:</em>{{ $cart->size->size }}</span>
                                        </div>
                                    </div>

                                    <div class="row justify-content-end align-items-center">
                                        <button type="button" onclick="addTimeline()" class="btn btn-primary"><i
                                                class="fas fa-plus"></i>
                                            Timeline</button>
                                    </div>

                                    {{-- </div> --}}
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

                                                    <div class="form-group mr-5">
                                                        <input type="date" name="update[]" id="" value="{{$data['date']}}">
                                                    </div>

                                                    <div class="form-group mr-3">
                                                        <input type="text" class="form-control" name="update[]"
                                                            id="update" placeholder="update..." value="{{$data['update']}}">
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="button" id="deleteTimeline{{$loop->iteration}}" onclick="deleteTimeline(this.id)"
                                                            class="btn btn-danger"><i class="fas fa-trash"></i></button>
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

                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="update[]"
                                                            id="update" placeholder="update...">
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="button" onclick="deleteTimeline(this.id)"
                                                            class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
                                                    <input type="text" class="form-control" name="update[]" id="update"
                                                        placeholder="update...">
                                                </div>

                                                <div class="form-group">
                                                    <button type="button" id="1" onclick="deleteTimeline(this.id)"
                                                        class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                </div>

                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
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
