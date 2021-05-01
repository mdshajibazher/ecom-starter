@extends('layouts.backend.vuelayout')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Collection</h1>
    </div>
    <product-collections :labels="{{ $groupLabels }}"> Loading </product-collections>
@endsection
