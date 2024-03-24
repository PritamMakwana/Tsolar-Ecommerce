@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="margin-top: 2%;">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="">List Of All Brands</h2>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="overflow-x: auto; max-width: 100%;">
                                <div>
                                    @if (request()->has('view_deleted'))
                                        <a href="{{ route('brand.show') }}" class="btn btn-primary">
                                            <i class="fa fa-arrow-left"></i>
                                            <span style="font-family: 'Source Sans Pro', sans-serif;">All Brands</span>
                                        </a>
                                        @if (count($data) > 0)
                                            <a href="{{ route('brand.delete.all') }}" class="btn btn-danger" id="delete_all"
                                                style="float: right;">
                                                <i class="fa fa-trash"></i>
                                                <span style="font-family: 'Source Sans Pro', sans-serif;">Empty Trash</span>
                                            </a>
                                            <a href="{{ route('brand.restore.all') }}" class="btn btn-success"
                                                style="float: right; margin-right:10px;">
                                                <i class="fa fa-history"></i>
                                                <span style="font-family: 'Source Sans Pro', sans-serif;">Restore All</span>
                                            </a>
                                        @endif
                                    @else
                                        <div class="d-flex justify-content-between align-items-center">

                                            <form action="{{ route('brand.add') }}" method="post" class="row">
                                                @csrf
                                                <input type="text" name="brand_name" class="form-control col-8 mr-2"
                                                    placeholder="Brand Name">
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>
                                                    Add</button>
                                            </form>

                                            <a href="{{ route('brand.show', ['view_deleted' => 'DeletedBrands']) }}"
                                                class="btn btn-danger" style="float: right;">
                                                <i class="fa fa-trash"></i>
                                                <span style="font-family: 'Source Sans Pro', sans-serif;">Trash</span>
                                            </a>
                                        </div>
                                    @endif
                                </div><br>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th style="width: 70%;">Name</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($data) > 0)
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($data as $brd)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $brd->brand_name }}</td>
                                                    <td class=" text-center">
                                                        @if (request()->has('view_deleted'))
                                                            <div class="action-buttons">
                                                                <a href="{{ route('brand.restore', $brd->id) }}"
                                                                    class="action-button" style="margin-right: 10px;">
                                                                    <i class="fa fa-history"
                                                                        style="font-size:20px;color:rgb(23, 239, 23)"></i>
                                                                </a>
                                                                <a href="{{ route('force-delete-category', $brd->id) }}"
                                                                    class="action-button" id="fdelete"
                                                                    style="margin-right: 10px;">
                                                                    <i class="fa fa-trash"
                                                                        style="font-size:20px;color:red"></i>
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="action-buttons">
                                                                <a href="#" class="action-button"
                                                                    style="margin-right: 10px;"
                                                                    onclick="edit({{ $brd->id }})">
                                                                    <i class="fa fa-edit"
                                                                        style="font-size:20px;color:rgb(23, 239, 23)"></i>
                                                                </a>
                                                                <a href="{{ route('brand.delete', $brd->id) }}"
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
                                                <td colspan="3" class="text-center">No Brands Found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="d-flex justify-content-center">
                                {{ $data->links() }}
                            </div>
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

    {{-- Modal --}}
    <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Brand</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('brand.edit') }}" method="POST">
                        @csrf
                        <input type="text" name="brand_name" id="edit_brand_name" class="form-control">
                        <input type="hidden" name="id" id="edit_id">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection

@section('script')
    <script>
        function edit(id) {
            $.ajax({
                url: "{{ route('brand.edit.data') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log(response);
                    $('#modal-default').modal('show');
                    $('#edit_brand_name').val(response.brand_name);
                    $('#edit_id').val(response.id);
                }
            })
        }
    </script>
@endsection
