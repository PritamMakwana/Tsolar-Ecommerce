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
                            <h3 class="card-title">Add Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('add-blog') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" placeholder="Enter Title" value="{{ old('title') }}">

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description"
                                        class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Hyperlink</label>
                                    <input type="text" class="form-control @error('hyperlink') is-invalid @enderror"
                                        id="hyperlink" name="hyperlink" placeholder="Enter Hyperlink"
                                        value="{{ old('hyperlink') }}">

                                    @error('hyperlink')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" id="image"
                                        class="form-control @error('image') is-invalid @enderror">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image">PDF</label>
                                    <input type="file" name="pdf" id="pdf"
                                        class="form-control @error('pdf') is-invalid @enderror">
                                    @error('pdf')
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
