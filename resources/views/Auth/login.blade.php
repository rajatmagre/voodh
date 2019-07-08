@extends('layouts.app_front')

@section('content')
<section class="login-page main-login signup-sec">
    <div class="container-fluid p-0">
         <div class="row">
           
            <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="login-form-box">
                    <div class="login-inner for-login-page">
                      <form name="login_form" id="login_form" method="post" action="{{ url('user-login') }}"> 
                        @csrf
                        <h5>Login to Your Account</h5>
                            <div class="form-signup-block">
                               <label>Email Address</label>
                               <div class="input-group">
                                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Enter email." data-rule-required="true" data-msg-required="Enter email."  data-rule-email="true" data-msg-email="Enter email." autocomplete="off" />

                                     
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon1"><img src="{{ url('/public/assets/images/icons/email.png') }}"></span>
                                  </div>
                                </div>
                                @if($errors->has('email'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('email') }}</strong>
                                      </span>
                                 @endif
                            </div>
                             <div class="form-signup-block">
                              <label>Password</label>
                               <div class="input-group">
                                  <input type="password" name="password" id="password" class="form-control" placeholder="Enter password." data-rule-required="true" data-msg-required="Enter password." >

                                  
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon1"><img src="{{ url('/public/assets/images/icons/pass.png') }}"></span>
                                  </div>
                                </div>
                                @if($errors->has('password'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                                @endif
                            </div>
                            <div class="text-right forgot-link ">
                              <a href="forget-password">Forgot Password?</a>
                            </div>
                         
                          <div class="text-center">
                              <button type="submit" type="submit" name="submit" id="login_btn" class="btn common-btn">Login</button>
                          </div>

                           <div class="text-center login-link">
                              <span>Need a Voodh Account? <a href="user-register">Create an Account.</a></span>
                          </div>

                          
                      </form>
                    </div>
                  </div>
            </div>
             <div class="col-md-6 img-login">
              <img src="{{ url('/public/assets/images/other/login-banner.jpg') }}" class="img-fluid">
            </div>
        </div>
    </div>
</section>
<script src="{{ url('/public/admin_assets/developer_validate/jquery.validate.min.js')}}"></script>
<script src="{{ url('/public/admin_assets/developer_validate/custom_validate.js')}}"></script>
<script type="text/javascript">

     $(document).ready(function(){

        $('#login_btn').click(function(){

        $('#login_form').validate({
            ignore: [],
            onfocusout: function(element) {
            this.element(element);
            },
            errorClass: 'error_validation',
            errorElement:'span',
            highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);

            }
        }); 

     });
    </script>
@endsection
