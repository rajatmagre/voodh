<?php

namespace App\Model;
use App\User;
use App\Staff;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{	
	protected $table='tbl_staff_designation_master';
    protected $fillable=['designation_name','designation_name_hn','designation_status','deleted','deleted_at','deleted_by','created_by','updated_by'];


    //laravel eloquest relation
    public function user_details()
    {
        return $this->hasOne('App\Model\Staff','id','created_by');
        // return $this->hasMany('App\Models\Messages','sender_id','id');
        // return $this->BelongsTo(Category::class);
    }

     public function staff_details()
    {
        return $this->hasMany('App\Model\Staff','id','designation_id');
        // return $this->hasMany('App\Models\Messages','sender_id','id');
        // return $this->BelongsTo(Category::class);
    }
}
