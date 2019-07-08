@extends('layouts.app_front')

  @section('content')


<section class="product-detail-sec">
  <div class="container">
    <div class="row">
      
    </div>
    <div class="row">
      <div class="col-md-2">
        <div class="main-tabs-field" style="max-height: 480px;overflow: auto;">
          @forelse($productImages as $eachImages)
              <div class="tablinks first @if($loop->first) active @endif" onmouseover="openCity(event, {{ $loop->iteration }})" onclick="openCity(event, {{ $loop->iteration }})">
                  <img src="{{ url('/public/uploads/admin/product_images/').'/'.$eachImages->image }}" class="img-fluid">
              </div>
          @empty
              <p>No Records found...</p>
          @endforelse
        </div>
      </div>
      <div class="col-md-5">
        <div class="img-center-block">
          
          @forelse($productImages as $eachImages)

              <div id="{{ $loop->iteration }}" class="tabcontent" @if($loop->first) style="display: block;" @endif >
                <img src="{{ url('/public/uploads/admin/product_images/').'/'.$eachImages->image }}" class="img-fluid">
              </div>
          @empty
              <p>No Records found...</p>
          @endforelse
        </div>
      </div>
      <div class="col-md-5">
        <div class="discription-block">
          <div class="row align-item-center">
            <div class="col-md-10 col-sm-10 col-9">
              <div class="desc-head">
                 <h5 class="main-heading">{{ $product->product_name }}</h5>
              </div>
            </div>
            <div class="col-md-2 col-sm-2 col-2">
              <div class="text-right">
                <img src="{{ url('/public/assets/images/icons/wishlist.png') }}" class="img-fluid like-icon" alt="like icon">
              </div>
            </div>
          </div>
          <div>
            <h5 class="price">₹ {{ $product->product_price }}/-</h5>
            <h6>Surprise Description</h6>
            <p>{{ $product->product_des }}</p>

            <h6>Specifications</h6>
            <p>{{ $product->product_des }} </p>
          </div>
          <div>
              <a href="#" class="btn-order"><span>Order Now</span> 
                  <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                  <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt="">
              </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<!-- Section with 1 columns-->
<section class="similar-products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
        <div class="desc-head">
            <h5 class="main-heading">Similar Products</h5>
        </div>
      </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="follow-slider">
                    <div class="items">
                         <img src="/public/assets/images/other/1.jpg" class="img-fluid">
                         <div class="row product-disc-row align-item-center">
                          <div class="col-md-9 col-sm-9 col-9">
                            <a href=""><h6>Birthday Hamper</h6></a>
                            <p>INR 1000/-</p>
                          </div>
                          <div class="col-md-3 col-sm-3 col-3">
                            <div class="icon-box">
                              <img src="/public/assets/images/icons/wishlist.png" class="img-fluid like-icon" alt="like icon">
                            </div>
                          </div>
                         </div>
                    </div>
                    <div class="items">
                       <img src="/public/assets/images/other/2.jpg" class="img-fluid">
                       <div class="row product-disc-row align-item-center">
                          <div class="col-md-9 col-sm-9 col-9">
                            <a href=""><h6>Birthday Hamper</h6></a>
                            <p>INR 1000/-</p>
                          </div>
                          <div class="col-md-3 col-sm-3 col-3">
                            <div class="icon-box">
                              <img src="/public/assets/images/icons/wishlist.png" class="img-fluid like-icon" alt="like icon">
                            </div>
                          </div>
                         </div>
                    </div>
                    <div class="items">
                        <img src="/public/assets/images/other/3.jpg" class="img-fluid">
                        <div class="row product-disc-row align-item-center">
                          <div class="col-md-9 col-sm-9 col-9">
                            <a href=""><h6>Birthday Hamper</h6></a>
                            <p>INR 1000/-</p>
                          </div>
                          <div class="col-md-3 col-sm-3 col-3">
                            <div class="icon-box">
                              <img src="/public/assets/images/icons/wishlist.png" class="img-fluid like-icon" alt="like icon">
                            </div>
                          </div>
                         </div>
                    </div>
                    <div class="items">
                        <img src="/public/assets/images/other/1.jpg" class="img-fluid">
                        <div class="row product-disc-row align-item-center">
                          <div class="col-md-9 col-sm-9 col-9">
                            <a href=""><h6>Birthday Hamper</h6></a>
                            <p>INR 1000/-</p>
                          </div>
                          <div class="col-md-3 col-sm-3 col-3">
                            <div class="icon-box">
                              <img src="/public/assets/images/icons/wishlist.png" class="img-fluid like-icon" alt="like icon">
                            </div>
                          </div>
                         </div>
                    </div>
                    <div class="items">
                        <img src="/public/assets/images/other/2.jpg" class="img-fluid">
                        <div class="row product-disc-row align-item-center">
                          <div class="col-md-9 col-sm-9 col-9">
                            <a href=""><h6>Birthday Hamper</h6></a>
                            <p>INR 1000/-</p>
                          </div>
                          <div class="col-md-3 col-sm-3 col-3">
                            <div class="icon-box">
                              <img src="/public/assets/images/icons/wishlist.png" class="img-fluid like-icon" alt="like icon">
                            </div>
                          </div>
                         </div>
                    </div>
                    <div class="items">
                        <img src="/public/assets/images/other/3.jpg" class="img-fluid">
                        <div class="row product-disc-row align-item-center">
                          <div class="col-md-9 col-sm-9 col-9">
                            <a href=""><h6>Birthday Hamper</h6></a>
                            <p>INR 1000/-</p>
                          </div>
                          <div class="col-md-3 col-sm-3 col-3">
                            <div class="icon-box">
                              <img src="/public/assets/images/icons/wishlist.png" class="img-fluid like-icon" alt="like icon">
                            </div>
                          </div>
                         </div>
                    </div>
                    <div class="items">
                       <img src="/public/assets/images/other/1.jpg" class="img-fluid"> 
                       <div class="row product-disc-row align-item-center">
                          <div class="col-md-9 col-sm-9 col-9">
                            <a href=""><h6>Birthday Hamper</h6></a>
                            <p>INR 1000/-</p>
                          </div>
                          <div class="col-md-3 col-sm-3 col-3">
                            <div class="icon-box">
                              <img src="/public/assets/images/icons/wishlist.png" class="img-fluid like-icon" alt="like icon">
                            </div>
                          </div>
                         </div>
                    </div>
                    <div class="items">
                       <img src="/public/assets/images/other/2.jpg" class="img-fluid">
                       <div class="row product-disc-row align-item-center">
                          <div class="col-md-9 col-sm-9 col-9">
                            <a href=""><h6>Birthday Hamper</h6></a>
                            <p>INR 1000/-</p>
                          </div>
                          <div class="col-md-3 col-sm-3 col-3">
                            <div class="icon-box">
                              <img src="/public/assets/images/icons/wishlist.png" class="img-fluid like-icon" alt="like icon">
                            </div>
                          </div>
                         </div>
                    </div>
                    <div class="items">
                        <img src="/public/assets/images/other/3.jpg" class="img-fluid">
                        <div class="row product-disc-row align-item-center">
                          <div class="col-md-9 col-sm-9 col-9">
                            <a href=""><h6>Birthday Hamper</h6></a>
                            <p>INR 1000/-</p>
                          </div>
                          <div class="col-md-3 col-sm-3 col-3">
                            <div class="icon-box">
                              <img src="/public/assets/images/icons/wishlist.png" class="img-fluid like-icon" alt="like icon">
                            </div>
                          </div>
                         </div>
                    </div>
                    <div class="items">
                        <img src="/public/assets/images/other/2.jpg" class="img-fluid">
                        <div class="row product-disc-row align-item-center">
                          <div class="col-md-9 col-sm-9 col-9">
                            <a href=""><h6>Birthday Hamper</h6></a>
                            <p>INR 1000/-</p>
                          </div>
                          <div class="col-md-3 col-sm-3 col-3">
                            <div class="icon-box">
                              <img src="/public/assets/images/icons/wishlist.png" class="img-fluid like-icon" alt="like icon">
                            </div>
                          </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
@endsection