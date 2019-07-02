<?php

namespace App\Http\Controllers\admin\SideMenus;

use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Model\Side_menu;

use App\Http\Controllers\Controller;

class SideMenuController extends Controller
{
    function __construct(Side_menu $side_menu)
	{		
		$this->side_menu=$side_menu;
	}

	public function index()
	{	
		
	}

	public function store(Request $request)
	{
	         	/**Request start**/      
	         
	          	$ValidatesRequest=$request->validate(
               	[
                   'menu_name'=>'required|unique:tbl_admin_side_menu',
                   
               	],
               	[
                   'menu_name.required'=>'Please enter menu name.',
                  
               	]);


	          	if($request->hasfile('menu_icon_image')){

            		$req_data['menu_icon_image'] = upload_file($request->file('menu_icon_image'),'/uploads/admin/menu_icons');
       			}else{
       			 	$req_data['menu_icon_image'] = '';
       			}
       			if(!empty($request->menu_parent_id)){
       				$menu_parent_id = $request->menu_parent_id;
       			}else{
       				$menu_parent_id = 0;
       			}


	          	$menu_arr=array(
	          		'menu_name'=>trim($request->menu_name),
	          		'menu_parent_id'=>trim($menu_parent_id),
	          		'menu_list_url'=>trim($request->menu_list_url),
	          		'menu_icon_image'=>trim($req_data['menu_icon_image']),
	          		'menu_status'=>trim($request->menu_status),
	          		'created_at'=>date('Y-m-d H:i:s')
	          	);

	          	$station_id = DB::table('tbl_admin_side_menu')->insertGetId($menu_arr);

          		if($station_id>0)
          		{
          			Session::flash('success', 'Menu added successfully.');
          		}
          		else
          		{
          			Session::flash('error', 'Something went wrong.');
          		}

	            return redirect('side-menu-list');

	          
	           /**Request end**/      

	}

	public function add_side_menu(Request $request)
	{
		
		$all_menus=$this->side_menu->where(array('deleted'=>'0','menu_status'=>'active'))->get();
		
		return view('Admin/Side-Menu/add_side_menu',compact(['all_menus']));

    }


    public function edit_menu($en_menuid,Request $request)
	{

		$menu_id=base64_decode($en_menuid);

		if(!empty($menu_id))
		{

			$where_menu=array('deleted'=>'0','menu_status'=>'active','menu_id'=>$menu_id);
			$menu_details=$this->side_menu->where($where_menu)->first();
			$all_menus=$this->side_menu->where(array('deleted'=>'0','menu_status'=>'active'))->get();
		
				return view('Admin/Side-Menu/edit_side_menu',compact(['menu_details','all_menus']));
		}
		

    }

     public function edit_menu_post($en_menuid,Request $request)
	 {

	 	$menuid=base64_decode($en_menuid);

	 		if(!empty($menuid))
		    {

	    	  	$ValidatesRequest=$request->validate(
               	[
                   'menu_name'=>'required',
               	],
               	[
                   'menu_name.required'=>'Please enter menu name.',
                   'menu_name.unique'=>'Please enter unique menu name.',
                  
               	]);


	          	if($request->hasfile('menu_icon_image')){

            		$req_data['menu_icon_image'] = upload_file($request->file('menu_icon_image'),'/uploads/admin/menu_icons');
       			}
       			else
       			{
       			 	$req_data['menu_icon_image'] = trim($request->old_menu_image);
       			}

	          	$menu_arr=array(
	          		'menu_name'=>trim($request->menu_name),
	          		'menu_parent_id'=>trim($request->menu_parent_id),
	          		'menu_list_url'=>trim($request->menu_list_url),
	          		'menu_icon_image'=>trim($req_data['menu_icon_image']),
	          		'menu_status'=>trim($request->menu_status),
	          		'updated_at'=>date('Y-m-d H:i:s')
	          	);


	          		DB::table('tbl_admin_side_menu')->where(array('menu_id'=>$menuid))->update($menu_arr);

	          		Session::flash('success', 'Menu updated successfully.');

	             return redirect('side-menu-list');


	        }
	        else
		    {
		   		Session::flash('error', 'Something went wrong!');
		        return redirect('side-menu-list');
		    }


	 }


 
    public function side_menu_list()
    {

        $all_menus=$this->side_menu->where(array('deleted'=>'0','menu_status'=>'active'))->get();
		return view('Admin/Side-Menu/side_menu_list',compact(['all_menus']));
    }

   

    public function delete_menu($enmenu_id,Request $request)
    {

    	$menu_id=base64_decode($enmenu_id);

    	if(!empty($menu_id))
    	{

			$this->side_menu->where(array('menu_id'=>$menu_id))->update(array('deleted'=>'1'));
			Session::flash('success', 'Menu deleted successfully.');
		    return redirect('side-menu-list');
    		
    	}
    	else
    	{
    		Session::flash('error', 'Something went wrong.');
		    return redirect('side-menu-list');
    	}

    }



	
}