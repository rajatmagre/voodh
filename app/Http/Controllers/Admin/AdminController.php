<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Model\Staff;
use Hash;


class AdminController extends Controller
{
    function __construct(Staff $staff)
	{
		
		$this->staff=$staff;
		
	}

	public function login(Request $request)
	{	

		$admin_cookie=\Auth::guard('admin')->getRecallerName();

		$cookie_val=$request->cookie($admin_cookie);


        if($cookie_val!=null)
        {
            \Auth::guard('admin')->viaRemember();

            return redirect('admin-dashboard');
        }
        else
        {
        	return view('Admin.login');
        }
		
	}	


	public function change_password(Request $request)
	{
		return view('Admin.change_password');
	}


	public function change_pass(Request $request)
	{

		$validatedData = $this->validate($request,[
            'current_password' => 'required',
            'new_pass' => 'required|min:6',
            'repass'=>'required'
           ],
	       [
	       	'current_password.required'=>'Please enter current password.',
	       	'new_pass.required'=>'Please enter new password.',
	       	'new_pass.min'=>'Minimum password length is 6.',
	       	'repass.required'=>'Please enter re-enter password.',
	       ]
	   	);


		
		if (!(Hash::check($request->get('current_password'),Auth::guard('admin')->user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not match with the password you provided. Please try again.");
        }
 
        if(strcmp($request->get('current_password'), $request->get('new_pass')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
 
       
 
        //Change Password
        $user_id = Auth::guard('admin')->user()->id;
   

        DB::table('tbl_staff_master')->where('id',$user_id)->update(array('password'=>bcrypt($request->get('new_pass'))));
       
 
        return redirect()->back()->with("success","Password changed successfully.");

	}

	public function forget_password(Request $request)
	{
		return view('Admin.forget_pass');
	}

	public function stateList(Request $request){
			
		$countryId = $request->country_id;

		$state = State::where('country_id',$countryId)->get();

		return $state;
		
	}

	public function cityList(Request $request){
			
		$stateId = $request->state_id;

		$city = City::where('state_id',$stateId)->get();

		return $city;
		
	}

	/**____ Kamlesh Work____**/ 
		/*__ Update staff profile __*/
		public function staff_update_profile(Request $request){

			$staff_id = Auth::guard('admin')->user()->id;

	        if ($request->method() == 'POST') {

	            /**__ Check Validation __**/ 
	                $validatedData = $request->validate(
	                    [
	                        'staff_name'  			=> 'required',
	                        'staff_contact_no'      => 'required',
	                        'staff_employee_id'     => 'required',
	                    ],
	                    [
	                       'staff_name.required'  		=>  'Please enter your name',
	                       'staff_contact_no.required'  =>  'Please enter contact number.',
	                       'staff_employee_id.required' =>  'Please enter your employee code.',
	                    ]
	                );
	            /**__ Check Validation __**/

	            $exist_number = $this->staff->where(['staff_contact_no' => $request['staff_contact_no'], 'deleted'=>'0'])->whereNotIn('id', [$staff_id])->first();
	            if (!empty($exist_number)) {
	            	
            		return redirect('/staff-update-profile')->with('error', 'Mobile number already exist.');
	            	exit;
	            }
	            /*_____ Update _____*/ 
		            if($request->hasfile('staff_image')){

		                $profile_img = upload_file($request->file('staff_image'),'/uploads/admin/staff_images');
		            }else{

		                $profile_img = $request['old_staff_image'];
		            }

		            $update =   Staff::where('id',$staff_id)->update([
		                            'staff_name'            => $request['staff_name'],
		                            'staff_employee_id'     => $request['staff_employee_id'],
		                            'staff_contact_no'      => $request['staff_contact_no'],
		                            'staff_profile_image'   => $profile_img,
		                            'updated_at'            => date('Y-m-d H:i:s'),
		                            'updated_by'            => $staff_id,//insert login session id
	                        	]);

		            $userSession = [

		            	'staff_name' 		  => $request['staff_name'],
		            	'staff_profile_image' => $profile_img,
		            ];
		            
		            Session::put($userSession);
	            /*_____ Update _____*/ 

	            if ($update) {
		            
		            return redirect('/staff-update-profile')->with('success', 'Your details updated successfully.');
		            exit;

		        }else{

		            return redirect('/staff-update-profile')->with('error', 'Something went wrong please try again.');
		            exit;
		        }
	        }



			$staff_type_id= Auth::guard('admin')->user()->staff_type_id;

			if($staff_type_id!=1)
			{
	        
	            $edit_staff_details = 	DB::table('tbl_staff_master AS staff')
									    ->join('tbl_staff_designation_master AS desig', 'desig.designation_id', '=', 'staff.staff_designation_id')
									    ->join('tbl_staff_type_master AS staff_type','staff_type.staff_type_id', '=','staff.staff_type_id')
									    ->select('staff.*','desig.designation_name','staff_type.staff_type_name')
									    ->where('staff.id', $staff_id)
									    ->get(); 
			}
			else
			{
				 $edit_staff_details = 	DB::table('tbl_staff_master AS staff')
								    ->leftJoin('tbl_staff_designation_master AS desig', 'desig.designation_id', '=', 'staff.staff_designation_id')
								    ->join('tbl_staff_type_master AS staff_type','staff_type.staff_type_id', '=','staff.staff_type_id')
								    ->select('staff.*','desig.designation_name','staff_type.staff_type_name')
								    ->where('staff.id', $staff_id)
								    ->get(); 

			}

	        return view('Admin.staff_update_profile', compact('edit_staff_details'));
		}
		/*__ End Update staff profile __*/ 

		/*__ Update View profile __*/
		public function staff_view_profile(){

			$staff_id = Auth::guard('admin')->user()->id;

			$staff_type_id = Auth::guard('admin')->user()->staff_type_id;

			if($staff_type_id!=1)
			{
				$view_staff_details = 	DB::table('tbl_staff_master AS staff')
								    ->join('tbl_staff_designation_master AS desig', 'desig.designation_id', '=', 'staff.staff_designation_id')
								    ->join('tbl_staff_type_master AS staff_type','staff_type.staff_type_id', '=','staff.staff_type_id')
								    ->select('staff.*','desig.designation_name','staff_type.staff_type_name')
								    ->where('staff.id', $staff_id)
								    ->get(); 
			}
			else
			{

				$view_staff_details = 	DB::table('tbl_staff_master AS staff')
								    ->leftJoin('tbl_staff_designation_master AS desig', 'desig.designation_id', '=', 'staff.staff_designation_id')
								    ->join('tbl_staff_type_master AS staff_type','staff_type.staff_type_id', '=','staff.staff_type_id')
								    ->select('staff.*','desig.designation_name','staff_type.staff_type_name')
								    ->where('staff.id', $staff_id)
								    ->get(); 

			}

            

	        return view('Admin.staff_view_profile', compact('view_staff_details'));
		}
		/*__ End Update View profile __*/ 
	/**____ End Kamlesh Work____**/ 

	
}