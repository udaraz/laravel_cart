<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" placeholder="Title" value="{{isset($product)?$product->title:''}}" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="price">Images</label>
            <input type="file" class="form-control" name="image[]" placeholder="Images" multiple>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" name="category_id" id="category" required>
                <option disabled selected>Select Category</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}" {{(isset($product) && $category->id == $product->category_id)?'selected':''}}>{{ucfirst($category->category)}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" class="form-control" name="price" placeholder="Price"
                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                   value="{{isset($product)?$product->price:''}}" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="price">Quantity</label>
            <input type="number" class="form-control" name="qty" placeholder="Quantity"
                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                   value="{{isset($product)?$product->qty:''}}" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Product Description</label>
            <textarea class="form-control textarea" name="description">{{isset($product)?$product->description:''}}</textarea>
        </div>
    </div>
</div>
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
