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
/**___ Use Model ___**/ 

DB::enableQueryLog();
class ApiControllerYawal extends Controller
{ 
    /**___ translate englist to hindi ___**/ 
      public function individual_blodd_camp_details(Request $request){ 

              if($request->isMethod('post'))
              {
                  $campId    = $request->camp_id;
                  $userId    = $request->user_id;
                  $lang_type = $request->language_type; 

                  if(!empty($campId) && !empty($userId))
                  {
                        $total_credit = DB::table('tbl_blood_bank')->where(['user_id'=>$userId,'donation_type'=>'credit','status'=>'approved'])->sum('blood_unit');

                        $total_debit  = DB::table('tbl_blood_bank')->where(['user_id'=>$userId,'donation_type'=>'debit','status'=>'approved'])->sum('blood_unit');


                         $remaining_unit = (isset($total_credit)?$total_credit:'0') - (isset($total_debit)?$total_debit:'0');

                        $campDetails = DB::table('tbl_blood_camp')->select('camp_id','camp_name','camp_address','camp_letitude','camp_longitude','camp_detail','start_date','end_date')->where(['camp_id'=>$campId,'status'=>'active','deleted'=>'0'])->first();

                        $representative  = DB::table('tbl_camp_representative')
                                        ->join('tbl_staff_master', 'tbl_staff_master.id', '=', 'tbl_camp_representative.staff_id')
                                        ->where(['staff_status'=>'active','tbl_staff_master.deleted'=>'0','camp_id'=>$campId])
                                        ->select('staff_name', 'email', 'staff_contact_no')
                                        ->get();

                        if(!empty($representative) && count($representative)>0)
                        {
                              foreach($representative as $repo)
                              {

                                    if($lang_type == "English")
                                    {
                                        $staff_name  = $repo->staff_name;
                                    }
                                    else
                                    {
                                       $staff_name =  $this->get_hindi_text($lang_type,$repo->staff_name);
                                    }

                                    $staff[] = array('staff_name'  => $staff_name,
                                                'email'            => $repo->email,
                                                'staff_contact_no' => $repo->staff_contact_no
                                    );
                              }
                        }
                        else
                        {
                              $staff = array();
                        }

                      if($lang_type == "English")
                      {
                         $finaldata = array('camp_id'  => isset($campDetails->camp_id)?$campDetails->camp_id:'',
                                     'camp_name'       =>  isset($campDetails->camp_name)?$campDetails->camp_name:'',
                            'camp_address'             => isset($campDetails->camp_address)?$campDetails->camp_address:'',
                           'camp_letitude'             => isset($campDetails->camp_letitude)?$campDetails->camp_letitude:'',
                           'camp_longitude'            => isset($campDetails->camp_longitude)?$campDetails->camp_longitude:'',
                           'camp_detail'               => isset($campDetails->camp_detail)?$campDetails->camp_detail:'',
                           'start_date'                => isset($campDetails->start_date)?$campDetails->start_date:'',
                           'end_date'                  => isset($campDetails->end_date)?$campDetails->end_date:'',
                           'total_blood_unit'          => isset($remaining_unit)?$remaining_unit:'0'
                      );   

                    }
                  else
                  {
                    $finaldata = array('camp_id' => isset($campDetails->camp_id)?$campDetails->camp_id:'',
                                     'camp_name'        =>  $this->get_hindi_text($lang_type,isset($campDetails->camp_name)?$campDetails->camp_name:''),
                            'camp_address'             => $this->get_hindi_text($lang_type,isset($campDetails->camp_address)?$campDetails->camp_address:''),
                           'camp_letitude'             => isset($campDetails->camp_letitude)?$campDetails->camp_letitude:'',
                           'camp_longitude'            => isset($campDetails->camp_longitude)?$campDetails->camp_longitude:'',
                           'camp_detail'               => $this->get_hindi_text($lang_type,isset($campDetails->camp_detail)?$campDetails->camp_detail:''),
                           'start_date'                => isset($campDetails->start_date)?$campDetails->start_date:'',
                           'end_date'                  => isset($campDetails->end_date)?$campDetails->end_date:'',
                           'total_blood_unit'          => isset($remaining_unit)?$remaining_unit:'0'
                      );   


                    }

                    return response()->json(['result' => $finaldata,'staff_members'=>$staff,'status' => 1,"msg"=>"success"]);
                  }
                  else
                  {
                       $msg = $this->get_hindi_text($lang_type,'No Record Found');
                       return response()->json(['msg' => $msg ,'status' => 0]);
                  }
              }
              else
              {
                     $msg1 = $this->get_hindi_text($lang_type,'Something Went Wrong');

                     return response()->json(['msg' => $msg1,'status' => 0]);
              }

      }
    /**___End translate englist to hindi ___**/ 



    public function add_new_travel_info(Request $request)
    {
              if($request->isMethod('post'))
              {

                    if($request->hasfile('driver_image')){
                            $driver_image = upload_file($request->file('driver_image'),'/uploads/admin/user_travel_info/driver');
                    }
                    else
                    {
                          $driver_image  = "";
                    } 

                    if($request->hasfile('vehicle_image')){
                            $vehicle_image = upload_file($request->file('vehicle_image'),'/uploads/admin/user_travel_info/vehicle');
                    }
                    else
                    {
                          $vehicle_image  = "";
                    } 
                    if($request->qr_type=='yes'){
                        $travelInfo   =   array(
                                            'user_id'                => $request->user_id,
                                            'qr_type'                => $request->qr_type,
                                            'qr_code'                => $request->qr_code,
                                            'estimated_deboard_time' => $request->estimated_deboard_time,
                                            'travel_status'          => 'on_the_way',
                                            'travelling_from'        => $request->travelling_from,
                                            'travelling_to'          => $request->travelling_to,
                                            'travel_start_time'      => $request->date
                                        );
                    }else{
                        $travelInfo   =   array(
                                              'user_id'                => $request->user_id,
                                              'driver_name'            => $request->driver_name,
                                              'vehicle_no'             => $request->vehicle_no,
                                              'estimated_deboard_time' => $request->estimated_deboard_time,
                                              'travel_status'          => 'on_the_way',
                                              'travelling_from'        => $request->travelling_from,
                                              'travelling_to'          => $request->travelling_to,
                                              'travel_start_time'      => $request->date,
                                              'vehicle_image'          => $vehicle_image,
                                              'driver_image'           => $driver_image,
                                              'registration_card_no'   => $request->registration_card_no
                        );
                    }
                    $travelId  =  DB::table('tbl_user_travel_imformation')->insertGetId($travelInfo);

                    if(!empty($travelId))
                    {
                        return response()->json(['msg' =>'Imformation Added Successfully', 'status' => 1]);
                    }
                    else
                    {
                        return response()->json(['msg' => 'Something Went Wrong', 'status' => 0]);
                    }
              } 
    }


    public function get_travel_info_list(Request $request)
    {
        if($request->isMethod('post'))
        {
              $userId     = $request->user_id;
              $lang_type  = $request->language_type;
             

              $travelData  =  DB::table('tbl_user_travel_imformation')->select('travel_id','user_id','travelling_from','travelling_to','travel_start_time','travel_status')->where(['deleted'=>'0','user_id'=>$userId])->get();

                if(!empty($travelData))
                {

                		$travelList = array();	
                		foreach($travelData as $value)
                		{

                            $travel_date = date('d-M-Y', strtotime($value->travel_start_time));
                            $travel_time = date('H:i:s', strtotime($value->travel_start_time));

                            if($value->travel_status == "reached")
                            {
                                $travel_status = "Reached";
                            }
                            else if($value->travel_status == "on_the_way")
                            {
                                $travel_status = "InWay";
                            }
                            else if($value->travel_status == "in_trouble")
                            {
                                $travel_status = "In Trouble";
                            }

                			       if($lang_type == 'English')
                            {
                                  $travelList[]  = array('travel_id'     => $value->travel_id,
                                                      'user_id'          => $value->user_id,
                                                      'travelling_from'  => $value->travelling_from,
                                                      'travelling_to'    => $value->travelling_to,
                                                      'travel_date'      => $travel_date,
                                                          'travel_time'      => $travel_time,
                                                      'travel_status'    => $travel_status
                                    );
                           }

                            else
                       	 {
                              $travelList[]  = array('travel_id'       => $value->travel_id,
                                                  'user_id'            => $value->user_id,
                                                   'travelling_from'   => $this->get_hindi_text($lang_type,isset($value->travelling_from)?$value->travelling_from:''),
                                                   'travelling_to'     => $this->get_hindi_text($lang_type,isset($value->travelling_to)?$value->travelling_to:''),
                                                     'travel_date'     => $travel_date,
                                                      'travel_time'    => $travel_time,
                                                   'travel_status'     => $travel_status
                                    );
                       	 }
                		}


                        return response()->json(['travel_list' =>$travelList, 'status' => 1]);
                }
                else
                {
                      if($lang_type == "English")
                      {
                          $msg  = "No Record Found";
                      }
                      else
                      {
                         $msg   = $this->get_hindi_text($lang_type,'No Record Found');
                      }

                       return response()->json(['msg'=>$msg ,'status' => 0]);
                } 

        }
    }


    // *****************  Near and Dear **********************//

    public function add_new_near_dear(Request $request)
    {
        if($request->isMethod('post'))
        {
              $userId     = $request->user_id;
              $lang_type  = $request->lnaguage_type;

              $dupliContact =   DB::table('tbl_near_and_dear')->select('near_dear_id')->where(['deleted'=>'0','user_id'=>$userId,'mobile_no'=>$request->mobile_no])->get();

              if(!empty($dupliContact) && count($dupliContact)>0)
              {
                       if($lang_type == "English")
                      {
                          $mob_msg  = "Mobile Number Already Exists, Please Try Another One";
                      }
                      else
                      {
                         $mob_msg   = $this->get_hindi_text($lang_type,'Mobile Number Already Exists, Please Try Another One');
                      }

                       return response()->json(['msg'=>$mob_msg ,'status' => 1]);
                       die();
              }


              $dupliPriority =  DB::table('tbl_near_and_dear')->select('near_dear_id')->where(['deleted'=>'0','user_id'=>$userId,'priority'=>$request->priority])->get();

              if(!empty($dupliPriority) && count($dupliPriority)>0)
              {
                     if($lang_type == "English")
                      {
                          $pri_msg  = "Priority" .$request->priority.  "Already Selected, Please Select Another One";
                      }
                      else
                      {
                         $pri_msg   = $this->get_hindi_text($lang_type,"Priority" .$request->priority.  "Already Selected, Please Select Another One");
                      }

                       return response()->json(['msg'=>$pri_msg ,'status' => 1]);
                       die();
              }


              $newNearDear  =  array('user_id'     => $request->user_id,
                                    'first_name'   => $request->first_name,
                                    'last_name'    => $request->last_name,
                                    'mobile_no'    => $request->mobile_no,
                                    'relationship' => $request->relationship,
                                    'age'          => $request->age,
                                    'priority'     => $request->priority,
                                    'gender'       => $request->gender,
                                    'created_at'   => date('Y-m-d H:i:s')
                    );


               $NearDearId  =  DB::table('tbl_near_and_dear')->insertGetId($newNearDear);

              if(!empty($NearDearId))
              {
                      if($lang_type == "English")
                      {
                          $final_msg  = "Imformation Added Successfully";
                      }
                      else
                      {
                         $final_msg   = $this->get_hindi_text($lang_type,"Imformation Added Successfully");
                      }


                     return response()->json(['msg' =>$final_msg, 'status' => 1]);
              }
              else
              {

                        if($lang_type == "English")
                      {
                          $error_msg  = "Something Went Wrong";
                      }
                      else
                      {
                         $error_msg   = $this->get_hindi_text($lang_type,"Something Went Wrong");
                      }

                     return response()->json(['msg' => $error_msg, 'status' => 0]);
              }

        }
    }

    // **********************************************************//



    // ***************  Near and Dear List **********************//

    public function get_near_dear_list(Request $request)
    {
          if($request->isMethod('post'))
          {

                $userId     = $request->user_id;
                $lang_type  = $request->language_type;

                $NeardearList =  DB::table('tbl_near_and_dear')->select('*')->where(['deleted'=>'0','user_id'=>$userId])->orderBy('priority', 'ASC')->get();

                if(!empty($NeardearList) && count($NeardearList)>0)
                {
                      foreach($NeardearList as $value)
                      {
                            if($lang_type == "English")
                            {
                                  $nearList[]   = array('near_dear_id'   => $value->near_dear_id,
                                                        'first_name'     => $value->first_name,
                                                        'last_name'      => $value->last_name,
                                                        'mobile_no'      => $value->mobile_no,
                                                        'age'            => $value->age,
                                                        'gender'         => $value->gender,
                                                        'priority'       => $value->priority,
                                                        'relationship'   => $value->relationship
                                      );
                            }
                            else
                            {
                                  $nearList[]  = array('near_dear_id'    => $value->near_dear_id,
                                                        'first_name'     => $this->get_hindi_text($lang_type,$value->first_name),
                                                        'last_name'      => $this->get_hindi_text($lang_type,$value->last_name),
                                                        'mobile_no'      => $value->mobile_no,
                                                        'age'            => $value->age,
                                                        'gender'         => $this->get_hindi_text($lang_type,$value->gender),
                                                        'priority'       => $value->priority,
                                                        'relationship'   => $this->get_hindi_text($lang_type,$value->relationship)
                                      );
                            }
                      }

                        return response()->json(['near_dear_list' =>$nearList, 'status' => 1]);
                }
                else
                {
                              if($lang_type == "English")
                            {
                                $msg  = "No Record Found";
                            }
                            else
                            {
                               $msg   = $this->get_hindi_text($lang_type,'No Record Found');
                            }

                             return response()->json(['msg'=>$msg ,'status' => 0]);
                }
          }
    }

    

    //***************************************************************//


     public function get_hindi_text($language_type, $get_english_text){ 

        $apiKey = 'AIzaSyCYjghtMIGCbMCCI_YzN595LVQrZdsn2RY'; // live key
               
        $text = $get_english_text;
        if ($language_type == 'Hindi') {

          $lang_type = 'hi';

        }elseif ($language_type == 'Panjabi') {
          
          $lang_type = 'en';
        }
        else{
           $lang_type = 'en';
        }
        
        $url = 'https://www.googleapis.com/language/translate/v2?key=' . $apiKey . '&q=' . rawurlencode($text) . '&source=en&target='.$lang_type;

        $handle = curl_init($url);
        
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($handle);                 
        
        $responseDecoded = json_decode($response, true);
        
        curl_close($handle);

        //d($responseDecoded);

        return $responseDecoded['data']['translations'][0]['translatedText'];

      }
 


}