<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Side_menu extends Model
{
    protected $table='tbl_admin_side_menu';
    protected $fillable=['menu_name','menu_parent_id','menu_icon_image','menu_status','deleted','deleted_at','deleted_by','created_at','created_by','updated_at','updated_by'];


   
}
