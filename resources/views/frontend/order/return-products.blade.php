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

    /* RETURN CODE STARTS HERE */
    .return-products-container {
        padding: 2% 15%;
        margin-bottom: 1%;
    }

    .return-pro-description {
        font-family: Jost;
        font-weight: 600;
        color: #7B7B7B;

    }

    .return-pro-main-description {
        font-weight: 500;
    }

    .return-custom-btn {
        background-color: #4DEAFF;
        border: none;
        border-radius: 50px;
        padding: 1.5% 10%;
        font-family: Inter;
        font-weight: 600;
        margin-top: 2.5%;
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
</style>
@endsection


@section('content')

<nav style="
  --bs-breadcrumb-divider: url(
    &#34;data:image/svg + xml,
    %3Csvgxmlns='http://www.w3.org/2000/svg'width='8'height='8'%3E%3Cpathd='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z'fill='%236c757d'/%3E%3C/svg%3E&#34;
  );
  border-bottom: 1px solid rgba(0, 0, 0, 0.036);
" aria-label="breadcrumb">
    <ol class="breadcrumb" style="padding: 2% 15% 0.1% 15%">
        <li class="breadcrumb-item"><a style="text-decoration: none;color: #34405485;font-size: 1.8rem;" href="#">My
                Orders</a></li>
        <li class="breadcrumb-item active" aria-current="page"
            style="color: #344054;font-size: 1.8rem;font-weight: 600;">
            Return Products
        </li>

    </ol>
    <p style="margin-left: 15%;font-family: Inter;font-weight: 400;">Each details about your orders is listed below.</p>
</nav>

<!-- Nav Ends -->

<!-- Return Product Section -->



<div class="return-products-container">
    <h6>Return Items : <span>{{$order->order_id}}</span></h6>
    <div class="row" style="border-bottom: 1px solid black ; padding: 2% 0%;">
        <div class="col-md-2"><img width="100%" src="{{ asset('Product_images/' . $cart->products->image) }}">
        </div>
        <div class="col-md-5">

            <h5>{{$cart->products->product_name}}</h5>
            <p class="return-pro-description">{{$cart->products->specification}}</p>
            <p class="return-pro-description">material : <span
                    class="return-pro-main-description">{{$cart->products->material}}</span> </p>
            <p class="return-pro-description">Quantity : {{$cart->quantity}}<span class="return-pro-main-description">At</span> </p>
        </div>
        <div class="col-md-5">
            <h5 style="font-family: Jost;font-weight: 600;color: #807D7E;margin-top: 25%;">Subtotal :<span
                    style="color: #4CE9FF;">$ {{$cart->total}}</span></h5>
        </div>
    </div>
    <form action="{{ route('return-product-data') }}"  method="POST">
        @csrf
        <input type="hidden" name="return_id" value="{{$order->id}}">
        <input type="hidden" name="cart_id" value="{{$cart->id}}">
        <div style="width: 80%;margin-top: 2.5%;">
            <input type="checkbox" name="confrimreturn">
            <label style="margin-left: 1%;">Return This Item</label>
            @error('confrimreturn')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="row" style="margin-top: 2.5%;">
                <div class="col-md-6">
                    <select class="form-control" id="qtyToReturn" name="qtytoreturn">
                        <option value="0" selected disabled>Qty to Return</option>
                        {{-- <option>1</option>
                        <option>2</option>
                        <option>3</option> --}}
                        @for ($i =1; $i <= $cart->quantity; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                            <!-- Add more options as needed -->
                    </select>
                    @error('qtytoreturn')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <select class="form-control" id="reasontoreturn" name="reasontoreturn">
                        <option selected >Reason to Return</option>
                        <option value="Defective Product">Defective Product</option>
                        <option value="Wrong Item">Wrong Item</option>
                        <option value="Not Satisfied">Not Satisfied</option>
                        <!-- Add more options as needed -->
                    </select>
                    @error('reasontoreturn')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="form-group col-md-12" style="margin-top:2.5%;">

                <input style="height: 150px;" type="text" class="form-control form-control-lg" id="optionalComments"
                    placeholder="Optional Comments" name="comments">
            </div>
            @error('comments')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            <button class="return-custom-btn" type="submit">Continue Return</button>
        </div>

    </form>
</div>

{{-- <div class="return-products-container">
    <h6>Return Items :<span>232112334</span></h6>
    <div class="row" style="border-bottom: 1px solid black ; padding: 2% 0%;">
        <div class="col-md-2"><img width="100%" src='./Images/4-390x520.jpg.png'></div>
        <div class="col-md-5">
            <h5>Solar panel cleaning brushesh</h5>
            <p class="return-pro-description">kenbrook</p>
            <p class="return-pro-description">Brush material :<span class="return-pro-main-description">Nylon</span>
            </p>
            <p class="return-pro-description">Quantity : 2<span class="return-pro-main-description">At</span> </p>
        </div>
        <div class="col-md-5">
            <h5 style="font-family: Jost;font-weight: 600;color: #807D7E;margin-top: 25%;">Subtotal :<span
                    style="color: #4CE9FF;">$ 64.00</span></h5>
        </div>
    </div>

    <div style="width: 80%;margin-top: 2.5%;">
        <input type="checkbox"><label style="margin-left: 1%;">Return This Item</label>
        <div class="row" style="margin-top: 2.5%;">
            <div class="col-md-6">

                <select class="form-control" id="qtyToReturn2">
                    <option selected>Qty to Return</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
            <div class="col-md-6">

                <select class="form-control" id="reasonToReturn2">
                    <option selected>Reason to Return</option>
                    <option>Defective Product</option>
                    <option>Wrong Item</option>
                    <option>Not Satisfied</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
        </div>
        <div class="form-group col-md-12" style="margin-top:2.5%;">

            <input style="height: 150px;" type="text" class="form-control form-control-lg" id="optionalComments"
                placeholder="Optional Comments">
        </div>
        <button class="return-custom-btn">Continue Return</button>
    </div>
</div> --}}


<!-- Return End -->
<div style="padding: 0% 15%;">
    <hr>
    <div style="display: flex;justify-content: center;">
        <h5 style="font-family: Inter;font-weight: 400;">You do not have any other orders</h5>
    </div>

</div>



@endsection
