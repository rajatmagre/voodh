

<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Tell the browser to be responsive to screen width -->

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">

    <!-- Favicon icon -->

    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/icon/favicon.png">

    <title>People-For-Help</title>

    <!-- Bootstrap Core CSS -->

    <link href="{{ asset('public/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->

    <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet">

    <!-- You can change the theme colors from here -->

    <link href="{{ asset('public/assets/css/colors/blue.css') }}" id="theme" rel="stylesheet">

    

</head>



<body>

    <!-- ============================================================== -->

    <!-- Preloader - style you can find in spinners.css -->

    <!-- ============================================================== -->

    <div class="preloader">

        <svg class="circular" viewBox="25 25 50 50">

            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>

    </div>

    <!-- ============================================================== -->

    <!-- Main wrapper - style you can find in pages.scss -->

    <!-- ============================================================== -->

    <section id="wrapper">

        <div class="login-register" style="background-image:url({{asset('public/assets/images/background/login-register.jpg')}});">        

            <div class="login-box card">

            <div class="card-block">

                 <form class="form-horizontal form-material"  data-parsley-validate id="loginform" action="" method="POST">

                    @csrf

                    <h3 class="box-title m-b-20">Sign In</h3>

                    <div class="form-group ">

                        <div class="col-xs-12">

        

                            <input type="text" placeholder="Email" name="email"  class="form-control valid-email" id="email" value="" autocomplete="on" required data-parsley-required-message=' Email is required.' value="" data-parsley-type='email'

                               required data-parsley-type-message='Please enter valid email address.'>



                        </div>

                    </div>

                   



                    <div class="form-group">

                        <div class="col-xs-12">

                            

                             <input type="password" name="password"  placeholder="Password" class="form-control required" value="" id="password" autocomplete="off"

                                 value="" required data-parsley-required-message='Password is required.'>



                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-md-12">

                           <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a> </div>

                    </div>

                    <div class="form-group text-center m-t-20">

                        <div class="col-xs-12">

                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" class="btn-submit" type="submit">Log In</button>

                        </div>

                    </div>

                    

                   

                </form>

               

            </div>

          </div>

        </div>

        

    </section>

    <!-- ============================================================== -->

    <!-- End Wrapper -->

    <!-- ============================================================== -->

    <!-- ============================================================== -->

    <!-- All Jquery -->

    <!-- ============================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://parsleyjs.org/dist/parsley.js"></script>
    <script src="{{ asset('public/assets/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap tether Core JavaScript -->

    <script src="{{ asset('public/assets/plugins/bootstrap/js/tether.min.js') }}"></script>

    <script src="{{ asset('public/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- slimscrollbar scrollbar JavaScript -->

    <script src="{{ asset('public/assets/js/jquery.slimscroll.js') }}"></script>

    <!--Wave Effects -->

    <script src="{{ asset('public/assets/js/waves.js') }}"></script>

    <!--Menu sidebar -->

    <script src="{{ asset('public/assets/js/sidebarmenu.js') }}"></script>

    <!--stickey kit -->

    <script src="{{ asset('public/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>

    <!--Custom JavaScript -->

    <script src="{{ asset('public/assets/js/custom.min.js') }}"></script>

    <!-- ============================================================== -->

    <!-- Style switcher -->

    <!-- ============================================================== -->

    <script src="{{ asset('public/assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>

</body>



</html>