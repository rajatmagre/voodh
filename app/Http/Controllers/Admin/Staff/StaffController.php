<?php
/*
	Created By Kp
*/
namespace App\Http\Controllers\admin\Staff;

use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;
use App\Model\Staff;
use Mail;
use App\Model\Designation;
use App\Model\StaffType;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StaffController extends Controller
{
    function __construct(Staff $staff, Designation $designation, StaffType $staff_type)
	{
        $this->middleware('admin'); //check admin login 
		$this->staff 		=	$staff;
		$this->designation 	= 	$designation;

		$this->staff_type 	= 	$staff_type;
	}

	public function staff_list()
	{	
		$all_staff_details = DB::table('tbl_staff_master AS staff')
            ->join('tbl_staff_designation_master AS desing', 'staff.staff_designation_id', '=', 'desing.designation_id')
            ->join('tbl_staff_type_master AS staff_type', 'staff.staff_type_id', '=', 'staff_type.staff_type_id')
            ->select('staff.*', 'desing.designation_name', 'staff_type.staff_type_name')
			->where('staff.deleted','0') 
            ->get();

         

		return view('Admin.Staff.staff_list',compact('all_staff_details'));
	}

	public function add_staff(Request $request)
	{	
		if ($request->method() == 'POST') {
      
            /**__ Check Validation __**/ 
                $validatedData = $request->validate(
                    [
                        'email'         	    => 'required|email|unique:tbl_staff_master',
                        'staff_employee_id'     => 'required|unique:tbl_staff_master',
                        'staff_contact_no'      => 'required|unique:tbl_staff_master',
                    ],
                    [
                       'staff_employee_id.required'     =>  'Please enter staff employee code.',
                       'staff_employee_id.unique'       =>  'Staff employee code already exist.',
                       'email.required'                 =>  'Please enter staff email.',
                       'email.unique'                   =>  'Staff email already exist.',
                       'staff_contact_no.required'      =>  'Please enter contact number.',
                       'staff_contact_no.unique'        =>  'Contact number already exist.',
                     
                    ]
                );

            


            /**__ Check Validation __**/ 

            $admin_id = Auth::guard('admin')->user()->id;//get set session Id

            if($request->hasfile('staff_image')){

                $profile_img = upload_file($request->file('staff_image'),'/uploads/admin/staff_images');
            }else{

                $profile_img = '';
            }

            $password = '123456';

            $insert =   Staff::create([
	                        'staff_name'  			=> $request['staff_name'],
	                        'staff_employee_id'  	=> $request['staff_employee_id'],
	                        'staff_designation_id'  => 1,
	                        'staff_type_id'  		=> $request['staff_type_id'],
                            'email'                 => $request['email'],
	                        'password'              => bcrypt($password),
                            'staff_contact_no'      => $request['staff_contact_no'],
	                        'staff_profile_image'   => $profile_img,
	                        'staff_status'         	=> $request['staff_status'],
	                        'created_at'            => date('Y-m-d H:i:s'),
	                        'created_by'            => $admin_id,
	                    ]);
             
          
	        if ($insert) {
                /* for mail */ 

                $email = $request['email'];
                 
                 // Mail::send('emails.staff_emails',['name'=> $request['staff_name'], 'email'=> $request['email'], 'password' => $password ], function ($message) use ($email){

                 //              $message->from('questtestmail@gmail.com', 'Indian Aviation Academy');
                 //              $message->to($email);
                 //              $message->subject('IAA Nomination');
                 //    }); 

	            return redirect('/staff-list')->with('success', 'Staff details added successfully.');
	            exit;

	        }else{

	            return redirect('/add-staff')->with('error', 'Something went wrong please try again.');
	            exit;
	        }
        }

		$data['all_designation']= $this->designation->where(['designation_status'=>'active','deleted'=>'0'])->get();

		$data['all_staff_type'] = $this->staff_type->where(['staff_type_status'=>'active','deleted'=>'0'])->get();

		return view('Admin.Staff.add_staff',$data );
	}

	public function edit_staff(Request $request,$staff_id)
	{	
		$decode_staff_id = base64_decode($staff_id);
		if ($request->method() == 'POST') {

            /**__ Check Validation __**/ 
                // $validatedData = $request->validate(
                //     [
                //         'staff_name'  			=> 'required',
                //         'staff_designation_id'  => 'required',
                //         'staff_type_id'  		=> 'required',
                //         'staff_station_id'  	=> 'required',
                //         'email'         	=> 'required|email',
                //         'staff_employee_id'     => 'required',
                //         'staff_contact_no'      => 'required',
                //         'staff_status'         	=> 'required',
                //     ],
                //     [
                //        'staff_name.required'  			=>  'Please enter staff name',
                //        'staff_employee_id.required'     =>  'Please enter staff employee code.',
                //        'staff_designation_id.required'  =>  'Please select staff designation.',
                //        'staff_type_id.required'  		=>  'Please select staff type.',
                //        'staff_station_id.required'  	=>  'Please select staff station ',
                //        'email.required'         	    =>  'Please enter staff email.',
                //        'staff_contact_no.required'      =>  'Please enter contact number.',
                //        'staff_status.required'         	=>  'Please select status.',
                //     ]
                // );
            /**__ Check Validation __**/

            $exist_email = $this->staff->where(['email' => $request['staff_email'], 'deleted'=>'0'])->first();
            if (!empty($exist_email)) {
            	
            	if ($exist_email['id'] != $decode_staff_id) {

            		return redirect('/edit-staff/'.$staff_id)->with('error', 'Email already exist.');
	            	exit;
            	}
            }

            $exist_mobile_no = $this->staff->where(['staff_contact_no' => $request['staff_contact_no'], 'deleted'=>'0'])->first();
            if (!empty($exist_mobile_no)) {
            	
            	if ($exist_mobile_no['id'] != $decode_staff_id) {

            		return redirect('/edit-staff/'.$staff_id)->with('error', 'Mobile number already exist.');
	            	exit;
            	}
            }

            $admin_id = Auth::guard('admin')->user()->id;//get set session Id
            // print_r($request->all());die;
            /*_____ Update _____*/ 
            if($request->hasfile('staff_image')){

                $profile_img = upload_file($request->file('staff_image'),'/uploads/admin/staff_images');
            }else{

                $profile_img = $request['old_staff_image'];
            }

            $update =   Staff::where('id',$decode_staff_id)->update([
                            'staff_name'            => $request['staff_name'],
                            'staff_employee_id'     => $request['staff_employee_id'],
                            'staff_type_id'         => $request['staff_type_id'],
                            'email'             => $request['staff_email'],
                            'staff_contact_no'      => $request['staff_contact_no'],
                            'staff_profile_image'   => $profile_img,
                            'staff_status'          => $request['staff_status'],
                            'updated_at'            => date('Y-m-d H:i:s'),
                            'updated_by'            => $admin_id,//insert login session id
                        ]);
            /*_____ Update _____*/ 

            if ($update) {
	            
	            return redirect('/staff-list')->with('success', 'Staff details updated successfully.');
	            exit;

	        }else{

	            return redirect('/edit-staff/'.$staff_id)->with('error', 'Something went wrong please try again.');
	            exit;
	        }
        }

		$data['all_designation']= $this->designation->where(['designation_status'=>'active','deleted'=>'0'])->get();

		$data['all_staff_type'] = $this->staff_type->where(['staff_type_status'=>'active','deleted'=>'0'])->get();
		// $data['all_station'] 	= $this->station->where(['station_status' => 'active','deleted'=>'0'])->get();

		$data['edit_staff_details'] = $this->staff->where(['id' => $decode_staff_id, 'deleted'=>'0'])->first();

		return view('Admin.Staff.edit_staff',$data);
	}

	/*___ Staff Delete ___*/
    public function delete_staff($staff_id)
    {
        $decode_staff_id = base64_decode($staff_id);

        $admin_id = Auth::guard('admin')->user()->id;//get set session Id

        $delete =   Staff::where('id',$decode_staff_id)->update([
                            'deleted'       => '1',
                            'staff_status' => 'inactive',
                            'deleted_at'    => date('Y-m-d H:i:s'),
                            'deleted_by'    => $admin_id,//insert login session id
                        ]);
        if ($delete) {

            return redirect('/staff-list')->with('success','Staff details deleted successfully.');
            exit;

        }else{

            return redirect('/staff-list')->with('error', 'Something went wrong. please try again.');
            exit;
        }

    }

}
