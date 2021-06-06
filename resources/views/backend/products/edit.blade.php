@extends('layouts.backend.vuelayout')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Product</h1>
    </div>
    <div id="app">
        <create-product :colors_props="{{$colors}}" :sizes_props="{{$sizes}}" :collections_props="{{ json_encode($collections)}}" :subcollections="{{ json_encode($subcollections)}}" :products="{{ json_encode($product) }}" :prices="{{ $prices }}" :image="{{$images}}" :edit_mode="true">Loading</create-product>
    </div>
@endsection
