@extends('layouts.app_front')

  @section('content')


<section class="product-sec">
    <div class="container">
         <div class="row">
            <div class="col-sm-12">
                <div class="text-center">
                    <p class="heading-content">View a wide range of our products</p>
                    <h5 class="main-heading">Gift For Him</h5>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-3 offset-md-9">
        		<div class="price-sort-box text-right">
        			
    					  <button class="btn" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    					    Price
    					    <span class="down-arrow"><i class="fas fa-chevron-down"></i></span>
    					  </button>
  					
      					<div class="collapse" id="collapseExample">
      					  <div class="card card-body">
      					     <div class="radio">
      				          <label>
      				            <input type="radio" name="o1" value="">
      				            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
      				            less than 1000
      				          </label>
      				        </div>
      				         <div class="radio">
      				          <label>
      				            <input type="radio" name="o1" value="">
      				            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
      				            1001 - 2000
      				          </label>
      				        </div>
      				         <div class="radio">
      				          <label>
      				            <input type="radio" name="o1" value="">
      				            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
      				            2001 - 5000
      				          </label>
      				        </div>
      				         <div class="radio">
      				          <label>
      				            <input type="radio" name="o1" value="">
      				            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
      				            More than 5000
      				          </label>
      				        </div>
      					  </div>
      					</div>
        		</div>
        	</div>
        </div>
        <div class="row product-row">
          <?php if(!empty($all_products) && count($all_products)>0){
              foreach ($all_products as $key => $each_value) {
          ?>
            <div class="col-sm-6  col-md-6 col-lg-3">
                <div class="card product-block">
                    <div class="img-product">
                      <img class="lazyload card-img-top img-fluid" alt="Glitter Bomb" src="{{ url('/public/uploads/admin/product_images/').'/'.$each_value->product_image }}">
                      <div class="inner-share">
                        <div class="inner-order">
                          <a class="order-now" href="">Order Now</a>
                          <a href=""><img class="" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> </a>
                          <a href=""><img class="" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a> 
                        </div>     
                       </div>
                    </div>
                    <div class="card-body">
                        <div class="row heading-row d-flex align-items-center">
                           <div class="col-md-9 col-sm-9 col-9">
                               <a href="{{ url('product-detail').'/'.base64_encode($each_value->product_id) }}">
                                    <h5>{{ $each_value->product_name }}</h5>
                                </a>
                           </div>
                           <div class="col-md-3 col-sm-3 col-3">
                             <a href="#" class="add-wishlist float-right">
                                 <img src="{{ url('/public/assets/images/icons/wishlist.png') }}">
                             </a>
                           </div>
                        </div>
                        <p>{{ $each_value->product_des }}</p>
                        <div class="card-border pt-1 pt-md-3">
                            <a href="#"> 
                                <span class="price-text"> <span class=" text-red"><span>₹</span>{{ $each_value->product_price }}</span>&nbsp;<b>₹{{ $each_value->discount_price }}</b></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
          <?php }} ?>
        </div>
    </div>
</section>

@endsection