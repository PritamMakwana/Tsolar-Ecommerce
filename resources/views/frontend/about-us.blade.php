@extends('frontend.layouts.app')
@section('content')
    <div class="blogs_container-main">
        {{-- <div style="display: flex;justify-content: center;margin-top: 2.5%;"> --}}
        <div class="d-flex flex-column main" style="margin: 5%;">
            {!! $aboutus->title !!}
            {{-- </div> --}}

            {{-- <div style="display: flex;;margin-top: 2.5%;"> --}}
            {!! $aboutus->description !!}
            {{-- </div> --}}
        </div>

    </div>
@endsection
