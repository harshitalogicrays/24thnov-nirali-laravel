<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">Our Products</h4>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">Price</div>
                        <div class="card-body">
                            <input type="radio" value="below1000" wire:model="priceInput"> >=100 and < 1000<br>
                            <input type="radio"  value="below2000" wire:model="priceInput"> >=1000 and < 2000<br>
                            <input type="radio"  value="below3000" wire:model="priceInput"> >=2000 and < 3000<br>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="row">
                        @forelse ($products as $product)
                        <div class="col-4">
                            <div class="product-card">
                                <div class="product-card-img">
                                    @if ($product->status=="1")
                                        <label class="stock bg-success">In Stock</label>
                                    @else
                                            <label class="stock bg-danger">Out of Stock</label>
                                    @endif
                                    <a href="{{url('/collection/'.$category->name.'/'.$product->name)}}">
                                    <img src="{{asset($product->productImages[0]->image)}}" height='200px'  alt="{{$product->name}}">
                                    </a>
                                </div>
                                <div class="product-card-body">
                                    <p class="product-brand">{{$product->brand}}</p>
                                    <h5 class="product-name">
                                    <a href="">
                                            {{$product->name}}
                                    </a>
                                    </h5>
                                    <div>
                                        <span class="selling-price">${{$product->selling_price}}</span>
                                        <span class="original-price">${{$product->original_price    }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                            <h1>No Product found for {{$category->name}}
                        @endforelse
                    </div>
                </div>
            </div>
         
            
        </div>
    </div>
</div>