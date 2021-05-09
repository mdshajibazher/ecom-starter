@extends('layouts.backend.vuelayout')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Product</h1>
    </div>
    
    <create-product :variants="{{ json_encode($variants) }}" :props_collections="{{ json_encode($collections)}}" :subcollections="{{ json_encode($subcollections)}}">Loading</create-product>

@endsection
