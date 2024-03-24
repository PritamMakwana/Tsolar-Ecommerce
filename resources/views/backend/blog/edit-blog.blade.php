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
                                <h3 class="card-title">Update Blog</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('edit-blog') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $fetch->id }}">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="name">Title</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            id="title" name="title" placeholder="Enter Title"
                                            value="{{ $fetch->title }}">

                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ $fetch->description }}</textarea>
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
                                            value="{{ $fetch->hyperlink }}">

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
                                        <img class="mt-1" src="{{ asset('blogs_images/' . $fetch->image) }}"
                                            height="150px" width="150px" />
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="pdf">PDF</label>
                                        <input type="file" name="pdf" id="pdf"
                                            class="form-control @error('pdf') is-invalid @enderror">
                                        <a href="{{ asset('blogs_pdfs/' . $fetch->pdf) }}">PDF</a>
                                        @error('pdf')
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
