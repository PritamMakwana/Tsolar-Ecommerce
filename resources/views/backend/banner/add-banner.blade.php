@extends('backend.layouts.app')
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
                            <h3 class="card-title">Add Banner</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('add-banner') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="image">Banner (only 1896 x 808) </label>
                                    <input type="file" name="image" id="image"
                                        class="form-control @error('image') is-invalid @enderror">
                                    @error('image')
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
