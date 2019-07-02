<?php
namespace App\Http\Controllers\api\api
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Mail;
use URL;
use Helper;

DB::enableQueryLog();
class ApiController extends Controller
{ 
    public function new_registration(Request $request)
    {
    
      /*if ($request->isMethod('post')) {
          $where      = array('email' => $data->email);
          $UserData  = DB::table('tbl_user_registration')->where($where)->get();
          if(!empty($UserData) && count($UserData)>0) {
            return response()->json(['data' => 'Email Already Exists.','status' => 0]);
          }
          $newData = array('name'         => $data->name,
                'email'                 => $data->email,
                'mobile_no'             => $data->mobile_no,
                'password'            => md5($data->password),
                'created_at'            => date('Y-m-d H:i:s')
          );
      //return response()->json(['data' => $newData,'status' => '500']);
          $id = DB::table('tbl_user_registration')->insertGetId($newData);
          if(!empty($id))
          {
            $where           = array('registration_id' => $id);
                $RegisteredData  = DB::table('tbl_user_registration')->where($where)->get();
                if(!empty($RegisteredData) && count($RegisteredData)) {
                   return response()->json(['allrecord' => $RegisteredData,'status' => 1]);
                } else {
                  return response()->json(['msg' => 'Data Cannot Be Inserted.','status' => 0]);
                }
          } else {
            return response()->json(['msg' => 'Something Went Worng.','status' => 0]);
          }
      }*/
      echo "hi";
    }
}