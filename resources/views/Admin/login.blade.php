@extends('layouts.app_single')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>People for Help</title>
    <base href="{{ url('/')}}/public/" />
    <link rel="stylesheet" href="admin_assets/css/bootstrap.min.css">
    <link href="admin_assets/css/fontawesome-all.css" rel="stylesheet">
    <link href="admin_assets/css/custom.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="admin_assets/images/icons/icon_fevi.png">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700" rel="stylesheet">
    <link href="admin_assets/css/jQuery-plugin-progressbar.css" rel="stylesheet">
</head>
<body class="login-body">

<section class="login-admin">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-sm-8 offset-sm-2">
        <div class="login-main-block">
          <h3 class="login-heading" style="color:#fff;">Admin Login</h3>
          <div>
            <div class="login-head">
              <a href="#"><img src="admin_assets/images/other/img_logo.png" alt="IAA" class="img-fluid"><span>People for Help</span></a>
            </div>
            <form name="admin-login" id="admin-login-form" action="{{ route('adminlogin') }}" method="post">
              @csrf
            <div class="login-form-part">
               <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><img src="admin_assets/images/icons/user.png" alt="user mail"></span>
                </div>
                <input type="email" class="form-control" placeholder="Email" name="email" value="" data-rule-required="true" data-msg-required="Please enter email-id." data-rule-email="true" data-msg-email="Please enter valid email-id."   />
              </div>

               <span for="email" class="error_validate"></span>
               @if($errors->has('email'))
                    <span for="email" class="error_validate mb-3">{{ $errors->first('email') }}</span>
                  @endif

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><img src="admin_assets/images/icons/password.png" alt="password"></span>
                </div>
                <input type="password" class="form-control" placeholder="Password" name="password" value="" data-rule-required="true" data-msg-required="Please enter password."  />
                <div class="input-group-append">
                  <span class="input-group-text"><img src="admin_assets/images/icons/eye.png" onclick="change_text();" alt="view"></span>
                </div>

              </div>

               <span for="password" class="error_validate"></span>

              @if($errors->has('password'))
                    <span for="password" class="error_validate  mb-3">{{ $errors->first('password') }}</span>
                  @endif
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                  <!--  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                  </div> -->
                   <div class="checkbox">
                      <label>
                        <input type="checkbox" name="remember_me" value="1" {{ old('remember_me') }} />
                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                        Remember Me
                      </label>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                  <div>
                    <a href="{{ url('forget-pass') }}">Forgot Password?</a>
                  </div>
                </div>
              </div>
              <div>
                <button type="submit" class="btn common-btn orange-btn">Sign In</button>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="admin_assets/js/jquery-3.3.1.min.js"></script>
<script src="admin_assets/js/bootstrap.min.js"></script>
<script src="admin_assets/developer_validate/jquery.validate.min.js"></script>
<script src="admin_assets/developer_validate/custom_validate.js"></script>
<script type="text/javascript">
    $('#admin-login-form').validate({
        ignore: [],
        onfocusout: function(element) {
        this.element(element);
        },
        errorClass: 'error_validate',
        errorElement:'span',
        highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
        }
    });
  

  </script>
</body>
</html>
 @endsection