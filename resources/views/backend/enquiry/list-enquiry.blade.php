@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="margin-top: 2%;">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="">List Of All Enquiry Form Entries</h2>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="overflow-x: auto; max-width: 100%;">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Message</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($Enquiry as $data)
                                            <tr>
                                                <td>{{ $data->id }}</td>
                                                <td>{{ $data->full_name }}</td>
                                                <td>{{ $data->email }}</td>
                                                <td>{{ $data->phone }}</td>
                                                <td>{{ $data->address }}</td>
                                                <td>{{ $data->message }}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-primary" href="mailto::{{$data->email}}" role="button"><i class="fas fa-envelope"></i></a>
                                                    <a class="btn btn-danger" id="fdelete" href="{{route('enquiry.delete',$data->id)}}" role="button"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-danger">No Enquiry Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <!-- Pagination Links -->
                            {{ $Enquiry->links() }}
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
