<div class="home-page-hero-container" style="background-image: url('{{ asset('banner_images/' . $b->image) }}')">
    <div class="home-page-hero-content" style="visibility: {{$show}}">
        <h1 style="visibility: hidden">Go solar and make a difference for the planet.</h1>
        <a style="visibility: hidden"  href="#ourProduct" class="btn btn-custom-hero">Start Shopping</a>
        {{-- <form action="#" method="GET">
            <div class="hero-search" style="z-index: 10;">
                <input type="text" id="productSearch" name="text" class="form-control" placeholder="Search for Product"
                    wire:model="text" wire:keyup="search">
                <div id="suggestions" style="background: white ;border-radius: 3px">
                    @if (!empty($search))
                    @foreach ($options as $p)
                    <a href="{{ route('product', $p->product_id) }}" class="list-group-item list-group-item-action">{{
                        $p->product_name }}</a>
                    @endforeach
                    @endif
                </div>
                <button class="btn btn-warning text-light" disabled>SEARCH</button>
            </div>
        </form> --}}
    </div>
</div>
