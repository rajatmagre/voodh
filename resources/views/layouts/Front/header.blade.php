<!DOCTYPE html>
<html>
<head>
    <title>VOODH</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ url('/public/assets/images/icons/fav-icon.png') }}">
  <!-- Bootstrap Core CSS -->
    <link href="{{ url('/public/assets/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ url('/public/assets/css/bootstrap-dropdownhover.min.css') }}" rel="stylesheet"/>
  <!-- Animate CSS -->
    <link href="{{ url('/public/assets/css/animate.css') }}" rel="stylesheet"/>
    <!-- slick CSS -->
    <link href="{{ url('/public/assets/css/slick.css') }}" rel="stylesheet"/>
    <link href="{{ url('/public/assets/css/slick-theme.css') }}" rel="stylesheet"/>
    <!-- hover-min CSS -->
    <link href="{{ url('/public/assets/css/hover-min.css') }}" rel="stylesheet"/>
    <!-- yamm css -->
    <link href="{{ url('/public/assets/css/yamm.css') }}" rel="stylesheet"/>
    <!-- Font-awesome web fonts with css -->
    <link href="{{ url('/public/assets/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Font-awesome web fonts with css -->
    <!-- loader css -->
    <link href="{{ url('/public/assets/css/loader.css') }}" rel="stylesheet"/>
  <!-- Custom CSS -->
    <link href="{{ url('/public/assets/css/custom.css') }}" rel="stylesheet"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<!-- Header html -->

<header>
  <div class="header-top">
     <div class="container">
        <div class="row align-item-center">
          <div class="col-lg-4 col-md-6">
            <div class="col-mail-list">
              <ul>
                <li><a href=""><img src="{{ url('/public/assets/images/icons/call.png') }}"> 086566 76677</a></li>
                <li><a href=""><img src="{{ url('/public/assets/images/icons/mail.png') }}">voodh@gmail.com</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 for-normal-screen-only">
            <div class="logo-top">
              <a href=""><img src="{{ url('/public/assets/images/logo.png') }}" class="img-fluid"></a>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="social-links">
              <ul>
                <li><a href=""><img src="{{ url('/public/assets/images/icons/snapchat.png') }}"></a></li>
                <li><a href=""><img src="{{ url('/public/assets/images/icons/whatsup.png') }}"></a></li>
                <li><a href=""><img src="{{ url('/public/assets/images/icons/youtobe.png') }}"></a></li>
                <li><a href=""><img src="{{ url('/public/assets/images/icons/twitter.png') }}"></a></li>
                <li><a href=""><img src="{{ url('/public/assets/images/icons/FB.png') }}"></a></li>
                <li><a href=""><img src="{{ url('/public/assets/images/icons/INSTA.png') }}"></a></li>
              </ul>
            </div>
          </div>
        </div>
     </div>
    </div>
  <div class="header-main">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#" style="display: none;"><img src="{{ url('/public/assets/images/logo.png') }} " class="img-fluid"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class=" navbar-collapse" id="gNavi">
            <ul class="navbar-nav mr-auto">
                      <li class="active">
                        <a href="" class="nav-link">Gifts</a>
                        <ul class="pulldownmenu for-after-arrow">
                          <?php 
                              $cats = getAllParentCat();
                              if(!empty($cats) && count($cats)>0){
                                foreach ($cats as $key => $cat) {
                          ?>
                              <li>
                                  <a href="{{ $cat->cat_name }}">{{ $cat->cat_name }}</a>

                                  <ul class="pulldownmenu after-left-arrow">
                                    <div class="row">
                                      <?php 
                                          $subCats = getSubCat($cat->cat_id);
                                          if(!empty($subCats) && count($subCats)>0){
                                            foreach ($subCats as $key => $subCat) {
                                      ?>
                                          <div class="col-md-3">
                                            <div>
                                                <h5>{{ $subCat->cat_name }}</h5>
                                                <?php 
                                                    $reSubCats = getSubCat($subCat->cat_id);
                                                    if(!empty($reSubCats) && count($reSubCats)>0){
                                                      foreach ($reSubCats as $key => $reSubCat) {
                                                ?>
                                                    <li><a href="{{ url('products').'/'.base64_encode($reSubCat->cat_id) }}">{{ $reSubCat->cat_name }}</a></li>
                                                <?php }} ?>
                                            </div>
                                          </div>
                                      <?php }} ?>
                                    </div>
                                  </ul>
                              </li>
                          <?php }} ?>
                        </ul>
                      </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Wedding</a>
              </li>
             <!--  <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li> -->
              <li class="nav-item">
                <a class="nav-link" href="#">Corporate</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Blogs</a>
              </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
             <div class="input-group search">
              <input type="text" class="form-control" placeholder="Search">
              <div class="input-group-append">
                <button class="btn btn-search" type="button"><i class="fas fa-search"></i></button>
              </div>
            </div>
            </form>
            <div class="login-btn">
              @if(Auth::check())
                  Hello, 
                  {{ ucfirst(Auth()->user()->full_name) }}
                  <a href="{{ url('logout') }}" class="common-btn">Logout</a>
              @else
                  <a href="{{ url('user-login') }}" class="common-btn">Login/Sigup</a>
              @endif
            </div>
          </div>
        </nav>
        
    </div>
  </div>
</header>
<!-- Header html end -->