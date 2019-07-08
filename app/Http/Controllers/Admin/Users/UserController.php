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
    		$all_users_details = User::where(['deleted' => '0'])->orderBy('id','DESC')->get();
            // print_r($all_users_details);die;
    		return view('Admin.Users.users_list',compact('all_users_details'));
    	}
    /**___ Users List ___**/ 

    /**___ User View details ___**/ 
        public function users_view_details($user_id){

            $decoded_id = base64_decode($user_id);

            $view_user_details = User::where(['id' => $decoded_id,'deleted' => '0'])->first();

            // print_r($view_user_details);die;
            return view('Admin.Users.users_view_details', compact('view_user_details'));
        }
    /**___ User View details ___**/ 


}
