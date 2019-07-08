@extends('layouts.app')

@section('content')
<script src='https://www.google.com/recaptcha/api.js'></script>

<!-- Start banner courses -->   
<section class="section  nomi-fom-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="text-center banner-content">
                     <!-- upcoming signup section heading start -->
                     @php    
                        $signup_main_heading=get_text_locale('signup_main_heading','signup',0);

                        if(!empty($signup_main_heading))
                        {
                         
                         if(app()->getlocale()=='hn')
                        {
                            $signup_main_heading_txt=$signup_main_heading->column_value_hn;
                        }
                        else
                        {
                            $signup_main_heading_txt=$signup_main_heading->column_value_en;
                        }
                        
                        }
                        $signup_main_description=get_text_locale('signup_main_description_below_heading','signup',0);
                         if(!empty($signup_main_description))
                        {
                         
                         if(app()->getlocale()=='hn')
                        {
                            $signup_description_txt=$signup_main_description->column_value_hn;
                        }
                        else
                        {
                            $signup_description_txt=$signup_main_description->column_value_en;
                        }
                        
                        }
                    @endphp
                <!-- upcoming signup section heading end --> 

                    <h3 class="title wow slideInLeft">{{@$signup_main_heading_txt}}</h3>
                    <p class="wow slideInRight">{!!@$signup_description_txt!!}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End banner courses -->


<!-- Start nomination form section -->
<section class="nom-form-sec">
    <div class="container">
        <!-- @if(Session::has('success'))
            <div class="alert alert-success"> 
                {{Session::get('success')}}
            </div>
            @endif  

            @if(Session::has('error'))
            <div class="alert alert-danger"> 
                {{Session::get('error')}}
            </div>
            @endif -->
        <div class="row">
            <div class="col-md-12">
                <div class="nomination-upper wow slideInUp">
                  <div class="nomination-inner">
                    <div class="img-block">
                        <div class="img-inner">
                            <!-- upcoming signup image section heading start -->
                            @php    
                                $signup_image=get_text_locale('signup_main_banner_image','signup',0);
        
                                if(!empty($signup_image))
                                {
                                    $signup_image_txt=$signup_image->column_value_en;
                                }

                                $signup_banner_heading_text=get_text_locale('signup_banner_heading','signup',0);
                                 if(!empty($signup_banner_heading_text))
                                {
                                 
                                 if(app()->getlocale()=='hn')
                                {
                                    $banner_heading_text=$signup_banner_heading_text->column_value_hn;
                                }
                                else
                                {
                                    $banner_heading_text=$signup_banner_heading_text->column_value_en;
                                }
                                
                                }
                            @endphp
                            <!-- upcoming signup section heading end -->
                            <img src="{{url('public/uploads/page_column_images/'.@$signup_image_txt)}}" alt="ICAO Approved">
                        </div>
                        <div class="content">
                            <h3 class="subTitle">{!!@$banner_heading_text!!}</h3>
                            <!-- <p class="common-text">Starts From 1st February</p> -->
                        </div>
                    </div>
                 
                    <div class="form-nomination">
                     
                        <form method="post" name="signup-form" id="signup_form" action="{{ url('user-register') }}" >
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                               <h4 class="subTitle">{{ trans('file.reg_heading') }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>{{ trans('file.label_first') }}</label>
                                    <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}"  id="first_name" placeholder="{{ trans('file.label_first') }}"  data-rule-required="true" data-msg-required="{{ trans('file.validate_first_name') }}" />


                                @if ($errors->has('first_name'))
                                    <span class="error_validation" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>{{ trans('file.label_last') }}</label>
                                    <input type="text" class="form-control" name="last_name"  id="last_name" value="{{ old('last_name') }}" placeholder="{{ trans('file.label_last') }}" data-rule-required="true" data-msg-required="{{ trans('file.validate_last_name') }}">


                                @if ($errors->has('last_name'))
                                    <span class="error_validation" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>{{ trans('file.label_email') }}</label>
                                    <input type="text" class="form-control" name="email"  id="email" value="{{ old('email') }}" placeholder="{{ trans('file.label_email') }}" data-rule-required="true" data-msg-required="{{ trans('file.validate_email_req') }}"  data-rule-email="true" data-msg-email="{{ trans('file.validate_email_type') }}"  >


                                @if ($errors->has('email'))
                                    <span class="error_validation" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>{{ trans('file.label_mobile') }}</label>
                                    <input type="text" class="form-control" name="mobile_no"  id="mobile_no" value="{{ old('mobile_no') }}" placeholder="{{ trans('file.label_mobile') }}" data-rule-required="true" data-msg-required="{{ trans('file.validate_mobile') }}" maxlength="12"/>


                                @if ($errors->has('mobile_no'))
                                    <span class="error_validation" role="alert">
                                        <strong>{{ $errors->first('mobile_no') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>{{ trans('file.label_pass') }}</label>
                                    <input type="password" class="form-control" name="password"  id="password" value="" placeholder="{{ trans('file.label_pass') }}" data-rule-required="true" data-msg-required="{{ trans('file.validate_pass') }}" data-rule-minlength="8" data-msg-minlength="{{ trans('file.pass_length') }}"  />


                                @if ($errors->has('password'))
                                    <span class="error_validation" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>{{ trans('file.label_cpass') }}</label>
                                    <input type="password" class="form-control" name="password_confirmation"   id="password_confirmation" value="" placeholder="{{ trans('file.label_cpass') }}" data-rule-required="true" data-msg-required="{{ trans('file.validate_confirm_pass') }}"  data-rule-equalto="#password" data-msg-equalto="{{ trans('file.valid_match_pass') }}" />


                                @if ($errors->has('password_confirmation'))
                                    <span class="error_validation" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="6LcXTJsUAAAAAKpcFo0wkZWrcB17gunXQMMLyUjB" data-callback="recaptchaCallback" data-expired-callback="recaptchaExpired" style="margin-top: 3rem;">
                                    
                                    </div>

                                    <input id="hidden-grecaptcha" name="hidden-grecaptcha" type="text"  style="opacity: 0; position: absolute; top: 0; left: 0; height: 1px; width: 1px;"/>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="loader_div_element" style="display: none;">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">

                                    <img src="{{ url('public/admin_assets/images/admin_loader.gif') }}" style="width:50px;height:50px;" >
                                </div>
                            </div>
                        </div>

                        <div class="row" id="msg_show" style="display: none;">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">

                                    <img src="{{ url('public/admin_assets/images/admin_loader.gif') }}" style="width:50px;height:50px;" >
                                </div>
                            </div>
                        </div>

                        
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                              <button type="submit" name="submit" id="submit_register" class="common-btn btn-arrwo button-register">{{ trans('file.reg_btn') }}<img src="front_assets/img/icon_right.png" alt="right-arrow"></button>
                            </div>
                        </div>

                        <p class="text-center m-top-30 common-text have-clr"><span>{{ trans('file.register_have_acc') }}</span><a href="{{ url('user-login') }}"> {{ trans('file.login_btn') }}</a></p>

                        </form>
                    </div>
                
                  </div>
                </div>
            </div>
        </div>
    
    </div>
</section>
<!-- Start nomination form section -->




<!-- Start our Facuties -->
<section class="section our-faculty-sec nom-faculty">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="head-block">
                    <!-- upcoming signup faculty section heading start -->
                     @php    
                            $signup_faculty_heading=get_text_locale('signup_faculty_section_main_heading','signup',0);
    
                            if(!empty($signup_faculty_heading))
                            {
                             
                             if(app()->getlocale()=='hn')
                            {
                                $signup_faculty_heading_txt=$signup_faculty_heading->column_value_hn;
                            }
                            else
                            {
                                $signup_faculty_heading_txt=$signup_faculty_heading->column_value_en;
                            }
                            
                            }
                            $faculty_section_description=get_text_locale('signup_faculty_section_main_description','signup',0);
                             if(!empty($faculty_section_description))
                            {
                             
                             if(app()->getlocale()=='hn')
                            {
                                $faculty_section_description_txt=$faculty_section_description->column_value_hn;
                            }
                            else
                            {
                                $faculty_section_description_txt=$faculty_section_description->column_value_en;
                            }
                            
                            }
                        @endphp
                <!-- upcoming signup faculty section heading end --> 
                    <h2 class="title wow slideInRight">{{@$signup_faculty_heading_txt}}<span>({{@$all_faculty_count}})</span></h2>
                    <p class="common-text wow slideInLeft">{!!@$faculty_section_description_txt!!}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if(!empty($all_faculty)) { 
                  foreach ($all_faculty as$all_faculty_value) {
                     if(app()->getlocale()=='hn')
                            {
                                $faculty_name_txt=$all_faculty_value->faculty_name_hn;
                                // $faculty_tech_name_text=$all_faculty_value->faculty_tech_name_hn;

                            }
                            else
                            {
                                $faculty_name_txt=$all_faculty_value->faculty_name_en;
                                // $faculty_tech_name_text=$all_faculty_value->faculty_tech_name_hn;
                            }
             ?>

            <div class="col-md-4 ">
                <a href="{{ url('faculty-detail/'.base64_encode($all_faculty_value->faculty_id)) }}">
                <div class="border-box wow slideInUp">
                    <img  class="image-radius-faculty" src="{{ url('/public/uploads/admin/faculty/'.$all_faculty_value->faculty_profile_img)}}" alt="Sharma">
                    <h3 class="subTitle ">{{@$faculty_name_txt}}</h3>
                    <!-- <p class="foot-title">{{@$faculty_tech_name_text}}</p> -->
                </div>
            </a>
            </div>
            <?php } } ?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="disc-block">
                    <!-- description section start -->
                     @php    
                            $desc_section_main_heading=get_text_locale('signup_description_section_main_heading','signup',0);
    
                            if(!empty($desc_section_main_heading))
                            {
                             
                             if(app()->getlocale()=='hn')
                            {
                                $desc_section_main_heading_txt=$desc_section_main_heading->column_value_hn;
                            }
                            else
                            {
                                $desc_section_main_heading_txt=$desc_section_main_heading->column_value_en;
                            }
                            
                            }
                            $text_below_heading=get_text_locale('signup_description_section_text_below_heading','signup',0);
                             if(!empty($text_below_heading))
                            {
                             
                             if(app()->getlocale()=='hn')
                            {
                                $text_below_heading_txt=$text_below_heading->column_value_hn;
                            }
                            else
                            {
                                $text_below_heading_txt=$text_below_heading->column_value_en;
                            }
                            
                            }
                        @endphp

                    <h3 class="title wow slideInRight">{{@$desc_section_main_heading_txt}}</h3>
                    <p class="common-text wow slideInLeft">{!!@$text_below_heading_txt!!}</p>
                </div>
            </div>
        </div>
        <div class="row features-row">
            <div class="col-md-4">
                <div class="for-features wow slideInLeft">
                    <!-- description sub section1 start -->
                     @php    
                            $section_sub1_headng1=get_text_locale('signup_description_section_sub1_headng1','signup',0);
    
                            if(!empty($section_sub1_headng1))
                            {
                             
                             if(app()->getlocale()=='hn')
                            {
                                $section_sub1_headng1_txt=$section_sub1_headng1->column_value_hn;
                            }
                            else
                            {
                                $section_sub1_headng1_txt=$section_sub1_headng1->column_value_en;
                            }
                            
                            }
                            $section_sub1_text1=get_text_locale('signup_description_section_sub1_text1','signup',0);
                             if(!empty($section_sub1_text1))
                            {
                             
                             if(app()->getlocale()=='hn')
                            {
                                $section_sub1_text1_txt=$section_sub1_text1->column_value_hn;
                            }
                            else
                            {
                                $section_sub1_text1_txt=$section_sub1_text1->column_value_en;
                            }
                            
                            }
                        @endphp
                  
                    <h4 class="subTitle">{{@$section_sub1_headng1_txt}}</h4>
                    <p class="common-text">{!!substr(@$section_sub1_text1_txt,0,450)!!}</p>
                    <!-- description sub section1 end -->

                </div>
            </div>
            <div class="col-md-4">
                <div class="for-features wow slideInUp">
                     <!-- description sub section2 start -->
                     @php    
                            $section_sub2_headng2=get_text_locale('signup_description_section_sub2_headng2','signup',0);
    
                            if(!empty($section_sub2_headng2))
                            {
                             
                             if(app()->getlocale()=='hn')
                            {
                                $section_sub2_headng2_txt=$section_sub2_headng2->column_value_hn;
                            }
                            else
                            {
                                $section_sub2_headng2_txt=$section_sub2_headng2->column_value_en;
                            }
                            
                            }
                            $section_sub2_text2=get_text_locale('signup_description_section_sub2_text2','signup',0);
                             if(!empty($section_sub2_text2))
                            {
                             
                             if(app()->getlocale()=='hn')
                            {
                                $section_sub2_text2_txt=$section_sub2_text2->column_value_hn;
                            }
                            else
                            {
                                $section_sub2_text2_txt=$section_sub2_text2->column_value_en;
                            }
                            
                            }
                        @endphp
                  
                    <h4 class="subTitle">{{@$section_sub2_headng2_txt}}</h4>
                    <p class="common-text">{!!substr(@$section_sub2_text2_txt,0,450)!!}</p>
                    <!-- description sub section2 end -->
                </div>
            </div>
            <div class="col-md-4">
                <div class="for-features wow slideInRight">
                     <!-- description sub section3 start -->
                     @php    
                            $section_sub3_headng3=get_text_locale('signup_description_section_sub3_heading3','signup',0);
    
                            if(!empty($section_sub3_headng3))
                            {
                             
                             if(app()->getlocale()=='hn')
                            {
                                $section_sub3_headng3_txt=$section_sub3_headng3->column_value_hn;
                            }
                            else
                            {
                                $section_sub3_headng3_txt=$section_sub3_headng3->column_value_en;
                            }
                            
                            }
                            $section_sub3_text3=get_text_locale('signup_description_section_sub3_text3','signup',0);
                             if(!empty($section_sub3_text3))
                            {
                             
                             if(app()->getlocale()=='hn')
                            {
                                $section_sub3_text3_txt=$section_sub3_text3->column_value_hn;
                            }
                            else
                            {
                                $section_sub3_text3_txt=$section_sub3_text3->column_value_en;
                            }
                            
                            }
                        @endphp
                  
                    <h4 class="subTitle">{{@$section_sub3_headng3_txt}}</h4>
                    <p class="common-text">{!!substr(@$section_sub3_text3_txt,0,450)!!}</p>
                    <!-- description sub section3 end -->       
                </div>
            </div>
            <div class="col-md-4">
                <div class="for-features wow slideInLeft">
                    <!-- description sub section4 start -->
                     @php    
                            $section_sub4_heading4=get_text_locale('signup_description_section_sub4_heading4','signup',0);
    
                            if(!empty($section_sub4_heading4))
                            {
                             
                             if(app()->getlocale()=='hn')
                            {
                                $section_sub4_heading4_txt=$section_sub4_heading4->column_value_hn;
                            }
                            else
                            {
                                $section_sub4_heading4_txt=$section_sub4_heading4->column_value_en;
                            }
                            
                            }
                            $section_sub4_text4=get_text_locale('signup_description_section_sub4_text4','signup',0);
                             if(!empty($section_sub4_text4))
                            {
                             
                             if(app()->getlocale()=='hn')
                            {
                                $section_sub4_text4_txt=$section_sub4_text4->column_value_hn;
                            }
                            else
                            {
                                $section_sub4_text4_txt=$section_sub4_text4->column_value_en;
                            }
                            
                            }
                        @endphp
                  
                    <h4 class="subTitle">{{@$section_sub4_heading4_txt}}</h4>
                    <p class="common-text">{!!substr(@$section_sub4_text4_txt,0,450)!!}</p>
                    <!-- description sub section4 end -->
                </div>
            </div>
            <div class="col-md-4">
                <div class="for-features wow slideInUp">

                     <!-- description sub section5 start -->
                     @php    
                            $section_sub5_heading=get_text_locale('signup_description_section_sub5_heading5','signup',0);
    
                            if(!empty($section_sub5_heading))
                            {
                             
                             if(app()->getlocale()=='hn')
                            {
                                $section_sub5_heading_txt=$section_sub5_heading->column_value_hn;
                            }
                            else
                            {
                                $section_sub5_heading_txt=$section_sub5_heading->column_value_en;
                            }
                            
                            }
                            $section_text5_text5=get_text_locale('signup_description_section_text5_text5','signup',0);
                             if(!empty($section_text5_text5))
                            {
                             
                             if(app()->getlocale()=='hn')
                            {
                                $section_text5_text5_txt=$section_text5_text5->column_value_hn;
                            }
                            else
                            {
                                $section_text5_text5_txt=$section_text5_text5->column_value_en;
                            }
                            
                            }
                        @endphp
                  
                    <h4 class="subTitle">{{@$section_sub5_heading_txt}}</h4>
                    <p class="common-text">{!!substr(@$section_text5_text5_txt,0,450)!!}</p>
                    <!-- description sub section5 end -->
                </div>
            </div>
            <div class="col-md-4">
                <div class="for-features wow slideInRight">
                   
                     <!-- description sub section6 start -->
                     @php    
                            $section_sub6_heading6=get_text_locale('signup_description_section_sub6_heading6','signup',0);
    
                            if(!empty($section_sub6_heading6))
                            {
                             
                             if(app()->getlocale()=='hn')
                            {
                                $section_sub6_heading6_txt=$section_sub6_heading6->column_value_hn;
                            }
                            else
                            {
                                $section_sub6_heading6_txt=$section_sub6_heading6->column_value_en;
                            }
                            
                            }
                            $section_text6_text6=get_text_locale('signup_description_section_text6_text6','signup',0);
                             if(!empty($section_text6_text6))
                            {
                             
                             if(app()->getlocale()=='hn')
                            {
                                $section_text6_text6_txt=$section_text6_text6->column_value_hn;
                            }
                            else
                            {
                                $section_text6_text6_txt=$section_text6_text6->column_value_en;
                            }
                            
                            }
                        @endphp
                  
                    <h4 class="subTitle">{{@$section_sub6_heading6_txt}}</h4>
                    <p class="common-text">{!!substr(@$section_text6_text6_txt,0,450)!!}</p>
                    <!-- description sub section6 end -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End our Facuties -->


<!-- Start popular courses -->
<section class="section all-courses-sec recent-news">
       <!-- upcoming course section heading and description start -->
                     @php    
                            $signup_main_heading=get_text_locale('signup_course_section_heading','signup',0);
    
                            if(!empty($signup_main_heading))
                            {
                             
                             if(app()->getlocale()=='hn')
                            {
                                $signup_main_heading_txt=$signup_main_heading->column_value_hn;
                            }
                            else
                            {
                                $signup_main_heading_txt=$signup_main_heading->column_value_en;
                            }
                            
                            }
                            $signup_course_section_desc=get_text_locale('signup_course_section_description','signup',0);
                             if(!empty($signup_course_section_desc))
                            {
                             
                             if(app()->getlocale()=='hn')
                            {
                                $signup_course_txt=$signup_course_section_desc->column_value_hn;
                            }
                            else
                            {
                                $signup_course_txt=$signup_course_section_desc->column_value_en;
                            }
                            
                            }
                        @endphp
                <!-- upcoming signup course section heading end --> 

    <h2 class="title1 wow slideInLeft">{{@$signup_main_heading_txt}}</h2>
    <span class="common-text wow slideInRight">{!!@$signup_course_txt!!}</span>
    <div class="container">
        <div class="row">
             <?php 
             if(!empty($front_course_master)){
             foreach ($front_course_master as $course_value) {
                  if(app()->getlocale()=='hn')
                            {
                                $course_name=$course_value->course_name_hn;
                                $courses_desc=$course_value->course_description_hn;
                            }
                            else
                            {
                                $course_name=$course_value->course_name_en;
                                $courses_desc=$course_value->course_description_en;
                            }
               
             ?>
            <div class="col-md-4 col-sm-6 wow slideInUp">
            <p><img src="front_assets//img/img_news1.png" alt="How to Work Aviation"></p>
            <div class="inner-news">
                <h3>{{@$course_name}}</h3>
                <ul>
                    <li><img src="front_assets/img/icon_calender.png" alt="calender">{{date('d M Y',strtotime(@$course_value->delivery_start_date))}} - {{date('d M Y',strtotime(@$course_value->delivery_end_date))}}</li>
                    <li><img src="front_assets/img/icon_clock.png" alt="clock"> {{date('H:i a',strtotime($course_value->delivery_start_date))}} - {{date('H:i a',strtotime($course_value->delivery_end_date))}}</li>
                </ul>
                <p class="news-details">{!!strip_tags(substr(@$courses_desc,0,400))!!}</p>
                <p class="text-center"><a href="{{url('course-detail')}}/{{ base64_encode($course_value->delivery_id) }}" class="common-btn">{{ trans('file.knowmore')}}</a></p>
            </div>
            </div>
           <?php } } ?>
        </div>
    </div>
</section>
<!-- End popular courses -->

<script src="{{ url('/public/admin_assets/developer_validate/jquery.validate.min.js')}}"></script>
<script src="{{ url('/public/admin_assets/developer_validate/custom_validate.js')}}"></script>
<script type="text/javascript">
    $('#signup_form').validate({
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
            $('#submit_register').prop("disabled", true);

            $('#loader_div_element').css('display','block');

            var recaptcha_val = jQuery("#hidden-grecaptcha").val();

            if (recaptcha_val != '') {

                $('#msg_show').css('display','none');

                $.ajax({

                    type : "POST",
                    url:'{{url("/captcha-verify")}}',
                    data : { recaptcha_val:recaptcha_val, "_token" : '<?php echo csrf_token() ?>' },
                    success:function (data)
                    {                        
                        $('#loader_div_element').css('display','none');

                        if (data == 'success') {

                            alert(data);

                            $( "#signup_form" ).submit();

                        }else{

                            $('#submit_register').prop("disabled", false);
                            $('#msg_show').css('display','block');
                            $('#msg_show').html('<div class="alert alert-danger">'+ data +'</div>');    
                            setTimeout(function() {

                               $('#msg_show').fadeOut('fast');

                               // location.reload();

                            }, 7000); // <-- time in milliseconds
                        }

                        
                    }
                });

            }else{


                $('#msg_show').css('display','block');

                // if( app()->getlocale()=='hn' )
                // {

                //     var msg = "कुछ गलत हो गया। कृपया पुन: प्रयास करें।";

                // }else{

                // } 

                var msg = "Please verify captcha.";

                $('#msg_show').html('<div class="alert alert-danger">'+ msg +'</div>'); 

                $('#loader_div_element').css('display','none');
                $('#submit_register').prop("disabled", false);

                return;
            } 


        }
    });

    function recaptchaCallback() {
        
        var response = grecaptcha.getResponse(),
        
        $button = jQuery(".button-register");
        
        jQuery("#hidden-grecaptcha").val(response);
        
        console.log(jQuery("#signup_form").valid());
        
    }

    function recaptchaExpired() {
      
        var $button = $("#submit_register");
       
        jQuery("#hidden-grecaptcha").val("");
        
        var $button = jQuery(".button-register");
        
    }

   
</script>
@endsection
