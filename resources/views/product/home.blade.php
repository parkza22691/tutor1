@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ Auth::user()->name }}</div>

                <div class="card-body table-responsive">
                    <a href="{{ url('product/form') }}" class="btn btn-primary">Add Product</a>
                    <br><br>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>image</th>
                          <th>สินค้า</th>
                          <th>ราคา</th>
                          <th></th>
                        </tr>
                      </thead>

                      <tbody id="table_detail">
                        @foreach ($Products as $key => $product)
                        <tr>
                          <td>{{$key+1}}</td>
                          <td>
                            <img src="storage/uploads/{{$product->product_image}}" style="max-height:100px;max-width:100px;" alt="">
                          </td>
                          <td>{{ $product->product_name }}</td>
                          <td>{{ number_format($product->product_price,2) }}</td>
                          <td>
                            <a href="{{ url('product/read/').'/'.$product->product_id }}" class="btn btn-warning btn-xs">Edit</a>
                            <a href="{{ url('product/delete/').'/'.$product->product_id }}" class="btn btn-danger btn-xs">Delete</a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>

                    </table>
                    {{ $Products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/product.js" charset="utf-8"></script>
@endsection
