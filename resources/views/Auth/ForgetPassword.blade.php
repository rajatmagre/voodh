@extends('layouts.app_front')

@section('content')
<section class="login-page main-login signup-sec">
    <div class="container-fluid p-0">
         <div class="row">
           <span id="message_span">  
              @if(Session::has('success'))
              <div class="alert alert-success"> 
                  {{Session::get('success')}}
              </div>
              @endif  

              @if(Session::has('error'))
              <div class="alert alert-danger"> 
                  {{Session::get('error')}}
              </div>
              @endif  
          </span> 
            <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="login-form-box">
                    <div class="login-inner for-forgot-pass">
                      <form name="forget_password" id="forget_password" method="post" action="{{ url('forget-password') }}">
                      @csrf 
                        <h5>Forgot Password?</h5>
                          <div class="login-link">
                            <span> Please confirm your email address below and <br> we will send you a password reset link.</span>
                          </div>
                            <div class="form-signup-block">
                               <label>Email Address</label>
                               <div class="input-group">
                                  <input type="text" class="form-control" name="email" id="email" value="" placeholder="Enter email." data-rule-required="true" data-msg-required="Enter email."  data-rule-email="true" data-msg-email="Enter email." />
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon1"><img src="{{ url('/public/assets/images/icons/email.png') }}"></span>
                                  </div>
                                </div>
                            </div>
                           
                           
                         
                          <div class="text-center">
                              <button type="submit" class="btn common-btn">Submit</button>
                          </div>

                           <div class="text-center login-link">
                              <span>You have remembered your password? <a href="user-login">Login</a></span>
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
    $('#forget_password').validate({
        ignore: [],
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
    
         $('#page_sub_btn').prop("disabled", true);
          form.submit();
        }
    });
    </script>
@endsection
