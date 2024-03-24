@extends('backend.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="margin-top: 2%;">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="">List Of All Orders</h2>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="overflow-x: auto; max-width: 100%;">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer Name</th>
                                            <th>Customer Email</th>
                                            <th>Bunch</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $data)
                                            <tr>
                                                <td>{{ $data->order_id }}</td>
                                                <td>{{ $data->customer->name }}</td>
                                                <td>{{ $data->customer->email }}</td>
                                                <th>{{ $data->bunch == 1 ? "Bunch" : "Individual" }}</th>
                                                <td class=" text-center">
                                                    <div class="action-buttons">
                                                        <a href="{{route('order.details',$data->id)}}" class="action-button" style="margin-right: 10px;">
                                                            <i class="fa fa-edit"
                                                                style="font-size:20px;color:rgb(23, 239, 23)"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-danger">No Orders Found</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="d-flex justify-content-center">
                                {{ $orders->links() }}
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
@endsection
