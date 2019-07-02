<?php

namespace App\Http\Controllers\admin\Staff;

use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;
use App\Model\StaffType;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StaffTypeController extends Controller
{
    function __construct(StaffType $staff_types)
	{
		$this->middleware('admin'); //check admin login 
		
		$this->staff_types=$staff_types;
	}

	/**____ Staff Type Listing ___**/ 
	public function staff_type_list()
	{	
		$staff_type = $this->staff_types->where('deleted','0')->with('AdminName')->get();

		$data['staff_type'] = $staff_type; 

		return view('admin.Staff.staff_type_list', $data);
	}

	/**____ Add Staff Type ____**/ 
	public function add_staff_type(Request $request)
	{	
		if ($request->method() == 'POST') {

			/**__ Check Validation __**/ 
	            $validatedData = $request->validate(
	                [
	                    'staff_type_name' => 'required',
	                ],
	                [
	                   'staff_type_name.required' =>   'Please enter staff type name.',
	                ]
	            );
			/**__ Check Validation __**/ 

			$req_data = $request->all();
			// dd($req_data);die;

			/*___ Check Unique Validation ___*/ 
                $exist_staff_type = DB::table('tbl_staff_type_master')
                            ->where([ 'staff_type_name'=>$req_data['staff_type_name'],'deleted'=>'0'])
                            ->get();

                if (!empty($exist_staff_type) && count($exist_staff_type) > 0 ) {

                    return redirect('/add-staff-type')->with('error', 'Staff Type name already exist.');
                    exit;
                }
            /*___ Check Unique Validation ___*/

            $admin_id = Auth::guard('admin')->user()->id;//get set session Id

			$insert = 	StaffType::create([
							'staff_type_name' 	=> $req_data['staff_type_name'],
							'staff_type_status' => $req_data['staff_type_status'],
							'created_at' 		=> date('Y-m-d H:i:s'),
							'created_by' 		=> $admin_id,//insert login session id
						]);

			if ($insert) {
                
                return redirect('/staff-type-list')->with('success', 'Staff type name added successfully.');
                exit;

            }else{

                return redirect('/add-staff-type')->with('error', 'Something went wrong please try again.');
                exit;
            }

		}

		return view('admin.Staff.add_staff_type');
	}

	/**____ Edit Staff Type ____**/ 
	public function edit_staff_type(Request $request,$staff_type_id)
	{	
		$decode_staff_type_id = base64_decode($staff_type_id);
		if ($request->method() == 'POST') {

			/**__ Check Validation __**/ 
	            $validatedData = $request->validate(
	                [
	                    'staff_type_name' => 'required',
	                ],
	                [
	                   'staff_type_name.required' =>   'Please enter staff type.',
	                ]
	            );
			/**__ Check Validation __**/ 

			$req_data = $request->all();

            /*___ Check Unique Validation ___*/ 
                $exist_staff_type = $this->staff_types->where(['staff_type_name'=>$req_data['staff_type_name'],'deleted'=>'0'])->get();
                if ( !empty($exist_staff_type) && count($exist_staff_type) > 0 ) {

                    if ($exist_staff_type[0]->staff_type_id != $decode_staff_type_id) {

                        return redirect('/edit-staff-type/'.$staff_type_id)->with('error', 'Staff type already exist.');
                        exit;
                    }
                }
            /*___ Check Unique Validation ___*/
            $admin_id = Auth::guard('admin')->user()->id;//get set session Id
			$updated = 	StaffType::where('staff_type_id',$decode_staff_type_id)->update([
							'staff_type_name' 	=> $req_data['staff_type_name'],
							'staff_type_status' => $req_data['staff_type_status'],
							'updated_at' 		=> date('Y-m-d H:i:s'),
							'updated_by' 		=> $admin_id,//insert login session id
						]);

			if ($updated) {
                
                return redirect('/staff-type-list')->with('success', 'Staff type name updated successfully.');
                exit;

            }else{

                return redirect('/edit-staff-type/'.$staff_type_id)->with('error', 'Something went wrong. please try again.');
                exit;
            }

		}

		$data['edit_staff_type'] = $this->staff_types->where(['staff_type_id' => $decode_staff_type_id, 'deleted'=>'0'])->get();
		// print_r($data['edit_staff_type'][0]['staff_type_name']);die;

		return view('admin.Staff.edit_staff_type', $data);
	}

	/*___ Staff Type Delete ___*/
    public function delete_staff_type($staff_type_id)
    {
        $decode_staff_type_id = base64_decode($staff_type_id);
        $admin_id = Auth::guard('admin')->user()->id;//get set session Id
        $delete = 	StaffType::where('staff_type_id',$decode_staff_type_id)->update([
							'deleted' 			=> '1',
							'staff_type_status' => 'inactive',
							'deleted_at' 		=> date('Y-m-d H:i:s'),
							'deleted_by' 		=> $admin_id,//insert login session id
						]);
        if ($delete) {

            return redirect('/staff-type-list')->with('success', 'Staff type deleted successfully.');
            exit;

        }else{

            return redirect('/staff-type-list')->with('error', 'Something went wrong. please try again.');
            exit;
        }

    }


	
}
