<?php
/* Create By Kamlesh */ 

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Auth;


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
         $admin_id=Auth::guard('admin')->user()->id;

        return view('Admin.dashboard');
    }

    /*___ Front menu Listing ___*/ 
    public function front_menu_list()
    {
        $all_menu =  DB::table('tbl_front_menu')->orderBy('menu_id','DESC')->where([ 'deleted'=>'0' ] )->get();

        if (!empty($all_menu)) {
            foreach ($all_menu as $each_menu) {

                /**___ Get Menu Parent Name ___**/ 
                $parent_menu_name_en = DB::table('tbl_front_menu')->where([ 'menu_id'=>$each_menu->menu_parent_id,'deleted'=>'0'])->value('menu_name_en');
                if(!empty($parent_menu_name_en))
                {
                    $each_menu->parent_name=$parent_menu_name_en;
                }
                else
                {
                    $each_menu->parent_name="";
                }

                /**___ Get Staff Name___**/ 
              
            }
        }        

        $data['front_menu_list'] = $all_menu;

        return view('Admin.Front_Menu.front_menu_list', $data);
    }

    /*___ Front menu Add & View ___*/ 
    public function add_front_menu(Request $request)
    {
        if ($_POST) {

            /**__ Check Validation __**/ 
            $validatedData = $request->validate(
                [
                    'menu_name_en'  => 'required|unique:tbl_front_menu',
                    'menu_name_hn'  => 'required|unique:tbl_front_menu',
                    'menu_url'      => 'required|unique:tbl_front_menu',
                    'menu_status'   => 'required',
                ],
                [
                   'menu_name_en.required'  =>   'Please enter menu name(English).',
                   'menu_name_en.unique'    =>   'Menu name already exist(English).',
                   'menu_name_hn.required'  =>   'Please enter menu name(Hindi).',
                   'menu_name_hn.unique'    =>   'Menu name already exist(Hindi).',
                   'menu_url.required'      =>   'Please enter menu URL.',
                   'menu_url.unique'        =>   'Menu URL already exist.',
                   'menu_status'            =>   'Please select menu status.',
                ]
            );

            $data = $request->all();//get all form values

            $menu_name_en = $data['menu_name_en'];
            $menu_name_hn = $data['menu_name_hn'];
            $parent_menu  = $data['parent_menu'];
            $menu_status  = $data['menu_status'];
            $menu_url  = $data['menu_url'];
            // $menu_url     = $this->createurl($menu_name_en);
            
            if (!empty($parent_menu)) {
                $parent_menu = $parent_menu;
            }else{
                $parent_menu = 0;
            }

            $admin_id=Auth::guard('admin')->user()->id;

            $insert = DB::table('tbl_front_menu')
                        ->insert(
                            ['menu_name_en' => $menu_name_en,
                            'menu_name_hn'  => $menu_name_hn,
                            'menu_parent_id'=> $parent_menu,
                            'menu_url'      => $menu_url,
                            'menu_status'   => $menu_status,
                            'created_at'    => date('Y-m-d H:i:s'),
                            'created_by'    => $admin_id,//insert session id
                            ]
                        );

            if ($insert) {

                return redirect('/front-menu-list')->with('success', 'Menu added successfully.');
                exit;

            }else{

                return redirect('/add-front-menu')->with('error', 'Something went wrong please try again.');
                exit;
            }

        }

        $data['parent_menu_list'] =  DB::table('tbl_front_menu')
                            ->where([ 'menu_parent_id' => 0, 'menu_status' => 'active', 'deleted'=>'0'])
                            ->get();

        return view('Admin.Front_Menu.add_front_menu', $data );
    }

    /*___ Front menu Edit ___*/
    public function edit_front_menu(Request $request,$menu_id)
    {
        $decoded_menu_id = base64_decode($menu_id);
        if ($_POST) {

            /**__ Check Validation __**/ 
            $validatedData = $request->validate(
                [
                    'menu_name_en'  => 'required',
                    'menu_name_hn'  => 'required',
                    'menu_url'      => 'required',
                    'menu_status'   => 'required',
                ],
                [
                   'menu_name_en.required'  =>   'Please enter menu name(English).',
                   'menu_name_hn.required'  =>   'Please enter menu name(Hindi).',
                   'menu_url.required'      =>   'Please enter menu URL.',
                   'menu_status.required'   =>   'Please select menu status.',
                ]
            );

            $data = $request->all();
            
            /*___ Check Unique Validation En/Hn Menu and URL ___*/ 
                $en_exist_menu = DB::table('tbl_front_menu')
                            ->where(['menu_name_en'=>$data['menu_name_en'],'deleted'=>'0'])
                            ->get();

                            // print_r($data['menu_name_en']);die;

                if (!empty($en_exist_menu) && count($en_exist_menu) > 0) {

                    if ($en_exist_menu[0]->menu_id != $decoded_menu_id) {

                        return redirect('/edit-front-menu/'.$menu_id)->with('error', 'Menu name already exist(English).');
                        exit;
                    }
                }

                $menu_name_hn = DB::table('tbl_front_menu')
                            ->where(['menu_name_hn'=>$data['menu_name_hn'],'deleted'=>'0'])
                            ->get();

                if (!empty($menu_name_hn)  && count($menu_name_hn) > 0) {

                    if ($menu_name_hn[0]->menu_id != $decoded_menu_id) {

                        return redirect('/edit-front-menu/'.$menu_id)->with('error', 'Menu name already exist(Hindi).');
                        exit;
                    }
                }

                $menu_url = DB::table('tbl_front_menu')
                            ->where(['menu_url'=>$data['menu_url'],'deleted'=>'0'])
                            ->get();

                if (!empty($menu_url)  && count($menu_url) > 0) {

                    if ($menu_url[0]->menu_id != $decoded_menu_id) {

                        return redirect('/edit-front-menu/'.$menu_id)->with('error', 'Menu URL already exist.');
                        exit;
                    }
                }
            /*___ Check Unique Validation ___*/ 

            $menu_name_en = $data['menu_name_en'];
            $menu_name_hn = $data['menu_name_hn'];
            $parent_menu  = $data['parent_menu'];
            $menu_status  = $data['menu_status'];
            $menu_url     = $data['menu_url'];
            // $menu_url     = $this->createurl($menu_name_en);
            
            if (!empty($parent_menu)) {
                $parent_menu = $parent_menu;
            }else{
                $parent_menu = 0;
            }


            $admin_id=Auth::guard('admin')->user()->id;

            $update = DB::table('tbl_front_menu')
                ->where('menu_id', $decoded_menu_id)
                ->update(
                    ['menu_name_en' => $menu_name_en,
                    'menu_name_hn'  => $menu_name_hn,
                    'menu_parent_id'=> $parent_menu,
                    'menu_url'      => $menu_url,
                    'menu_status'   => $menu_status,
                    'updated_at'    => date('Y-m-d H:i:s'),
                    'updated_by'    => $admin_id,//insert session id
                    ]
                );
            if ($update) {

                return redirect('/front-menu-list')->with('success', 'Menu Updated successfully.');
                exit;

            }else{
                return redirect('/edit-front-menu/'.$menu_id)->with('error', 'Something went wrong please try again.');
                exit;
            }


        }

        /**___ get menu details __**/ 
        if (!empty($decoded_menu_id)) {

            $data['edit_menu_details'] =  DB::table('tbl_front_menu')
                                            ->where([ 'menu_id' => $decoded_menu_id,'deleted'=>'0'])
                                            ->first();
        }

        /*____ get all menu ____*/ 
        $data['parent_menu_list'] = DB::table('tbl_front_menu')
                                    ->where([ 'menu_parent_id' => 0,'menu_status' => 'active', 'deleted'=>'0'])
                                    ->get();

        return view('Admin.Front_Menu.edit_front_menu', $data);

    }

    /*___ Front menu Delete ___*/
    public function delete_front_menu($menu_id)
    {
        $decoded_menu_id = base64_decode($menu_id);


        $admin_id=Auth::guard('admin')->user()->id;

        DB::table('tbl_front_menu')
            ->where('menu_id', $decoded_menu_id)
            ->update([
                'deleted'       => '1',
                'menu_status'   => 'inactive',
                'deleted_at'    => date('Y-m-d H:i:s'),
                'deleted_by'    => $admin_id,//put session id
            ]);

        return redirect('/front-menu-list')->with('success', 'Menu deleted successfully.');
        exit;

    }


    public function permissin_denied()
    {
        return view('Admin.permission_denied');
    }

}
