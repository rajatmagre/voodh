<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StaffType extends Model
{
    protected $table	=	'tbl_staff_type_master';
    protected $fillable	=	['staff_type_name','staff_type_status','created_at','created_by'];

     public function AdminName()
    {
        return $this->hasOne('App\Model\Staff','id','created_by');
     
    }

}
