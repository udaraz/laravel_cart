@extends('back-office.master')

@section('title', 'Product Manage')

@section('main-content')
    <div class="card card-user">
        <div class="card-header">
            <h5 class="card-title">Manage Product</h5>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif

            <table class="table table-bordered data-table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Description</th>
                    <th>Categoty</th>
                    <th>Images</th>
                    <th width="100px">Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>

            </table>
        </div>
    </div>


@endsection

@push('custom-css')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@push('custom-scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src={{asset('assets/js/back-office/products/product-datatable.js')}}></script>

@endpush
