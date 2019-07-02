<?php

namespace App\Http\Controllers\admin\Designation;

use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;
use App\Model\Designation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DesignationController extends Controller
{	
	function __construct(Designation $designation)
	{   
        $this->middleware('admin');
		$this->designation=$designation;
	}

    public function index()
    {
    	return view('admin.Designation.add_edit_designation');
    }

    public function create(Request $request)
    {

        $this->validate($request, [
        'designation_name' =>'required|string|max:255',
        'designation_name_hn' =>'required|string|max:255',
        'designation_status' =>'required',
        ],
        [
               
               'designation_name.required'    =>'Please enter designation name in english.', 
               'designation_name_hn.required'=>'Please enter designation name in hindi.', 
               'designation_status.required'=>'Please enter Status.', 
               
        ]);

        $admin_id = Auth::guard('admin')->user()->id;//get set session Id

         $dataInsert = [

                'designation_name'   => $request->designation_name,
    	        'designation_name_hn'=> $request->designation_name_hn,
    	        'designation_status' => $request->designation_status,
    	        'created_at'         => date('Y/m/d H:i:s'),
    	        'created_by'         => $admin_id, 
         ];   
    
    	Session::flash('success','Designation Added Successfully.');

        $where =  [
            
            'designation_name' => $request->designation_name,
        ];   
        
    	Designation::updateOrCreate($where,$dataInsert);

    	return redirect('designation-list');
    	
    }
    public function edit($id)
    {
        
    	$designation=DB::table('tbl_staff_designation_master')->where('designation_id',base64_decode($id))->first();
    	return view('admin.Designation.add_edit_designation',compact('designation'));

    }

    public function update(Request $request,$id)
    {
        $admin_id = Auth::guard('admin')->user()->id;//get set session Id

    	$upt=[];
        $upt['designation_name']   = $request->designation_name;
    	$upt['designation_name_hn']= $request->designation_name_hn;
    	$upt['designation_status'] = $request->designation_status;
    	$upt['updated_at']         = date('Y/m/d H:i:s');
    	$upt['updated_by']         = $admin_id;

    	$designation=DB::table('tbl_staff_designation_master')->where('designation_id',base64_decode($id))->update($upt);

    	Session::flash('success','Designation Updated Successfully.');
    	return redirect('designation-list');
    }


    public function designation_list()
    {	
    	
    	$designation_list=$this->designation->where('deleted',1)->with('user_details')->get();
    	// $designation_list=DB::table('tbl_staff_designation_master')->get();
    	return view('admin.Designation.designation_list',compact('designation_list'));
    }

    public function delete($id)
    {   
    	$del=[];
    	$del['deleted_at']=date('Y/m/d H:i:s');
    	$del['deleted']='1';
    	$del['deleted_by']=1;
    	// return $del;
    	DB::table('tbl_staff_designation_master')->where('designation_id',base64_decode($id))->update($del);
    	Session::flash('success','Designation Deleted Successfully.');
    	return redirect('designation-list');

    }
}
