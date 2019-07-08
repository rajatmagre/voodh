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

                         <form name="change_password" id="change_password" method="post" action="{{ route('password.update') }}">

                            @csrf
                            <input type="hidden" name="user_id" id="user_id" value="{{ Request::segment('2') }}">
                           <input type="hidden" name="token" value="{{ $token }}">

                             <div class="row m-top-10">
                                <div class="form-group">
                                     @include('admin.session_message.success')
                                    <label>{{ trans('file.email') }}</label>
                                    <input type="email" class="form-control" name="email" id="email" value="" placeholder="{{ trans('file.email') }}" data-rule-required="true" data-msg-required="{{ trans('file.email_validate') }}" />

                                     @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                     @endif
                                </div>
                            </div>
                            <div class="row m-top-10">
                                <div class="form-group">
                                     @include('admin.session_message.success')
                                    <label>{{ trans('file.password') }}</label>
                                    <input type="password" class="form-control" name="password" id="password" value="" placeholder="{{ trans('file.password') }}" data-rule-required="true" data-msg-required="{{ trans('file.password_validate') }}" />

                                     @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                     @endif
                                </div>
                            </div>
                             <div class="row m-top-10">
                                <div class="form-group">
                                     @include('admin.session_message.success')
                                    <label>{{ trans('file.confirm_password') }}</label>
                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" value="" placeholder="{{ trans('file.confirm_password') }}" data-rule-required="true" data-rule-equalto="#new_password" data-msg-equalto="{{ trans('file.valid_match_pass') }}"  data-msg-required="{{ trans('file.confirm_password_validate') }}" />

                                     @if ($errors->has('confirm_password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('confirm_password') }}</strong>
                                            </span>
                                     @endif
                                </div>
                            </div>
                            <div class="row m-top-30">
                                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                   <button type="submit" name="submit" class="common-btn btn-arrwo">{{ trans('file.send') }} <img src="{{ url('/public/front_assets/img/icon_right.png')}}" alt="right-arrow"></button>
                                </div>
                            </div>
                             <p class="text-center m-top-30 common-text have-clr"><span>{{  trans('file.forget_content') }}</span><a href="{{ url('/register') }}"> {{ trans('file.register') }}</a></p>
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
    </script>
@endsection
