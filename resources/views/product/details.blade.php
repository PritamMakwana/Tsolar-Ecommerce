@extends('frontend.layouts.app')
@section('style')
<style>
    .single-product_container {
        background-color: #f6f6f6;
        padding: 2% 5%;
    }

    .product-gallery {
        width: 45px;
    }

    .product-gallery img {
        border-radius: 10px;
        margin-bottom: 5px;
    }

    .selected-thumbnail {
        background-color: #ffd233;
        opacity: 0.8;
    }

    .product-name_main {
        font-family: Jost;
        font-weight: 600;
        text-align: left;
    }

    .product-comment {
        font-family: Jost;
        color: #807d7e;
        font-weight: 500;
    }

    .product-pricing {
        font-family: Jost;
        font-weight: 600;
    }

    .product-specifics {
        margin-top: 4%;
    }

    .product-specifics p {
        font-family: Jost;
        font-weight: 600;
        text-align: left;
    }

    .brand-info,
    .material-info {
        font-family: Jost;
        color: #807d7e;
        font-weight: 500;
    }

    .single-product-btn_container button {
        border-radius: 50px;
        font-family: Jost;
        font-weight: 500;
        text-align: center;
        color: black;
        padding: 1.5% 4%;
        margin-top: 5%;
    }

    .product-addToCart {
        background-color: #ffd233;
    }

    .product-buyNow {
        background-color: #4deaff;
        margin-left: 5%;
    }

    /* Details Start Here */

    .detailed-content_container {
        padding: 4% 12%;
    }

    .about-the-product ul,
    .product-functions ul,
    .key-features ul {
        color: #807d7e;
    }

    .fbt-container {
        background-color: #e6e6e6;
        padding: 1% 8%;
    }

    .fbt-heading {
        font-family: Jost;
        font-weight: 500;
    }

    .combined-info {
        padding: 5%;
        line-height: 10%;
        text-align: unset;
        align-items: unset;
    }

    .combined-info h5 {
        font-family: Jost;
        margin-bottom: 8%;
        font-weight: 400;
        text-align: left;
    }

    .fbt-item1 {
        font-family: Jost;

        font-weight: 400;
        color: #f87c09;
        text-align: left;
    }

    .fbt-items {
        font-family: Jost;
        font-weight: 400;
    }

    .fbt-total {
        font-family: Jost;
        color: #ffd233;
        font-weight: 500;
        text-align: left;
    }

    .fbt-addToCart {
        border-radius: 50px;
        background-color: #4deaff;
        padding: 2% 8%;
        color: black;
        font-family: Jost;
        font-weight: 500;
        text-align: center;
    }

    /* Footer Submit */

    .footer-search {
        position: relative;
        box-shadow: 0 0 40px rgba(51, 51, 51, 0.1);
        margin-top: 8%;
    }

    .footer-search input {
        height: 50px;
        text-indent: 25px;
        border-radius: 50px;
    }

    .footer-search input:focus {
        box-shadow: none;
        border: 2px solid #4deaff;
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
        background: #4deaff;
        border-radius: 50px;
    }
</style>
@endsection

@section('content')
<!-- Single Product Section -->

<div class="single-product_container">
    <div class="row align-items-center">
        <!-- Added align-items-center class -->
        <!-- Product Image Gallery and Navigation -->
        <div class="col-md-2 col-2 d-flex justify-contect-center flex-column align-items-end">
            <div class="product-gallery">
                <img class="img-fluid" src="{{ asset('Product_images/' . $product->image) }}" alt="Product Image 1"
                    onclick="showImage(0)" id="thumbnail0">
                @foreach ($product->product_images as $pro_imgs)
                <img class="img-fluid " src="{{ asset('Product_images/' . $pro_imgs) }}"
                    alt="Product Image {{ $loop->iteration }}" onclick="showImage({{ $loop->iteration }})"
                    id="thumbnail0">
                @endforeach
                {{-- <img class="img-thumbnail" src="./Images/img2.png" alt="Product Image 2" onclick="showImage(1)"
                    id="thumbnail1">
                <img class="img-thumbnail" src="./Images/img3.png" alt="Product Image 3" onclick="showImage(2)"
                    id="thumbnail2"> --}}
            </div>
            <div style="display: flex; flex-direction: column; margin-top: 10px;">
                <button style="border-radius: 50px; width: 40px; height: 40px; background-color: white; color: black;"
                    onclick="prevImage()" class="btn ">&#9650;</button>
                <!-- Downwards arrow button -->
                <button
                    style="margin-top: 10px;border-radius: 50px; width: 40px; height: 40px; background-color: black; color: white;"
                    onclick="nextImage()" class="btn ">&#9660;</button>
            </div>
        </div>
        <!-- Large Product Image -->
        <div class="col-md-4 col-10">
            <img style="border-radius: 12px;width:80%;object-fit:contain;" id="product-image" src=""
                alt="Product Image">
        </div>
        <!-- Product Details -->
        <div class="col-md-6 col-12">
            <h2 class="product-name_main">{{ $product->product_name }}</h2>
            {{-- <div class="row mt-3">
                <div class="col-md-4 col-6">
                    <!-- Star rating (5 stars) -->
                    <span class="text-warning mb-0">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </span>
                </div>
                <div class="col-md-4 col-2">
                    <!-- Numerical rating (3.5) -->
                    <p>3.5</p>
                </div>
                <div class="col-md-4 col-4">
                    <!-- Comment icon with number (120) -->
                    <p class="product-comment"><i style="margin-right: 5px;" class="fas fa-comment"></i>120 comment</p>
                </div>
            </div> --}}

                <h3 class="product-pricing mt-3">$ {{ $product->price }}.00</h3>
                <form action="{{ route('cart.add_product') }}" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="product-specifics">
                        <p>Brand <span class="brand-info">{{ $product->brand->brand_name }}</span></p>
                        <p>Material <span class="material-info">{{ $product->material }}</span></p>
                        <p>Select Size
                            <span class="size-info"style=" margin-left: 10px;">
                                <select id="size-select" name="size" onchange="quantity_change()">
                                    @foreach ($product->sizeQuantity as $sq)
                                        @if ($sq->status == false || $sq->quantity == 0)
                                            @continue
                                        @endif
                                        <option value="{{ $sq->id }}" data-quantity="{{ $sq->quantity }}">
                                            {{ $sq->size }}</option>
                                    @endforeach
                                </select>
                            </span>
                        </p>
                        <p>Select Quantity
                            <span class="quantity-info">
                                <input style="width: 40px; margin-left: 10px;" name="quantity" type="number"
                                    id="quantity-input" value="1" min="1"
                                    max="{{ $product->sizeQuantity->first()->quantity }}">
                            </span>
                        </p>
                    </div>
                    <div class="single-product-btn_container">
                        <button type="submit" class="btn product-addToCart"><i style="margin-right: 10px;"
                                class="fas fa-shopping-cart"></i>Add to Cart</button>
                        <button class="btn product-buyNow">Buy Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- Single Product Detailed Section -->

<div class="detailed-content_container">
    <div class="about-the-product">
        <h3>About This product :</h3>
        <ul>
            <li>
                Specially designed Nylon UV treated Bristles which effectively
                removes dust without causing any harm or scratches to Solar / Glass
                Panels. These bristles are soft and retain their flexibility even if
                pressed hard and also if kept in sun. The brush can be used for Dry
                as well as Wet cleaning.
            </li>
            <li>
                Inline Water feeding System which eliminates need for separate
                equipment for water supply. It consists of Valve and hose adaptor
                for ease of use. Can be directly connected to garden hose. This
                system saves about 70% water than normal water cleaning. ON/OFF
                Valve helps to cut off water supply to the brush.
            </li>

            <li>
                Aluminium Telescopic pole helps to reach longer distance making
                cleaning process hassle-free. The extendable length of the pole is 6
                meters and 2 meters when not extended, which makes it easy for
                storage.
            </li>
        </ul>
    </div>

    <div class="product-functions">
        <h3>Functions & key features :</h3>
        <ul>
            <li>
                To clean solar panels effectively without causing any harm or
                scratches.
            </li>
            <li>To remove dust, dirt, and grime from solar panels.</li>
            <li>
                To improve the efficiency of solar panels by maximizing sunlight
                absorption.
            </li>
        </ul>
    </div>

    <div class="key-features">
        <h3>Key features:</h3>
        <ul>
            <li>
                Specially designed nylon bristles that are soft and flexible, yet
                effective at cleaning solar panels.
            </li>
            <li>
                Inline water feeding system that eliminates the need for separate
                equipment for water supply.
            </li>
            <li>
                Aluminium telescopic pole that helps to reach longer distances,
                making cleaning process hassle-free.
            </li>
            <li>ON/OFF valve that helps to cut off water supply to the brush.</li>
            <li>Easy to use and store.</li>
        </ul>
    </div>
</div>
@endsection

@section('script')
<script>
    const images = [
            "{{ asset('Product_images/' . $product->image) }}",
            @foreach ($product->product_images as $proimg)
                "{{ asset('Product_images/' . $proimg) }}",
            @endforeach
            // "./Images/img1.png",
            // "./Images/img2.png",
            // "./Images/img3.png",
        ]; // Replace with your image URLs
        let currentImageIndex = 0;
        const productImage = document.getElementById("product-image");

        function updateImage() {
            productImage.src = images[currentImageIndex];
        }

        function showImage(index) {
            currentImageIndex = index;
            updateImage();

            const thumbnails = document.querySelectorAll(".img-thumbnail");
            thumbnails.forEach((thumbnail, i) => {
                thumbnail.classList.remove("selected-thumbnail");
            });

            // Set the background and opacity for the selected thumbnail
            const selectedThumbnail = document.getElementById(`thumbnail${index}`);
            selectedThumbnail.classList.add("selected-thumbnail");
        }

        function nextImage() {
            currentImageIndex = (currentImageIndex + 1) % images.length;
            showImage(currentImageIndex);
        }

        function prevImage() {
            currentImageIndex =
                (currentImageIndex - 1 + images.length) % images.length;
            showImage(currentImageIndex);
        }

        updateImage();
</script>
<script>
    function quantity_change() {
            // get the select value
            var select = document.getElementById("size-select");
            // change quantity-input max to the quantity
            document.getElementById("quantity-input").max = select.options[select.selectedIndex].dataset.quantity;
        }
        quantity_change();
</script>
@endsection
