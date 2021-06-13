@extends('layouts.backend.vuelayout')
@section('title','Product List')

@section('content')
<index-product :url="{{json_encode(["url" => url('/')])}}" :products="{{json_encode($products)}}">Loading </index-product>
@endsection

