@extends('backend.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="margin-top: 2%;">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="">Tags</h2>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="overflow-x: auto; max-width: 100%;">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center">

                                        <form action="{{ route('tags.create') }}" method="post" class="row">
                                            @csrf
                                            <input type="text" name="name" class="form-control col-8 mr-2"
                                                placeholder="Tag Name">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>
                                                Add</button>
                                        </form>
                                    </div>
                                </div><br>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th style="width: 70%;">Name</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($tags as $tag)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{ $tag->name }}</td>
                                                <td class=" text-center">
                                                    <div class="action-buttons">
                                                        <a href="#" class="action-button" style="margin-right: 10px;"
                                                            onclick="edit({{ $tag->id }})">
                                                            <i class="fa fa-edit"
                                                                style="font-size:20px;color:rgb(23, 239, 23)"></i>
                                                        </a>
                                                        <a href="{{ route('tags.delete', $tag->id) }}" id="delete"
                                                            class="action-button">
                                                            <i class="fa fa-trash" style="font-size:20px;color:red"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">No Tags Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="d-flex justify-content-center">
                                {{ $tags->links() }}
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
                    <h4 class="modal-title">Edit Tag</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tags.edit') }}" method="POST">
                        @csrf
                        <input type="text" name="name" id="edit_tag_name" class="form-control">
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
                url: "{{ route('tags.edit.data') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(response) {
                    $('#edit_tag_name').val(response.name);
                    $('#edit_id').val(response.id);
                    $('#modal-default').modal('show');
                }
            });
        }
    </script>
@endsection
