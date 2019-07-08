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

                    <h3 class="title wow slideInLeft">{{ trans('file.otp_verificatio_page_heading') }}</h3>
                    <p class="wow slideInRight">{!!@$signup_description_txt!!}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End banner courses -->


<!-- Start nomination form section -->
<section class="nom-form-sec remove-height remove-pad-sp">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="nomination-upper otp-wrapper wow slideInUp ">
                  <div class="">
                    <div class="form-nomination">
                        @if(Session::has('success_otp_send'))
                            <div class="alert alert-success">{{Session::get('success_otp_send')}}</div>
                        @endif
                        @if(Session::has('error_otp_send'))
                            <div class="alert alert-danger">{{Session::get('error_otp_send')}}</div>
                        @endif
                        <form method="post" name="otp-form" id="otp-form" action="javascript:void(0)" >                        
                        <div class="row">
                            <div class="col-md-12">
                               <h4 class="subTitle text-center font-size-30">
                               {{ trans('file.fill_your_otp') }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group opt-width">
                                    <label>{{ trans('file.enter_new_otp') }}<span class="maditory_star">*</span></label>
                                    <div class="divOuter">
                                        <div class="divInner"> <!-- {{ trans('file.enter_new_otp_placeholder') }} -->
                                            <input type="text" class="form-control" name="otp" value=""  id="otp" placeholder="0000"  data-rule-required="true" data-msg-required="{{ trans('file.enter_new_otp_error') }}" data-msg-minlength="{{ trans('file.otp_minimum_number') }}" minlength="4" maxlength="4" onkeypress="return isNumberKey(event);"/>
                                        </div>
                                    </div>
                                        <span class="error_validation" role="alert">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                </div>
                            </div>
                            
                        </div>

                        <input type="hidden" id="session_user" value="{{ app('request')->input('veri_code') }}">                        
                        
                        <div class="row otp_messge_parent">
                           <div class="text-center otp_messge_parent_img">
                                <img src="{{url('public/front_assets/ajax-loader.gif')}}" class="nom_popup_loader">
                                
                            </div>
                        </div>

                        <div class="row otp_messge_parent">
                           <div class="text-center otp_message_div">
                                <span  class="nom_pop_loader_msg_otp">@if(Lang::locale()=='en')Please wait while we are validating OTP...@else कृपया प्रतीक्षा करें, जब हम ओ.टी.पी. की जाँच कर रहे हैं ... @endif</span>
                            </div>
                        </div>

                        <div class="row resend_otp_messge_parent">
                           <div class="text-center otp_messge_parent_img">
                                <img src="{{url('public/front_assets/ajax-loader.gif')}}" class="nom_popup_loader">
                                
                            </div>
                        </div>

                        <div class="row resend_otp_messge_parent">
                           <div class="text-center otp_message_div">
                                <span  class="nom_pop_loader_msg_resendotp">@if(Lang::locale()=='en')Please wait while we are Re sending OTP...@else कृपया प्रतीक्षा करें जब तक हम पुनः ओ.टी.पी. भेज रहे हैं ... @endif</span>
                            </div>
                        </div>
                        <div class="row">
                           <div class="timer-wrapper"><span id="timer"></span></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 text-center btn-gap">
                              <button type="submit" name="submit" id="submit_otp" class="common-btn btn-arrwo button-register">{{ trans('file.reg_btn') }}<img src="front_assets/img/icon_right.png" alt="right-arrow"></button>

                              <button type="button" name="submit" id="resend_otp" class="common-btn btn-arrwo button-register">{{ trans('file.resend_otp') }}<img src="front_assets/img/icon_right.png" alt="right-arrow"></button>


                            </div>
                        </div>

                        <hr>
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
                     if(app()->getlocale()=='hn'){
                                
                                $faculty_name_txt=$all_faculty_value->faculty_name_hn;

                            }
                            else
                            {
                                $faculty_name_txt=$all_faculty_value->faculty_name_en;
                            }
             ?>

            <div class="col-md-4 ">
                <a href="{{ url('faculty-detail/'.base64_encode($all_faculty_value->faculty_id)) }}">
                <div class="border-box wow slideInUp">
                    <img  class="image-radius-faculty" src="{{ url('/public/uploads/admin/faculty/'.$all_faculty_value->faculty_profile_img)}}" alt="Sharma">
                    <h3 class="subTitle ">{{@$faculty_name_txt}}</h3>
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
<section class="section all-courses-sec">
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

    <div class="container">
    <h2 class="title1 m-bottom-30 wow slideInLeft text-center">{{@$signup_main_heading_txt}}</h2>
    <p class="common-text m-bottom-30 wow slideInRight text-center">{!!@$signup_course_txt!!}</p>
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
            <p class="recent-news-img"><img src="{{ url('/public/uploads/admin/course/'.$course_value->course_img)}}" alt="Course image"></p>
            <div class="inner-news">
                <h3>{{@$course_name}}</h3>
                <div class="dropdown date-dropdown">
                  <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="front_assets/img/icon_calender1.png" alt="Calender"> {{ trans('file.select_date')}} <i class="fas fa-sort-down arrow-down"></i></a>
                  
                    <ul class="dropdown-menu">
                        <?php $current_date = date('Y-m-d');  ?>

                      @foreach($course_value->deliveryInfo as $valuetext)      

                      

                      <li><a href="{{url('course-detail')}}/{{ base64_encode($course_value->course_id) }}/{{ base64_encode($valuetext->delivery_id) }}">{{date('d M Y',strtotime($valuetext['delivery_start_date']))}} - {{date('d M Y',strtotime($valuetext['delivery_end_date']))}}</a></li>    

                  

                       @endforeach 
                    </ul>
                  </a>
                </div>
                {{-- <ul>
                    <li><img src="front_assets/img/icon_calender.png" alt="calender">{{date('d M Y',strtotime(@$course_value->delivery_start_date))}} - {{date('d M Y',strtotime(@$course_value->delivery_end_date))}}</li>
                    <li><img src="front_assets/img/icon_clock.png" alt="clock"> {{date('H:i a',strtotime($course_value->delivery_start_date))}} - {{date('H:i a',strtotime($course_value->delivery_end_date))}}</li>
                </ul> --}}
        

                 <p>{!!strip_tags(substr(@$courses_desc,0,250))!!}</p>

                <p class="text-center"><a href="{{url('course-detail')}}/{{ base64_encode($course_value->course_id) }}" class="common-btn">{{ trans('file.knowmore')}} </a></p>
            </div>
            </div>
           <?php } } ?>
        </div>
    </div>
</section>
<!-- End popular courses -->

<script src="{{ url('/public/admin_assets/developer_validate/jquery.validate.min.js')}}"></script>
<script src="{{ url('/public/admin_assets/developer_validate/custom_validate.js')}}"></script>
 
<!-- for country code e -->
<!-- OTP Timer start -->
<script>
    let timerOn = true;

function timer(remaining) {
  var m = Math.floor(remaining / 60);
  var s = remaining % 60;
  
  m = m < 10 ? '0' + m : m;
  s = s < 10 ? '0' + s : s;
  document.getElementById('timer').innerHTML = m + ':' + s;
  remaining -= 1;
  
  if(remaining >= 0 && timerOn) {
    setTimeout(function() {
        timer(remaining);
    }, 1000);
    return;
  }

  if(!timerOn) {
    // Do validate stuff here
    return;
  }
  
  // Do timeout stuff here
  $("#resend_otp").show();
}

timer(30);
</script>
<!-- OTP Timer end -->
<script>
    function hideSms(){
        $(".alert.alert-danger").fadeOut(300);
    }
    setTimeout(hideSms,3000);
</script>
<script type="text/javascript">

    $('#otp-form').validate({
        onfocusout: function(element) {
        this.element(element);
        },
        errorClass: 'error_validation',
        errorElement:'span',
        highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);

        },
        submitHandler:function(form){
            
            var otp = $('#otp').val();
            var session_user = $('#session_user').val();
            var token = $('#token').val();
            $('#submit_otp').css('display','none');
            $('.resend_otp_messge_parent').css('display','none');
            $('.otp_messge_parent').css('display','block');
            if(otp != ''){
                $.ajax({
                    dataType:'JSON',
                    type: 'GET',
                    url: "{{ url('verify-registration-otp') }}", 
                    data: {entered_otp: otp,session_otp:session_user},
                    success: function(data){
                        
                        $('.otp_messge_parent_img').css('display','none');
                        
                        if(data.status == 1){

                            $('.nom_pop_loader_msg_otp').html(data.message)
                            $('.nom_pop_loader_msg_otp').css('color','green');
                            $('#resend_otp').css('display','none');

                            setTimeout(function(){ window.location.replace("{{url('/unverified-email')}}/?session_key="+session_user); }, 3000);
                            
                        } else {

                            $('.nom_pop_loader_msg_otp').html(data.message)
                            $('.nom_pop_loader_msg_otp').css('color','red');
                            $('#submit_otp').css('display','inline-block');
                        }

                    }
                      
                });
             }

        }
    });


$count=1;
function send_otp()
{
    var mobile_no=$('#mobile_no').val();
    $.ajax({
        dataType: "json",
        type: 'GET',
        url: '{{ url('send_registration_otp') }}',
        data: {mobile_no: mobile_no},
        success: function(data){
            console.log(data);
            var locale='{{ app()->getlocale() }}';
            if (data =='success') {
                $('.otp_info').css('display','block');
                if ($count>1) {
                    
                        if(locale=='hn')
                        {
                            var otp_msg = "हमने आपके दिए गए नंबर पर सफलतापूर्वक ओपीटी भेज दिया है।";
                        
                        } else{
                            
                            var otp_msg = "We have sent OPT to your given number successfuly.";
                        }
                    $('.otp_info').html(otp_msg);
                
                }
            
            } else {
                if(locale=='hn')
                {
                    var otp_msg = "कुछ गलत हो गया!";
                } else{
                    var otp_msg = "Something went wrong!";
                }
                $('.otp_info').html();
            }
            $count++;
        }
    });
}

function submit_otp()
{
    // alert("test");
     // $('#signup-form').submit();
    var sms_otp=$('#sms_otp').val();
    var mobile_no=$('#mobile_no').val();
    $.ajax({
        dataType: "json",
        type: 'GET',
        url: '{{ url('verify_registration_otp') }}',
        data: {mobile_no:mobile_no,mobile_otp: sms_otp},
        success: function(data){
            console.log(data);
            var locale='{{ app()->getlocale() }}';
            if (data =='success') {
                $('.otp_info').html('');
                jQuery('#myModal-confirm').modal('hide');
                $('.otp_verified').val('verified');
                console.log("submit");
                $('#submit_register').attr('disabled',false);
                $('#submit_register').submit();
                if(locale=='hn')
                {
                    var otp_msg = "OTP सफलतापूर्वक सत्यापित किया गया। अब फॉर्म सबमिट करें।";
                } else{
                    var otp_msg = "OTP verified successfully now submit form.";
                }

                $('#otp_msg').css('display','block');
                $('#otp_msg').html('<div class="alert alert-success">'+ otp_msg +'</div>');
                 
            } else {
                $('.otp_verified').val('pending');
                $('.otp_info').html('invalid OTP!');
            }
        }
    });
}

$('#resend_otp').on('click',function(){

    var session_user = $('#session_user').val();
    $('#resend_otp').css('display','none');
    $('.resend_otp_messge_parent').css('display','block');
    $('.otp_messge_parent').css('display','none');
    
    $.ajax({
            dataType:'JSON',
            type: 'GET',
            url: "{{ url('resend-otp') }}", 
            data: {session_otp:session_user},
            success: function(data){
                
                $('.otp_messge_parent_img').css('display','none');
                
                if(data.status == 1){

                    $('.nom_pop_loader_msg_resendotp').html(data.message)
                    $('.nom_pop_loader_msg_resendotp').css('color','green');
                    $('#resend_otp').css('display','inline-block');

                } else {

                    $('.nom_pop_loader_msg_resendotp').html(data.message)
                    $('.nom_pop_loader_msg_resendotp').css('color','red');
                }

            }
              
        });

});
</script>

@endsection
