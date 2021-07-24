@foreach($products as $product)
    <div class="col-md-3 col-sm-6 col-xs-12">
        <x-image-panel img="{{(count($product['images'])>0)?$product['images'][0]->image:''}}"
                       price="{{$product->price}}"
                       title="{{$product->title}}"
                       pid="{{$product->id}}"/>
    </div>
@endforeach

<div class="col-md-12">
    {{$products->links("pagination::bootstrap-4")}}
</div>

