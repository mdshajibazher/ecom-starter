@extends('layouts.backend.vuelayout')

@section('title','collections')

@section('content')
<subcollection-label :labels="{{ json_encode($groupLabels) }}"> Loading </subcollection-label>
@endsection


