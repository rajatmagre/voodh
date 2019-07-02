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
             <!--  <li class="nav-item active">
                <a class="nav-link" href="#">Gifts</a>
              </li> -->
              <!--  <li class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Gifts <b class="caret"></b></a> 
                          <ul class="dropdown-menu main-menu">
                            <li class="kopie"><a href="#">Occasion</a></li>
                              <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Relationship</a>
                      <ul class="dropdown-menu">
                                     <div class="row">
                                        <div class="col-md-3">
                                          <li>Special</li>
                                          <li><a href="">Wife</a></li>
                                          <li><a href="">Husband</a></li>
                                          <li><a href="">Girlfriend</a></li>
                                          <li><a href="">Boyfriend</a></li>
                                          <li><a href="">Fiance</a></li>
                                        </div>
                                        <div class="col-md-3">
                                          <li>Special</li>
                                          <li><a href="">Wife</a></li>
                                          <li><a href="">Husband</a></li>
                                          <li><a href="">Girlfriend</a></li>
                                          <li><a href="">Boyfriend</a></li>
                                          <li><a href="">Fiance</a></li>
                                        </div>
                                        <div class="col-md-3">
                                          <li>Special</li>
                                          <li><a href="">Wife</a></li>
                                          <li><a href="">Husband</a></li>
                                          <li><a href="">Girlfriend</a></li>
                                          <li><a href="">Boyfriend</a></li>
                                          <li><a href="">Fiance</a></li>
                                        </div>
                                        <div class="col-md-3">
                                          <li>Special</li>
                                          <li><a href="">Wife</a></li>
                                          <li><a href="">Husband</a></li>
                                          <li><a href="">Girlfriend</a></li>
                                          <li><a href="">Boyfriend</a></li>
                                          <li><a href="">Fiance</a></li>
                                        </div>
                                     </div>
                                                                        
                  </ul>
                </li>                                  
                          </ul>
                      </li> -->
                      <li class="active">
                        <a href="" class="nav-link">Gifts</a>
                        <ul class="pulldownmenu for-after-arrow">
                          <li><a href="">Occasion</a>
                            <ul class="pulldownmenu after-left-arrow">
                              <div class="row">
                                <div class="col-md-3">
                                  <div>
                                      <h5>Festivals</h5>
                                      <li><a href="">Diwali</a></li>
                                      <li><a href="">Holi</a></li>
                                      <li><a href="">Rakhi</a></li>
                                      <li><a href="">Dashahara</a></li>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div>
                                      <h5>Special Days</h5>
                                      <li><a href="">Mother's Day</a></li>
                                      <li><a href="">Father's Day</a></li>
                                      <li><a href="">Women's Day</a></li>
                                      <li><a href="">Children's Day</a></li>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div>
                                      <h5>Special Days</h5>
                                      <li><a href="">Friendship Day</a></li>
                                      <li><a href="">Teacher's Day</a></li>
                                      <li><a href="">Valentine's Day</a></li>
                                  </div>
                                </div>
                                
                              </div>
                            </ul>
                          </li>
                          <li><a href="">Relationship</a>
                            <ul class="pulldownmenu after-left-arrow">
                              <div class="row">
                                <div class="col-md-3">
                                  <div>
                                      <h5>Special</h5>
                                      <li><a href="">Wife</a></li>
                                      <li><a href="">Husband</a></li>
                                      <li><a href="">Girlfriend</a></li>
                                      <li><a href="">Boyfriend</a></li>
                                      <li><a href="">Fiance</a></li>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div>
                                      <h5>Friends</h5>
                                      <li><a href="">Him</a></li>
                                      <li><a href="">Her</a></li>
                                      <li><a href="">Both</a></li>
                                      <li><a href="">Colleagues</a></li>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div>
                                      <h5>Parents</h5>
                                      <li><a href="">Father</a></li>
                                      <li><a href="">Mother</a></li>
                                      <li><a href="">Both</a></li>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div>
                                      <h5>Family</h5>
                                      <li><a href="">Son</a></li>
                                      <li><a href="">Daughter</a></li>
                                      <li><a href="">Couple</a></li>
                                      <li><a href="">Sibling</a></li>
                                      <li><a href="">Others</a></li>
                                  </div>
                                </div>
                              </div>
                            </ul>
                          </li>
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
          </div>
        </nav>
        
    </div>
  </div>
</header>
<!-- Header html end -->