@extends('back-office.master')

@section('title', 'Product Manage')

@section('main-content')
    <div class="card card-user">
        <div class="card-header">
            <h5 class="card-title">Sales</h5>
        </div>
        <div class="card-body">

            <table class="table table-bordered data-table w-100">
                <thead>
                <tr>
                    <th>Order_Id</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Country</th>
                    <th>Province</th>
                    <th>Zip</th>
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
    <script src={{asset('assets/js/back-office/sales/sales-datatable.js')}}></script>

@endpush
