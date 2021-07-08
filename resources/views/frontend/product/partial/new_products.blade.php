          <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
            <div class="more-info-tab clearfix ">
              <h3 class="new-product-title pull-left">
                    @if(session()->get('language') == 'turkce') 
                    Yeni Ürünler 
                    @else 
                    New Products 
                    @endif
              </h3>
              <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                <li class="active">
                  <a data-transition-type="backSlide" href="#all" data-toggle="tab">
                @if(session()->get('language') == 'turkce') 
                    Tümü 
                    @else 
                    All 
                    @endif

                  </a>
                </li>
                
                @foreach($categories as $category)
                <li>
                  <a data-transition-type="backSlide" href="#category{{ $category->id }}" data-toggle="tab">

                    @if(session()->get('language') == 'turkce') 
                    {{ $category->category_name_tr }} 
                    @else 
                    {{ $category->category_name_en }} 
                    @endif
                  </a>
                </li>
                @endforeach
                <!-- <li><a data-transition-type="backSlide" href="#laptop" data-toggle="tab">Electronics</a></li>
                
                <li><a data-transition-type="backSlide" href="#apple" data-toggle="tab">Shoes</a></li> -->
               </ul>
              <!-- /.nav-tabs --> 
            </div>
            

            <div class="tab-content outer-top-xs">

              <div class="tab-pane in active" id="all">
                <div class="product-slider">
                  <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">


                    @foreach($products as $product)
                    <div class="item item-carousel">
                      <div class="products">
                        <div class="product">
                          <div class="product-image">
                            <div class="image"> 
                              <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_tr)}}">
                                <img  src="{{ asset($product->product_thumbnail) }}" alt="">
                              </a> 
                            </div>
                            <!-- /.image -->
              @php
              $amount = $product->selling_price - $product->discount_price;
              $discount = ($amount/$product->selling_price) * 100;

              @endphp
                            <div>
                              @if($product->discount_price == NULL)
                            <div class="tag new"><span>
                              @if(session()->get('language') == 'turkce') yeni @else new @endif


                            </span></div>
                              @else
                            <div class="tag sale"><span>
                              @if(session()->get('language') == 'turkce') %{{ round($discount) }} @else {{ round($discount) }}% @endif

                            </span></div>

                              @endif
                            </div>

                          </div>
                          <!-- /.product-image -->
                          
                          <div class="product-info text-left">
                            <h3 class="name">
                              <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_tr)}}">
                              @if(session()->get('language') == 'turkce') {{ $product->product_name_tr }} @else {{ $product->product_name_en }} @endif
                              </a>
                            </h3>
                            <div class="rating rateit-small"></div>
                            <div class="description"></div>
 @if($product->discount_price == NULL)
<div class="product-price"> <span class="price">{{ $product->selling_price }} ₺</span> </div>
@else
<div class="product-price">
<span class="price"> {{ $product->discount_price }} ₺</span> 
<span class="price-before-discount">{{ $product->selling_price }} ₺</span> 
</div>
@endif




                            
                            <!-- /.product-price --> 
                            
                          </div>
                          <!-- /.product-info -->
                          <div class="cart clearfix animate-effect">
                            <div class="action">
                              <ul class="list-unstyled">
                                <li class="add-cart-button btn-group">
                                  <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title="Add Cart"> <i class="fa fa-shopping-cart"></i> </button>
                                  <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                </li>
                                <li class="lnk wishlist"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                              </ul>
                            </div>
                            <!-- /.action --> 
                          </div>
                          <!-- /.cart --> 
                        </div>
                        <!-- /.product --> 
                        
                      </div>
                      <!-- /.products --> 
                    </div>
                    @endforeach
                    <!-- /.item -->
                     
                  </div>
                  <!-- /.home-owl-carousel --> 
                </div>
                <!-- /.product-slider --> 
              </div>
              <!-- /.tab-pane -->

              @foreach($categories as $category)
              <div class="tab-pane" id="category{{ $category->id }}">
                <div class="product-slider">
                  <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">

                      @php
                        $catwiseProduct = App\Models\Product::where('category_id',$category->id)->orderBy('id','DESC')->get();
                      @endphp
                    @forelse($catwiseProduct as $product)
                    <div class="item item-carousel">
                      <div class="products">
                        <div class="product">
                          <div class="product-image">
                            <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_tr)}}"><img  src="{{ asset($product->product_thumbnail) }}" alt=""></a> </div>
                            <!-- /.image -->

              @php
              $amount = $product->selling_price - $product->discount_price;
              $discount = ($amount/$product->selling_price) * 100;

              @endphp
<div>
  @if($product->discount_price == NULL)
  <div class="tag new"><span>
@if(session()->get('language') == 'turkce') yeni @else new @endif
</span></div>
@else
  <div class="tag sale"><span>

@if(session()->get('language') == 'turkce') %{{ round($discount) }} @else {{ round($discount) }}% @endif


  </span></div>
@endif

</div>
                            
                          </div>
                          <!-- /.product-image -->
                          
                          <div class="product-info text-left">
                            <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_tr)}}">
@if(session()->get('language') == 'turkce') {{ $product->product_name_tr }} @else {{ $product->product_name_en }} @endif



                              </a></h3>
                            <div class="rating rateit-small"></div>
                            <div class="description"></div>

  @if($product->discount_price == NULL)
<div class="product-price"> <span class="price">{{ $product->selling_price }} ₺</span> </div>
@else
<div class="product-price">
<span class="price"> {{ $product->discount_price }} ₺</span> 
<span class="price-before-discount">{{ $product->selling_price }} ₺</span> 
</div>
@endif
<!--                             <div class="product-price"> <span class="price"> {{ $product->discount_price }} ₺</span> <span class="price-before-discount">{{ $product->selling_price }} ₺</span> </div>
 -->                            <!-- /.product-price --> 
                            
                          </div>
                          <!-- /.product-info -->
                          <div class="cart clearfix animate-effect">
                            <div class="action">
                              <ul class="list-unstyled">
                                <li class="add-cart-button btn-group">
                                  <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title="Add Cart"> <i class="fa fa-shopping-cart"></i> </button>
                                  <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                </li>
                                <li class="lnk wishlist"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                              </ul>
                            </div>
                            <!-- /.action --> 
                          </div>
                          <!-- /.cart --> 
                        </div>
                        <!-- /.product --> 
                        
                      </div>
                      <!-- /.products --> 
                    </div>
                      @empty
                      <h3 class="text-danger text-center">Ürün bulunamadi!!</h3>
                      @endforelse
                    <!-- /.item -->
                     
                  </div>
                  <!-- /.home-owl-carousel --> 
                </div>
                <!-- /.product-slider --> 
              </div>
              <!-- /.tab-pane -->
              @endforeach           

              
            </div>
            <!-- /.tab-content --> 
          </div>
          <!-- /.scroll-tabs --> 