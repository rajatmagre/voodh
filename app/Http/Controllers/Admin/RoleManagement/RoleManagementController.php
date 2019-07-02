<?php

namespace App\Http\Controllers\admin\RoleManagement;

use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;
use App\Model\Designation;
use App\Model\Staff;
use App\Model\CourseDelivery;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RoleManagementController extends Controller
{
	/*
	 Developer Name:- Vinod dhakad
	 created Date :- 16 march
	 Purpose:- Tendor Listing
	*/

	public function index(){	
        $data["staff"] = Staff::where('deleted','0')->get(['id','staff_name']);
		return view('admin.RoleManagement.RoleManagement', $data);
	}
	/******
		Get All Employee List
	******/
	public function getAllStaff(Request $request){
		$res = Staff::where(['staff_designation_id'=>$request->designation])->get(['id','staff_name']);
		/******forech***/
		//print_r($res);exit;
		$str ="<option value=''>Select Staff</option>";
		foreach ($res as  $value) {
			$str .='<option value="'.$value->id.'">'.$value->staff_name.'</option>';
		}
		echo $str;
	}
	/**************Get Alloted menu******/
	public function getAllotedMenu(Request $request)
    {
            $staff_id=$request->staff_id;

            $staff_details=DB::table('tbl_staff_master')->where(array('id'=>$staff_id,'deleted'=>'0'))->first();

            /**if staff is not empty start**/

            if(!empty($staff_details))
            {
                 /**get userv designation start**/

            $staff_type_id=$staff_details->staff_type_id;

            $data["all_menus"] = sub_menu_list_new(0,$staff_type_id,0,$staff_id);
            return view('admin.RoleManagement.ajax_alooted_menu', $data);
           }
    	
        
    }
    /***********
    update
    ***/

   public function updateMenuOld(Request $request) {
   		if ($request) {


           //  $staff_type_id = $request->designation_id;
            $menu_ids = $request->menu_ids;



            // echo "<pre>";print_r($menu_ids);
            // die();
            $staff_id  = $request->staff_id;
            $today       = date('Y-m-d H:i:s');

           
            $staff_details=DB::table('tbl_staff_master')->where(array('id'=>$staff_id,'deleted'=>'0'))->first();

            /**if staff is not empty start**/

            if(!empty($staff_details))
            {
                 /**get userv designation start**/

            $staff_type_id=$staff_details->staff_type_id;


            /**get user designation end**/
            $allot_row     = DB::table('tbl_menu_allotment')->where([
                'status' => 'active',
                 'staff_type_id' => $staff_type_id,
                'staff_id' => $staff_id
            ])->get();

          
            if (!empty($allot_row)) {
                
                DB::table('tbl_menu_allotment')->where([
                     'staff_type_id' => $staff_type_id,
                    'staff_id' => $staff_id
                ])->delete();
            }
            
            if (!empty($menu_ids)) {
                
                foreach ($menu_ids as $each_menu) {
                    
                    
                    $allot_arr = array(
                        'staff_type_id' 	=> $staff_type_id,
                        'menu_id' 			=> $each_menu,
                        'staff_id' 			=> $staff_id,
                        'created_date' 		=> $today
                    );
                    
                    $allot_id = DB::table('tbl_menu_allotment')->insert($allot_arr);
                }
                	return redirect('/role-asign-management')->with('success', 'successfully Updated.');
            		exit;

            }
        }
        /**if staff is not empty end**/
            
        }//END post id
        
   }

   public function updateMenu(Request $request) {
        if ($request) {
           // $staff_type_id = $request->designation_id;
            $menu_ids      = $request->menu_ids;
            $staff_id    = $request->staff_id;
            $today         = date('Y-m-d H:i:s');

             $staff_details=DB::table('tbl_staff_master')->where(array('id'=>$staff_id,'deleted'=>'0'))->first();

            /**if staff is not empty start**/

            echo "<pre>";print_r($menu_ids);

            if(!empty($staff_details))
            {
                 /**get userv designation start**/

            $staff_type_id=$staff_details->staff_type_id;

            $allot_row     = DB::table('tbl_menu_allotment')->where([
                'status' => 'active',
                'staff_type_id' => $staff_type_id,
                'staff_id' => $staff_id
            ])->get();

          
            if (!empty($allot_row)) {
                
                DB::table('tbl_menu_allotment')->where([
                    'staff_type_id' => $staff_type_id,
                    'staff_id' => $staff_id
                ])->delete();
            }
            
            if (!empty($menu_ids)) {
                
                foreach($menu_ids as $each_menu){
                   
                    $listing_url = $request->input('list_url'.$each_menu);
                    
                    // if (empty($add_url)) {
                    //     $add_auth = '0';
                    // } else {
                    //     $add_auth = $add_url;
                    // }
                    
                    // if (empty($edit_url)) {
                    //     $edit_auth = '0';
                    // } else {
                    //     $edit_auth = $edit_url;
                    // }
                    
                    // if (empty($delete_url)) {
                    //     $delete_auth = '0';
                    // } else {
                    //     $delete_auth = $delete_url;
                    // }
                    
                    if (empty($listing_url)) 
                    {
                        $list_auth = '0';
                    } 
                    else 
                    {
                        $list_auth = $listing_url;
                    }
                    
                    
                    
                    $allot_arr = array(
                        'staff_type_id'     => $staff_type_id,
                        'menu_id'           => $each_menu,
                        'listing_authority' => $list_auth,
                        'staff_id'          => $staff_id,
                        'created_date'      => $today
                    );
                    
                    $allot_id = DB::table('tbl_menu_allotment')->insert($allot_arr);
                }
                    return redirect('/role-asign-management')->with('success', 'successfully Updated.');
                    exit;

             }
          }

           /**if staff is not empty end**/
            
        }//END post id
        
   }


}
