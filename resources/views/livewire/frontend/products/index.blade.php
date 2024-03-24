<div>
    <h2 class="mb-3">Our Products</h2>
    <div class="row">


        <aside class="col-md-3 ">
            {{-- <div class="card">
                <p class="card-title">Filter</p>
            </div> --}}
            <h4 class="text-dark ">Filter</h4>
            <div class="card">

                <article class="filter-group">
                    <header class="card-header">
                        <a href="#" data-bs-toggle="collapse" data-bs-target="#collapse_1" aria-expanded="false"
                            class="">
                            <i class="icon-control fa fa-chevron-down"></i>
                            <h6 class="title">Category</h6>
                        </a>
                    </header>
                    <div class="filter-content collapse @if ($categoryInputs) show @endif" id="collapse_1">
                        <div class="card-body" style="display: flex; flex-direction: column;">

                            @foreach ($categories as $category)
                                <label class="custom-control custom-checkbox d-flex align-items-center">
                                    <input type="checkbox" wire:key="category-{{ $category->id }}"
                                        wire:model="categoryInputs.{{ $category->id }}" wire:click="searchFillter"
                                        class="custom-control-input" value="{{ $category->id }}"
                                        @if (array_key_exists($category->id, $categoryInputs)) checked @endif>
                                    <div class="flex-grow-1">
                                        <p class="mb-0 type-of">{{ $category->name }}<span
                                                class="type-of-quantity"></span>
                                        </p>
                                    </div>
                                </label>
                            @endforeach

                        </div>
                    </div>
                </article>

                <article class="filter-group">
                    <header class="card-header">
                        <a href="#" data-bs-toggle="collapse" data-bs-target="#collapse_4" aria-expanded="false"
                            class="">
                            <i class="icon-control fa fa-chevron-down"></i>
                            <h6 class="title">Fillter</h6>
                        </a>
                    </header>
                    <div class="filter-content collapse @if ($fillterPopularInputs || $fillterLatestInputs) show @endif" id="collapse_4">
                        <div class="card-body" style="display: flex; flex-direction: column;">
                            <label class="custom-control custom-checkbox d-flex align-items-center">
                                <input type="checkbox" class="custom-control-input" wire:model="fillterPopularInputs"
                                    wire:key="fillterPopularInputs" 
                                    wire:click="searchFillter"  
                                    value="true">
                                <div class="flex-grow-1">
                                    <p class="mb-0 type-of">Popular
                                        {{-- <span class="type-of-quantity">(68)</span> --}}
                                    </p>
                                </div>
                            </label>
                            <label class="custom-control custom-checkbox d-flex align-items-center">
                                <input type="checkbox" class="custom-control-input" wire:model="fillterLatestInputs"
                                    wire:key="fillterLatestInputs" wire:click="searchFillter"  value="true">
                                <div class="flex-grow-1">
                                    <p class="mb-0 type-of">Latest
                                        {{-- <span class="type-of-quantity">(17)</span> --}}
                                    </p>
                                </div>
                            </label>
                        </div>
                    </div>
                </article>

                <article class="filter-group">
                    <header class="card-header">
                        <a href="#" data-bs-toggle="collapse" data-bs-target="#collapse_5" aria-expanded="false"
                            class="">
                            <i class="icon-control fa fa-chevron-down"></i>
                            <h6 class="title">Price</h6>
                        </a>
                    </header>
                    <div class="filter-content collapse @if ($priceInput) show @endif" id="collapse_5">
                        <div class="card-body" style="display: flex; flex-direction: column;">

                            <label class="custom-control custom-checkbox d-flex align-items-center">
                                <input type="radio" class="custom-control-input" name="priceSort"
                                    wire:model="priceInput" wire:key="high-to-low" value="high-to-low"
                                    wire:click="searchFillter">
                                <div class="flex-grow-1">
                                    <p class="mb-0 type-of">High to Low</p>
                                </div>
                            </label>

                            <label class="custom-control custom-checkbox d-flex align-items-center">
                                <input type="radio" name="priceSort" class="custom-control-input"
                                    wire:model="priceInput" wire:key="low-to-Hight" wire:click="searchFillter"
                                    value="low-to-Hight">
                                <div class="flex-grow-1">
                                    <p class="mb-0 type-of">Low to High</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </article>

            </div>
        </aside>
        <main class="col-md-9">

            <header class="border-bottom mb-4 pb-3">

                <div class="d-flex justify-content-end align-items-center">
                    <span class="mb-md-auto">{{ $productShow->total() }} Items found</span>
                </div>

            </header>
            <!-- sect-heading -->

            <div class="row">

                @forelse ($productShow as $p)
                    {{-- @dd($p->sizeQuantity) --}}
                    <div class="col-md-4">
                        <a href="{{ route('product', $p->product_id) }}" target="_blank" class="title">
                            <figure class="card card-product-grid shadow" style="border-radius: 10px;">
                                <div class="img-wrap">
                                    {{-- <span class="badge badge-danger">NEW</span> --}}
                                    <img style="height: 200px;width:100%;border-radius:10px 10px 0px 0px;"
                                        src="{{ asset('Product_thumbnails/' . $p->image) }}" class="img-fluid">
                                    {{-- <a class="btn-overlay" href="#"><i class="fa fa-search-plus"></i> Quick
                                        view</a> --}}
                                </div> <!-- img-wrap.// -->
                                <figcaption class="info-wrap">
                                    <form action="{{ route('cart.add_product') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $p->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <div class="fix-height">
                                            <div class="d-flex">
                                                <a href="{{ route('product', $p->product_id) }}" class="title"
                                                    style="overflow: hidden;
                                                    text-overflow: ellipsis;
                                                    display: -webkit-box;
                                                    -webkit-line-clamp: 1;
                                                    -webkit-box-orient: vertical;">{{ $p->product_name }}</a>
                                            </div>

                                            <div class="price-wrap mt-2 mb-2">
                                                <label for=""><strong>Price : </strong></label>
                                                <span class="price">${{ $p->price }}</span><br>
                                                <label for=""><strong>Size :</strong></label>
                                                <span class="size-info"style=" margin-left: 10px;">
                                                    <select id="size-select" name="size">
                                                        @foreach ($p->sizeQuantity as $sq)
                                                            @if ($sq->status != false && $sq->quantity != 0)
                                                                <option value="{{ $sq->id }}"
                                                                    data-quantity="{{ $sq->quantity }}">
                                                                    {{ $sq->size }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </span>
                                                {{-- <del class="price-old">$1980</del> --}}
                                            </div> <!-- price-wrap.// -->
                                        </div>
                                        <div class="row">
                                            <button type="submit" class="btn btn-primary btn-block">Add to
                                                cart</button>
                                        </div>
                                    </form>
                                </figcaption>
                            </figure>
                        </a>
                    </div> <!-- col.// -->

                @empty
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>No products avaliable for fillter</h4>
                        </div>
                    </div>
                @endforelse

                <!-- Repeat this block for other product items -->

            </div> <!-- row end.// -->

            <div class="row">
                {{ $productShow->links() }}
            </div>
            {{-- <nav class="mt-4" aria-label="Page navigation sample">
                <ul class="pagination">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav> --}}

        </main>

    </div>
</div>
