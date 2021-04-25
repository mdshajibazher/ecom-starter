@extends('layouts.backend.app')


@section('title','Products')



@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-news-paper icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ __('All Products') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('app.product.create') }}" class="btn-shadow btn btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-plus-circle fa-w-20"></i>
                        </span>
                        {{ __('Create Product') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="main-card mb-3 card">
                <div class="overflow-hidden">
                    <div class="form-group">
                        <form action="{{route('app.product.search')}}" method="POST" class="card-header">
                            @csrf
                            @method('POST')
                            <div class="form-row justify-content-between">
                                <div class="col-md-4">
                                    <input type="text" name="title" placeholder="Product Title" class="form-control">
                                    @error('title')
                                       <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
          
                
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Price Range</span>
                                        </div>
                                        <input type="text" name="price_from" aria-label="First name" placeholder="From" class="form-control">
                                        <input type="text" name="price_to" aria-label="Last name" placeholder="To" class="form-control">
                                         @error('price_from')
                                           <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                         @error('price_to')
                                           <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary float-right"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-hover" >
                        <thead>
                        <tr>
                            <th>#</th>
                            <th width="10%">Title</th>
                            <th>Description</th>
                            <th>Variant</th>
                            <th width="150px">Action</th>
                        </tr>
                        </thead>
    
                        <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$product->title}} </td>
                                <td>{{$product->description}}</td>
                                <td>
                                    <dl class="row mb-0" style="height: 80px; overflow: hidden" id="variant">
    
                                        @forelse($product->prices as $price)
                                            <dt class="col-sm-3 pb-0">
                                                {{$price->variant_one==null?'':$price->variant_one->variant.'/' }}
    
                                                {{$price->variant_two!=null?$price->variant_two->variant.'/':''}}
                                                
                                                {{$price->variant_three!=null?$price->variant_three->variant.'/':''}}
                                            </dt>
                                            <dd class="col-sm-9">
                                                <dl class="row mb-0">
                                                    <dt class="col-sm-4 pb-0">Price : {{ number_format($price->price,2) }}</dt>
                                                    <dd class="col-sm-8 pb-0">InStock : {{ number_format($price->stock,2) }}</dd>
                                                </dl>
                                            </dd>
                                        @empty
                                        @endforelse
    
                                    </dl>
                                    <button onclick="$('#variant').toggleClass('h-auto')" class="btn btn-sm btn-link">Show more</button>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('app.product.edit', $product->id) }}" class="btn btn-success">Edit</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"><h1 class="text-center">Data not found</h1></td>
                            </tr>
                        @endforelse
    
                        </tbody>
    
                    </table>
                </div>
                <div class="row justify-content-between">
                    @if(filled($products))
                        <div class="col-md-6">
                            <p>Showing {{$products->firstItem()}} to {{ $products->lastItem() }} out of {{ $products->total() }}</p>
                        </div>
                        <div class="col-md-2">
                            {{$products->links()}}
                        </div>
                    @endif
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

