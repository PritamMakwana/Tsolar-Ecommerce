@extends('frontend.layouts.app')
@section('title', 'Tsolar - Our Products')
@section('style')
<style>
    /* Products Section */

    .icon-control {
        margin-top: 5px;
        float: right;
        font-size: 80%;
    }



    .btn-light {
        background-color: #fff;
        border-color: #e4e4e4;
    }

    .list-menu {
        list-style: none;
        margin: 0;
        padding-left: 0;
    }

    .list-menu a {
        color: #343a40;
    }

    .card-product-grid .info-wrap {
        overflow: hidden;
        padding: 18px 20px;
    }

    [class*='card-product'] a.title {
        color: #212529;
        display: block;
    }

    .card-product-grid:hover .btn-overlay {
        opacity: 1;
    }

    .card-product-grid .btn-overlay {
        -webkit-transition: .5s;
        transition: .5s;
        opacity: 0;
        left: 0;
        bottom: 0;
        color: #fff;
        width: 100%;
        padding: 5px 0;
        text-align: center;
        position: absolute;
        background: rgba(0, 0, 0, 0.5);
    }

    .img-wrap {
        overflow: hidden;
        position: relative;
    }


    .custom-checkbox {
        display: flex;
        gap: 5px;
    }

    .title {
        color: #000;

    }

    a {
        text-decoration: none !important;
    }

    .type-of-quantity {
        color: grey;
    }

    .product-buyNow {
        background-color: #d8ff4d;
        margin-left: 5%;
    }
</style>
@endsection
@section('content')
<div class="container" style="margin-top: 5%;">
    <livewire:frontend.products.index />
</div>

@endsection
