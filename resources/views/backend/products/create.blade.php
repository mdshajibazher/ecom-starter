@extends('layouts.backend.vuelayout')
@section('modal')
<!-- Modal -->
<div class="modal fade" id="imageUploaderModal" tabindex="-1" aria-labelledby="imageUploaderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <variant-image-uploader/>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Product</h1>
    </div>
    
    <create-product :colors_props="{{$colors}}" :sizes_props="{{$sizes}}"  :collections_props="{{ json_encode($collections)}}" :subcollections="{{ json_encode($subcollections)}}">Loading</create-product>

@endsection
