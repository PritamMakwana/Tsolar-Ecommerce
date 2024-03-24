@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="margin-top: 2%;">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="">List Of All Products</h2>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="overflow-x: auto; max-width: 100%;">
                                <div>
                                    @if (request()->has('view_deleted'))
                                        <a href="{{ route('show-products') }}" class="btn btn-primary">
                                            <i class="fa fa-arrow-left"></i>
                                            <span style="font-family: 'Source Sans Pro', sans-serif;">All Products</span>
                                        </a>
                                        @if (count($data) > 0)
                                            <a href="{{ route('delete-all-product') }}" class="btn btn-danger"
                                                id="delete_all" style="float: right;">
                                                <i class="fa fa-trash"></i>
                                                <span style="font-family: 'Source Sans Pro', sans-serif;">Empty Trash</span>
                                            </a>
                                            <a href="{{ route('restore-all-product') }}" class="btn btn-success"
                                                style="float: right; margin-right:10px;">
                                                <i class="fa fa-history"></i>
                                                <span style="font-family: 'Source Sans Pro', sans-serif;">Restore All</span>
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ route('add-page-product') }}" class="btn btn-primary">
                                            <i class="fa fa-plus"></i>
                                            <span style="font-family: 'Source Sans Pro', sans-serif;">Add Product</span>
                                        </a>
                                        <a href="{{ route('show-products', ['view_deleted' => 'DeletedCategories']) }}"
                                            class="btn btn-danger" style="float: right;">
                                            <i class="fa fa-trash"></i>
                                            <span style="font-family: 'Source Sans Pro', sans-serif;">Trash</span>
                                        </a>
                                    @endif
                                </div><br>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            @if (!request()->has('view_deleted'))
                                                <th class="text-center">Popular</th>
                                                <th class="text-center">Latest</th>
                                            @endif
                                            <th>Image</th>
                                            <th>Product Id</th>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Specification</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            {{-- <th>Quantity</th> --}}
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($data) > 0)
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($data as $p)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    @if (!request()->has('view_deleted'))
                                                        <td>
                                                            <input type="checkbox" class="checkbox" id="visible"
                                                                data-id="{{ $p->id }}"
                                                                {{ $p->visible == 'true' ? 'checked' : '' }} />
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="checkbox" id="latest"
                                                                data-id="{{ $p->id }}"
                                                                {{ $p->latest == 1 ? 'checked' : '' }} />
                                                        </td>
                                                    @endif
                                                    <td><img src="{{ asset('Product_thumbnails/' . $p->image) }}" width="30"
                                                            height="30"></td>
                                                    <td>{{ $p->product_id }}</td>
                                                    <td>{{ $p->category()->withTrashed()->first()->name ?? $p->category->name }}
                                                    </td>
                                                    <td>{{ $p->product_name }}</td>
                                                    <td><span
                                                            style="
                                            display:inline-block;
                                            white-space: nowrap;
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                            max-width: 30ch;">{{ $p->specification }}
                                                        </span></td>
                                                    <td>{{ $p->price }}</td>
                                                    <td>{{ $p->discount }}</td>
                                                    {{-- <td>{{ $p->quantity }}</td> --}}

                                                    <td class=" text-center">
                                                        @if (request()->has('view_deleted'))
                                                            <div class="action-buttons">
                                                                <a href="{{ route('restore-product', $p->id) }}"
                                                                    class="action-button" style="margin-right: 10px;">
                                                                    <i class="fa fa-history"
                                                                        style="font-size:20px;color:rgb(23, 239, 23)"></i>
                                                                </a>
                                                                <a href="{{ route('force-delete-product', $p->id) }}"
                                                                    class="action-button" id="fdelete"
                                                                    style="margin-right: 10px;">
                                                                    <i class="fa fa-trash"
                                                                        style="font-size:20px;color:red"></i>
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="action-buttons">
                                                                <a href="{{ route('edit-page-product', $p->id) }}"
                                                                    class="action-button" style="margin-right: 10px;">
                                                                    <i class="fa fa-edit"
                                                                        style="font-size:20px;color:rgb(23, 239, 23)"></i>
                                                                </a>
                                                                <a href="{{ route('delete-product', $p->id) }}"
                                                                    id="delete" class="action-button">
                                                                    <i class="fa fa-trash"
                                                                        style="font-size:20px;color:red"></i>
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="10" class="text-center">No Products Found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->

                            <!-- Pagination Links -->



                            @if ($pagi == true)

                                @if ($data->hasPages())
                                    <div style="display: flex; justify-content: center; margin-top: 4rem;">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                                @if ($data->onFirstPage())
                                                    <li class="page-item disabled">
                                                        <span class="page-link">Previous</span>
                                                    </li>
                                                @else
                                                    <li class="page-item">
                                                        <a class="page-link"
                                                            href="{{ $data->previousPageUrl() }}">Previous</a>
                                                    </li>
                                                @endif

                                                @php
                                                    // Calculate the total number of pages
                                                    $totalPages = ceil($data->total() / $data->perPage());
                                                @endphp

                                                @for ($i = 1; $i <= $totalPages; $i++)
                                                    <li class="page-item{{ $data->currentPage() == $i ? ' active' : '' }}">
                                                        <a class="page-link"
                                                            href="{{ $data->url($i) }}">{{ $i }}</a>
                                                    </li>
                                                @endfor

                                                @if ($data->hasMorePages())
                                                    <li class="page-item">
                                                        <a class="page-link" href="{{ $data->nextPageUrl() }}">Next</a>
                                                    </li>
                                                @else
                                                    <li class="page-item disabled">
                                                        <span class="page-link">Next</span>
                                                    </li>
                                                @endif
                                            </ul>
                                        </nav>
                                    </div>
                                @endif

                            @endif




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
        const checkboxes = document.querySelectorAll('#visible');
        const checklatest = document.querySelectorAll('#latest');

        // const maxChecked = 8;


        // const checkedCount = document.querySelectorAll('.checkbox:checked').length;
        // if (checkedCount >= maxChecked) {
        //     checkboxes.forEach((cb) => {
        //         if (!cb.checked) {
        //             cb.disabled = true;
        //         }
        //     });
        // } else {
        //     checkboxes.forEach((cb) => {
        //         cb.disabled = false;
        //     });
        // }


        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', function() {
                // const checkedCount = document.querySelectorAll('.checkbox:checked').length;
                // if (checkedCount >= maxChecked) {
                //     checkboxes.forEach((cb) => {
                //         if (!cb.checked) {
                //             cb.disabled = true;
                //         }
                //     });
                // } else {
                //     checkboxes.forEach((cb) => {
                //         cb.disabled = false;
                //     });
                // }

                const id = this.getAttribute('data-id');
                const checked = this.checked;

                let url = '{{ route('visible-change-product', ['id' => ':id']) }}';
                url = url.replace(":id", id);

                // console.log(url);

                // Send an AJAX request to update the database
                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            checked
                        }),
                    })
                    .then((response) => response.json())
                    .then((data) => console.log(data));
                // .catch((error) => console.error(error));
            });
        });

        checklatest.forEach((checkbox) => {
            checkbox.addEventListener('change', function() {

                const id = this.getAttribute('data-id');
                const checked = this.checked;

                let url = '{{ route('latest-change-product', ['id' => ':id']) }}';
                url = url.replace(":id", id);

                // console.log(url);

                // Send an AJAX request to update the database
                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            checked
                        }),
                    })
                    .then((response) => response.json())
                    .then((data) => console.log(data));
                // .catch((error) => console.error(error));
            });
        });
    </script>
@endsection
