@extends('back-office.master')

@section('title', 'Product Manage')

@section('main-content')
    <div class="card card-user">
        <div class="card-header">
            <h5 class="card-title">Order ID :{{$order->id}} </h5>
        </div>
        <div class="card-body">

            <div class="container mt-5 mb-5">
                <div class="row">
                    <div class="col-md-12">
                        @php
                            $items = unserialize($order->cart);
                        @endphp
                        <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <p class="h6">User : <br>{{$order->user->name}}</p>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <p class="h6">Date : <br>{{$order->order_date}}</p>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <p class="h6">Total : <br>${{$order->total}}</p>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <p class="h6">Items : <br>{{$items->count}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                @foreach($items->items as $item)
                                                    <div class="row">
                                                        <div class="col-sm-3 hidden-xs">
                                                            <img src="{{ '/'.$item['image'] }}" width="50"
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
                                                <p><b>Name:</b> {{$order->billing['name']}}</p>
                                                <p><b>Address:</b> {{$order->billing['address']}}</p>
                                                <p><b>Country:</b> {{$order->billing['country']}}</p>
                                                <p><b>Province:</b> {{$order->billing['province']}}</p>
                                                <p><b>Zip:</b> {{$order->billing['zip']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

