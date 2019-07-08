@extends('layouts.app_front')

@section('content')
<section class="login-page signup-sec">
    <div class="container-fluid p-0">
         <div class="row">
            <div class="col-md-6 img-login">
              <img src="{{ url('/public/assets/images/other/login-banner.jpg') }}" class="img-fluid">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="login-form-box">
                    <div class="login-inner">
                      <form method="post" name="signup-form" id="signup-form" action="{{ url('user-register') }}" >
                        @csrf
                        <h5>Create Your Free Account</h5>
                          <div class="login-link">
                              <span> Already have an account? <a href="user-login"> Log in</a></span>
                          </div>
                          <div class="form-signup-block">
                              <label>Full Name</label>
                              <div class="input-group">
                                  <input type="text" class="form-control" name="full_name" value="{{ old('full_name') }}"  id="full_name" placeholder="Enter full name."  data-rule-required="true" data-msg-required="Enter full name." />
                                 
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon1"><img src="{{ url('/public/assets/images/icons/user.png') }}"></span>
                                  </div>
                              </div>
                              @if ($errors->has('full_name'))
                                  <span class="error_validation" role="alert">
                                      <strong>{{ $errors->first('full_name') }}</strong>
                                  </span>
                              @endif
                          </div>
                         
                          <div class="form-signup-block">
                              <label>Email Address</label>
                              <div class="input-group">
                                  <input type="text" class="form-control" name="email" value="{{ old('email') }}"  id="email" placeholder="Enter Email."  data-rule-required="true" data-msg-required="Enter Email." />
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon1"><img src="{{ url('/public/assets/images/icons/email.png') }}"></span>
                                  </div>
                              </div>
                              @if ($errors->has('email'))
                                  <span class="error_validation" role="alert">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                              @endif
                          </div>
                             <div class="form-signup-block">
                              <label>Password</label>
                               <div class="input-group">
                                  <input type="password" class="form-control" name="password"  id="password" value="" placeholder="Password" data-rule-required="true" data-msg-required="Password" data-rule-minlength="8" data-msg-minlength="Password"  />
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon1"><img src="{{ url('/public/assets/images/icons/pass.png') }}"></span>
                                  </div>
                                </div>

                                @if ($errors->has('password'))
                                    <span class="error_validation" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-signup-block">
                              <label>Confirm Password</label>
                               <div class="input-group">
                                  <input type="password" class="form-control" name="password_confirmation"   id="password_confirmation" value="" placeholder="Confirm Password" data-rule-required="true" data-msg-required="Confirm Password"  data-rule-equalto="#password" data-msg-equalto="Confirm Password should be same." />


                                    
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon1"><img src="{{ url('/public/assets/images/icons/pass.png') }}"></span>
                                  </div>
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <span class="error_validation" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                          <div class="text-center">
                              <button type="submit" class="btn common-btn">Create Account</button>
                          </div>

                           <div class="text-center login-link">
                              <span>By Signing up. You are agreeing to <a href="login.html">Voodh's Terms & Conditions.</a></span>
                          </div>

                          
                      </form>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</section>
<!-- SMS verification popup -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script src="{{ url('/public/admin_assets/developer_validate/jquery.validate.min.js')}}"></script>
<script src="{{ url('/public/admin_assets/developer_validate/custom_validate.js')}}"></script>
<script src="{{ url('/public/front_assets/js/intlTelInput.js')}}"></script> <!-- for Country code -->

<!-- for country code s -->
<script>
    
  $(document).ready(function(){

  $(".select2").select2({

   templateResult: formatState
  
  });
 
 });

<!-- for country code e -->
<script type="text/javascript">

    $('#signup-form').validate({
        //ignore: [],
        onfocusout: function(element) {
        this.element(element);
        },
        errorClass: 'error_validation',
        errorElement:'span',
        highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);

        },
        submitHandler:function(form)
        {

            //var my_country_code = $('.selected-flag').attr('title');

            //var set_val_code = $('#country_code').val(my_country_code.slice(-2));
            
            $('#submit_register').prop("disabled", true);

            var recaptcha_val = $("#hidden-grecaptcha").val();

            if (recaptcha_val != '') {

                $('#msg_show').css('display','none');

                form.submit();
                
            } else{

                $('#msg_show').css('display','block');

                var error_msg = $('#hidden_captcha_msg').val();

                $('#msg_show').html('<div class="alert alert-danger">'+ error_msg +'</div>'); 

                $('#loader_div_element').css('display','none');

                $('#submit_register').prop("disabled", false);

                return;
            } 


        }
    });

    

</script>

@endsection
