@extends('cart.master')

@section('title', 'Your Orders')

@section('main-content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                @if(count($orders)>0)
                    @foreach($orders as $order)
                        @php
                            $items = unserialize($order->cart);
                        @endphp
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <p class="h6">Order ID : {{$order->id}}</p>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <p class="h6">Date : {{$order->order_date}}</p>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <p class="h6">Total : ${{$order->total}}</p>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <p class="h6">Items : {{$items->count}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                @foreach($items->items as $item)
                                                    <div class="row">
                                                        <div class="col-sm-3 hidden-xs">
                                                            <img src="{{ $item['image'] }}" width="50"
                                                                 height="50" class="img-responsive"/>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <p class="nomargin h5">{{ $item['title'] }}</p>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <p class="nomargin h5">{{ $item['quantity'] }}</p>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <p class="nomargin h5">${{ $item['price'] }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <p class="h5">Billing Details</p>
                                                <p>Name: {{$order->billing['name']}}</p>
                                                <p>Address: {{$order->billing['address']}}</p>
                                                <p>Country: {{$order->billing['country']}}</p>
                                                <p>Province: {{$order->billing['province']}}</p>
                                                <p>Zip: {{$order->billing['zip']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row float-right">
                        <div class="col-md-12 mt-5">
                            {{$orders->links("pagination::bootstrap-4")}}
                        </div>
                    </div>
                @else
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    Currently you have no any orders yet
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script src="{{asset('assets/js/cart/cart.js')}}"></script>
@endpush
