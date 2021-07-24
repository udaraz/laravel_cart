@extends('back-office.master')

@section('title', 'Product Add')

@section('main-content')
    <div class="card card-user">
        <div class="card-header">
            <h5 class="card-title">Add Product</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('admin.product.store')}}" enctype="multipart/form-data">
                @csrf

                @include('back-office.products.form')

                <div class="row">
                    <div class="ml-auto mr-3">
                        <button type="submit" class="btn btn-primary btn-round">Create Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
