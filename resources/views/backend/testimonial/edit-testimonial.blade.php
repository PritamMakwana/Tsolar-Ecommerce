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
                            <h3 class="card-title">Update Testimonial</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('edit-testimonial') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $fetch->id }}">
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="name">Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="username" name="username" placeholder="Enter Username"
                                        value="{{ $fetch->username }}">

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Description must not exceed 500 characters." maxlength="500"
                                        name="description"
                                        class="form-control @error('description') is-invalid @enderror">{{ $fetch->description }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>



                                <div class="form-group">
                                    <label for="image">Image (height:408px width:612px )</label>
                                    <input type="file" name="image" id="image"
                                        class="form-control @error('image') is-invalid @enderror">
                                    <img class="mt-1" src="{{ asset('testimonial_images/' . $fetch->image) }}"
                                        style="height:350px;border-radius:5px" />
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
