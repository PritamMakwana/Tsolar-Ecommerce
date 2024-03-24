<!-- Footer Starts Here -->
<footer style="background-color: #000; color: #fff;padding: 4%;">
    <div class="container py-4 footer-container">
        <div class="row">
            <!-- Product Categories Column -->
            <div class="col-md-4">
                <h4>Product Categories</h4>
                <ul class="list-unstyled" style="margin-top: 5%;">

                    @php
                    $category = \App\Models\Category::all();
                    @endphp

                    @if (isset($category[0]->name))
                    <li><a href="{{ route('all-products-page', ["category[{$category[0]->id}]" => 'true']) }}">{{
                            $category[0]->name }}</a>
                    </li>
                    @endif
                    @if (isset($category[1]->name))
                    <li><a href="{{ route('all-products-page', ["category[{$category[1]->id}]" => 'true']) }}">{{
                            $category[1]->name }}</a>
                    </li>
                    @endif
                    @if (isset($category[2]->name))
                    <li><a href="{{ route('all-products-page', ["category[{$category[2]->id}]" => 'true']) }}">{{
                            $category[2]->name }}</a>
                    </li>
                    @endif
                    @if (isset($category[3]->name))
                    <li><a href="{{ route('all-products-page', ["category[{$category[3]->id}]" => 'true']) }}">{{
                            $category[3]->name }}</a>
                    </li>
                    @endif
                    @if (isset($category[4]->name))
                    <li><a href="{{ route('all-products-page', ["category[{$category[4]->id}]" => 'true']) }}">{{
                            $category[4]->name }}</a>
                    </li>
                    @endif
                    @if (isset($category[5]->name))
                    <li><a href="{{ route('all-products-page', ["category[{$category[5]->id}]" => 'true']) }}">{{
                            $category[5]->name }}</a>
                    </li>
                    @endif

                </ul>
            </div>
            <!-- Account Column -->
            <div class="col-md-4">
                <h4>Account</h4>
                <ul class="list-unstyled" style="margin-top: 5%;">
                    @auth('customer')
                    <li><a href="{{ route('profile', ['id' => Auth::guard('customer')->user()->id]) }}">My Profile</a>
                    </li>
                    @else
                    <li><a href="{{ route('customer-login') }}">My Profile</a></li>
                    @endif
                    <li><a href="{{ route('order.index') }}">My Orders</a></li>
                    {{-- <li><a href="#">Track Order</a></li>
                    <li><a href="#">Order Status</a></li>
                    <li><a href="#">Shipping & Returns</a></li> --}}
                    {{-- <li><a href="#">Payment</a></li> --}}
                </ul>
            </div>
            <!-- Newsletter Sign Up Column -->
            <div class="col-md-4">
                <h4>Newsletter Sign Up</h4>
                <form action="{{ route('news-letter-data') }}" method="POST">
                    @csrf
                    <div class="footer-search">
                        <input type="text" class="form-control" placeholder="Enter your email here..." name="emailn"
                            value="{{ old('emailn') }}">
                        @error('emailn')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <hr style="height: 2px;">
        <div style="display: flex;justify-content: space-between;" id="news-letter">
            <h3> <a class="navbar-brand" href="{{ route('homepage') }}">
                    <img src="{{ asset('frontend/homepage/Images/logo.jpeg') }}" alt="Logo" width="100">
                </a></h3>
            <p>©2023 • All Rights Reserved</p>
            <div style="display: flex;">
                <img width="30px" height="30px" src="{{ asset('frontend/home/Images/twitter.png') }}" />
                <img style="margin-left: 5px;" width="30px" height="30px"
                    src="{{ asset('frontend/home/Images/linkedin.png') }}" />
                <img style="margin-left: 5px;" width="30px" height="30px"
                    src="{{ asset('frontend/home/Images/facebook.png') }}" />
            </div>
        </div>
    </div>

</footer>


@section('script')
@if ($errors->has('emailn'))
<script>
    // scroll to contact us section
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('news-letter').scrollIntoView();
            });
</script>
@endif
@endsection
