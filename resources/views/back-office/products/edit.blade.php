@extends('back-office.master')

@section('title', 'Product Add')

@section('main-content')
    <div class="card card-user">
        <div class="card-header">
            <h5 class="card-title">Edit Product</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('admin.product.update',['product' => $product->id])}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="id" name="id" value="{{$product->id}}">
                @include('back-office.products.form')

                <div class="row">
                    @foreach($product->images as $image)
                        <div class="col-md-2">
                            <div class="bg-light text-center">
                                <img class="p-1" src="/{{$image->image}}" alt="">
                                <a href="{{route('admin.products.image.delete',['id' => $image->id])}}" class="btn btn-sm btn-danger text-white">Delete</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="ml-auto mr-3">
                        <button type="submit" class="btn btn-primary btn-round">Update Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
