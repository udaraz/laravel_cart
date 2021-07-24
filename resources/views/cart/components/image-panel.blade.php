@php
    $lang = $lang =app()->getLocale();
@endphp

<div class="product-img">
    <div class="pic">
        <a href="{{route('product.single.view',$pid)}}">
            <img src="{{(file_exists($img) && $img!='') ?$img:'assets/img/no-img.png'}}" alt="">
        </a>
    </div>
    <div class="product-content text-center">
        <p class="product-title pr-2 pl-2"><a href="{{route('product.single.view',$pid)}}"><x-translate text="{{$title}}"/></a></p>
        <div class="price">
           USD {{number_format((float)$price, 2, '.', '')}}
        </div>
        <div>
            <a class="btn btn-sm btn-primary border-0 text-white add-to-cart" href="{{ route('add.to.cart', $pid) }}" role="button">
                <x-translate text="ADD TO CART"/>
            </a>
        </div>
    </div>
</div>

