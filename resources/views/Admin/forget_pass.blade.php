@extends('layouts.app_single')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IAA</title>
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
<!--Forget Password start-->
<section class="login-admin">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-sm-8 offset-sm-2">
        <div class="login-main-block">
          <h3 class="login-heading">Forgot Password</h3>
          <div>
            <div class="login-head">
              <a href="#"><img src="admin_assets/images/other/img_logo.png" alt="IAA" class="img-fluid"><span>Indian Aviation Academy</span></a>
            </div>
            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}
            <!--form start-->
            <form name="forget-form" id="forget-form" method="post" action="{{ url('forgot-pass') }}"  >
            	@csrf
	            <div class="login-form-part">
                @if (session('status'))
                  <div class="alert alert-success">
                      {{ session('status') }}
                  </div>
              @endif
	              <p class="text-line">Enter your email account to receive a link  allowing you to Create a Password.</p>
	              <div class="input-group mb-3">
	                <div class="input-group-prepend">
	                  <span class="input-group-text" id="email"><img src="admin_assets/images/icons/user.png" align="user mail"></span>
	                </div>
	                <input type="email" id="email" class="form-control" name="email" placeholder="Email" value="" data-rule-required="true" data-msg-required="Please enter email-id." data-rule-email="true" data-msg-email="Please enter valid email-id." />
	              </div>
	              @if ($errors->has('email'))
                  <span for="email" class="error_validate">{{ $errors->first('email') }}</span>
                @endif
	             <span for="email" class="error_validate"></span>
	              <div class="back-to-login">
	                <a href="{{ route('admin-login') }}"><img src="admin_assets/images/icons/back-sign.png" align="back sign">  Back to Login</a>
	              </div>
	              <div>
	                <button name="submit" type="submit" class="btn common-btn orange-btn">Submit</button>
	              </div>
	            </div>
          	</form>
            <!--form end-->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--Forget Password end-->

<script src="admin_assets/js/jquery-3.3.1.min.js"></script>
<script src="admin_assets/js/bootstrap.min.js"></script>
<script src="admin_assets/developer_validate/jquery.validate.min.js"></script>
<script src="admin_assets/developer_validate/custom_validate.js"></script>

<script type="text/javascript">
    $('#forget-form').validate({
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