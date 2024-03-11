<div class="py-3 py-md-5 bg-light">
   <div class="container">
         <h1>Cart Page</h1><hr/>
       <div class="row">
           <div class="col-md-12">
               <div class="shopping-cart">

                   <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                       <div class="row">
                           <div class="col-md-4">
                               <h4>Products</h4>
                           </div>
                           <div class="col-md-2">
                               <h4>Price</h4>
                           </div>
                           <div class="col-md-2">
                               <h4>Quantity</h4>
                           </div>
                           <div class="col-md-2">
                              <h4>Total</h4>
                          </div>
                           <div class="col-md-2">
                               <h4>Remove</h4>
                           </div>
                       </div>
                   </div>

                   <div class="cart-item">
                     @php
                        $totalPrice=0;
                     @endphp
                     @forelse ($cart as $c)
                     <div class="row mb-2">
                        <div class="col-md-4 my-auto">
                            <a href="">
                                <label class="product-name">
                                    <img src="{{asset($c->product->productImages[0]->image)}}" style="width: 50px; height: 50px" alt="">
                                   {{$c->product->name}}
                                </label>
                            </a>
                        </div>
                        <div class="col-md-2 my-auto">
                            <label class="price">${{$c->product->selling_price}} </label>
                        </div>
                        <div class="col-md-2 col-7 my-auto">
                            <div class="quantity">
                                <div class="input-group">
                                    <button wire:click="decreaseQty({{$c->id}})" >-</button>
                                    <input type="text"  value="{{$c->quantity}}"  readonly 
                                    class="input-quantity" style="width: 40px;text-align:center" />
                                    <button wire:click="increaseQty({{$c->id}})">+</button>
                                       @php
                                          $totalPrice += ($c->quantity * $c->product->selling_price)
                                       @endphp
                                 </div>
                            </div>
                        </div>
                        <div class="col-md-2 my-auto">
                           <label class="price">${{$c->quantity * $c->product->selling_price}} </label>
                       </div>
                        <div class="col-md-2 col-5 my-auto">
                            <div class="remove">
                                <button class="btn btn-danger btn-sm" wire:click="removeCartItem({{$c->id}})">
                                    <i class="bi bi-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                    </div>
                     @empty
                        <h1>Cart is Empty</h1>
                     @endforelse
                      
                   </div>
                           
               </div>
           </div>
       </div><hr/>
       <div class="row">
         <div class="col-8">Get the best deals and offers</div>
         <div class="col-4">
               <h5>Total:<span class="float-end">${{$totalPrice}}</span></h5><hr/>
               <div class="d-grid gap-2">
                  <a type="button" href="{{url('checkout-show')}}" class="btn btn-warning" >
                     Checkout
                   </a>
               </div>
               
         </div>
   </div>
  
   </div>
</div>
