<?php
/*
	Created By Kp
*/
namespace App\Http\Controllers\Admin\Users;

use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;
use App\Model\User;
use Mail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    function __construct()
	{
        $this->middleware('admin'); //check admin login 
	}

    /**___ Users List ___**/ 
    	public function users_list()
    	{	
    		$all_users_details = User::where(['deleted' => '0'])->orderBy('user_id','DESC')->get();
            // print_r($all_users_details);die;
    		return view('Admin.Users.users_list',compact('all_users_details'));
    	}
    /**___ Users List ___**/ 

    /**___ User View details ___**/ 
        public function users_view_details($user_id){

            $decoded_id = base64_decode($user_id);

            $view_user_details = User::where(['user_id' => $decoded_id,'deleted' => '0'])->first();

            // print_r($view_user_details);die;
            return view('Admin.Users.users_view_details', compact('view_user_details'));
        }
    /**___ User View details ___**/ 

    /**___ Show User Accedent Details ___**/ 
        public function user_accident_details($user_id){

            $decoded_id = base64_decode($user_id);
            $accedent_details = DB::table('tbl_accident')
                    ->join('tbl_user_registration AS user_reg', 'tbl_accident.user_id', '=', 'user_reg.user_id')
                    ->leftjoin('tbl_staff_master', 'tbl_accident.assign_by', '=', 'tbl_staff_master.id')
                    ->select('tbl_accident.*', 'user_reg.first_name','user_reg.last_name','tbl_vehicle.vehicle_no','tbl_staff_master.staff_name')
                    ->orderBy('accident_id','DESC')
                    ->where(['tbl_accident.user_id' => $decoded_id, 'user_reg.deleted' => '0'])
                    ->get();
            return view('Admin.Users.user_accident_details', compact('accedent_details'));
        }
    /**___ End Show User Accedent Details ___**/

}
