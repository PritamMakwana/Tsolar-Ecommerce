@extends('backend.layouts.app')
@section('style')
<style>
    .truncate-text {
        max-width: 200px;
        /* Adjust the width as needed */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        transition-delay: 1s;
    }

    .full-text {
        display: none;
    }

    .description-cell:hover .truncate-text {
        display: none;
    }

    .description-cell:hover .full-text {
        display: inline;
    }
</style>
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row" style="margin-top: 2%;">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="">List Of All Return Products</h2>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="overflow-x: auto; max-width: 100%;">
                            <div>
                                @if (request()->has('view_deleted'))
                                <a href="{{ route('return-product.show') }}" class="btn btn-primary">
                                    <i class="fa fa-arrow-left"></i>
                                    <span style="font-family: 'Source Sans Pro', sans-serif;">All Return Products</span>
                                </a>
                                @if (count($data) > 0)
                                <a href="{{ route('delete-all-return-product') }}" class="btn btn-danger" id="delete_all"
                                    style="float: right;">
                                    <i class="fa fa-trash"></i>
                                    <span style="font-family: 'Source Sans Pro', sans-serif;">Empty Trash</span>
                                </a>
                                <a href="{{ route('restore-all-return-product') }}" class="btn btn-success"
                                    style="float: right; margin-right:10px;">
                                    <i class="fa fa-history"></i>
                                    <span style="font-family: 'Source Sans Pro', sans-serif;">Restore All</span>
                                </a>
                                @endif
                                 @else
                               {{-- <a href="{{ route('add-page-category') }}" class="btn btn-primary">
                                    <i class="fa fa-plus"></i>
                                    <span style="font-family: 'Source Sans Pro', sans-serif;">Add Category</span>
                                </a> --}}
                                <a href="{{ route('return-product.show', ['view_deleted' => 'DeletedReturnProduct']) }}"
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
                                        <th>Order Id</th>
                                        <th>Return Quantity</th>
                                        <th>Reason</th>
                                        <th>Comments</th>
                                        <th>Product</th>
                                        {{-- <th>Image</th>
                                        <th style="width: 70%;">Name</th>
                                        @if (!request()->has('view_deleted'))
                                        <th class="text-center">Visible</th>
                                        @endif--}}
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($data) > 0)
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach ($data as $rp)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $rp->order->order_id }}</td>
                                        <td>{{ $rp->quantity }}</td>
                                        <td>{{ $rp->reason }}</td>
                                        <td  class="description-cell">
                                            <div class="truncate-text">{{ $rp->comments }}</div>
                                            <div class="full-text">{{ $rp->comments }}</div>
                                        </td>
                                        <td>{{ $rp->order->carts->products->product_name }}</td>
                                        {{-- <td>{{ $rp->order->carts->products->product_name }}</td>
                                        <td>{{ $rp->order->carts->products->product_name }}</td> --}}




                                        <td class=" text-center">
                                            @if (request()->has('view_deleted'))
                                            <div class="action-buttons">
                                                <a href="{{ route('restore-return-product',$rp->id) }}" class="action-button"
                                                    style="margin-right: 10px;">
                                                    <i class="fa fa-history"
                                                        style="font-size:20px;color:rgb(23, 239, 23)"></i>
                                                </a>
                                                <a href="{{ route('force-delete-return-product',$rp->id) }}"
                                                    class="action-button" id="fdelete" style="margin-right: 10px;">
                                                    <i class="fa fa-trash" style="font-size:20px;color:red"></i>
                                                </a>
                                            </div>
                                            @else
                                            <div class="action-buttons">
                                                {{-- <a href="{{ route('edit-page-category',$rp->id) }}"
                                                    class="action-button" style="margin-right: 10px;">
                                                    <i class="fa fa-edit"
                                                        style="font-size:20px;color:rgb(23, 239, 23)"></i>
                                                </a> --}}
                                                <a href="{{ route('delete-return-product',$rp->id) }}" id="delete"
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
                                        <td colspan="7" class="text-center text-danger">No Product Return Found</td>
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
