@extends('backend.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
                                <h3 class="card-title">Add Product</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('add-product') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select name="category" id="category"
                                            class="form-control @error('category') is-invalid @enderror">
                                            <option selected value="none" disabled>Select Category</option>
                                            @foreach ($category_data as $ctr)
                                                <option value="{{ $ctr->id }}">{{ $ctr->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="brand">Brand</label>
                                        <select name="brand" id="brand"
                                            class="form-control @error('brand') is-invalid @enderror">
                                            <option selected value="none" disabled>Select Brand</option>
                                            @foreach ($brands as $brd)
                                                <option value="{{ $brd->id }}">{{ $brd->brand_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Product Name</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="specification">Specification</label>
                                        <textarea name="specification" class="form-control @error('specification') is-invalid @enderror">{{ old('specification') }}</textarea>
                                        @error('specification')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="material">Material</label>
                                        <input type="text" name="material" id="material"
                                            class="form-control @error('material') is-invalid @enderror"
                                            value="{{ old('material') }}">
                                        @error('material')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group" data-select2-id="29">
                                        <label>Tags</label>
                                        <select class="select2 select2-hidden-accessible" multiple="" name="tags[]"
                                            id="tags" data-placeholder="Select Tags" style="width: 100%;"
                                            data-select2-id="7" tabindex="-1" aria-hidden="true">
                                            @foreach ($tags as $tg)
                                                <option value="{{ $tg->name }}">{{ $tg->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('tags')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" name="price" id="price"
                                            class="form-control @error('price') is-invalid @enderror"
                                            value="{{ old('price') }}">
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="shipping">Shipping</label>
                                        <input type="number" name="shipping" id="shipping" min="0" value="0"
                                            class="form-control @error('shipping') is-invalid @enderror"
                                            value="{{ old('shipping') }}">
                                        @error('shipping')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="discount">Discount</label>
                                        <input type="number" name="discount" id="discount"
                                            class="form-control @error('discount') is-invalid @enderror"
                                            value="{{ old('discount') }}">
                                        @error('discount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" name="quantity" id="quantity"
                                            class="form-control @error('quantity') is-invalid @enderror"
                                            value="{{ old('quantity') }}">
                                        @error('quantity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}

                                    <div class="row mb-3">
                                        <div class="col-3 text-bold">Size</div>
                                        <div class="col-3 text-bold">Quantity</div>
                                        <div class="col-3 text-bold"><button type="button" onclick="addFields()"
                                                class="btn btn-primary"><i class="fas fa-plus"></i></button></div>
                                    </div>
                                    <div class="fields">
                                        <div class="row form-group fields-child">
                                            <div class="col-3">
                                                <input type="text" name="size_quantity[]" class="form-control">
                                            </div>
                                            <div class="col-3">
                                                <input type="number" name="size_quantity[]" class="form-control">
                                            </div>
                                            <div class="col-3 text-bold"><button type="button" id="1"
                                                    onclick="deleteField(this.id)" class="btn btn-danger"><i
                                                        class="fas fa-trash"></i></button></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Cover Image</label>
                                        <input type="file" name="image" id="image"
                                            class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Product Images</label>
                                        <input type="file" name="product_images[]" id="product_images"
                                            class="form-control @error('product_images') is-invalid @enderror" multiple>
                                        @error('product_images')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
    <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $('.select2').select2({
            theme: 'bootstrap4'
        })
    </script>
    <script>
        function addFields() {
            var number = document.getElementsByClassName("fields")[0].childElementCount + 1;
            var newField =
                '<div class="row form-group fields-child"><div class="col-3"><input type="text" name="size_quantity[]" class="form-control"></div><div class="col-3"><input type="number" name="size_quantity[]" class="form-control"></div><div class="col-3 text-bold"><button type="button" id="' +
                number +
                '" onclick="deleteField(this.id)" class="btn btn-danger"><i class="fas fa-trash"></i></button></div></div>';
            $(".fields").append(newField);
        }

        function deleteField(id) {
            var number = document.getElementsByClassName("fields")[0].childElementCount;
            if (number > 1) {
                $("#" + id).parent().parent().remove();
            }
        }
    </script>
@endsection
