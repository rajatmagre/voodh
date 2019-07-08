@extends('layouts.app')
@section('content')
<!-- Start banner courses -->   
<section class="section  nomi-fom-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="text-center banner-content">

                     <!-- upcoming course section heading start -->
                     @php    
                            $login_main_heading=get_text_locale('login_main_heading','login',0);
    
                            if(!empty($login_main_heading))
                            {
                             
                             if(app()->getlocale()=='hn')
                            {
                                $login_main_heading_txt=$login_main_heading->column_value_hn;
                            }
                            else
                            {
                                $login_main_heading_txt=$login_main_heading->column_value_en;
                            }
                            
                            }
                            $login_page_main_description=get_text_locale('login_description_blow_heading','login',0);
                             if(!empty($login_page_main_description))
                            {
                             
                             if(app()->getlocale()=='hn')
                            {
                                $login_page_main_description_txt=$login_page_main_description->column_value_hn;
                            }
                            else
                            {
                                $login_page_main_description_txt=$login_page_main_description->column_value_en;
                            }
                            
                            }
                        @endphp
                <!-- upcoming course section heading end --> 
                    <h3 class="title wow slideInLeft">{{ trans('file.change_password') }}</h3>
                    <p class="wow slideInRight">{!!@$login_page_main_description_txt!!}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End banner courses -->


<!-- Start nomination form section -->
<section class="nom-form-sec login-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="nomination-upper wow slideInUp">
                  <div class="nomination-inner">
                    <div class="img-block">
                        <div class="img-inner">

                            <!-- upcoming course section heading start -->
                     @php    
                            $login_image=get_text_locale('login_banner_image','login',0);
    
                            if(!empty($login_image))
                            {
                                $banner_image=$login_image->column_value_en;
                            }
                            
                            $banner_heading=get_text_locale('login_banner_image_heading','login',0);
                            if(!empty($banner_heading))
                            {
                             
                            if(app()->getlocale()=='hn')
                            {
                                $banner_heading_txt=$banner_heading->column_value_hn;
                            }
                            else
                            {
                                $banner_heading_txt=$banner_heading->column_value_en;
                            }
                            
                            }
                        @endphp

                            <img src="{{url('public/uploads/page_column_images/'.@$banner_image)}}" alt="ICAO Approved">
                        </div>
                        <div class="content">
                            <h3 class="subTitle">{{@$banner_heading_txt}} 546</h3>
                            <!-- <p class="common-text">Starts From 1st February</p> -->
                        </div>
                    </div>
                    <div class="form-nomination log-in">
                        <div class="row">
                            <div class="col-md-12">
                               <h4 class="subTitle">{{ trans('file.change_password') }}</h4>
                            </div>
                        </div>

                         <form name="change_password" id="change_password" method="post" action="{{ url('user-password/update') }}">
                            @csrf
                            <input type="hidden" name="user_id" id="user_id" value="{{ Request::segment('2') }}">
                           <input type="hidden" name="token" value="{{ $token }}">

                           
                                
                                @if ($errors->has('email'))

                                       <div class="alert alert-danger" role="alert">
                                            
                                            {{ $errors->first('email') }}
                                        
                                        </div>
                                @endif
                            

                             <div class="row">
                                <div class="form-group">
                                     @include('admin.session_message.success')
                                    <label>{{ trans('file.login_email') }} <span class="maditory_star">*</span></label>
                                    <input type="email" class="form-control" name="email" id="email" value="" placeholder="{{ trans('file.login_email') }}" data-rule-required="true" data-msg-required="{{ trans('file.validate_email_req') }}"  data-rule-email="true" data-msg-email="{{ trans('file.validate_email_type') }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                     @include('admin.session_message.success')
                                    <label>{{ trans('file.login_pass') }}<span class="maditory_star">*</span></label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="{{ trans('file.login_pass') }}" data-rule-required="true" data-msg-required="{{ trans('file.validate_pass') }}" />

                                     @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                     @endif
                                </div>
                            </div>
                             <div class="row">
                                <div class="form-group">
                                     @include('admin.session_message.success')
                                    <label>{{ trans('file.label_cpass') }}<span class="maditory_star">*</span></label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="" placeholder="{{ trans('file.label_cpass') }}" data-rule-required="true" data-rule-equalto="#password" data-msg-equalto="{{ trans('file.valid_match_pass') }}"  data-msg-required="{{ trans('file.confirm_password_validate') }}" />

                                     @if ($errors->has('password_confirmation'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                     @endif
                                </div>
                            </div>
                            <div class="row m-top-30">
                                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                   <button type="submit" name="submit" id="change_btn" class="common-btn btn-arrwo">{{ trans('file.send') }} <img src="{{ url('/public/front_assets/img/icon_right.png')}}" alt="right-arrow"></button>
                                </div>
                            </div>
                             <p class="text-center m-top-30 common-text have-clr"><span>{{  trans('file.forget_content') }}</span><a href="{{ url('user-register') }}"> {{ trans('file.register') }}</a></p>
                        </form>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{ url('/public/admin_assets/developer_validate/jquery.validate.min.js')}}"></script>
<script src="{{ url('/public/admin_assets/developer_validate/custom_validate.js')}}"></script>
<script type="text/javascript">

    $(document).ready(function(){

        $('#change_btn').click(function(){

                $('#change_password').validate({
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


        var valida_msg=$('#change_password').find('.error_validate');

        if(valida_msg)
        {
          $('.invalid-feedback').hide();
        }

         });

     });
    </script>
@endsection


