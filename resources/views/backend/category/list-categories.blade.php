@extends('backend.layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row" style="margin-top: 2%;">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="">List Of All Categories</h2>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="overflow-x: auto; max-width: 100%;">
                            <div>
                                @if (request()->has('view_deleted'))
                                <a href="{{ route('show-categories') }}" class="btn btn-primary">
                                    <i class="fa fa-arrow-left"></i>
                                    <span style="font-family: 'Source Sans Pro', sans-serif;">All Categories</span>
                                </a>
                                @if (count($data) > 0)
                                <a href="{{ route('delete-all-category') }}" class="btn btn-danger"
                                    id="delete_all" style="float: right;">
                                    <i class="fa fa-trash"></i>
                                    <span style="font-family: 'Source Sans Pro', sans-serif;">Empty Trash</span>
                                </a>
                                <a href="{{ route('restore-all-category') }}" class="btn btn-success"
                                    style="float: right; margin-right:10px;">
                                    <i class="fa fa-history"></i>
                                    <span style="font-family: 'Source Sans Pro', sans-serif;">Restore All</span>
                                </a>
                                @endif
                                @else
                                <a href="{{ route('add-page-category') }}" class="btn btn-primary">
                                    <i class="fa fa-plus"></i>
                                    <span style="font-family: 'Source Sans Pro', sans-serif;">Add Category</span>
                                </a>
                                <a href="{{ route('show-categories', ['view_deleted' => 'DeletedCategories']) }}"
                                    class="btn btn-danger" style="float: right;">
                                    <i class="fa fa-trash"></i>
                                    <span style="font-family: 'Source Sans Pro', sans-serif;">Trash</span>
                                </a>
                                @endif
                            </div><br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th style="width: 70%;">Name</th>
                                        @if (!request()->has('view_deleted'))
                                        {{-- <th class="text-center">Visible</th> --}}
                                        @endif
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($data) > 0)
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach ($data as $ctr)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td><img src="{{ asset('category_thumbnails/' . $ctr->image) }}" width="30"
                                                height="30"></td>
                                        <td>{{ $ctr->name }}</td>
                                        {{-- @if (!request()->has('view_deleted'))
                                        <td>
                                            <input type="checkbox" class="checkbox" data-id="{{ $ctr->id }}"
                                                {{$ctr->visible == 'true' ? 'checked' : '' }} />
                                        </td> --}}
                                        {{-- @endif --}}
                                        <td class=" text-center">
                                            @if (request()->has('view_deleted'))
                                            <div class="action-buttons">
                                                <a href="{{ route('restore-category',$ctr->id) }}"
                                                    class="action-button" style="margin-right: 10px;">
                                                    <i class="fa fa-history"
                                                        style="font-size:20px;color:rgb(23, 239, 23)"></i>
                                                </a>
                                                <a href="{{ route('force-delete-category',$ctr->id) }}"
                                                    class="action-button" id="fdelete" style="margin-right: 10px;">
                                                    <i class="fa fa-trash" style="font-size:20px;color:red"></i>
                                                </a>
                                            </div>
                                            @else
                                            <div class="action-buttons">
                                                <a href="{{ route('edit-page-category',$ctr->id) }}" class="action-button"
                                                    style="margin-right: 10px;">
                                                    <i class="fa fa-edit"
                                                        style="font-size:20px;color:rgb(23, 239, 23)"></i>
                                                </a>
                                                <a href="{{ route('delete-category',$ctr->id) }}" id="delete"
                                                    class="action-button">
                                                    <i class="fa fa-trash" style="font-size:20px;color:red"></i>
                                                </a>
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" class="text-center">No Categories Found</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <!-- Pagination Links -->



                        @if($pagi == true)

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
                                        <a class="page-link" href="{{ $data->previousPageUrl() }}">Previous</a>
                                    </li>
                                    @endif

                                    @php
                                    // Calculate the total number of pages
                                    $totalPages = ceil($data->total() / $data->perPage());
                                    @endphp

                                    @for ($i = 1; $i <= $totalPages; $i++) <li
                                        class="page-item{{ $data->currentPage() == $i ? ' active' : '' }}">
                                        <a class="page-link" href="{{ $data->url($i) }}">{{ $i }}</a>
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
{{--
<script>
    const checkboxes = document.querySelectorAll('.checkbox');
    const maxChecked = 6;


        const checkedCount = document.querySelectorAll('.checkbox:checked').length;
            if (checkedCount >= maxChecked) {
                checkboxes.forEach((cb) => {
                    if (!cb.checked) {
                        cb.disabled = true;
                    }
                });
            } else {
                checkboxes.forEach((cb) => {
                    cb.disabled = false;
                });
            }


    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', function () {
            const checkedCount = document.querySelectorAll('.checkbox:checked').length;
            if (checkedCount >= maxChecked) {
                checkboxes.forEach((cb) => {
                    if (!cb.checked) {
                        cb.disabled = true;
                    }
                });
            } else {
                checkboxes.forEach((cb) => {
                    cb.disabled = false;
                });
            }

            const id = this.getAttribute('data-id');
            const checked = this.checked;

            let url = '{{ route('visible-change',['id' => ":id"])}}';
            url  = url.replace(":id", id);

            // console.log(url);

            // Send an AJAX request to update the database
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ checked }),
            })
            .then((response) => response.json())
            .then((data) => console.log(data));
            // .catch((error) => console.error(error));
        });
    });
</script>
@endsection --}}
