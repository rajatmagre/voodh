<?php
/*
	Created By Kp
*/
namespace App\Http\Controllers\admin\Category;

use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;
use App\Model\Category;
use Mail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    function __construct()
	{

	}
    //Global Function for upload Single image
    function upload_file($file,$path)
    {
       $image = $file;
       $imagename = Str::slug($image->getClientOriginalName(), '-').'.'.$image->getClientOriginalExtension();
       $destinationPath = public_path($path);
       $image->move($destinationPath, $imagename);

       return $imagename;
    }

	public function category_list()
	{	
		$all_category_details = Category::where(['deleted' => '0'])->orderBy('cat_id','ASC')->get();
        // echo "<pre>";
        // print_r($all_category_details);die();
		return view('Admin.Category.category_list',compact('all_category_details'));
	}

	public function add_category(Request $request)
	{	
		if ($request->method() == 'POST') {
            /**__ Check Validation __**/ 
                $validatedData = $request->validate(
                    [
                        'cat_name'         	    => 'required|unique:tbl_category',
                    ],
                    [
                        'cat_name.unique'       =>  'Category already exist.',
                        'cat_name.required'     =>  'Please enter category name.',
                    ]
                );

            /**__ Check Validation __**/ 

            $admin_id = Auth::guard('admin')->user()->id;//get set session Id

            if($request->hasfile('cat_image')){

                $cat_img = $this->upload_file($request->file('cat_image'),'/uploads/admin/cat_images');
            }else{

                $cat_img = '';
            }
            if($request['parent_cat_id']){
                $parent_cat_id = $request['parent_cat_id'];
            }else{
                $parent_cat_id = 0;
            }

            $insert =   Category::create([
	                        'cat_name'  			=> $request['cat_name'],
	                        'parent_cat_id'         => $parent_cat_id,
                            'cat_image'             => $cat_img,
	                        'cat_status'         	=> $request['cat_status'],
	                        'created_at'            => date('Y-m-d H:i:s'),
	                        'created_by'            => $admin_id,
	                    ]);
             
          
	        if ($insert) {

	            // return redirect('/category-list')->with('success', 'Category details added successfully.');
                return redirect('/add-category')->with('error', 'Something went wrong please try again.');
	            exit;

	        }else{

	            return redirect('/add-category')->with('error', 'Something went wrong please try again.');
	            exit;
	        }
        }

        $data['all_parent_cats'] = Category::where(['deleted' => '0'])->orderBy('cat_id','ASC')->get();
        
		return view('Admin.Category.add_category',$data );
	}

	public function edit_category(Request $request,$cat_id)
	{	
		$decode_cat_id = base64_decode($cat_id);
		if ($request->method() == 'POST') {


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

                $profile_img = $this->upload_file($request->file('staff_image'),'/uploads/admin/staff_images');
            }else{

                $profile_img = $request['old_staff_image'];
            }

            $update =   Category::where('id',$decode_cat_id)->update([
                            'cat_name'              => $request['cat_name'],
                            'parent_cat_id'         => $parent_cat_id,
                            'cat_image'             => $cat_img,
                            'cat_status'            => $request['cat_status'],
                            'updated_at'            => date('Y-m-d H:i:s'),
                            'updated_by'            => $admin_id,//insert login session id
                        ]);
            /*_____ Update _____*/ 

            if ($update) {
	            
	            return redirect('/category-list')->with('success', 'Category details updated successfully.');
	            exit;

	        }else{

	            return redirect('/edit-category/'.$cat_id)->with('error', 'Something went wrong please try again.');
	            exit;
	        }
        }

		return view('Admin.Category.edit_category',$data);
	}

	/*___ Staff Delete ___*/
    public function delete_category($cat_id)
    {
        $decode_cat_id = base64_decode($cat_id);

        $admin_id = Auth::guard('admin')->user()->id;//get set session Id

        $delete =   Staff::where('id',$decode_cat_id)->update([
                            'deleted'       => '1',
                            'cat_status' => 'inactive',
                            'deleted_at'    => date('Y-m-d H:i:s'),
                            'deleted_by'    => $admin_id,//insert login session id
                        ]);
        if ($delete) {

            return redirect('/category-list')->with('success','Category details deleted successfully.');
            exit;

        }else{

            return redirect('/category-list')->with('error', 'Something went wrong. please try again.');
            exit;
        }

    }

}
