@extends('layouts.backend.vuelayout')

@section('title','collections')

@section('content')
<product-collections :collections="{{json_encode($collections)}}" :subcollections="{{json_encode($subcollection)}}" :labels="{{ json_encode($groupLabels) }}"> Loading </product-collections>
@endsection


