@extends('layouts.app_front')

  @section('content')

  <!-- Slider Section html -->
<section class="sec-slider">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-slider">
                    <div class="item">
                      <div class="container">
                      	<div class="row align-item-center">
                          <div class="col-md-6">
                              <h5>Gifts&nbsp;<span><i class="fas fa-circle"></i></span>&nbsp; Corporate</h5>
                              <h2>Curators of Gifts</h2>
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                              <div>
                                  <a href="" class="common-btn"> Buy Now</a>
                              </div>
                          </div>
                          <div class="col-md-5 offset-md-1">
                              <div class="img-zoomin">
                                  <img src="{{ url('/public/assets/images/other/image2.jpg') }}" class="img-fluid">
                              </div>
                          </div>
                      </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="container">
                      	<div class="row align-item-center">
                          <div class="col-md-6">
                              <h5>Gifts&nbsp;<span><i class="fas fa-circle"></i></span>&nbsp; Corporate</h5>
                              <h2>Curators of Gifts</h2>
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                              <div>
                                  <a href="" class="common-btn"> Buy Now</a>
                              </div>
                          </div>
                          <div class="col-md-5 offset-md-1">
                              <div class="img-zoomin">
                                  <img src="{{ url('/public/assets/images/other/image2.jpg') }}" class="img-fluid">
                              </div>
                          </div>
                      </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="container">
                      	<div class="row align-item-center">
                          <div class="col-md-6">
                              <h5>Gifts&nbsp;<span><i class="fas fa-circle"></i></span>&nbsp; Corporate</h5>
                              <h2>Curators of Gifts</h2>
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                              <div>
                                  <a href="" class="common-btn"> Buy Now</a>
                              </div>
                          </div>
                          <div class="col-md-5 offset-md-1">
                              <div class="img-zoomin">
                                  <img src="{{ url('/public/assets/images/other/image2.jpg') }}" class="img-fluid">
                              </div>
                          </div>
                      </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- Section with 1 column -->
<section class="sec-best-seller">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="text-center">
                    <p class="heading-content wow slideInLeft">View a wide range of our products</p>
                    <h5 class="main-heading wow slideInRight">Best Sellers</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="seller-option">
                    <ul class="nav nav-tabs wow slideInUp" id="myTab">
                      <li class="nav-item active">
                        <a class="nav-link filter-button" id="home-tab" href="javascript:void(0)" data-filter="hdpe"><span>Birthday</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link filter-button" id="profile-tab" href="javascript:void(0)" data-filter="sprinkle"><span>Anniversary</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link filter-button" id="contact-tab" href="javascript:void(0)" data-filter="spray"><span>Weddings</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link filter-button" id="contact-tab" href="javascript:void(0)" data-filter="irrigation"><span>Housewarming</span></a>
                      </li>
                    </ul>
                </div>
                <div id="myTabContent" class="wow slideInUp">
                  <div id="home">
                    <!-- birthday section start  -->
                      <div class="row masonary-wraper">
                        <!-- left section start -->
                          <div class="col-sm-4 col-md-4 col-lg-3 filter hdpe">
                              <div class="seller-commn small-img1">
                                 <img src="{{ url('/public/assets/images/other/image3.jpg') }}">
                                 <div class="inner-seller">
                                     <a href="#" class="btn-order"><span>Order Now</span> 
                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                 </div> 
                              </div>
                              <div class="seller-commn small-img2">
                                 <img src="{{ url('/public/assets/images/other/image4.jpg') }}">
                                  <div class="inner-seller">
                                     <a href="#" class="btn-order"><span>Order Now</span> 
                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                 </div>  
                              </div>
                          </div>
                          <!-- left section end -->
                          <!-- middle section start -->
                            <div class="col-sm-4 col-md-4 col-lg-6 filter hdpe">
                                <div class="middle-img-wrapper">
                                    <div class="seller-commn middle-top-img">
                                        <img src="{{ url('/public/assets/images/other/image7.png') }}">
                                         <div class="inner-seller">
                                            <a href="#" class="btn-order"><span>Order Now</span> 
                                                <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                                <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt="">
                                            </a>
                                         </div>  
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-6">
                                            <div class="seller-commn middle-bottom-img">
                                                <img src="{{ url('/public/assets/images/other/image5.jpg') }}">
                                                 <div class="inner-seller">
                                                     <a href="#" class="btn-order"><span>Order Now</span> 
                                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                                 </div>  
                                            </div>
                                        </div> 
                                        <div class="col-md-12 col-lg-6">
                                            <div class="seller-commn middle-bottom-img">
                                                <img src="{{ url('/public/assets/images/other/image6.jpg') }}">
                                                 <div class="inner-seller">
                                                     <a href="#" class="btn-order"><span>Order Now</span> 
                                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                                 </div>  
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <!-- middle section End -->
                            <!-- right section start -->
                            <div class="col-sm-4 col-md-4 col-lg-3 filter hdpe">
                                <div class="seller-commn small-img1">
                                    <img src="{{ url('/public/assets/images/other/image3.jpg') }}">
                                     <div class="inner-seller">
                                         <a href="#" class="btn-order"><span>Order Now</span> 
                                            <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                            <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                     </div>  
                                </div>
                                <div class="seller-commn small-img2">
                                    <img src="{{ url('/public/assets/images/other/image4.jpg') }}">
                                     <div class="inner-seller">
                                         <a href="#" class="btn-order"><span>Order Now</span> 
                                            <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                            <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                     </div>  
                                </div>
                            </div>
                          <!-- right section end -->
                        
                        <!-- Birthday section  End   -->


                          <!-- left section start -->
                          <div class="col-sm-4 col-md-4 col-lg-4 filter spray mas-hide">
                              <div class="seller-commn small-img1">
                                 <img src="{{ url('/public/assets/images/other/image3.jpg') }}">
                                  <div class="inner-seller">
                                     <a href="#" class="btn-order"><span>Order Now</span> 
                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                 </div>  
                              </div>
                              <div class="seller-commn small-img2">
                                 <img src="{{ url('/public/assets/images/other/image4.jpg') }}">
                                  <div class="inner-seller">
                                     <a href="#" class="btn-order"><span>Order Now</span> 
                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                 </div>  
                              </div>
                          </div>
                          <!-- left section end -->
                          <!-- middle section start -->
                            <div class="col-sm-4 col-md-4 col-lg-5 filter spray  mas-hide">
                                <div class="middle-img-wrapper">
                                    <div class="seller-commn middle-top-img">
                                        <img src="{{ url('/public/assets/images/other/img_masonary3.png') }}">
                                         <div class="inner-seller">
                                     <a href="#" class="btn-order"><span>Order Now</span> 
                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                 </div>  
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-6 for-small-gallery-img">
                                            <div class="seller-commn middle-bottom-img">
                                                <img src="{{ url('/public/assets/images/other/img_masonary4.png') }}">
                                                 <div class="inner-seller">
			                                     <a href="#" class="btn-order"><span>Order Now</span> 
			                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
			                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt="">
			                                     </a>
			                                 </div>  
                                            </div>
                                        </div> 
                                        <div class="col-md-12 col-lg-6 for-small-gallery-img">
                                            <div class="seller-commn middle-bottom-img">
                                                <img src="{{ url('/public/assets/images/other/img_masonary5.png') }}">
                                                 <div class="inner-seller">
			                                     <a href="#" class="btn-order"><span>Order Now</span> 
			                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
			                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt="">
			                                     </a>
			                                 </div>  
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <!-- middle section End -->
                            <!-- right section start -->
                            <div class="col-sm-4 col-md-4 col-lg-3 filter spray  mas-hide">
                                <div class="seller-commn small-img1">
                                    <img src="{{ url('/public/assets/images/other/img_masonary6.png') }}">
                                     <div class="inner-seller">
                                     <a href="#" class="btn-order"><span>Order Now</span> 
                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                 </div>  
                                </div>
                                <div class="seller-commn small-img2">
                                    <img src="{{ url('/public/assets/images/other/img_masonary7.png') }}"> 
                                     <div class="inner-seller">
                                     <a href="#" class="btn-order"><span>Order Now</span> 
                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                 </div> 
                                </div>
                            </div>
                          <!-- right section end -->
                        
                         <!-- Anniversary section  End   -->

                          <!-- left section start -->
                          <div class="col-sm-4 col-md-4 col-lg-4 col-xl-6 filter sprinkle mas-hide">
                              <div class="seller-commn small-img1">
                                 <img src="{{ url('/public/assets/images/other/img_masonary1.png') }}">
                                  <div class="inner-seller">
                                     <a href="#" class="btn-order"><span>Order Now</span> 
                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                 </div>  
                              </div>
                              <div class="seller-commn small-img2">
                                 <img src="{{ url('/public/assets/images/other/img_masonary2.png') }}">
                                  <div class="inner-seller">
                                     <a href="#" class="btn-order"><span>Order Now</span> 
                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                 </div>  
                              </div>
                          </div>
                          <!-- left section end -->
                          <!-- middle section start -->
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-3 filter sprinkle  mas-hide">
                                <div class="middle-img-wrapper">
                                    <div class="seller-commn middle-top-img">
                                        <img src="{{ url('/public/assets/images/other/img_masonary3.png') }}">
                                         <div class="inner-seller">
                                     <a href="#" class="btn-order"><span>Order Now</span> 
                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                 </div>  
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-xl-6 m-bottom-30 for-small-gallery-img">
                                            <div class="seller-commn middle-bottom-img">
                                                <img src="{{ url('/public/assets/images/other/img_masonary4.png') }}">
                                                 <div class="inner-seller">
                                     <a href="#" class="btn-order btn-order-smal"><span>Order Now</span> 
                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                 </div>  
                                            </div>
                                        </div> 
                                        <div class="col-md-12 col-xl-6 for-small-gallery-img">
                                            <div class="seller-commn middle-bottom-img">
                                                <img src="{{ url('/public/assets/images/other/img_masonary5.png') }}">
                                                 <div class="inner-seller">
                                     <a href="#" class="btn-order btn-order-smal"><span>Order Now</span> 
                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                 </div>  
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <!-- middle section End -->
                            <!-- right section start -->
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-3 filter sprinkle  mas-hide">
                                <div class="seller-commn small-img1">
                                    <img src="{{ url('/public/assets/images/other/img_masonary6.png') }}">
                                     <div class="inner-seller">
                                     <a href="#" class="btn-order"><span>Order Now</span> 
                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                 </div>  
                                </div>
                                <div class="seller-commn small-img2">
                                    <img src="{{ url('/public/assets/images/other/img_masonary7.png') }}">
                                     <div class="inner-seller">
                                     <a href="#" class="btn-order"><span>Order Now</span> 
                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                 </div>  
                                </div>
                            </div>
                          <!-- right section end -->

                           <!-- Wedding section  End   -->

                           <!-- left section start -->
                          <div class="col-sm-4 col-md-4 col-lg-2 filter irrigation mas-hide">
                              <div class="seller-commn small-img1">
                                 <img src="{{ url('/public/assets/images/other/img_masonary1.png') }}">
                                  <div class="inner-seller">
                                     <a href="#" class="btn-order btn-order-smal"><span>Order Now</span> 
                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                 </div>  
                              </div>
                              <div class="seller-commn small-img2">
                                 <img src="{{ url('/public/assets/images/other/img_masonary2.png') }}">
                                  <div class="inner-seller">
                                     <a href="#" class="btn-order btn-order-smal"><span>Order Now</span> 
                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                 </div>  
                              </div>
                          </div>
                          <!-- left section end -->
                          <!-- middle section start -->
                            <div class="col-sm-4 col-md-4 col-lg-4 filter irrigation  mas-hide">
                                <div class="middle-img-wrapper">
                                    <div class="seller-commn middle-top-img">
                                        <img src="{{ url('/public/assets/images/other/img_masonary3.png') }}">
                                         <div class="inner-seller">
                                     <a href="#" class="btn-order"><span>Order Now</span> 
                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                 </div>  
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-6">
                                            <div class="seller-commn middle-bottom-img">
                                                <img src="{{ url('/public/assets/images/other/img_masonary4.png') }}">
                                                 <div class="inner-seller">
                                     <a href="#" class="btn-order btn-order-smal"><span>Order Now</span> 
                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                 </div>  
                                            </div>
                                        </div> 
                                        <div class="col-md-12 col-lg-6">
                                            <div class="seller-commn middle-bottom-img">
                                                <img src="{{ url('/public/assets/images/other/img_masonary5.png') }}">
                                                 <div class="inner-seller">
                                     <a href="#" class="btn-order btn-order-smal"><span>Order Now</span> 
                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                 </div>  
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <!-- middle section End -->
                            <!-- right section start -->
                            <div class="col-sm-4  col-md-4 col-lg-6 filter irrigation  mas-hide">
                                <div class="seller-commn small-img1">
                                    <img src="{{ url('/public/assets/images/other/img_masonary6.png') }}">
                                     <div class="inner-seller">
                                     <a href="#" class="btn-order"><span>Order Now</span> 
                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                 </div>  
                                </div>
                                <div class="seller-commn small-img2">
                                    <img src="{{ url('/public/assets/images/other/img_masonary7.png') }}">
                                     <div class="inner-seller">
                                     <a href="#" class="btn-order"><span>Order Now</span> 
                                        <img class="m-left-32" src="{{ url('/public/assets/images/icons/whatsup.png') }}" alt=""> 
                                        <img class="m-left-10" src="{{ url('/public/assets/images/icons/call.png') }}" alt=""></a>
                                 </div>  
                                </div>
                            </div>
                          <!-- right section end -->
                      </div>
                       <!-- birthday section start  -->
                  </div>
                  <!-- <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div> -->
                </div>
            </div>
        </div>
    </div>
</section>




<!-- Section with 4 columns -->
<section class="sec-occation">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="text-center">
                    <p class="heading-content wow slideInLeft">choose your favourite</p>
                    <h5 class="main-heading wow slideInRight">Occasions</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="occation-box wow slideInUp mt-50">
                    <a href="">Farewell</a>
                    <div>
                        <img src="{{ url('/public/assets/images/other/img8.jpg') }}" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="occation-box wow slideInUp">
                    <a href="">Bride</a>
                    <div>
                        <img src="{{ url('/public/assets/images/other/img9.jpg') }}" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="occation-box wow slideInUp mt-50">
                    <a href="">Mother's Day</a>
                    <div>
                        <img src="{{ url('/public/assets/images/other/img10.jpg') }}" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="occation-box wow slideInUp">
                    <a href="">Baby Shower</a>
                    <div>
                        <img src="{{ url('/public/assets/images/other/img11.jpg') }}" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- Section with 2 columns -->
<section class="sec-client-dairy">
    <div class="container">
	 	<div class="row align-item-center">
	    	<div class="col-sm-6 offset-md-1">
              <div class="wow slideInLeft">
                  <img src="{{ url('/public/assets/images/other/image1.jpg') }}" class="img-fluid">
              </div>      
            </div>
	    	<div class="col-sm-4 ">
               <div class="wow slideInRight">
                    <p class="heading-content">discover what our clients have to say</p>
                    <h5 class="main-heading">client diaries</h5>
                    <h6>They create very <br> nice hampers.</h6>
                    <p class="discription">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                </div>      
            </div>
	  	</div>
	</div>
</section>



<!-- Section with 1 columns-->
<section class="sec-follow-us">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="text-center">
                    <p class="heading-content wow slideInLeft">Follow Us On</p>
                    <h5 class="main-heading wow slideInRight">Instagram</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="follow-slider wow slideInUp">
                    <div class="items">
                         <img src="{{ url('/public/assets/images/other/1.jpg') }}" class="img-fluid">
                    </div>
                    <div class="items">
                       <img src="{{ url('/public/assets/images/other/2.jpg') }}" class="img-fluid">
                    </div>
                    <div class="items">
                        <img src="{{ url('/public/assets/images/other/3.jpg') }}" class="img-fluid">
                    </div>
                    <div class="items">
                        <img src="{{ url('/public/assets/images/other/1.jpg') }}" class="img-fluid">
                    </div>
                    <div class="items">
                        <img src="{{ url('/public/assets/images/other/2.jpg') }}" class="img-fluid">
                    </div>
                    <div class="items">
                        <img src="{{ url('/public/assets/images/other/3.jpg') }}" class="img-fluid">
                    </div>

                    <div class="items">
                       <img src="{{ url('/public/assets/images/other/1.jpg') }}" class="img-fluid"> 
                    </div>
                    <div class="items">
                       <img src="{{ url('/public/assets/images/other/2.jpg') }}" class="img-fluid">
                    </div>
                    <div class="items">
                        <img src="{{ url('/public/assets/images/other/3.jpg') }}" class="img-fluid">
                    </div>

                    <div class="items">
                        <img src="{{ url('/public/assets/images/other/2.jpg') }}" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection