@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="margin-top: 2%;">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="">List Of All NewsLetter</h2>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="overflow-x: auto; max-width: 100%;">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($Newsletter as $data)
                                            <tr>
                                                <td>{{ $data->id }}</td>
                                                <td>{{ $data->email }}</td>
                                                <td class="text-center"><a class="btn btn-primary" href="mailto::{{$data->email}}" role="button"><i class="fas fa-envelope"></i></a></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-danger">No Newsletter Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <!-- Pagination Links -->
                            {{ $Newsletter->links() }}
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
