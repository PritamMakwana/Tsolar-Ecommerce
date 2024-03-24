@extends('frontend.layouts.app')
@section('content')
    <h3>Hello, {{ Auth::guard('customer')->user()->name }}</h3>
    <a href="{{ route('customer-logout') }}" class="btn btn-danger">Logout</a>
@endsection
