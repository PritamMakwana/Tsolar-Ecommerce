@extends('frontend.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('frontend/cart/style.css') }}">
@endsection

@section('content')
    <div class="Checkout_Container-Main">
        <h1 class="checkout-heading">Checkout</h1>

        <div class="padding-bottom-3x mb-1">

            <?php

            $total = 0;
            $shipping = 0;

            ?>

            <!-- Shopping Cart-->
            <div class="table-responsive shopping-cart">
                <table class="table">
                    <thead>
                        <tr>
                            <th>PRODUCT DETAILS</th>
                            <th class="text-center">QUANTITY</th>
                            <th class="text-center">PRICE</th>
                            <th class="text-center">SHIPPING</th>
                            <th class="text-center">SUBTOTAL</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cart as $data)
                            <tr>
                                <td>
                                    <div class="product-item">
                                        <a class="product-thumb" href="#"><img
                                                src="{{ asset('Product_images/' . $data->products->image) }}"
                                                alt="Product"></a>
                                        <div class="product-info">
                                            <h4 class="product-title"><a
                                                    href="#">{{ $data->products->product_name }}</a>
                                            </h4>
                                            <span><em>Size:</em>{{ $data->size->size }}</span>
                                            {{-- <span><em>Color:</em> Dark Blue</span> --}}
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="count-input">
                                        <select class="form-control" onchange="updateQuantity({{ $data->id }})">
                                            @for ($i = 1; $i <= $data->size->quantity; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $data->quantity == $i ? 'selected' : '' }}>
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </td>
                                <td class="text-center text-lg text-medium">${{ $data->products->price }}</td>
                                <td class="text-center text-lg text-medium">
                                    {{ $data->products->shipping == 0 ? 'FREE' : "$" . $data->products->shipping }}</td>
                                <td class="text-center text-lg text-medium">${{ $data->products->price * $data->quantity }}
                                </td>
                                <td class="text-center"><a class="remove-from-cart"
                                        href="{{ route('cart.remove_product', $data->id) }}" data-toggle="tooltip"
                                        title="" data-original-title="Remove item"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php $total += $data->products->price * $data->quantity;
                            $shipping += $data->products->shipping;
                            ?>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No Products Added Yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


    </div>

    <div class="Checkout_Container-Total">
        <div class="row justify-content-center">
            {{-- <div class="col-md-6">
                <h4 class="discount-text">Discount Codes</h4>
                <p class="discount-subtext">Enter your coupon code if you have one</p>
                <div class="hero-search">
                    <input type="text" class="form-control" placeholder="Enter Coupon">
                    <button class="btn">Apply Coupon</button>
                </div>
                <a href="{{ route('all-products-page') }}" class="continue-shopping-cart">Continue Shopping</a>
            </div> --}}
            <div class="col-md-6 grandtotal-window">
                <div style="border-bottom: dotted 1px black;">
                    <div class="row">
                        <div class="col-6">
                            <p class="amount-checkout">Sub Total</p>
                        </div>
                        <div class="col-6">
                            <p class="num-amount-checkout">${{ $total }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p class="amount-checkout">Shipping</p>
                        </div>
                        <div class="col-6">
                            <p class="num-amount-checkout">${{ $shipping }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p class="amount-checkout">Grand Total</p>
                        </div>
                        <div class="col-6">
                            <p class="grand-total-num">${{ $total + $shipping }}</p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('cart.checkout') }}" class="btn proceed-checkout">Proceed to Checkout</a>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).on("click", ".remove-from-cart", function(e) {
            e.preventDefault();
            var link = $(this).attr("href");
            swal({
                    title: "Are you sure you want to remove the item?",
                    // text: "The data will be moved to Trash",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = link;
                    } else {
                        // swal("Operation cancelled. Data is safe!");
                    }
                });
        });
    </script>
    <script>
        function updateQuantity(id) {
            var quantity = event.target.value;
            $.ajax({
                url: "{{ route('cart.update-quantity') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    quantity: quantity
                },
                success: function(response) {
                    console.log(response);
                    swal("Quantity Updated", "success").then(() => {
                        location.reload();
                    });
                },
                error: function(error) {
                    console.log(error);
                    // location.reload();
                }
            });
        }
    </script>
@endsection
