@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Product form') }}</div>

                <div class="card-body">
                  @if( isset($Products->product_id) )
                  <form method="POST" action="{{url('product/update').'/'.$Products->product_id}}" enctype="multipart/form-data">
                  @else
                  <form method="POST" action="{{ url('product/save') }}" enctype="multipart/form-data">
                  @endif
                    @csrf
                    <div class="form-group row">
                      <label for="product_name" class="col-md-4 col-form-label text-md-right">{{ __('Product name') }}</label>
                      <div class="col-md-6">
                        <input id="product_name" type="text" class="form-control" name="product_name" value="@if( isset($Products->product_id) ){{$Products->product_name}}@endif" required autocomplete="name" autofocus>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="product_price" class="col-md-4 col-form-label text-md-right">{{ __('Product price') }}</label>
                      <div class="col-md-6">
                        <input id="product_price" type="number" class="form-control" name="product_price" required  value="@if( isset($Products->product_id) ){{$Products->product_price}}@endif">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="product_image" class="col-md-4 col-form-label text-md-right">{{ __('Product image') }}</label>
                      <div class="col-md-6">
                        <input id="product_image" type="file" class="form-control" name="product_image" accept="image/*">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="product_image_oth" class="col-md-4 col-form-label text-md-right">{{ __('Product image other') }}</label>
                      <div class="col-md-6">
                        <input id="product_image_oth" type="file" class="form-control" multiple name="product_image_oth[]" accept="image/*">
                      </div>
                    </div>
                    @if( isset($Image) )
                      @foreach ($Image as $key => $Image)
                        {{ $Image->product_image_name }}<br>
                      @endforeach
                    @endif
                    <div class="form-group row mb-0">
                      <div class="col-md-6 offset-md-4">
                        @if( isset($Products->product_id) )
                        <button type="submit" class="btn btn-warning">
                          {{ __('Save') }}
                        </button>
                        @else
                        <button type="submit" class="btn btn-primary">
                          {{ __('Save') }}
                        </button>
                        @endif

                      </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
