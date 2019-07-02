<?php 
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Model\Side_menu;
use App\Model\Staff;
use admin\Auth;


  if(!function_exists('get_menu_name')){

        /**get website text according to hindi/english start**/
        function get_menu_name($menu_id) 
        {

           $hmenu_name=Side_menu::where(array('deleted'=>'0','menu_id'=>$menu_id))->first();

            if(!empty($hmenu_name))
            {
                return $hmenu_name->menu_name;
            }
            else
            {
                return '';  
            }

        }
    }

   
    
   if(!function_exists('menu_text_admin')){
        function menu_text_admin($admenu_parent_id,$admenu_html='',$adcount_index) 
        {
           $adwhere_menu=array('deleted'=>'0','menu_status'=>'active','menu_parent_id'=>$admenu_parent_id);
            $admenu_details=DB::table('tbl_admin_side_menu')->where($adwhere_menu)->get();


           

            if(!empty($admenu_details))
            {
                     $admenu_html='';
                    foreach($admenu_details as $each_admenu) {

                        $adcount_index++;
                        $adchild_count=admenu_child_count($each_admenu->menu_id);
                        $hmenu_name=$each_admenu->menu_name; 

                            if($adchild_count==0){

                                if($each_admenu->menu_parent_id!=0){

                                     $type_id= \Auth::guard('admin')->user()->staff_type_id;
                                     $id= \Auth::guard('admin')->user()->id;
                                     
                                     if($type_id==1) {
                                           $where_admenu=array('deleted'=>'0','menu_status'=>'active');
                                       } else {
                                          $where_admenu=array('deleted'=>'0','menu_status'=>'active','tbl_menu_allotment.menu_id'=>$each_admenu->menu_id,"staff_id"=>$id,'listing_authority'=>'1'
                                      );
                                       }


                                        if($type_id==1) {

                                            $check_auth=DB::table('tbl_admin_side_menu')->where($where_admenu)->count();

                                        }else
                                        {

                                            $check_auth=DB::table('tbl_admin_side_menu')
                                                    -> join("tbl_menu_allotment",'tbl_admin_side_menu.menu_id','tbl_menu_allotment.menu_id')
                                                    ->where($where_admenu)->count();

                                        }
            

                                     
                                    if(($check_auth)!=0) {
                                         $admenu_html.='<li><a href="'.url('/').'/'.$each_admenu->menu_list_url.'"><span>'.ucfirst($each_admenu->menu_name).'</span></a></li>';
                                    }
                                     /*$admenu_html.='<li><a href="'.url('/').'/'.$each_admenu->menu_list_url.'"><span>'.$each_admenu->menu_name.'</span></a></li>';*/
                                }
                    
                            } else {
                                $admenu_html.='<li class="sidebar-dropdown"> <a href="'.$each_admenu->menu_list_url.'"> <img src="'.url('public/uploads/admin/menu_icons/') .'/'.$each_admenu->menu_icon_image .'" alt=""><span>'.ucfirst($each_admenu->menu_name).'</span></a>';
                                $admenu_html.='<div class="sidebar-submenu">';
                                 $admenu_html.='<ul>';
                                 $adinb_html=menu_text_admin($each_admenu->menu_id,$admenu_html,$adcount_index);

                                 $adinb_html.='</ul></div></li>';
                                 $admenu_html.=$adinb_html;
                            }
                    }
            }
            return $admenu_html;
        }
    }


    if(!function_exists('admenu_child_count')){
      function admenu_child_count($admenu_parent_id) 
        {
             $id=\Auth::guard('admin')->user()->id;

             $type_id=\Auth::guard('admin')->user()->staff_type_id;


             if($type_id==1) {
                $where_admenu=array('deleted'=>'0','menu_status'=>'active','menu_parent_id'=>$admenu_parent_id);
             } else {
                $where_admenu=array('deleted'=>'0','menu_status'=>'active','menu_parent_id'=>$admenu_parent_id,"staff_id"=>$id,'listing_authority'=>'1');
             }


             if($type_id==1)
             {
                $adchild_menu_count=DB::table('tbl_admin_side_menu')->where($where_admenu)->count();
                

             }
             else
             {
                 $adchild_menu_count=DB::table('tbl_admin_side_menu')
                                     -> join("tbl_menu_allotment",'tbl_admin_side_menu.menu_id','tbl_menu_allotment.menu_id')
                                    ->where($where_admenu)->count();
             }
            

           
           
              return $adchild_menu_count;
           
        }
    }


/**********************menu alloted***********/
if(!function_exists('sub_menu_list_new'))
    {

    function sub_menu_list_new($parent1,$type_id1,$count1,$h_staff)
    {
       
         $submenu_html='';
        

       /* $h_sub_menus1=$ci->front->get_data_orderby_where('tbl_side_menu',"menu_name",array('status'=>'active','deleted'=>'0','menu_parent'=>$parent1),$order_by="ASC"); */
       $h_sub_menus1=DB::table('tbl_admin_side_menu')->where(array('menu_status'=>'active','deleted'=>'0','menu_parent_id'=>$parent1))->get();
       
         if(!empty($h_sub_menus1) and $parent1!=0)
         {
            $submenu_html.='<table class="table table-bordered">';
            $submenu_html.='<thead>';
            $submenu_html.='<tr>';
            foreach($h_sub_menus1 as $heach_menu1)
            {
              $heach_menu1->submenu = DB::table('tbl_admin_side_menu')->where(array('menu_status'=>'active','deleted'=>'0','menu_parent_id'=>$heach_menu1->menu_id))->get();

                if(!empty($heach_menu1->submenu) && $heach_menu1->menu_parent_id!=0)
                  {
                   
                     $submenu_html.='<th>';
                    

                     $submenu_html.='<div class="checkbox checkbox-for-theam">
                                  <label>
                                     
                                    '.$heach_menu1->menu_name.'
                                  </label>
                                </div>';
                     $submenu_html.='<input type="hidden" name="menu_ids[]" id="menu_ids" value="'.$heach_menu1->menu_id.'" />';
                     $submenu_html.='</th>';
                    
                  }
                  
             }
             $submenu_html.='</tr>';
             $submenu_html.='</thead>';
             $submenu_html.='<tbody>';

             //  $submenu_html.='<tr>';
             // foreach($h_sub_menus1 as $heach_menu1) {  

               
             //    $m_alloted = DB::table('tbl_menu_allotment')
             //                ->where(array('status'=>'active','staff_type_id'=>$type_id1,'menu_id'=>$heach_menu1->menu_id,'staff_id'=>$h_staff))
             //                ->get();

             //         if(count($m_alloted)!=0)
             //         {
             //            if($m_alloted[0]->add_authority=='1')
             //            {
             //              $add_checked="checked='checked'";
             //            }
             //            else
             //            {
             //              $add_checked="";
             //            }
             //         }
             //         else
             //         {
             //           $add_checked="";
                       
             //         } 
             //         //$add_checked="";
             //      if(!empty($heach_menu1->submenu) && $heach_menu1->menu_parent_id!=0)
             //      {    
             //         $submenu_html.='<td>';
             //       /*  $submenu_html.='<input type="checkbox" data-parent="'.$parent1.'" class="check_all" value="1" name="add_url'.$heach_menu1->menu_id.'" '.$add_checked.' id="sub_add'.$heach_menu1->menu_id.'"> Add';
             //        */
             //         $submenu_html.='<div class="checkbox checkbox-for-theam">
             //                      <label>
             //                        <input type="checkbox" data-parent="'.$parent1.'" class="check_all" value="1" name="add_url'.$heach_menu1->menu_id.'" '.$add_checked.' id="sub_add'.$heach_menu1->menu_id.'">
             //                        <span class="cr"><i class="fa fa-check cr-icon"></i></span>
             //                        Add
             //                      </label>
             //                    </div>';

             //         $submenu_html.='</td>';
             //       }
                     
             //  }

             //  $submenu_html.='</tr>';



              // $submenu_html.='<tr>';
              // foreach($h_sub_menus1 as $heach_menu1)
              // {    

              //     $m_alloted=DB::table('tbl_menu_allotment')
              //               ->where(array('status'=>'active','staff_type_id'=>$type_id1,'menu_id'=>$heach_menu1->menu_id,'staff_id'=>$h_staff))
              //               ->get();

              //        if(count($m_alloted)!=0)
              //        {
              //           if($m_alloted[0]->edit_authority=='1')
              //           {
              //             $edit_checked="checked='checked'";
              //           }
              //           else
              //           {
              //             $edit_checked="";
              //           }

              //        }
              //        else
              //        {
              //           $edit_checked="";
              //        }    
                    
              //     if(!empty($heach_menu1->submenu) && $heach_menu1->menu_parent_id!=0)
              //     {
              //        $submenu_html.='<td>';
              //       /* $submenu_html.='<input type="checkbox" data-parent="'.$parent1.'" class="check_all" value="1" name="edit_url'.$heach_menu1->menu_id.'"  '.$edit_checked.' id="sub_edit'.$heach_menu1->menu_id.'"> Edit';*/

              //        $submenu_html.='<div class="checkbox checkbox-for-theam">
              //                     <label>
              //                       <input type="checkbox" data-parent="'.$parent1.'" class="check_all" value="1" name="edit_url'.$heach_menu1->menu_id.'"  '.$edit_checked.' id="sub_edit'.$heach_menu1->menu_id.'">
              //                       <span class="cr"><i class="fa fa-check cr-icon"></i></span>
              //                       Edit
              //                     </label>
              //                   </div> ';

                     

              //        $submenu_html.='</td>';
              //     }
                     
              // }
              // $submenu_html.='</tr>';

               $submenu_html.='<tr>';
              foreach($h_sub_menus1 as $heach_menu1)
              {    

                  $m_alloted=DB::table('tbl_menu_allotment')
                            ->where(array('status'=>'active','staff_type_id'=>$type_id1,'menu_id'=>$heach_menu1->menu_id,'staff_id'=>$h_staff))
                            ->get();

                     if(count($m_alloted)!=0)
                     {
                        if($m_alloted[0]->listing_authority=='1'){
                          $listing_checked="checked='checked'";
                        } else {
                          $listing_checked="";
                        }

                     } 
                     else {
                        $listing_checked="";
                     }    
                     
                  if(!empty($heach_menu1->submenu) && $heach_menu1->menu_parent_id!=0)
                  {
                        $submenu_html.='<td>';
                        $submenu_html.='<div class="checkbox checkbox-for-theam">
                                  <label>
                                    <input type="checkbox" data-parent="'.$parent1.'" class="check_all" value="1" name="list_url'.$heach_menu1->menu_id.'"  '.$listing_checked.' id="sub_list'.$heach_menu1->menu_id.'">
                                    <span class="cr"><i class="fa fa-check cr-icon"></i></span>
                                    LIST
                                  </label>
                                </div>';
                        $submenu_html.='</td>';
                  }
                     
              }
              $submenu_html.='</tr>';


              // $submenu_html.='<tr>';
              // foreach($h_sub_menus1 as $heach_menu1)
              // { 
              //      $m_alloted=DB::table('tbl_menu_allotment')
              //               ->where(array('status'=>'active','staff_type_id'=>$type_id1,'menu_id'=>$heach_menu1->menu_id,'staff_id'=>$h_staff))
              //               ->get();

               

              //        if(count($m_alloted)!=0){
                       
              //           if($m_alloted[0]->delete_authority=='1')
              //           {
              //             $delete_checked="checked='checked'";
              //           } else {
              //             $delete_checked="";
              //           }

              //        } else {
              //           $delete_checked="";
              //        }    
                     
              // //     if(!empty($heach_menu1->submenu) && $heach_menu1->menu_parent_id!=0)
              // //     {    
              // //        $submenu_html.='<td>';
              // //       $submenu_html.='<div class="checkbox checkbox-for-theam">
              // //                     <label>
              // //                       <input type="checkbox" data-parent="'.$parent1.'" class="check_all" value="1" name="delete_url'.$heach_menu1->menu_id.'" '.$delete_checked.' id="sub_delete'.$heach_menu1->menu_id.'">
              // //                       <span class="cr"><i class="fa fa-check cr-icon"></i></span>
              // //                       Delete
              // //                     </label>
              // //                   </div>';
              // //        $submenu_html.='</td>';
              // //      }
                     
              // // }

              // $submenu_html.='</tr>';
              $submenu_html.='</tbody>';
              $submenu_html.='</table>';
             
           
            }
             foreach($h_sub_menus1 as $heach_menu1)
               {  
                $all_check ='';
                  if(empty($heach_menu1->submenu) && $heach_menu1->menu_parent_id==0)
                  {  
                        if($heach_menu1->menu_parent_id==0) 
                        {
                            $all_check = '<div class="checkbox checkbox-for-theam">
                                                  <label>
                                                    <input type="checkbox" class="check_all" value=""  data-parent_all="'.$heach_menu1->menu_id.'" onclick="get_checked_parent_submenu('.$heach_menu1->menu_id.');">
                                                    <span class="cr"><i class="fa fa-check cr-icon"></i></span>'
                                                  .$heach_menu1->menu_name.'
                                                  </label>
                                                </div>';
                        } 
                        $submenu_html.='<div class="row">
                                        <div class="col-md-4 offset-md-4">
                                            <div class="text-center for-table-blcok">
                                                 '.$all_check.'
                                            </div>
                                        </div>
                                    </div>';
                        $submenu_html.=sub_menu_list_new($heach_menu1->menu_id,$type_id1,$count1,$h_staff);
                  }
                  

               }
            
         return $submenu_html;

    }
}
   

/** Kamlesh Ji**/
if(!function_exists('get_staff_log_details')){

    function get_staff_log_details($staff_id){ 

        $staff_name=Staff::where( array('id'=>$staff_id) )->value('staff_name');

        if(!empty($staff_name))
        {
            return ucfirst($staff_name);
        }
        else
        {
            return '';  
        }

    }
}
/** End Kamlesh Ji**/ 

/**start menu helper check url start**/
 if(!function_exists('check_menu_permission'))
 {
    function check_menu_permission($allot_menu_url,$menu_action)
    {
         $admin_id=\Auth::guard('admin')->user()->id;
         $admin_type=\Auth::guard('admin')->user()->staff_type_id;

         if($admin_type==1)
         {
            return 1;
         }
         else
         {

                    if($menu_action=='add')
                    {
                        $where_allmenu=array('menu_status'=>'active','deleted'=>'0','menu_add_url'=>$allot_menu_url,'add_authority'=>'1','staff_id'=>$admin_id);
                    }
                    else if($menu_action=='edit')
                    {
                        $where_allmenu=array('menu_status'=>'active','deleted'=>'0','menu_edit_url'=>$allot_menu_url,'edit_authority'=>'1','staff_id'=>$admin_id);
                    }
                    else if($menu_action=='listing')
                    {
                        $where_allmenu=array('menu_status'=>'active','deleted'=>'0','menu_list_url'=>$allot_menu_url,'listing_authority'=>'1','staff_id'=>$admin_id);
                    }
                    else if($menu_action=='delete')
                    {
                        $where_allmenu=array('menu_status'=>'active','deleted'=>'0','menu_delete_url'=>$allot_menu_url,'delete_authority'=>'1','staff_id'=>$admin_id);
                    }
                    else if($menu_action=='excel')
                    {
                        $where_allmenu=array('menu_status'=>'active','deleted'=>'0','menu_excel_url'=>$allot_menu_url,'excel_authority'=>'1','staff_id'=>$admin_id);
                    }

                    

                     $permission_count=DB::table('tbl_admin_side_menu')
                      ->join('tbl_menu_allotment','tbl_admin_side_menu.menu_id', '=', 'tbl_menu_allotment.menu_id')->where($where_allmenu)->count();

                     if($permission_count>0)
                     {
                        return $permission_count;
                     }
                     else
                     {
                        return false;
                     }

        }

    }
 }
/**end menu helper check url end**/

  /**__ Custom date format for admin list show __**/ 
  function custom_date_format($date)
  {
      return \Carbon::parse($date)->format('d F, Y H:i:s');
  }
  /**__ Blood Unit Count __**/ 
  
?>