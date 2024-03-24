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
                            <h3 class="card-title">Privacy Policy</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('privacy-policy-data') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Title</label>
                                    <textarea name="title" id="titleA">{{ $fetch->title }}</textarea>
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>


                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" id="descB">{{ $fetch->description }}</textarea>

                                </div>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

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
@section('script')
<script>
    $(document).ready(function() {
        $('#titleA').summernote();
        $('#descB').summernote();
    });
</script>
@endsection
