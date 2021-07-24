@extends('cart.master')

@section('title', 'Home')

@section('main-content')
    <div class="mb-5 mt-5">
        <div class="single_product">
            <div class="container" style=" background-color: #fff; padding: 11px;">
                <div class="row">
                    <div class="col-lg-4 order-lg-1 order-2">
                        <div id="carouselProducts" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @if(isset($product->images) && count($product->images)>0)
                                    @foreach($product->images as $key=>$image)
                                        <div class="carousel-item {{($key==0)?'active':''}}">
                                            <img class="d-block w-100" src="{{'/'.$image['image']}}">
                                        </div>
                                    @endforeach
                                @else
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="/assets/img/no-img.png">
                                    </div>
                                @endif
                            </div>
                            <a class="carousel-control-prev" href="#carouselProducts" role="button"
                               data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselProducts" role="button"
                               data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 order-3">
                        <div class="product_description">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <x-translate text="Home"/>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <x-translate text="Products"/>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        <x-translate text="{{ucwords($product->category['category'])}}"/>
                                    </li>
                                </ol>
                            </nav>
                            <div class="product_name">
                                <x-translate text="{{$product->title}}"/>
                            </div>

                            <div><span class="product_price">$ {{$product->price}}</span></div>
                            <hr class="singleline">
                            <div><span class="product_info"><x-translate text="{{$product->description}}"/></span></div>

                            <hr class="singleline">

                            <div class="row">
                                <div class="col-xs-6">
                                    <a class="btn btn-sm btn-primary border-0 text-white add-to-cart"
                                       href="{{ route('add.to.cart', $product->id) }}" role="button">
                                        <x-translate text="ADD TO CART"/>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
