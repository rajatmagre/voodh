<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Mail;
use URL;
use Helper;
use Config;

/**___ Use Model ___**/ 
  use App\Model\Instruction;
  use App\Model\BloodRequirement;
  use App\Model\AccidentTrack;
  use App\Model\AccidentReason;
  use App\Model\BloodCamp;
  use App\Model\UserRewards;
  use App\Model\BloodBank;
  use App\Model\User;
/**___ Use Model ___**/ 

DB::enableQueryLog();
class ApiController extends Controller
{ 
    
    /**___ translate englist to hindi ___**/ 
      public function get_hindi_text($language_type, $get_english_text){ 

        $apiKey = 'AIzaSyDKvMz3VIGboqJZAIUyIJomdfIQFN83wwE'; // live key
               
        $text = $get_english_text;
        if ($language_type == 'Hindi') {

          $lang_type = 'hi';

        }elseif ($language_type == 'Panjabi') {
          
          $lang_type = 'pa';

        }elseif ($language_type == 'Urdu') {
          
          $lang_type = 'ur';
        }elseif ($language_type == 'Assamese') {
          
          $lang_type = 'as';
        }elseif ($language_type == 'Bengali') {
          
          $lang_type = 'bn';
        }elseif ($language_type == 'Bhojpuri') {
          
          $lang_type = 'bh';
        }elseif ($language_type == 'Gujarati') {
          
          $lang_type = 'gu';
        }elseif ($language_type == 'Kannada') {
          
          $lang_type = 'kn';
        }elseif ($language_type == 'Malayalam') {
          
          $lang_type = 'ml';
        }elseif ($language_type == 'Marathi') {
          
          $lang_type = 'mr';
        }elseif ($language_type == 'Odia') {
          
          $lang_type = 'or';
        }elseif ($language_type == 'Telugu') {
          
          $lang_type = 'tel';
        }elseif ($language_type == 'Chinese') {
          
          $lang_type = 'zh';
        }elseif ($language_type == 'Israeli') {
          
          $lang_type = 'ar';
        }elseif ($language_type == 'German') {
          
          $lang_type = 'de';
        }elseif ($language_type == 'French') {
          
          $lang_type = 'fr';
        }elseif ($language_type == 'Russian') {
          
          $lang_type = 'ru';
        }elseif ($language_type == 'Japanese') {
          
          $lang_type = 'ja';
        }elseif ($language_type == 'Korean') {
          
          $lang_type = 'ko';
        }elseif ($language_type == 'Arabic') {
          
          $lang_type = 'ar';
        }elseif ($language_type == 'Nepali') {
          
          $lang_type = 'ne';
        }elseif ($language_type == 'Sri Lankan') {
          
          $lang_type = 'ar';
        }elseif ($language_type == 'Tibetan') {
          
          $lang_type = 'bo';
        }else{

          $lang_type = 'en';
        }
        
        $url = 'https://www.googleapis.com/language/translate/v2?key=' . $apiKey . '&q=' . rawurlencode($text) . '&source=en&target='.$lang_type;

        $handle = curl_init($url);
        
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($handle);                 
        
        $responseDecoded = json_decode($response, true);
        
        curl_close($handle);
        // return $text;

        return $responseDecoded['data']['translations'][0]['translatedText'];

      }
    /**___End translate englist to hindi ___**/ 

    public function new_registration(Request $request)
    {
        if ($request->isMethod('post')) {

            $device_token = $request->device_token;
            $device_type = $request->device_type;
            
            // $otp = rand(1000,9999);
            $otp = 1234;

            $lang_type        = $request->language_type;

            if (empty($lang_type)) {
              return response()->json(['msg' => 'Please add language type.', 'status' => 0]);
            }

            if(empty($device_token)){

              if ($lang_type == 'English') {

                $device_token_msg = "Device token can not be null / blank.";
                
              }else{

                $device_token_msg = $this->get_hindi_text($lang_type, "Device token can not be null / blank.");
                
              }
              return response()->json(['msg' => $device_token_msg,'status' => 0]);
            }

            if(empty($device_type)){

              if ($lang_type == 'English') {

                $device_type_msg = "Device type can not be null / blank.";
                
              }else{

                $device_type_msg = $this->get_hindi_text($lang_type, "Device type can not be null / blank.");
                
              }
              return response()->json(['msg' => $device_type_msg,'status' => 0]);
            }

            if(empty($request->phone_no)){

              if ($lang_type == 'English') {

                $phone_msg = "Mobile can not be null / blank.";
                
              }else{

                $phone_msg = $this->get_hindi_text($lang_type, "Mobile can not be null / blank.");
                
              }
              return response()->json(['msg' => $phone_msg,'status' => 0]);
            }
            if(empty($request->email)){
              if ($lang_type == 'English') {

                $email_msg = "Email can not be null / blank.";
                
              }else{

                $email_msg = $this->get_hindi_text($lang_type, "Email can not be null / blank.");
                
              }
                return response()->json(['msg' => $email_msg,'status' => 0]);
            }
            
            $checkMobile  = DB::table('tbl_user_registration')->where(['phone_no' => $request->phone_no])->first();
            if(!empty($checkMobile)){
              if ($lang_type == 'English') {

                $phone_exist_msg = "Mobile number already exists.";
                
              }else{

                $phone_exist_msg = $this->get_hindi_text($lang_type, "Mobile number already exists.");
                
              }
              return response()->json(['msg' => $phone_exist_msg,'status' => 0]);
            }

            $checkEmail  = DB::table('tbl_user_registration')->where(['email' => $request->email])->first();
            if(!empty($checkEmail)){

              if ($lang_type == 'English') {

                $email_exist_msg = "Email already exists.";
                
              }else{

                $email_exist_msg = $this->get_hindi_text($lang_type, "Email already exists.");
                
              }
              return response()->json(['msg' => $email_exist_msg, 'status' => 0]);
            }

            $newData =  array(
                          'phone_no'    => $request->phone_no,
                          'otp'         => $otp,
                          'first_name'  => $request->first_name,
                          'last_name'   => $request->last_name,
                          'email'       => $request->email,
                          'password'    => 4,
                          'language'    => @$lang_type,
                          'user_image'  =>'',//$user_image,
                          'device_token'=> $device_token,
                          'device_type' => $device_type,
                          'permanent_address' =>@$request->permanent_address,
                          'current_address'   =>@$request->current_address,
                          'state_id'    =>@$request->state,
                          'city_id'     =>@$request->city,
                          
                        );

            $id = DB::table('tbl_user_registration')->insertGetId($newData);
            if(!empty($id))
            {
                $where           = array('user_id' => $id);
                $res  = DB::table('tbl_user_registration')->where($where)->first();

                $state_data  = DB::table('tbl_state_master')->where(['id' => $res->state_id])->first();
                $city_data   = DB::table('tbl_city_master')->where(['city_id' => $res->city_id])->first();

                if(!empty($res)) {

                  if (!empty($res->user_image)) {
                    
                    $Img = url('/').'/public/uploads/user/'.$res->user_image;

                  }else{
                    $Img = '';
                  }

                  if ($lang_type == 'English') {

                    $first_name         = $res->first_name;
                    $last_name          = $res->last_name;
                    $permanent_address  = $res->permanent_address;
                    $current_address    = $res->current_address;
                    $state_name         = $state_data->state_name ?? '';
                    $city_name          = $city_data->city_name ?? '';
                    $verified_otp       = $res->verified_otp ?? '';
                    $msg                = "Successfully registered.";
                    
                  }else{

                    $first_name         = $this->get_hindi_text($lang_type, $res->first_name);
                    $last_name          = $this->get_hindi_text($lang_type, $res->last_name);
                    $permanent_address  = $this->get_hindi_text($lang_type, $res->permanent_address);
                    $current_address    = $this->get_hindi_text($lang_type, $res->current_address);
                    $state_name         = $this->get_hindi_text($lang_type, $state_data->state_name?? '');
                    $city_name          = $this->get_hindi_text($lang_type, $city_data->city_name ?? '');
                    $verified_otp       = $this->get_hindi_text($lang_type, $res->verified_otp ?? '');

                    $msg                = $this->get_hindi_text($lang_type, "Successfully registered");
                    
                  }

                  $qTres  = DB::table('tbl_que_ans')->where(['user_id' => $id])->first();
                  if(!empty($qTres)){
                    $question_status = '1';
                  }else{
                    $question_status = '0';
                  }
                  if(!empty($res->user_type)){
                    $user_type_status = '1';
                  }else{
                    $user_type_status = '0';
                  }

                  /**___ get total user unit ___**/ 
                  $total_credit_unit = BloodBank::where(['user_id'=>$request->user_id,'donation_type'=>'credit','status'=>'approved'])->sum('blood_unit');
                  $total_debit_unit   = BloodBank::where(['user_id'=>$request->user_id,'donation_type'=>'debit','status'=>'approved'])->sum('blood_unit');
                  $total_unit = $total_credit_unit-$total_debit_unit;
                  if ($total_unit > 0) {
                    $user_total_unit = $total_unit;
                  }else{
                    $user_total_unit = 0;
                  }

                  $UserData = array(
                                'phone_no'         => isset($res->phone_no)?$res->phone_no:'',
                                'user_type'        => isset($res->user_type)?$res->user_type:'',
                                'first_name'       => $first_name ?? '',
                                'last_name'        => $last_name ?? '',
                                'email'            => isset($res->email)?$res->email:'',
                                'language'         => isset($res->language)?$res->language:'',
                                'user_image'       => $Img,
                                'permanent_address'=> $permanent_address ?? '',
                                'current_address'  => $current_address ?? '',
                                'user_type_status' => $user_type_status,
                                'question_status'  => $question_status,
                                'user_id'          => isset($res->user_id)?$res->user_id:'',
                                'state'            => $state_name ?? '',
                                'city'             => $city_name ?? '',
                                'aadhar_no'        => $res->aadhar_no ?? '',
                                'total_unit'       => $user_total_unit ?? '0',
                                'current_distance' => $res->current_distance ?? '0',
                                'blood_current_distance' => $res->blood_current_distance ?? 0,
                                'blood_group'      => $res->blood_group ?? '',
                                'verified_otp'      => $verified_otp ?? '',
                              );
                  return response()->json([ 'result' => $UserData,'status' => 1,"msg"=>$msg ]);
                } else {

                  if ($lang_type == 'English') {

                    $not_reg_msg = "Data can not be inserted. Please try again.";
                    
                  }else{

                    $not_reg_msg = $this->get_hindi_text($lang_type, "Data can not be inserted. Please try again.");
                    
                  }
                  return response()->json(['msg' => $not_reg_msg, 'status' => 0]);
                }
            } else {

              if ($lang_type == 'English') {

                $wrong_msg = "Something went wrong. Please try again.";
                
              }else{

                $wrong_msg = $this->get_hindi_text($lang_type, "Something went wrong. Please try again.");
                
              }
              return response()->json(['msg' => $wrong_msg,'status' => 0]);
            }
        }
    }
  /*****************Verify opt api*****************/
    public function veryfyOtp(Request $request) {
      if ($request->isMethod('post')) {
        
        $phone_no = $request->phone_no;
        $otp      = $request->otp; 
        $lang_type= $request->language_type; 
        $user_come_from = $request->user_come_from; //user come from (Big Brother & Normal)
        $device_token   = $request->device_token;
        $device_type    = $request->device_type;

        if (empty($lang_type)) {
          return response()->json(['msg' => "Please select language type.", 'status' => 0]);
        }else{

          if(empty($phone_no)){

            if ($lang_type == 'English') {

              $mobile_msg = "Phone number can not be null / blank.";
            }else{

              $mobile_msg = $this->get_hindi_text($lang_type,"Phone number can not be null / blank.");
            }
            return response()->json(['msg' => $mobile_msg, 'status' => 0]);
          } 
          if(empty($otp)){

            if ($lang_type == 'English') {

              $otp_msg = "OTP can not be null / blank.";
            }else{

              $otp_msg = $this->get_hindi_text($lang_type,"OTP can not be null / blank.");
            }
            return response()->json(['msg' => $otp_msg,'status' => 0]);
          }  

          $where = array('phone_no' => $phone_no, 'otp' => $otp, 'deleted'=>'0');
          $res   = DB::table('tbl_user_registration')->where($where)->first();

          /************update opt***********/
          if(!empty($res)) {

              $arr = array('device_token' => $device_token, 'device_type' => $device_type, 'verified_otp' => 'yes', 'last_login'=>date('Y-m-d H:i:s'));
              User::where('phone_no', $phone_no)->update($arr);

              $Img = url('/').'/public/uploads/user/'.$res->user_image;

              $state_data  = DB::table('tbl_state_master')->where(['id' => $res->state_id])->first();
              $city_data   = DB::table('tbl_city_master')->where(['city_id' => $res->city_id])->first();


              if ($lang_type == 'English') {

                $first_name        = isset($res->first_name)?$res->first_name:'';
                $last_name         = isset($res->last_name)?$res->last_name:'';
                $permanent_address = isset($res->permanent_address)?$res->permanent_address:'';
                $current_address   = isset($res->current_address)?$res->current_address:'';
                $verified_otp       = $res->verified_otp ?? '';


                $state_name         = $state_data->state_name ?? '';
                $city_name          = $city_data->city_name ?? '';
              }else{

                $first_name = $this->get_hindi_text($lang_type,$res->first_name);
                $last_name  = $this->get_hindi_text($lang_type,$res->last_name);
                $permanent_address  = $this->get_hindi_text($lang_type,$res->permanent_address);
                $current_address    = $this->get_hindi_text($lang_type,$res->current_address);

                $state_name         = $this->get_hindi_text($lang_type, $state_data->state_name?? '');
                $city_name          = $this->get_hindi_text($lang_type, $city_data->city_name ?? '');
                $verified_otp       = $this->get_hindi_text($lang_type, $res->verified_otp ?? '');
              }

              $qTres  = DB::table('tbl_que_ans')->where(['user_id' => $res->user_id])->first();
              if(!empty($qTres)){
                $question_status = '1';
              }else{
                $question_status = '0';
              }
              if(!empty($res->user_type)){
                $user_type_status = '1';
              }else{
                $user_type_status = '0';
              }

              /**___ get total user unit ___**/ 
              $total_credit_unit = BloodBank::where(['user_id'=>$request->user_id,'donation_type'=>'credit','status'=>'approved'])->sum('blood_unit');
              $total_debit_unit   = BloodBank::where(['user_id'=>$request->user_id,'donation_type'=>'debit','status'=>'approved'])->sum('blood_unit');
              $total_unit = $total_credit_unit-$total_debit_unit;
              if ($total_unit > 0) {
                $user_total_unit = $total_unit;
              }else{
                $user_total_unit = 0;
              }

              $UserData = array(
                            'phone_no'         => isset($res->phone_no)?$res->phone_no:'',
                            'user_type'        => isset($res->user_type)?$res->user_type:'',
                            'first_name'       => $first_name ?? '',
                            'last_name'        => $last_name ?? '',
                            'email'            => isset($res->email)?$res->email:'',
                            'language'         => isset($res->language)?$res->language:'',
                            'user_image'       => $Img,
                            'permanent_address'=> $permanent_address ?? '',
                            'current_address'  => $current_address ?? '',
                            'user_type_status' => $user_type_status,
                            'question_status'  => $question_status,
                            'user_id'          => isset($res->user_id)?$res->user_id:'',
                            'state'            => $state_name ?? '',
                            'city'             => $city_name ?? '',
                            'aadhar_no'        => $res->aadhar_no ?? '',
                            'total_unit'       => $user_total_unit ?? '',
                            'current_distance' => $res->current_distance ?? '',
                            'blood_current_distance' => $res->blood_current_distance ?? 0,
                            'blood_group'      => $res->blood_group ?? '',
                            'verified_otp'      => $verified_otp ?? '',
                          );

              
              if ($lang_type == 'English') {

                if ($user_come_from == 'normal') {
                  $success_msg = "Login successfully.";
                }else{

                  $success_msg = "OTP verify from Big Brother.";
                }

              }else{
                if ($user_come_from == 'normal') {
                  $msg = "Login successfully.";
                }else{

                  $msg = "OTP verify from Big Brother.";
                }
                $success_msg = $this->get_hindi_text($lang_type, $msg);
              }

             return response()->json(['result' => $UserData,'msg' => $success_msg,'status' => 1]);
          } else {
            if ($lang_type == 'English') {

              $otp_msg = "Enter valid OTP.";
            }else{

              $otp_msg = $this->get_hindi_text($lang_type,"Enter valid OTP.");
            }
            return response()->json(['msg' => $otp_msg,'status' => 0]);
          }
          /***********response***********/
        }
      } 
    }
  /*****************Resend opt api*****************/
    public function reSendOtp(Request $request) {
        if ($request->isMethod('post')) {
          
          // $otp = rand(1000,9999);
          $otp = 1234;
          /************update opt***********/
                DB::table('tbl_user_registration')
                    ->where('phone_no', $request->phone_no)
                    ->update(['otp' => $otp]);

            /***********response***********/
            return response()->json(['otp'=>$otp]);
        } // End check method
    }

    /*****************Forget Password api*****************/
    public function forget_password(Request $request) {
        if ($request->isMethod('post')) {
          $email = $request->email;
          if(empty($email)){
              return response()->json(['msg' => 'Email can not be null.','status' => 0]);
          }
          $where = array('email' => $request->email,'deleted'=>'0','status'=>'active');
          $res  = DB::table('tbl_user_registration')->where($where)->first();
          if(!empty($res)){
              $newpass = rand(100000,999999);
              DB::table('tbl_user_registration')
                    ->where('email', $request->email)
                    ->update(['password' => md5($newpass)]);

              Mail::raw('Hi your new password is: '.$newpass.'', function ($message) use ($email){

                        $message->from('questtestmail@gmail.com', 'People for help');
                        $message->to($email);
                        $message->subject('Forget Password');

              });

              return response()->json(['status' => 1,"msg"=>"New password successfully sent on your mail."]);
          } else {
              return response()->json(['msg' => 'Email not matched with our system.','status' => 0]);
          }

        } // End check method
    }
    /*****************Forget Password api*****************/
    public function change_password(Request $request) {
        if ($request->isMethod('post')) {
          $user_id = $request->user_id;
          $oldpw = $request->oldpw;
          $newpw = $request->newpw;

          $lang_type    = $request->language_type;

          if(empty($oldpw)){

              if ($lang_type == 'English') {
                $oldpw_msg    = "Old password can not be null / blank.";
              }else{
                $oldpw_msg    = $this->get_hindi_text($lang_type, 'Old password can not be null / blank.');
              }

              return response()->json(['msg' => $oldpw_msg, 'status' => 0]);
          }
          if(empty($newpw)){
              if ($lang_type == 'English') {              
                $newpw_msg    = "New password can not be null / blank.";                
              }else{
                $newpw_msg     = $this->get_hindi_text($lang_type, 'New password can not be null / blank.');
              }
              return response()->json(['msg' => $newpw_msg,'status' => 0]);
          }
          $where = array('user_id' => $user_id,'password' => $oldpw,'deleted'=>'0','status'=>'active');

          $res  = DB::table('tbl_user_registration')->where($where)->first();

          if(!empty($res)){
              DB::table('tbl_user_registration')
                    ->where('user_id', $user_id)
                    ->update(['password' => $newpw]);

              if ($lang_type == 'English') {
            
                $new_pass_msg = "New password has been successfully changed.";
                
              }else{

                $new_pass_msg = $this->get_hindi_text($lang_type, 'New password has been successfully changed.');
              }

              return response()->json(['status' => 1,"msg"=> $new_pass_msg]);

          } else {

              if ($lang_type == 'English') {
            
                $not_match = "Old password don't match.";
                
              }else{

                $not_match = $this->get_hindi_text($lang_type, "Old password don't match.");
              }
              return response()->json(['msg' => $not_match, 'status' => 0]);
          }

        } // End check method
    }
    /*****************Update Language api*****************/
    public function update_language(Request $request) {
      if ($request->isMethod('post')) {
        $user_id = $request->user_id;
        $lauguage_name = $request->lauguage_name;
        if(empty($user_id)){
            return response()->json(['msg' => 'User Id can not be null.','status' => 0]);
        }
        if(empty($lauguage_name)){
            return response()->json(['msg' => 'Language can not be null.','status' => 0]);
        }
        $where = array('user_id' => $user_id,'deleted'=>'0','status'=>'active');

        $res  = DB::table('tbl_user_registration')->where($where)->first();

        if(!empty($res)){
            DB::table('tbl_user_registration')
                  ->where('user_id', $user_id)
                  ->update(['language' =>$lauguage_name]);


            return response()->json(['status' => 1,"msg"=>"Language updated successfully changed."]);
        } else {
            return response()->json(['msg' => 'Something went worng.','status' => 0]);
        }

      } // End check method
    }
    /*****************Login api*****************/
    public function login(Request $request) {
      if ($request->isMethod('post')) {
        
        $device_token   = $request->device_token;
        $device_type    = $request->device_type;
        $user_name1     = $request->user_name;
        $user_name2     = $request->user_name;
        $password       = $request->password;        
        
        if(empty($device_token)){
            return response()->json(['msg' => 'Device Token can not be null.','status' => 0]);
        }
        if(empty($request->user_name)){
            return response()->json(['msg' => 'Username can not be null.','status' => 0]);
        }
        if(empty($password)){
            return response()->json(['msg' => 'Password can not be null.','status' => 0]);
        }

        $where      = array('password' => $password,'deleted'=>'0','status'=>'active');

        $res  = DB::table('tbl_user_registration')
                            ->Where($where)
                            ->where(function($q) use($user_name1,$user_name2) {
                                $q->where('email', $user_name1)
                                 ->orWhere('phone_no', $user_name2);
                            })
                            ->first();

        /************update opt***********/
          if(!empty($res)) {
            
            if ($res->verified_otp == 'yes') {
              // $otp = rand(1000,9999);'verified_otp' => 'yes',
              // $email = $res->email;
              // DB::table('tbl_user_registration')
              //     ->where('user_id', $res->user_id)
              //     ->update(['otp' => $otp]);
              // Mail::raw('Your OTP is: '.$otp.'', function ($message) use ($email){

              //     $message->from('questtestmail@gmail.com', 'People for help');
              //     $message->to($email);
              //     $message->subject('Login OPT');

              // });
              $arr = array('device_token' => $device_token,'device_type' => $device_type,'otp' => NULL,'last_login'=>date('Y-m-d H:i:s'));

              DB::table('tbl_user_registration')->where('phone_no', $res->phone_no)->update($arr);
              $Img = url('/').'/public/uploads/user/'.$res->user_image;

              $state_data  = DB::table('tbl_state_master')->where(['id' => $res->state_id])->first();
              $city_data   = DB::table('tbl_city_master')->where(['city_id' => $res->city_id])->first();

              $qTres  = DB::table('tbl_que_ans')->where(['user_id' => $res->user_id])->first();
              if(!empty($qTres)){
                  $question_status = '1';
              }else{
                  $question_status = '0';
              }
              if(!empty($res->user_type)){
                  $user_type_status = '1';
              }else{
                  $user_type_status = '0';
              }

              /**___ get total user unit ___**/ 
              $total_credit_unit = BloodBank::where(['user_id'=>$request->user_id,'donation_type'=>'credit','status'=>'approved'])->sum('blood_unit');
              $total_debit_unit   = BloodBank::where(['user_id'=>$request->user_id,'donation_type'=>'debit','status'=>'approved'])->sum('blood_unit');
              $total_unit = $total_credit_unit-$total_debit_unit;
              if ($total_unit > 0) {
                $user_total_unit = $total_unit;
              }else{
                $user_total_unit = 0;
              }

              $UserData = array(
                          'phone_no'         => isset($res->phone_no)?$res->phone_no:'',
                          'user_type'        => isset($res->user_type)?$res->user_type:'',
                          'first_name'       => isset($res->first_name)?$res->first_name:'',
                          'last_name'        => isset($res->last_name)?$res->last_name:'',
                          'email'            => isset($res->email)?$res->email:'',
                          'language'         => isset($res->language)?$res->language:'',
                          'user_image'       => $Img,
                          'permanent_address'=> isset($res->permanent_address)?$res->permanent_address:'',
                          'current_address'  => isset($res->current_address)?$res->current_address:'',
                          'user_type_status' => $user_type_status,
                          'question_status'  => $question_status,
                          'user_id'          => isset($res->user_id)?$res->user_id:'',
                          'state'            => $state_data->state_name ?? '',
                          'city'             => $city_data->city_name ?? '',
                          'aadhar_no'        => $res->aadhar_no ?? '',
                          'total_unit'       => $user_total_unit ?? '',
                          'current_distance' => $res->current_distance ?? '',
                          'blood_current_distance' => $res->blood_current_distance ?? 0,
                          'blood_group'      => $res->blood_group ?? '',
                          'verified_otp'      => $res->verified_otp ?? '',
                        );

              return response()->json(['result' => $UserData,'msg' => 'Login Successfully.','status' => 1]);
              // return response()->json(['msg' => 'OTP sent on your Mail.','status' => 1]);
            }else{

              return response()->json(['msg' => 'Your OTP is not verified.','status' => 0]);
            }

          } else {
            return response()->json(['msg' => 'Username or Password is incorrect.','status' => 0]);
          }
          /***********response***********/
      } 
    }
    /*****************LoginVerify opt api*****************/
    public function loginVeryfyOtp(Request $request) {
      if ($request->isMethod('post')) {
        $phone_no = $request->phone_no;
        $otp = $request->otp;    
        if(empty($phone_no)){
            return response()->json(['msg' => 'Mobile can not be null.','status' => 0]);
        } 
        if(empty($otp)){
            return response()->json(['msg' => 'OTP can not be null.','status' => 0]);
        }      
        $where      = array('phone_no' => $phone_no,'otp' => $otp,'deleted'=>'0');
        $res  = DB::table('tbl_user_registration')->where($where)->first();
        // print_r($RegisteredData);die();
        /************update opt***********/
        if(!empty($res)) {

          $arr = array('verified_otp'=>'yes', 'otp' => NULL, 'last_login'=>date('Y-m-d H:i:s'));

          DB::table('tbl_user_registration')->where('phone_no', $phone_no)->update($arr);
          $Img = url('/').'/public/uploads/user/'.$res->user_image;
          $UserData = array(
                      'phone_no'=>isset($res->phone_no)?$res->phone_no:'',
                      'first_name'=>isset($res->first_name)?$res->first_name:'',
                      'last_name'=>isset($res->last_name)?$res->last_name:'',
                      'email'=>isset($res->email)?$res->email:'',
                      'language'=>isset($res->language)?$res->language:'',
                      'user_image'=>$Img,
                      'permanent_address'=>isset($res->permanent_address)?$res->permanent_address:'',
                      'current_address'=>isset($res->current_address)?$res->current_address:''
                    );

          return response()->json(['result' => $UserData,'msg' => 'Login Successfully.','status' => 1]);
        } else {
          return response()->json(['msg' => 'Enter Valid OTP.','status' => 0]);
        }
        /***********response***********/
      } 
    }
    /************************Get profiles*************************/
    public function get_profile(Request $request) {
      if ($request->isMethod('post')) {

        $where  = array('user_id' => $request->user_id);
        $res    = DB::table('tbl_user_registration')->where($where)->first();
        $qTres  = DB::table('tbl_que_ans')->where(['user_id' => $request->user_id])->first();
        if(!empty($qTres)){
            $question_status = '1';
        }else{
            $question_status = '0';
        }
        if(!empty($res->user_type)){
            $user_type_status = '1';
        }else{
            $user_type_status = '0';
        }

        /**___ get total user unit ___**/ 
        $total_credit_unit = BloodBank::where(['user_id'=>$request->user_id,'donation_type'=>'credit','status'=>'approved'])->sum('blood_unit');
        $total_debit_unit   = BloodBank::where(['user_id'=>$request->user_id,'donation_type'=>'debit','status'=>'approved'])->sum('blood_unit');
        $total_unit = $total_credit_unit-$total_debit_unit;
        if ($total_unit > 0) {
          $user_total_unit = $total_unit;
        }else{
          $user_total_unit = 0;
        }
        if(!empty($res)) {

          if (!empty($res->state_id)) {

            $state_data  = DB::table('tbl_state_master')->where(['id' => $res->state_id])->first();
            $state_name  = $state_data->state_name ?? '';
            $state_id    = $res->state_id;
          }else{
            $state_name  = '';
            $state_id    = 0;
          } 

          if (!empty($res->city_id)) {
            $city_data   = DB::table('tbl_city_master')->where(['city_id' => $res->city_id])->first();
            $city_name   = $city_data->city_name ?? '';
            $city_id     = $res->city_id;
          }else{
            $city_name  = '';
            $city_id    = 0;
          }

          $Img = url('/').'/public/uploads/user/'.$res->user_image;
          $UserData = array(
                        'phone_no'         => isset($res->phone_no)?$res->phone_no:'',
                        'user_type'        => isset($res->user_type)?$res->user_type:'',
                        'first_name'       => isset($res->first_name)?$res->first_name:'',
                        'last_name'        => isset($res->last_name)?$res->last_name:'',
                        'email'            => isset($res->email)?$res->email:'',
                        'language'         => isset($res->language)?$res->language:'',
                        'user_image'       => $Img,
                        'permanent_address'=> isset($res->permanent_address)?$res->permanent_address:'',
                        'current_address'  => isset($res->current_address)?$res->current_address:'',
                        'user_type_status' => $user_type_status,
                        'question_status'  => $question_status,
                        'user_id'          => isset($res->user_id)?$res->user_id:'',
                        'state_id'         => $state_id ?? 0,
                        'state_name'       => $state_name ?? '',
                        'city_id'          => $city_id ?? 0,
                        'city_name'        => $city_name ?? '',
                        'aadhar_no'        => $res->aadhar_no ?? '',
                        'total_unit'       => $user_total_unit,
                        'current_distance' => $res->current_distance ?? '',
                        'blood_current_distance' => $res->blood_current_distance ?? 0,
                        'blood_group'      => $res->blood_group ?? '',
                        'verified_otp'     => $res->verified_otp ?? '',
                      );
          return response()->json(['result' => $UserData,'status' => 1]);
        } else {
          return response()->json(['msg' =>"Record Not Found", 'total_unit' => $user_total_unit,'status' => 0]);
        }
      }
    }
    // **************** Update Profile ************//
    public function update_profile(Request $request) {
      if ($request->isMethod('post')) {
        $user_id   = $request->user_id;
        $lang_type = $request->language_type;

        if(empty($user_id)){
          if ($lang_type == 'English') {
            $user_id_msg      = "User Id can not be null/blank.";
          }else{
            $user_id_msg     = $this->get_hindi_text($lang_type, "User Id can not be null / blank.");
          }
          return response()->json(['msg' => $user_id_msg, 'status' => 0]);
        }
        if($request->hasfile('user_image')){
            $user_image = upload_file($request->file('user_image'),'/uploads/user');
            DB::table('tbl_user_registration')
                ->where('user_id', $user_id)
                ->update(array('user_image'=>$user_image));
        }
        
        $newData = array(
                    'first_name'        =>  $request->first_name,
                    'last_name'         =>  $request->last_name,
                    'email'             =>  $request->email,
                    'permanent_address' =>  $request->permanent_address,
                    'current_address'   =>  $request->current_address,
                    'state_id'          =>  @$request->state,
                    'city_id'           =>  @$request->city,
                  );
        DB::table('tbl_user_registration')
          ->where('user_id', $user_id)
          ->update($newData);
        $where = array('user_id' => $request->user_id);
        $res   = DB::table('tbl_user_registration')->where($where)->first();
        if (!empty($res)) {

          if (!empty($res->state_id)) {
            $state_data  = DB::table('tbl_state_master')->where(['id' => $res->state_id])->first();
            if ($lang_type == 'English') {
              $state_name  = $state_data->state_name ?? '';                
            }else{
              $state_name     = $this->get_hindi_text($lang_type, $state_data->state_name ?? '');
            }
          }

          if (!empty($res->city_id)) {
            $city_data   = DB::table('tbl_city_master')->where(['city_id' => $res->city_id])->first();
           
            if ($lang_type == 'English') {
              $city_name  = $city_data->city_name ?? '';                
            }else{
              $city_name     = $this->get_hindi_text($lang_type, $city_data->city_name ?? '');
            }
          }

          if ($lang_type == 'English') {

            $first_name = $res->first_name;
            $last_name  = $res->last_name;
            $permanent_address  = $res->permanent_address;
            $current_address  = $res->current_address;
          }else{

            $first_name = $this->get_hindi_text($lang_type, $res->first_name);
            $last_name = $this->get_hindi_text($lang_type, $res->last_name);
            $permanent_address = $this->get_hindi_text($lang_type, $res->permanent_address);
            $current_address = $this->get_hindi_text($lang_type, $res->current_address);
          }

          
          if (!empty($res->user_image)) {
            $Img = url('/').'/public/uploads/user/'.$res->user_image;
          }else{
            $Img = '';
          }
          $UserData = array(
                        'phone_no'         => isset($res->phone_no)?$res->phone_no:'',
                        'user_type'        => isset($res->user_type)?$res->user_type:'',
                        'first_name'       => isset($res->first_name)?$res->first_name:'',
                        'last_name'        => isset($res->last_name)?$res->last_name:'',
                        'email'            => isset($res->email)?$res->email:'',
                        'language'         => isset($res->language)?$res->language:'',
                        'user_image'       => $Img,
                        'permanent_address'=> isset($res->permanent_address)?$res->permanent_address:'',
                        'current_address'  => isset($res->current_address)?$res->current_address:'',
                        'user_id'          => isset($res->user_id)?$res->user_id:'',
                        'state_id'         => $state_id ?? 0,
                        'state_name'       => $state_name ?? '',
                        'city_id'          => $city_id ?? 0,
                        'city_name'        => $city_name ?? '',
                        'aadhar_no'        => $res->aadhar_no ?? '',
                        'current_distance' => $res->current_distance ?? '',
                        'blood_current_distance' => $res->blood_current_distance ?? 0,
                        'blood_group'      => $res->blood_group ?? '',
                        'verified_otp'     => $res->verified_otp ?? '',
                      );
          

          if ($lang_type == 'English') {

            $success_msg      = "Profile updated successfully.";

          }else{

            $success_msg     = $this->get_hindi_text($lang_type, "Profile updated successfully.");
          }
          return response()->json(['result' => $UserData, 'msg'=>$success_msg, 'status' => 1]);
        }else{
          if ($lang_type == 'English') {

            $not_found_msg      = "Record not found.";

          }else{

            $not_found_msg = $this->get_hindi_text($lang_type, "Record not found.");
          }
          return response()->json(['msg' =>$not_found_msg,'status' => 0]);
        }
      } else {
        return response()->json(['msg' =>"Something went worng.",'status' => 0]);
      }
    }
    /************************Get Question*************************/
    public function get_question(Request $request) {
      if ($request->isMethod('post')) {        
          $user_id = $request->user_id;
          $language_type = $request->language_type;

          $where      = array('status' => 'active','deleted'=>'0');
          $queData  = DB::table('tbl_question')->where($where)->get();

          if(!empty($queData)) {
            $UserData = array();
            foreach ($queData as  $value) {

                if($language_type=='English'){

                    $question = isset($value->question_en)?$value->question_en:'';

                }elseif ($language_type=='Hindi') {

                  $question = isset($value->question_hn)?$value->question_hn:'';

                }else{

                  $question  = $this->get_hindi_text($lang_type, isset($value->question_en)?$value->question_en:'');
                }

                $UserData[] = array(
                            'que_id'=>isset($value->que_id)?$value->que_id:'',
                            'question'=>$question,
                            'que_type'=>isset($value->que_type)?$value->que_type:''
                          );
            }
            
            return response()->json(['questions' => $UserData,'status' => 1]);
          } else {
            if ($language_type == 'English') {

              $record_not_found  = "Record not found.";

            }else{

              $record_not_found = $this->get_hindi_text($lang_type, "Record not found.");
            }
            return response()->json(['msg' => $record_not_found, 'status' => 0]);
          }
      }
    }
    // ********* Submit Question ****************//
    public function submit_question(Request $request) {
      if ($request->isMethod('post')) {

        $user_id   = $request->user_id;
        $lang_type = $request->language_type;

        if ($lang_type == 'English') {

          $user_id_msg      = "User Id can not be null/blank.";
          $success_msg      = "Submited successfully.";
          $something_wrong  = "Something went worng. Please try again.";

        }else{

          $user_id_msg     = $this->get_hindi_text($lang_type, "User Id can not be null / blank.");
          $success_msg     = $this->get_hindi_text($lang_type, "Submited successfully.");
          $something_wrong = $this->get_hindi_text($lang_type, "Something went worng. Please try again.");
        }

        if(empty($user_id)){

          return response()->json(['msg' => $user_id_msg, 'status' => 0]);
        }

        $language_type  = $request->language_type;
        $answer_array   = $request->answer_array;
        $answer_array   = json_decode($request->answer_array, TRUE);
        if($answer_array){
            foreach ($answer_array as $value) {
                $newData = array(
                          'user_id'=>$user_id,
                          'language_type'=>$language_type,
                          'question_id'=>$value['question_id'],
                          'answer'=>$value['answer']
                        );

                DB::table('tbl_que_ans')->insertGetId($newData);
            }
            return response()->json(['msg' =>$success_msg, 'status' => 1]);
        } else {
            return response()->json(['msg' => $something_wrong, 'status' => 0]);
        }
      }
    }
    // **************** Informer helper ************//
    public function helper_informer(Request $request) {
      if ($request->isMethod('post')) {

        $user_id                  = $request->user_id;
        $user_type                = $request->user_type;
        $current_letlong          = $request->current_letlong;

        $lang_type                = $request->language_type;
        
        if(empty($user_id)){

          if ($lang_type == 'English') {
            $user_id_msg        = "User Id can not be null/blank.";
          }else{
            $user_id_msg    = $this->get_hindi_text($lang_type, "User Id can not be null / blank.");
          }

          return response()->json(['msg' => $user_id_msg, 'status' => 0]);
        }
        if(empty($user_type)){

          if ($lang_type == 'English') {

            $user_type_msg      = "User Type can not be null / blank.";

          }else{

            $user_type_msg  = $this->get_hindi_text($lang_type, "User Type can not be null / blank.");
          }

          return response()->json(['msg' => $user_type_msg, 'status' => 0]);
        }
        if(empty($current_letlong)){

            if ($lang_type == 'English') {

              $curr_letlong_msg   = "Current Letlong can not be null / blank.";
              
            }else{

              $curr_letlong_msg=$this->get_hindi_text($lang_type,"Current Letlong can not be null / blank.");
              
            }
            return response()->json(['msg' => $curr_letlong_msg, 'status' => 0]);
        }
        
        if (!empty($current_letlong)) {

          $get_letlong        = explode(',', $current_letlong);
          $current_latitude   = $get_letlong[0];
          $current_longitude  = $get_letlong[1];
        }

        $newData = array(
                    'user_type'=>$user_type,
                    'permanent_address' =>$request->permanent_address,
                    'current_address'   =>$request->current_address,
                    'current_letlong'   =>$current_letlong,
                    'current_latitude'  =>@$current_latitude,
                    'current_longitude' =>@$current_longitude,
                    'current_distance'  =>$request->current_distance,
                    'help_time_start'   =>$request->help_time_start,
                    'help_time_end'     =>$request->help_time_end
                  );
        DB::table('tbl_user_registration')
                  ->where('user_id', $user_id)
                  ->update($newData);
        $where     = array('user_id' => $user_id);
        $UserInfo  = DB::table('tbl_user_registration')->where($where)->first();

        $Img = url('/').'/public/uploads/user/'.$UserInfo->user_image;

        $str_user_type = str_replace("_"," ",$UserInfo->user_type);

        if ($lang_type == 'English') {

            $user_type          = $str_user_type;
            $first_name         = $UserInfo->first_name;
            $last_name          = $UserInfo->last_name;
            $permanent_address  = $UserInfo->permanent_address;
            $current_address    = $UserInfo->current_address;

        }else{

          $user_type          = $this->get_hindi_text($lang_type, $str_user_type);
          $first_name         = $this->get_hindi_text($lang_type, $UserInfo->first_name);
          $last_name          = $this->get_hindi_text($lang_type, $UserInfo->last_name);
          $permanent_address  = $this->get_hindi_text($lang_type, $UserInfo->permanent_address);
          $current_address    = $this->get_hindi_text($lang_type, $UserInfo->current_address);
        }

        $UserData = array(
                    'phone_no'    =>  isset($UserInfo->phone_no)?$UserInfo->phone_no:'',
                    'user_type'   =>  $user_type ?? '',
                    'first_name'  =>  $first_name ?? '',
                    'last_name'   =>  isset($UserInfo->last_name)?$UserInfo->last_name:'',
                    'email'       =>  isset($UserInfo->email)?$UserInfo->email:'',
                    'language'    =>  isset($UserInfo->language)?$UserInfo->language:'',
                    'user_image'  =>$Img,
                    'permanent_address'=>isset($UserInfo->permanent_address)?$UserInfo->permanent_address:'',
                    'current_address'  =>isset($UserInfo->current_address)?$UserInfo->current_address:''
                  );

        if ($lang_type == 'English') {
          $success_msg = "Updated successfully.";

        }else{
          $success_msg    = $this->get_hindi_text($lang_type, "Updated successfully.");
        }
        return response()->json(['result' => $UserData,'msg'=> $success_msg, 'status' => 1]);

      } else {
          return response()->json(['msg' =>"Something went worng. Please try again.",'status' => 0]);
      }
    }
    // **************** Informer  ************//
    public function informer(Request $request) {
        if ($request->isMethod('post')) {

            $user_id        = $request->user_id;
            $user_type      = $request->user_type;
            $lang_type      = $request->language_type;

            if ($lang_type == 'English') {

              $user_id_msg = "User Id can not be null / blank.";
              $user_type_msg = "User type can not be null / blank.";
              $success_msg = "Updated successfully.";
              $not_found_msg = "Record not found.";

            }else{

              $user_id_msg    = $this->get_hindi_text($lang_type, "User Id can not be null / blank.");
              $user_type_msg  = $this->get_hindi_text($lang_type, "User type can not be null / blank.");
              $success_msg    = $this->get_hindi_text($lang_type, "Updated successfully.");
              $not_found_msg  = $this->get_hindi_text($lang_type, "Record not found.");
            }

            if(empty($user_id)){
                return response()->json(['msg' => $user_id_msg, 'status' => 0]);
            }

            if(empty($user_type)){
                return response()->json(['msg' => $user_type_msg, 'status' => 0]);
            }

            $newData = array(
                        'user_type'=>$user_type
                      );

            DB::table('tbl_user_registration')
                      ->where('user_id', $user_id)
                      ->update($newData);

            $where      = array('user_id' => $user_id);
            $UserInfo  = DB::table('tbl_user_registration')->where($where)->first();

            if (!empty($UserInfo)) {

              $Img = url('/').'/public/uploads/user/'.$UserInfo->user_image;
              // print_r($UserInfo);
              $str_user_type = str_replace("_"," ",$UserInfo->user_type);

              if ($lang_type == 'English') {
                  
                $user_type          = $str_user_type;
                $first_name         = $UserInfo->first_name;
                $last_name          = $UserInfo->last_name;
                $permanent_address  = $UserInfo->permanent_address;
                $current_address    = $UserInfo->current_address;

              }else{

                $user_type          = $this->get_hindi_text($lang_type, $str_user_type);
                $first_name         = $this->get_hindi_text($lang_type, $UserInfo->first_name);
                $last_name          = $this->get_hindi_text($lang_type, $UserInfo->last_name);
                $permanent_address  = $this->get_hindi_text($lang_type, $UserInfo->permanent_address);
                $current_address    = $this->get_hindi_text($lang_type, $UserInfo->current_address);
              }

              $UserData = array(
                          'phone_no'    =>  isset($UserInfo->phone_no)?$UserInfo->phone_no:'',
                          'user_type'   =>  $user_type ?? '',
                          'first_name'  =>  $first_name ?? '',
                          'last_name'   =>  $last_name ?? '',
                          'email'       =>  isset($UserInfo->email)?$UserInfo->email:'',
                          'language'    =>  isset($UserInfo->language)?$UserInfo->language:'',
                          'user_image'  =>  $Img,
                          'permanent_address' => $permanent_address ?? '',
                          'current_address'   => $current_address ?? '',
                        );
              return response()->json(['result' => $UserData,'msg'=> $success_msg,'status' => 1]);
            
            }else{

              return response()->json(['msg' => $not_found_msg, 'status' => 0]);
            }
            
            
        }else {
            return response()->json(['msg' => 'Something went worng. Please try again.', 'status' => 0]);
        }
    }
    // **************** Accident Submit  ************//
    public function accident_upload(Request $request) {
        if ($request->isMethod('post')) {

            $user_id          = $request->user_id;
            $accident_video   = $request->accident_video;
            $accident_pic     = $request->accident_pic;
            $accident_address = $request->accident_address;
            $accident_letlong = $request->accident_letlong;

            $accident_type    = $request->accident_type;
            $reason_id        = $request->reason_id;
            $other_reason     = $request->other_reason;

            $lang_type        = $request->language_type;
            if (empty($lang_type)) {
              return response()->json(['msg' => 'Please add language type.', 'status' => 0]);
            }

            if(empty($accident_type)){              
                if ($lang_type == 'English') {

                  $accident_type_msg = "Accident type can not be null / blank.";
                }else{

                  $accident_type_msg = $this->get_hindi_text($lang_type, "Accident type can not be null / blank.");
                }
                return response()->json(['msg' => $accident_type_msg, 'status' => 0]);
            }

            if(empty($reason_id)){              
                if ($lang_type == 'English') {

                  $reason_id_msg = "Reason id can not be null / blank.";
                }else{

                  $reason_id_msg = $this->get_hindi_text($lang_type, "Reason id can not be null / blank.");
                }
                return response()->json(['msg' => $reason_id_msg, 'status' => 0]);
            }elseif ($reason_id == 4){
              // reason_id == 4 means Other
              if(empty($other_reason)){              
                if ($lang_type == 'English') {

                  $other_reason_msg = "other reason can not be null / blank.";
                }else{

                  $other_reason_msg = $this->get_hindi_text($lang_type, "other reason can not be null / blank.");
                }
                return response()->json(['msg' => $other_reason_msg, 'status' => 0]);
              }
            }

            if(empty($user_id)){
                if ($lang_type == 'English') {

                  $user_id_msg = "User Id can not be null / blank.";
                }else{

                  $user_id_msg = $this->get_hindi_text($lang_type, "User Id can not be null / blank.");
                }
                return response()->json(['msg' => $user_id_msg, 'status' => 0]);
            }

            if(empty($accident_address)){
              if ($lang_type == 'English') {

                $acc_add_msg = "Accident address can not be null / blank.";
                
              }else{

                $acc_add_msg = $this->get_hindi_text($lang_type, "Accident address can not be null / blank");
                
              }
              return response()->json(['msg' => $acc_add_msg, 'status' => 0]);
            }

            if($request->hasfile('accident_video')){
                $accident_video = upload_file($request->file('accident_video'),'/uploads/accident/videos');
            }
            if($request->hasfile('accident_pic')){
                $accident_pic = upload_file($request->file('accident_pic'),'/uploads/accident/pics');
            }
            $loc = explode(',', $accident_letlong);

            $newData =  array(
                          'user_id'         =>  $user_id,
                          'accident_video'  =>  $accident_video,
                          'accident_pic'    =>  $accident_pic,
                          'accident_address'=>  $accident_address,
                          'accident_type'   =>  $accident_type,
                          'reason_id'       =>  $reason_id,
                          'other_reason'    =>  $other_reason,
                          'accident_letitude' =>  $loc[0],
                          'accident_longitude'=>  $loc[1],
                          'status'            =>  'pending'
                        );

            $id = DB::table('tbl_accident')->insertGetId($newData);
            if($id){
                $where      = array('user_id' => $user_id);
                $resData  = DB::table('tbl_accident')->where($where)->get();
                
                if(!empty($resData)  && count($resData) > 0) {
                    $UserData = array();
                    foreach ($resData as  $value) {

                        if ($lang_type == 'English') {
                
                          $accident_address = $value->accident_address;

                        }else{

                          $accident_address = $this->get_hindi_text($lang_type, $value->accident_address);
                        }


                        $accVideo = url('/').'/public/uploads/accident/videos/'.$value->accident_video;
                        $accImg = url('/').'/public/uploads/accident/pics/'.$value->accident_pic;
                        $UserData[] = array(
                                        'accident_id'=>isset($value->accident_id)?$value->accident_id:'',
                                        'accident_address'=>$accident_address ?? '',
                                        'accident_pic'=>$accImg,
                                        'accident_video'=>$accVideo,
                                        'accident_time'=>isset($value->accident_time)?$value->accident_time:''
                                      );
                    }
                      
                    if ($lang_type == 'English') {
                      $success_msg = "Uploaded successfully.";
                    }else{
                      $success_msg = $this->get_hindi_text($lang_type, "Uploaded successfully.");
                    }
                    return response()->json(['msg' =>$success_msg, 'accident_list' => $UserData,'status' => 1]);

                } else {
                  if ($lang_type == 'English') {

                    $not_found_msg = "Record not found.";

                  }else{

                    $not_found_msg = $this->get_hindi_text($lang_type, "Record not found.");
                  }
                  return response()->json(['msg' => $not_found_msg, 'status' => 0]);
                }
            }else {
              if ($lang_type == 'English') {

                $something_wrong = "Something went worng. Please try again.";

              }else{

                $something_wrong = $this->get_hindi_text($lang_type,"Something went worng. Please try again.");
              }
              return response()->json(['msg' => $something_wrong, 'status' => 0]);
            }
            
        } else {
            return response()->json(['msg' => 'Something went worng. Please try again.', 'status' => 0]);
        }
    }
    // **************** Accident List  ************//
    public function accident_list(Request $request) {

        if ($request->isMethod('post')) {

          $user_id    = $request->user_id;
          $page_type  = $request->page_type;
          $lang_type  = $request->language_type;

          if ($lang_type == 'English') {
              
            $user_id_msg  = "User Id can not be null / blank.";
            $msg          = "Record not found.";
            
          }else{

            $user_id_msg = $this->get_hindi_text($lang_type, "User Id can not be null / blank.");
            $msg         = $this->get_hindi_text($lang_type, "Record not found.");
          
          }

          if(empty($user_id)){

              return response()->json(['msg' => $user_id_msg, 'status' => 0]);
          }

          if(!empty($page_type)){

            $page_data    = Instruction::where(['page_type'=>$page_type,'status'=>'active','deleted'=>'0'])->select('page_content')->first();

            if (!empty($page_data)) {

              if ($lang_type == 'English') {

                $page_content = $page_data->page_content;
                
              }else{

                $page_content = $this->get_hindi_text($lang_type, $page_data->page_content);
              }
            }
          }
          // echo $page_content;die;
          $where      = array('user_id' => $user_id);
          $resData    = DB::table('tbl_accident')->where($where)->whereNotIn('status', ['cancel'])->orderBy('accident_id','DESC')->get();
          if(!empty($resData) && count($resData) > 0) {
              $UserData = array();
              foreach ($resData as  $value) {

                  if ($lang_type == 'English') {
                
                    $accident_address = $value->accident_address;

                  }else{

                    $accident_address = $this->get_hindi_text($lang_type, $value->accident_address);
                  }


                  $accVideo   = url('/').'/public/uploads/accident/videos/'.$value->accident_video;
                  $accImg     = url('/').'/public/uploads/accident/pics/'.$value->accident_pic;

                  $accident_date = date('d-M-Y', strtotime($value->accident_time));
                  $accident_time = date('H:i:s', strtotime($value->accident_time));
                  $UserData[] = array(
                              'accident_id'     =>  isset($value->accident_id)?$value->accident_id:'',
                              'accident_address'=>  $accident_address ?? '',
                              'accident_pic'    =>  $accImg,
                              'accident_video'  =>  $accVideo,
                              'accident_date'   =>  $accident_date,
                              'accident_time'   =>  $accident_time,
                              'status'          =>  $value->status ?? '',
                            );
              }
              
              return response()->json(['accident_list' => $UserData,'page_content' => @$page_content ?? '','status' => 1]);

          } else {

              return response()->json(['msg' =>$msg,'page_content' => @$page_content ?? '','status' => 0]);
          }
            
        } else {

            $msg = "Something went worng. Please try again.";

            return response()->json(['msg' =>$msg,'status' => 0]);
        }
    }
    // **************** blood_update_profile  ************//
    public function blood_update_profile(Request $request) {
        if ($request->isMethod('post')) {

          $user_id                  = $request->user_id;
          $blood_group              = $request->blood_group;
          $aadhar_no                = $request->aadhar_no;
          $blood_current_distance   = $request->blood_current_distance;
          $current_address          = $request->current_address;
          $current_letlong          = $request->current_letlong;

          $lang_type                = $request->language_type;
          
          if (empty($lang_type)) {

            return response()->json(['msg' => "Please select language type.", 'status' => 0]);
          }

          if(empty($user_id)){
            if ($lang_type == 'English') {
            
              $user_id_msg = "User Id can not be null / blank.";
              
            }else{

              $user_id_msg = $this->get_hindi_text($lang_type, 'User Id can not be null / blank.');
            }
            return response()->json(['msg' => $user_id_msg, 'status' => 0]);
          }

          if (!empty($request->current_letlong)) {

            $current_letlong    = explode(',', $request->current_letlong);
            $current_latitude   = $current_letlong[0];
            $current_longitude  = $current_letlong[1];
          }
          $update_data = array(
                      'blood_group'             =>  $blood_group,
                      'aadhar_no'               =>  $aadhar_no,
                      'blood_current_distance'  =>  $blood_current_distance,
                      'current_address'         =>  $request->current_address,
                      'current_letlong'         =>  $request->current_letlong,
                      'current_latitude'        =>  @$current_latitude,
                      'current_longitude'       =>  @$current_longitude
                    );
          // print_r($update_data);die;
          DB::table('tbl_user_registration')
            ->where('user_id', $user_id)
            ->update($update_data);

          $where  = array('user_id' => $user_id);
          $res    = DB::table('tbl_user_registration')->where($where)->first();
          if ($lang_type == 'English') {
              
            $first_name         = $res->first_name;
            $last_name          = $res->last_name;
            $permanent_address  = $res->permanent_address;
            $current_address    = $res->current_address;
            $msg = "Profile updated successfully.";

          }else{

            $first_name         = $this->get_hindi_text($lang_type, $res->first_name);
            $last_name          = $this->get_hindi_text($lang_type, $res->last_name);
            $permanent_address  = $this->get_hindi_text($lang_type, $res->permanent_address);
            $current_address    = $this->get_hindi_text($lang_type, $res->current_address);
            $msg                = $this->get_hindi_text($lang_type, 'Profile updated successfully.');

          }

          $Img = url('/').'/public/uploads/user/'.$res->user_image;
          // print_r($res->aadhar_no);die;
          $UserData = array(
                        'phone_no'          =>  isset($res->phone_no)?$res->phone_no:'',
                        'first_name'        =>  $first_name ?? '',
                        'last_name'         =>  $last_name ?? '',
                        'email'             =>  isset($res->email)?$res->email:'',
                        'language'          =>  isset($res->language)?$res->language:'',
                        'user_image'        =>  $Img,
                        'permanent_address' =>  $permanent_address ?? '',
                        'current_address'   =>  $current_address ?? '',
                        'blood_group'       =>  isset($res->blood_group)?$res->blood_group:'',
                        'aadhar_no'         =>  isset($res->aadhar_no)?$res->aadhar_no:'',
                        'blood_current_distance'  =>  isset($res->blood_current_distance)?$res->blood_current_distance:0,
                        'current_letlong'   =>  isset($res->current_letlong)?$res->current_letlong:'',
                      );
            return response()->json(['result' => $UserData, 'msg'=>$msg,'status' => 1]);
            
        } else {

          $msg = "Something went worng. Please try again.";

          return response()->json(['msg' =>$msg,'status' => 0]);
        }
    }

    /**___ get content for big brother __**/ 
    public function get_blood_camp(Request $request) {
      if ($request->isMethod('post')) {

        $lang_type  = $request->language_type;
        $user_id    = $request->user_id;

        if (empty($user_id)) {
          if ($lang_type == 'English') {

            $user_id_msg   = "User id can not be nu;; / blank.";
            
          }else{

            $user_id_msg   = $this->get_hindi_text($lang_type, 'User id can not be nu;; / blank.');
          }
          return response()->json(['msg' =>$user_id_msg, 'status' => 1]);
        }

        if (!empty($lang_type)) {
          $blood_camp_list    = BloodCamp::where(['status'=>'active','deleted'=>'0'])->select('camp_id','camp_name','camp_address')->get();

          /**___ get total user unit ___**/ 
          $total_credit_unit = BloodBank::where(['user_id'=>$user_id,'donation_type'=>'credit','status'=>'approved'])->sum('blood_unit');
          $total_debit_unit   = BloodBank::where(['user_id'=>$user_id,'donation_type'=>'debit','status'=>'approved'])->sum('blood_unit');

          $total_unit = $total_credit_unit-$total_debit_unit;
          if ($total_unit >= 0) {
            $user_total_unit = $total_unit;
          }else{
            $user_total_unit = 0;
          }

          if (!empty($blood_camp_list)) {
            foreach ($blood_camp_list as $each_val) {

              if ($lang_type == 'English') {

                $camp_name = $each_val->camp_name;
                $camp_address = $each_val->camp_address;
                
              }else{

                $camp_name = $this->get_hindi_text($lang_type, $each_val->camp_name);
                $camp_address = $this->get_hindi_text($lang_type, $each_val->camp_address);
              }

              $start_date = date('d-M-Y', strtotime($each_val->start_date));
              $start_time = date('H:i:s', strtotime($each_val->start_date));
              $end_date   = date('d-M-Y', strtotime($each_val->end_date));
              $end_time   = date('H:i:s', strtotime($each_val->end_date));

              $CampData[] = array(
                              'camp_id'     => $each_val->camp_id, 
                              'camp_name'   => $camp_name ?? '', 
                              'camp_address'=> $camp_address ?? '', 
                              'start_date'  => $start_date ?? '', 
                              'start_time'  => $start_time ?? '', 
                              'end_date'    => $end_date ?? '', 
                              'end_time'    => $end_time ?? '', 
                            );
            }
            return response()->json(['CampData' => $CampData,'total_unit' => $user_total_unit, 'status' => 1]);
          }else{

            if ($lang_type == 'English') {
            
              $record_not_found = "Record not found.";
              
            }else{

              $record_not_found = $this->get_hindi_text($lang_type, 'Record not found.');
            }

            return response()->json(['msg' =>$record_not_found, 'total_unit' => $user_total_unit, 'status' => 0]);
          }
        }else{
          return response()->json(['msg' =>'Please select language type.','status' => 0]);
        }
      }
    }
    // **************** Accident Submit  ************//
    public function upload_certificate(Request $request) {

      if ($request->isMethod('post')) {

          $user_id            = $request->user_id;

          $center_type        = $request->center_type;//other or our
          $other_center_name  = $request->other_center_name;//blood camp name insert
          $our_center_id      = $request->our_center_id;//blood camp id

          $blood_group        = $request->blood_group;
          $blood_unit         = $request->blood_unit;

          $lang_type          = $request->language_type;

          /**___ Start Validation ___**/ 
            if(empty($user_id)){
              if ($lang_type == 'English') {
              
                $user_id_msg  = "User Id can not be null/blank.";
              }else{
                $user_id_msg  = $this->get_hindi_text($lang_type, 'User Id can not be null/blank.');
              }
              return response()->json(['msg' => $user_id_msg, 'status' => 0]);
            }

            if(!$request->hasfile('certificate')){
              if ($lang_type == 'English') {

                $certificate_msg  = "Please upload certificate.";
              }else{
                $certificate_msg  = $this->get_hindi_text($lang_type,'Please upload certificate.');
              }
              return response()->json(['msg' => $certificate_msg, 'status' => 0]);
            }

            if(empty($blood_group)){
              if ($lang_type == 'English') {
              
                $blood_group_msg  = "Blood group can not be null/blank.";
              }else{
                $blood_group_msg  = $this->get_hindi_text($lang_type, 'Blood group can not be null/blank.');
              }
              return response()->json(['msg' => $blood_group_msg, 'status' => 0]);
            }

            if(empty($blood_unit)){
              if ($lang_type == 'English') {
              
                $blood_unit_msg  = "Blood unit can not be null/blank.";
              }else{
                $blood_unit_msg  = $this->get_hindi_text($lang_type, 'Blood unit can not be null/blank.');
              }
              return response()->json(['msg' => $blood_unit_msg, 'status' => 0]);
            }

            if(empty($center_type)){
              if ($lang_type == 'English') {
              
                $center_type_msg  = "Center type can not be null / blank.";
              }else{
                $center_type_msg  = $this->get_hindi_text($lang_type, 'Center type can not be null / blank.');
              }
              return response()->json(['msg' => $center_type_msg, 'status' => 0]);

            }elseif ($center_type =='other') {

              if (empty($other_center_name)) {
                if ($lang_type == 'English') {
                  $center_name_msg  = "Center name can not be null / blank.";
                }else{
                  $center_name_msg  = $this->get_hindi_text($lang_type,'Center name can not be null / blank.');
                }
                return response()->json(['msg' => $center_name_msg, 'status' => 0]);
              }

              /**__ if center_type == other then insert camp __**/ 
              $new_camp_data =  array(
                          'camp_name'   =>  $other_center_name,
                          'created_at'  =>  date('Y-m-d H:i:s')
                        );

              $camp_id = BloodCamp::insertGetId($new_camp_data);

            }else{

              if (empty($our_center_id)) {

                if ($lang_type == 'English') {

                  $center_id_msg  = "Center id can not be null / blank.";
                }else{
                  $center_id_msg  = $this->get_hindi_text($lang_type,'Center id can not be null / blank.');
                }
                return response()->json(['msg' => $center_id_msg, 'status' => 0]);

              }else{

                $camp_id = $our_center_id;
              }

            }
          /**___ End Validation ___**/

          if($request->hasfile('certificate')){
            $certificate = upload_file($request->file('certificate'),'/uploads/blood_bank');
          }
          
          $newData =  array(
                        'camp_id'     =>  $camp_id,
                        'user_id'     =>  $user_id,
                        'blood_group' =>  $blood_group,
                        'blood_unit'  =>  $blood_unit,
                        'document'    =>  $certificate,
                        'donation_type'=> "credit",
                        'created_at'  =>  date('Y-m-d H:i:s')
                      );

          $id = DB::table('tbl_blood_bank')->insertGetId($newData);
          if($id){ 
            if ($lang_type == 'English') {
              $msg          = "Uploaded successfully.";            
            }else{
              $msg          = $this->get_hindi_text($lang_type, 'Uploaded successfully.');
            }
            return response()->json(['msg' =>$msg,'status' => 1]);
              
          } else {

            if ($lang_type == 'English') {
              $something_wrong  = "Something went worng. Please try again.";
            }else{
              $something_wrong = $this->get_hindi_text($lang_type, 'Something went worng. Please try again.');
            }

            return response()->json(['msg' =>$something_wrong, 'status' => 0]);
          }
          
      } else {

        $msg = "Something went worng. Please try again.";

        return response()->json(['msg' =>$msg,'status' => 0]);
      }
    }
    // **************** Accident Submit  ************//
    public function blood_requirement(Request $request) {

        if ($request->isMethod('post')) {

            $user_id          = $request->user_id;
            $where_address    = $request->where_address;
            $blood_unit       = $request->blood_unit;
            $requirement_date = $request->requirement_date;
            $blood_group      = $request->blood_group;

            $lang_type        = $request->language_type;

            if(empty($user_id)){
              if ($lang_type == 'English') {
              
                $user_id_msg  = "User Id can not be null/blank.";
                
              }else{

                $user_id_msg  = $this->get_hindi_text($lang_type, 'User Id can not be null/blank.');
              }
                return response()->json(['msg' => $user_id_msg, 'status' => 0]);
            }

            $newData =  array(
                          'user_id'=>$user_id,
                          'where_address'=>$where_address,
                          'blood_unit'=>$blood_unit,
                          'blood_group'=>$blood_group,
                          'requirement_date'=>$requirement_date,
                          'created_at'=>date('Y-m-d H:i:s')
                        );

            $id = DB::table('tbl_blood_requirement')->insertGetId($newData);
            if($id){ 

                if ($lang_type == 'English') {

                  $msg          = "Request sent successfully.";
                  
                }else{

                  $msg          = $this->get_hindi_text($lang_type, 'Request sent successfully.');
                }
                return response()->json(['msg' =>$msg,'status' => 1]);
                
            }else {
               if ($lang_type == 'English') {

                  $something_wrong  = "Something went worng. Please try again.";
                  
                }else{
                  $something_wrong = $this->get_hindi_text($lang_type,'Something went worng. Please try again.');
                }
              return response()->json(['msg' =>$something_wrong,'status' => 0]);
            }
            
        } else {

          $msg = "Something went worng. Please try again.";

          return response()->json(['msg' =>$msg,'status' => 0]);
        }
    }

    public function blood_donetion_list(Request $request) {

      if ($request->isMethod('post')) {

          $user_id    = $request->user_id;
          $lang_type  = $request->language_type;
          $page_type  = $request->page_type;

          $latitude   = $request->latitude;
          $longitude  = $request->longitude;

          if(empty($lang_type)){

            return response()->json(['msg' => "Please select language type.", 'status' => 0]);
          }

          if(empty($user_id)){

            if ($lang_type == 'English') {
            
              $user_id_msg  = "User Id can not be null/blank.";
              
            }else{

              $user_id_msg      = $this->get_hindi_text($lang_type, 'User Id can not be null/blank.');
            }
            return response()->json(['msg' => $user_id_msg, 'status' => 0]);
          }

          if(!empty($page_type)){

            $page_data    = Instruction::where(['page_type'=>$page_type,'status'=>'active','deleted'=>'0'])->select('page_content')->first();
            if (!empty($page_data)) {

              if ($lang_type == 'English') {

                $page_content = $page_data->page_content;
                
              }else{

                $page_content = $this->get_hindi_text($lang_type, $page_data->page_content);
              }

            }
          }else{
            $page_content = '';
          }

          if(empty($latitude)){

            if ($lang_type == 'English') {
            
              $latitude_msg  = "Latitude can not be null/blank.";
              
            }else{

              $latitude_msg      = $this->get_hindi_text($lang_type, 'Latitude can not be null/blank.');
            }
            return response()->json(['msg' => $latitude_msg, 'status' => 0]);
          }

          if(empty($longitude)){

            if ($lang_type == 'English') {
            
              $longitude_msg  = "Longitude can not be null/blank.";
              
            }else{

              $longitude_msg      = $this->get_hindi_text($lang_type, 'Longitude can not be null/blank.');
            }
            return response()->json(['msg' => $longitude_msg, 'status' => 0]);
          }
          $userInfo = User::where(['user_id'=>$user_id, 'deleted'=>'0'])->first();
          if(!empty($userInfo->blood_current_distance)){
              $radius = $userInfo->blood_current_distance;
          }else{
              $radius = 10;
          }
          $blood_camp_list = BloodCamp::selectRaw("*, ( 6371 * acos( cos( radians(" . $latitude . ") ) * cos( radians(camp_letitude) ) * cos( radians(camp_longitude) - radians(" . $longitude . ") ) + sin( radians(" . $latitude . ") ) * sin( radians(camp_letitude) ) ) ) AS distance")
                    ->where(['status'=>'active','deleted'=>'0'])
                    ->having("distance", "<=", $radius)
                    ->orderBy("distance", "ASC")
                    ->get();

          if( !empty($blood_camp_list) && count($blood_camp_list) > 0 ) {
              $near_by_camp_status = 'yes';
          }else{
              $near_by_camp_status = 'no';
          }

          $res = DB::table('tbl_blood_bank')
                        ->join('tbl_user_registration AS user_reg', 'tbl_blood_bank.user_id', '=', 'user_reg.user_id')
                        ->leftjoin('tbl_blood_camp AS camp', 'tbl_blood_bank.camp_id', '=', 'camp.camp_id')
                        ->select('tbl_blood_bank.*','camp.camp_name','camp.camp_address', 'user_reg.first_name','user_reg.last_name')
                        ->orderBy('blood_bank_id','DESC')
                        ->where(['tbl_blood_bank.user_id' => $user_id,'user_reg.deleted' => '0','tbl_blood_bank.status' => 'approved'])
                        ->get();
          /**___ get total user unit ___**/ 
          $total_credit_unit  = BloodBank::where(['user_id'=>$user_id,'donation_type'=>'credit','status'=>'approved'])->sum('blood_unit');
          $total_debit_unit   = BloodBank::where(['user_id'=>$user_id,'donation_type'=>'debit','status'=>'approved'])->sum('blood_unit');

          $total_unit = $total_credit_unit-$total_debit_unit;
          if ($total_unit >= 0) {
            $user_total_unit = $total_unit;
          }else{
            $user_total_unit = 0;
          }
          // $user_total_blood_units = BloodRequirement::where(['user_id'=>$user_id, 'deleted'=>'0'])->sum('blood_unit');
          if ( !empty($res) && count($res) > 0) {

            foreach ($res as $val) {

              if ($lang_type == 'English') {
                  
                $camp_address   = $val->camp_address ?? '';
                $camp_name          = $val->camp_name ?? '';
                $first_name      = $val->first_name ?? '';
                $last_name       = $val->last_name ?? '';
                $status       = $val->status ?? '';

              }else{

                $camp_address  = $this->get_hindi_text($lang_type, $val->camp_address);
                $camp_name         = $this->get_hindi_text($lang_type, $val->camp_name);
                $first_name     = $this->get_hindi_text($lang_type, $val->first_name);
                $last_name      = $this->get_hindi_text($lang_type, $val->last_name);
                $status      = $this->get_hindi_text($lang_type, $val->status);

              }

              $data[] = array(
                          'first_name'        =>  $first_name ?? '',
                          'last_name'         =>  $last_name ?? '',
                          'camp_address'      =>  $camp_address ?? '',
                          'camp_name'         =>  $camp_name ?? '',
                          'status'            =>  $status ?? '',
                          'blood_group'       => isset($val->blood_group)?$val->blood_group:'',
                          'blood_unit'        =>  isset($val->blood_unit)?$val->blood_unit:'',
                        );
            }

            return response()->json(['result' => $data, 'total_unit' => $user_total_unit, 'near_by_camp_status' => $near_by_camp_status, 'page_content' => @$page_content, 'status' => 1]);

          }else{

            if ($lang_type == 'English') {
            
              $record_not_found = "Record not found.";
              
            }else{

              $record_not_found = $this->get_hindi_text($lang_type, 'Record not found.');
            }

            return response()->json(['msg' =>$record_not_found,'total_unit' => $user_total_unit,'near_by_camp_status' => $near_by_camp_status,'page_content' => @$page_content ?? '', 'status' => 0]);
          }
          
      } else {

        return response()->json(['msg' =>'Something went worng. Please try again.','status' => 0]);
      }
    }

    /************************Get State*************************/
    public function get_state(Request $request) {
      if ($request->isMethod('post')) { 

          $user_id    = $request->user_id;
          $lang_type  = $request->language_type;

          if ($lang_type == 'English') {
              
            $record_not_found = "Record not found.";
          }else{

            $record_not_found = $this->get_hindi_text($lang_type, 'Record not found.');
          }

          $where      = array('country_id' => 101, 'deleted' => '0');
          $StateData  = DB::table('tbl_state_master')->where($where)->get();

          if(!empty($StateData) && count($StateData) > 0) {

            foreach ($StateData as  $value) {

                if($lang_type=='English'){

                  $state = isset($value->state_name)?$value->state_name:'';

                }else{

                  $state  = $this->get_hindi_text($lang_type, isset($value->state_name)?$value->state_name:'');
                }

                $data[] = array(
                            'state_id'=>$value->id ?? '',
                            'state'   =>$state
                          );
            }
            
            return response()->json(['states' => $data,'status' => 1]);

          } else {
            return response()->json(['msg' => $record_not_found, 'status' => 0]);
          }
      }
    }
    /**___ get city according to state __**/ 
    public function get_city(Request $request) {
      if ($request->isMethod('post')) { 

          $user_id    = $request->user_id;
          $state_id   = $request->state_id;
          $lang_type  = $request->language_type;

          if ($lang_type == 'English') {
              
            $state_id_msg     = "User Id can not be null/blank.";
            $record_not_found = "Record not found.";
            
          }else{

            $state_id_msg     = $this->get_hindi_text($lang_type, 'State Id can not be null/blank.');
            $record_not_found = $this->get_hindi_text($lang_type, 'Record not found.');
          }

          if(empty($state_id)){

            return response()->json(['msg' => $state_id_msg, 'status' => 0]);
          }

          $where      = array('state_id' => $state_id);
          $CityData   = DB::table('tbl_city_master')->where($where)->get();

          if( !empty($CityData) && count($CityData) > 0 ) {

            foreach ($CityData as  $value) {

              if($lang_type=='English'){

                  $city = $value->city_name ?? '';

              }else{

                  $city  = $this->get_hindi_text($lang_type, $value->city_name ?? '');
              }

              $data[] = array(
                          'city_id' =>  $value->city_id ?? '',
                          'city'    =>  $city
                        );
            }
            
            return response()->json(['cities' => $data,'status' => 1]);

          } else {

            return response()->json(['msg' => $record_not_found, 'status' => 0]);
          }
      }
    }

    /**___ Accident Track __**/ 
    public function accident_track(Request $request) {

        if ($request->isMethod('post')) { 

          $user_id      = $request->user_id;
          $accident_id  = $request->accident_id;
          $lang_type    = $request->language_type;

          if ($lang_type == 'English') {
              
            $accident_id_msg    = "Accident Id can not be null / blank.";
            $record_not_found   = "Record not found.";
            
          }else{

            $accident_id_msg  = $this->get_hindi_text($lang_type, 'Accident Id can not be null / blank.');
            $record_not_found = $this->get_hindi_text($lang_type, 'Record not found.');
          }

          if(empty($accident_id)){

            return response()->json(['msg' => $accident_id_msg, 'status' => 0]);
          }

          $where      = array('accident_id'=>$accident_id,'status'=>'active','deleted'=>'0');
          $AccidentTrackData   = AccidentTrack::where($where)->orderBy('track_id','DESC')->get();

          if( !empty($AccidentTrackData) && count($AccidentTrackData) > 0 ) {

            foreach ($AccidentTrackData as  $value) {

              if($lang_type=='English'){

                $current_status = $value->current_status ?? '';

              }else{

                $current_status  = $this->get_hindi_text($lang_type, $value->current_status ?? '');
              }

              $track_date = date('d-M-Y', strtotime($value->track_time));
              $track_time = date('H:i:s', strtotime($value->track_time));

              $data[] = array(
                          'tracker_status' => $current_status,
                          'track_date'     => $track_date ?? '',
                          'track_time'     => $track_time ?? '',
                        );
            }
            
            return response()->json(['accident_track_details' => $data,'status' => 1]);

          } else {

            return response()->json(['msg' => $record_not_found, 'status' => 0]);
          }
        }
    }

    /**___ Accident Reason List __**/ 
    public function accident_reason_list(Request $request) {
      if ($request->isMethod('post')) { 

        $lang_type = $request->language_type;
        $page_type = $request->page_type;

        if (!empty($lang_type)){

          if(!empty($page_type)){

            $page_data    = Instruction::where(['page_type'=>$page_type,'status'=>'active','deleted'=>'0'])->select('page_content')->first();

            if (!empty($page_data)) {

              if ($lang_type == 'English') {

                $page_content = $page_data->page_content;
                
              }else{

                $page_content = $this->get_hindi_text($lang_type, $page_data->page_content);
              }
            }
          }

          $where       = array('reason_type'=>'informer','status'=>'active','deleted'=>'0');
          $reason_data = AccidentReason::where($where)->get();

          if( !empty($reason_data) && count($reason_data) > 0 ) {

            foreach ($reason_data as  $value) {

              if($lang_type=='English'){

                $reason_type = $value->reason_type ?? '';
                $reason_name = $value->reason_name ?? '';

              }else{

                $reason_type  = $this->get_hindi_text($lang_type, $value->reason_type ?? '');
                $reason_name  = $this->get_hindi_text($lang_type, $value->reason_name ?? '');
              }

              $data[] = array(
                          'reason_id'     => $value->res_id,
                          'reason_type'   => $reason_type,
                          'reason_name'     => $reason_name,
                        );
            }
            
            return response()->json(['accident_reason_details' => $data,'page_content' => $page_content,'status' => 1]);

          } else {

            if ($lang_type == 'English') {
              
              $record_not_found   = "Record not found.";
            
            }else{

              $record_not_found = $this->get_hindi_text($lang_type, 'Record not found.');
            }
            return response()->json(['msg' => $record_not_found, 'page_content' => @$page_content, 'status' => 0]);
          }

        }else{

          return response()->json(['msg' => "Please send language type.", 'status' => 0]);
        }
      }
    }
    /**___ Accident Reason List __**/ 
    public function helper_accident_reason_list(Request $request) {
      if ($request->isMethod('post')) { 

        $lang_type = $request->language_type;
        $page_type = $request->page_type;

        if (!empty($lang_type)){

          if(!empty($page_type)){

            $page_data    = Instruction::where(['page_type'=>$page_type,'status'=>'active','deleted'=>'0'])->select('page_content')->first();

            if (!empty($page_data)) {

              if ($lang_type == 'English') {

                $page_content = $page_data->page_content;
                
              }else{

                $page_content = $this->get_hindi_text($lang_type, $page_data->page_content);
              }
            }
          }

          $where       = array('reason_type'=>'helper','status'=>'active','deleted'=>'0');
          $reason_data = AccidentReason::where($where)->get();

          if( !empty($reason_data) && count($reason_data) > 0 ) {

            foreach ($reason_data as  $value) {

              if($lang_type=='English'){

                $reason_type = $value->reason_type ?? '';
                $reason_name = $value->reason_name ?? '';

              }else{

                $reason_type  = $this->get_hindi_text($lang_type, $value->reason_type ?? '');
                $reason_name  = $this->get_hindi_text($lang_type, $value->reason_name ?? '');
              }

              $data[] = array(
                          'reason_id'     => $value->res_id,
                          'reason_type'   => $reason_type,
                          'reason_name'     => $reason_name,
                        );
            }
            
            return response()->json(['accident_reason_details' => $data,'page_content' => $page_content,'status' => 1]);

          } else {

            if ($lang_type == 'English') {
              
              $record_not_found   = "Record not found.";
            
            }else{

              $record_not_found = $this->get_hindi_text($lang_type, 'Record not found.');
            }
            return response()->json(['msg' => $record_not_found, 'page_content' => @$page_content, 'status' => 0]);
          }

        }else{

          return response()->json(['msg' => "Please send language type.", 'status' => 0]);
        }
      }
    }

    /** blood under 10 km blood camp**/ 
    public function boold_donation_camp_near_by_user(Request $request) {
      if ($request->isMethod('post')) { 

          $user_id   = $request->user_id;
          $lang_type = $request->language_type;
          $latitude  = $request->currentlat;
          $longitude = $request->currentlong;

          if (!empty($lang_type)){

            if (empty($user_id)) {
              if ($lang_type == 'English') {

                $user_id_msg   = "User id can not be nu;; / blank.";
                
              }else{

                $user_id_msg   = $this->get_hindi_text($lang_type, 'User id can not be nu;; / blank.');
              }
              return response()->json(['msg' =>$user_id_msg, 'status' => 1]);
            }

            if (empty($latitude)) {

              if ($lang_type == 'English') {                
                $latitude_msg    = "latitude can not be null / blank.";                  
              }else{
                $latitude_msg     = $this->get_hindi_text($lang_type, 'latitude can not be null / blank.');
              }
              return response()->json(['msg' => $latitude_msg, 'status' => 0]);
            }

            if (empty($longitude)) {

              if ($lang_type == 'English') {                
                $longitude_msg    = "longitude can not be null / blank.";                  
              }else{
                $longitude_msg     = $this->get_hindi_text($lang_type, 'longitude can not be null / blank.');
              }
              return response()->json(['msg' => $longitude_msg, 'status' => 0]);
            }

            /**___ get total user unit ___**/ 
            $total_credit_unit = BloodBank::where(['user_id'=>$user_id,'donation_type'=>'credit','status'=>'approved'])->sum('blood_unit');
            $total_debit_unit   = BloodBank::where(['user_id'=>$user_id,'donation_type'=>'debit','status'=>'approved'])->sum('blood_unit');

            $total_unit = $total_credit_unit-$total_debit_unit;
            if ($total_unit >= 0) {
              $user_total_unit = $total_unit;
            }else{
              $user_total_unit = 0;
            }

            $radius = Config::get('constants.RADIUS_DISTANCE');
            $blood_camp_list = BloodCamp::selectRaw("*, ( 6371 * acos( cos( radians(" . $latitude . ") ) * cos( radians(camp_letitude) ) * cos( radians(camp_longitude) - radians(" . $longitude . ") ) + sin( radians(" . $latitude . ") ) * sin( radians(camp_letitude) ) ) ) AS distance")
                      ->where(['status'=>'active','deleted'=>'0'])
                      ->having("distance", "<=", $radius)
                      ->orderBy("distance", "ASC")
                      ->get();

              if( !empty($blood_camp_list) && count($blood_camp_list) > 0 ) {

                foreach ($blood_camp_list as  $value) {

                  $start_date = date('d-M-Y', strtotime($value->start_date));
                  $start_time = date('H:i:s', strtotime($value->start_date));
                  $end_date   = date('d-M-Y', strtotime($value->end_date));
                  $end_time   = date('H:i:s', strtotime($value->end_date));

                  if($lang_type=='English'){

                    $camp_name    = $value->camp_name ?? '';
                    $camp_address = $value->camp_address ?? '';

                  }else{

                    $camp_name    = $this->get_hindi_text($lang_type, $value->camp_name ?? '');
                    $camp_address = $this->get_hindi_text($lang_type, $value->camp_address ?? '');
                  }

                  $data[] = array(
                              'camp_id'       => $value->camp_id,
                              'camp_name'     => $camp_name,
                              'camp_address'  => $camp_address,
                              'start_date'    => $start_date,
                              'start_time'    => $start_time,
                              'end_date'      => $end_date,
                              'end_time'      => $end_time,
                            );
                }
                
                return response()->json(['camp_list_near_by' => $data, 'total_unit' => $user_total_unit,'status' => 1]);

              } else {

                if ($lang_type == 'English') {
                  
                  $record_not_found   = "Record not found.";
                
                }else{

                  $record_not_found = $this->get_hindi_text($lang_type, 'Record not found.');
                }
                return response()->json(['msg' => $record_not_found,'total_unit' => $user_total_unit, 'status' => 0]);
              }

          }else{

            return response()->json(['msg' => "Please send language type.", 'status' => 0]);
          }
      }
    }

    /**___ user_rewards List __**/ 
    public function user_rewards(Request $request) {
      if ($request->isMethod('post')) { 

          $lang_type    = $request->language_type;
          $user_id      = $request->user_id;
          // $accident_id  = $request->accident_id;
          if (!empty($lang_type)){

            if (empty($user_id)) {
              if ($lang_type == 'English') {
                  
                $user_id_msg   = "User id can not be null / blank.";
              
              }else{

                $user_id_msg = $this->get_hindi_text($lang_type, 'User id can not be null / blank.');
              }
              return response()->json(['msg' => $user_id_msg, 'status' => 0]);
            }

            $all_rewarts = UserRewards::where(['user_id'=>$user_id, 'deleted'=>'0'])->with('accident_details')->orderBy('rew_id','DESC')->get();

            $user_total_rewarts = UserRewards::where(['user_id'=>$user_id, 'deleted'=>'0'])->sum('tbl_user_rewards.rating');

            if( !empty($all_rewarts) && count($all_rewarts) > 0 ) {

              foreach ($all_rewarts as  $each_val) {

                if($lang_type=='English'){

                  $accident_address = $each_val->accident_details->accident_address ?? '';

                }else{

                  $accident_address  = $this->get_hindi_text($lang_type, $each_val->accident_details->accident_address ?? '');
                }

                $accident_date = date('d-M-Y', strtotime($each_val->accident_details->accident_time));
                $accident_time = date('H:i:s', strtotime($each_val->accident_details->accident_time));

                // $accident_time = custom_date_format($each_val->accident_details->accident_time) ?? '';
                $data[] = array(
                            'accident_address'  => $accident_address,
                            'accident_date'     => $accident_date,
                            'accident_time'     => $accident_time,
                            'rating'            => $each_val->rating,
                            'remark'            => $each_val->remark,
                          );

              }
              
              return response()->json(['user_rewards_details' => $data ,'TotalRewards' => $user_total_rewarts,'status' => 1]);

            } else {

              if ($lang_type == 'English') {
                
                $record_not_found   = "Record not found.";
              
              }else{

                $record_not_found = $this->get_hindi_text($lang_type, 'Record not found.');
              }
              return response()->json(['msg' => $record_not_found, 'status' => 0]);
            }

          }else{

            return response()->json(['msg' => "Please send language type.", 'status' => 0]);
          }
      }
    }/**___ user_rewards List __**/ 

    public function get_big_brother_content(Request $request) {
      if ($request->isMethod('post')) {

        $page_type  = $request->page_type;
        $lang_type  = $request->language_type;

        if(!empty($page_type)){

          $page_data    = Instruction::where(['page_type'=>$page_type,'status'=>'active','deleted'=>'0'])->select('page_content')->first();

          if (!empty($page_data)) {

            if ($lang_type == 'English') {

              $page_content = $page_data->page_content;
              
            }else{

              $page_content = $this->get_hindi_text($lang_type, $page_data->page_content);
            }
            return response()->json(['page_content' => $page_content, 'status' => 1]);
          }
        }
      }
    }

    // ******* sent help request to Big Brother  ******//
    public function help_request_to_big_brother(Request $request) {
      if ($request->isMethod('post')) {

          $video   = $request->accident_video;
          $image   = $request->accident_pic;
          $audio   = $request->accident_audio;
          $comment = $request->comment_txt﻿;

          $address = $request->accident_address;
          $letlong = $request->accident_letlong;

          $lang_type        = $request->language_type;
          if (empty($lang_type)) {
            return response()->json(['msg' => 'Please add language type.', 'status' => 0]);
          }

          if(empty($address)){

            if ($lang_type == 'English') {

              $address_msg = "Address can not be null / blank.";
              
            }else{

              $address_msg = $this->get_hindi_text($lang_type, "Address can not be null / blank");
              
            }
            return response()->json(['msg' => $address_msg, 'status' => 0]);
          }

          if(empty($letlong)){

            if ($lang_type == 'English') {

              $letlong_msg = "Address can not be null / blank.";
              
            }else{

              $letlong_msg = $this->get_hindi_text($lang_type, "letlong can not be null / blank");
              
            }
            return response()->json(['msg' => $letlong_msg, 'status' => 0]);
          }

          if($request->hasfile('accident_video')){
            $video = upload_file($request->file('accident_video'),'/uploads/big_brother/videos');
          }else{
            $video = '';
          }

          if($request->hasfile('accident_audio')){
            $audio = upload_file($request->file('accident_audio'),'/uploads/big_brother/audio');
          }else{
            $audio = '';
          }

          if($request->hasfile('accident_pic')){
            $image = upload_file($request->file('accident_pic'),'/uploads/big_brother/images');
          }else{
            $image = '';
          }

          if (empty($video) && empty($audio) && empty($image)) {

            if ($lang_type == 'English') {                
              $upload_msg = "Please upload atleast one file.";
            }else{
              $upload_msg = $this->get_hindi_text($lang_type, "Please upload atleast one file.");
            }
            return response()->json(['msg' =>$upload_msg, 'status' => 0]);
          }

          $get_letlong = explode(',', $letlong);

          $newData =  array(
                        'video'     =>  $video,
                        'image'     =>  $image,
                        'audio'     =>  $audio,
                        'comment'   =>  $comment,
                        'address'   =>  $address,
                        'latitude'  =>  $get_letlong[0],
                        'longitude' =>  $get_letlong[1],
                        'created_at'=>  date('Y-m-d H:i:s'),
                      );

          $id = DB::table('tbl_big_brother_help_request')->insertGetId($newData);
          if($id){

            if ($lang_type == 'English') {                
              $success_msg = "We have received your request we will try to reach you asap. ";
            }else{
              $success_msg = $this->get_hindi_text($lang_type, "We have received your request we will try to reach you asap .");
            }
            return response()->json(['msg' =>$success_msg,'status' => 1]);
          }else {

            if ($lang_type == 'English') {

              $something_wrong = "Something went worng. Please try again.";

            }else{

              $something_wrong = $this->get_hindi_text($lang_type,"Something went worng. Please try again.");
            }
            return response()->json(['msg' => $something_wrong, 'status' => 0]);
          }
      } else {
        return response()->json(['msg' => 'Something went worng. Please try again.', 'status' => 0]);
      }
    }

    // ***** Request Submit Big Brother******//
    public function request_submit_big_brother(Request $request){

      if ($request->isMethod('post')) {

        $mobile_no = $request->Phone_Number;
        $lang_type = $request->language_type;
        $device_token   = $request->device_token;
        $device_type   = $request->device_type;

        $otp = 1234;
        if(!empty($lang_type)){

          if(empty($device_token)){
            if($lang_type == 'English'){

              $device_token_msg = "Device Token can not be null / blank.";
            }else{

              $device_token_msg = $this->get_hindi_text($lang_type, "Device Token can not be null / blank.");
            }  
            return response()->json(['msg' => $device_token_msg,'status' => 0]);
          }

          if(empty($device_type)){

            if($lang_type == 'English'){

              $device_type_msg = "Device type can not be null / blank.";

            }else{

              $device_type_msg = $this->get_hindi_text($lang_type, "Device type can not be null / blank.");
            }  
            return response()->json(['msg' => $device_type_msg,'status' => 0]);
          }

          if(empty($mobile_no)){

            if($lang_type == 'English'){

              $mobile_msg = "Mobile can not be null / blank.";
            }else{

              $mobile_msg = $this->get_hindi_text($lang_type, "Mobile can not be null / blank.");
            }                
            return response()->json(['msg' => $mobile_msg, 'status' => 0]);
          }

        }else{

          return response()->json(['msg' => 'Please select language type.','status' => 0]);
        }
        
        $checkMobile = User::where(['phone_no' => $mobile_no])->first();
        if(!empty($checkMobile)){

          $id = User::where(['phone_no' => $mobile_no])
                ->update([
                  'otp' => $otp,
                  'device_token' => $device_token,
                  'device_type' => $device_type,
                ]);
        }else{

          $newData =  array(
                        'phone_no'    =>$mobile_no,
                        'otp'         =>$otp,
                        'password'    =>4,
                        // 'language'    =>$request->language,
                        'device_token'=>$device_token,
                        'device_type' =>$device_type,
                      );
          $id = User::insertGetId($newData);
        }

        if(!empty($id))
        {
          $UserInfo = User::where(['phone_no' => $mobile_no])->first();

          if($lang_type == 'English'){

            $success_msg = "OTP successfully sent. and your OTP is $otp";
          }else{

            $success_msg = $this->get_hindi_text($lang_type, "OTP successfully sent. and your OTP is $otp");
          }   

          return response()->json(["msg" => $success_msg,'userStatus'=>$UserInfo->verified_otp , 'status' => 1]);
        } else {

          if($lang_type == 'English'){

            $wrong_msg = "Something went wrong. Please try again.";
          }else{
                      
            $wrong_msg = $this->get_hindi_text($lang_type, "Something went wrong. Please try again.");
          }   
          return response()->json(['msg' => $wrong_msg, 'status' => 0]);
        }

      } else {
        return response()->json(['msg' => 'Something went wrong. Please try again.','status' => 0]);
      }
    }

    // ***** add_helper_accident ******//
    public function add_helper_accident(Request $request){

      if ($request->isMethod('post')) {

        $lang_type    = $request->language_type;

        $helper_id    = $request->helper_id;
        $accident_id  = $request->accident_id;
        $noti_type    = $request->noti_type;
        $reason       = $request->reason;

        if(!empty($lang_type)){

          if(empty($helper_id)){
            if($lang_type == 'English'){

              $helper_id_msg = "Helper id can not be null / blank.";
            }else{

              $helper_id_msg = $this->get_hindi_text($lang_type, "Helper id can not be null / blank.");
            }  
            return response()->json(['msg' => $helper_id_msg,'status' => 0]);
          }

          if(empty($accident_id)){

            if($lang_type == 'English'){

              $accident_id_msg = "Accident id can not be null / blank.";

            }else{

              $accident_id_msg = $this->get_hindi_text($lang_type, "Accident id can not be null / blank.");
            }  
            return response()->json(['msg' => $accident_id_msg,'status' => 0]);
          }

          if(empty($noti_type)){

            if($lang_type == 'English'){

              $type_msg = "Notification accept type can not be null / blank.";
            }else{

              $type_msg = $this->get_hindi_text($lang_type, "Notification accept type can not be null / blank.");
            }                
            return response()->json(['msg' => $type_msg, 'status' => 0]);
          }elseif ($noti_type == 'no') {
            if(empty($reason)){

              if($lang_type == 'English'){

                $reason_msg = "Reason can not be null / blank.";

              }else{

                $reason_msg = $this->get_hindi_text($lang_type, "Reason can not be null / blank.");
              }                
              return response()->json(['msg' => $reason_msg, 'status' => 0]);
            }
          }

        }else{

          return response()->json(['msg' => 'Please select language type.','status' => 0]);
        }
        

        $newData =  array(
                    'helper_id'    =>$helper_id,
                    'accident_id'  =>$accident_id,
                    'type'         =>$noti_type,//yes,no
                    'reason'       =>@$reason,//yes,no
                  );
        $id =  DB::table('tbl_helper_accident_rel')->insertGetId($newData);
        
        if(!empty($id))
        {
          if($lang_type == 'English'){

            $success_msg = "Success";
          }else{

            $success_msg = $this->get_hindi_text($lang_type, "Success");
          }   
          return response()->json(["msg" => $success_msg, 'status' => 1]);

        } else {

          if($lang_type == 'English'){

            $wrong_msg = "Something went wrong. Please try again.";
          }else{
                      
            $wrong_msg = $this->get_hindi_text($lang_type, "Something went wrong. Please try again.");
          }   
          return response()->json(['msg' => $wrong_msg, 'status' => 0]);
        }

      } else {
        return response()->json(['msg' => 'Something went wrong. Please try again.','status' => 0]);
      }
    }
    
    public function helper_accident_list(Request $request) {
      if ($request->isMethod('post')) {

        $lang_type  = $request->language_type;
        $helper_id  = $request->helper_id;

        if(!empty($lang_type)){

          if(empty($helper_id)){
            if($lang_type == 'English'){

              $helper_id_msg = "Helper id can not be null / blank.";
            }else{

              $helper_id_msg = $this->get_hindi_text($lang_type, "Helper id can not be null / blank.");
            }  
            return response()->json(['msg' => $helper_id_msg,'status' => 0]);
          }

          $helper_accident_list = DB::table('tbl_helper_accident_rel AS helper_accident')
                        ->join('tbl_accident AS acc', 'helper_accident.accident_id','=','acc.user_id')
                        ->select('acc.*')
                        ->orderBy('id','DESC')
                        ->where(['helper_id' => $helper_id,'helper_accident.deleted' => '0', 'helper_accident.type' => 'yes'])
                        ->get();
          if (!empty($helper_accident_list) && count($helper_accident_list) > 0) {

            foreach ($helper_accident_list as  $value) {

                if ($lang_type == 'English') {
                
                  $accident_address = $value->accident_address;

                }else{

                  $accident_address = $this->get_hindi_text($lang_type, $value->accident_address);
                }


                $accVideo   = url('/').'/public/uploads/accident/videos/'.$value->accident_video;
                $accImg     = url('/').'/public/uploads/accident/pics/'.$value->accident_pic;

                $accident_date = date('d-M-Y', strtotime($value->accident_time));
                $accident_time = date('H:i:s', strtotime($value->accident_time));
                $UserData[] = array(
                            'accident_id'     =>  isset($value->accident_id)?$value->accident_id:'',
                            'accident_address'=>  $accident_address ?? '',
                            'accident_pic'    =>  $accImg,
                            'accident_video'  =>  $accVideo,
                            'accident_date'   =>  $accident_date,
                            'accident_time'   =>  $accident_time,
                          );
            }
            return response()->json(['accident_list' => $UserData, 'status' => 1]);
          }else{

            if ($lang_type == 'English') {
                
              $no_record_msg = "No record found.";

            }else{

              $no_record_msg = $this->get_hindi_text($lang_type, "No record found.");
            }
            return response()->json(['msg' => $no_record_msg,'status' => 0]);
          }
          

        }else{

          return response()->json(['msg' => 'Please select language type.','status' => 0]);
        }
        
      }
    }
    /**___ Accident Track __**/ 
    public function dummy_notification(Request $request) {

          $device_token   = $request->device_token;
          $title      = "People for Help";
          $subtitle   = "Blood Unit Added";
          $alert_msg  = "We have added 3 blood.";
         // Put your device token here (without spaces):
         $deviceToken = trim($device_token);
           // $deviceToken = '383CEFA6298157FAF27D028F9DE814D5E58A49FBFBB1421FCE4CC21DEB9F3F1B';
          // Put your private key's passphrase here:
          $passphrase = '';

          $ctx     = stream_context_create();
          $pem_url = "Certificates.pem";

          // dd($pem_url); 
          stream_context_set_option($ctx, 'ssl', 'local_cert', $pem_url);
          stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

          // Open a connection to the APNS server
          $fp = stream_socket_client(
              'ssl://gateway.sandbox.push.apple.com:2195', $err,
              $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx
          );

          if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);

          //echo 'Connected to APNS' . PHP_EOL;

          // Create the payload body
          
          $payload = json_encode([
                'aps' => [
                    'alert' => [
                            'title'=> "TEST TITLE", 
                            'subtitle'=> "SUB TITLE", 
                            'body'=> "Now add more content to your Push Notifications!"
                          ],
                    'accident_id' => 1,
                    'sound' => 'default',
                    "category" => "CustomSamplePush",
                    'attachment-url'=> "https://pusher.com/static_logos/320x320.png",
                    'badge' => 1
                ]
            ]);
          // $body['attachment-url'] = "https://pusher.com/static_logos/320x320.png";
          

          // Encode the payload as JSON
          // $payload = json_encode($body);

          // Build the binary notification
          $msg = chr(0) . pack('n', 32) . pack('H*',$deviceToken) . pack('n', strlen($payload)) . $payload;

          // Send it to the server
         //  sleep(5);
          // $result = fwrite($fp, $msg, strlen($msg) );

          try {  
            sleep(10);                         
            $result = fwrite($fp, $msg, strlen($msg));
          }
          catch (Exception $ex) {

            // echo "test";
            // try once again for socket busy error (fwrite(): SSL operation failed with code 1.
            // OpenSSL Error messages:\nerror:1409F07F:SSL routines:SSL3_WRITE_PENDING)
            sleep(10); //sleep for 5 seconds
            $result = fwrite($fp, $msg, strlen($msg));
            if ($result)
            {
              return true;
            }
            else {
              return false;
            }
          }

          // print_r($payload);die;
          if (!$result)
            return 'Message not delivered' . PHP_EOL;
          else
            return 'Message successfully delivered' . PHP_EOL;

          // Close the connection to the server
          fclose($fp);
    }


     /*___ push notifictation send  for IOS ___*/ 
    function push_notification_ios(Request $request)
    {
        define( 'APPPATH', "http://192.168.1.236/people_for_help/" );
        // Put your device token here (without spaces):
        $deviceToken = trim($request->device_token);
        // Put your private key's passphrase here:
        $passphrase = '';

        $path = APPPATH . 'Certificates.pem';

        ////////////////////////////////////////////////////////////////////////////////

        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', $path);
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        // Open a connection to the APNS server
        $fp = stream_socket_client(
          'ssl://gateway.sandbox.push.apple.com:2195', $err,
          $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp)
          exit("Failed to connect: $err $errstr" . PHP_EOL);

        //echo 'Connected to APNS' . PHP_EOL;
         $noti_msg  = "We have added 3 blood.";
        // Create the payload body
        $body['aps'] = array(
            'alert' => $noti_msg,
            'sound' => 'default',
            // 'link_url' => $url,
            'badge' => 1,
            'title'=>'Test Dummy Notification'
        );

        // Encode the payload as JSON
        $payload = json_encode($body);

        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));
        print_r($payload);die;
        // if (!$result)
        //   echo 'Message not delivered' . PHP_EOL;
        // else
        //   echo 'Message successfully delivered' . PHP_EOL;

        // Close the connection to the server
        fclose($fp);
   
    }


}