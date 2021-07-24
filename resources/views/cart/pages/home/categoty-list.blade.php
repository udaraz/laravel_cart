<section class="product-img-list">
    <div class="container">
        @foreach($categories as $category)
            @if($category->category!='Other')
                @if($category->products_count>0)
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <h2 class="sub-title">
                                <x-translate text="{{$category->category}}"/>
                            </h2>
                        </div>
                        <hr width="100%">
                        <x-category-section id="{{$category->id}}"/>
                    </div>
                @endif
            @elseif($category->category=='Other')
                <hr>
                @if($category->products_count>0)
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <h2 class="sub-title">
                                <x-translate text="{{$category->category}}"/>
                            </h2>
                        </div>
                        <hr width="100%">
                        <x-category-section id="{{$category->id}}"/>
                    </div>
                @endif
            @endif
        @endforeach

        {{--@foreach($products as $product)--}}
        {{--<div class="col-md-3 col-sm-6 col-xs-12">--}}
        {{--<x-image-panel img="{{(count($product['images'])>0)?$product['images'][0]->image:''}}" price="{{$product->price}}" title="{{$product->title}}"/>--}}
        {{--</div>--}}
        {{--@endforeach--}}

        {{--<div class="col-md-12 text-center">--}}
        {{--<button class="btn btn-lg btn-block btn-main">View More</button>--}}
        {{--</div>--}}
    </div>
</section>
