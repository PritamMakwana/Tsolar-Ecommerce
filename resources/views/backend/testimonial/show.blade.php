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
                            <h2 class="">List Of All Testimonial</h2>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="overflow-x: auto; max-width: 100%;">
                            <div>
                                <a href="{{ route('add-page-testimonial') }}" class="btn btn-primary">
                                    <i class="fa fa-plus"></i>
                                    <span style="font-family: 'Source Sans Pro', sans-serif;">Add Testimonial</span>
                                </a>
                            </div><br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Username</th>
                                        <th style="width: 70%;">Description</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($data) > 0)
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td><img src="{{ asset('testimonial_images/' . $d->image) }}" width="30" height="30">
                                        </td>
                                        <td>{{ $d->username }}</td>
                                        <td class="description-cell">
                                            <div class="truncate-text">{{ $d->description }}</div>
                                            <div class="full-text">{{ $d->description }}</div>
                                        </td>
                                        <td class=" text-center">
                                            <div class="action-buttons">
                                                <a href="{{ route('edit-page-testimonial',$d->id) }}" class="action-button"
                                                    style="margin-right: 10px;">
                                                    <i class="fa fa-edit"
                                                        style="font-size:20px;color:rgb(23, 239, 23)"></i>
                                                </a>
                                                <a href="{{ route('delete-testimonial',$d->id) }}" id="fdelete"
                                                    class="action-button">
                                                    <i class="fa fa-trash" style="font-size:20px;color:red"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" class="text-center">No Testimonial Found</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <!-- Pagination Links -->




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
