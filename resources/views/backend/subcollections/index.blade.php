@extends('layouts.backend.vuelayout')

@section('title','collections')

@section('content')
<product-subcollections :subcollections="{{json_encode($subcollections)}}" :labels="{{ json_encode($groupLabels) }}"> Loading </product-subcollections>
@endsection

