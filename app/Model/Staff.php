<?php
namespace App\Model;

 use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordNotification;

class Staff extends Authenticatable
{	
	use Notifiable;
    protected $table='tbl_staff_master';
    protected $fillable=['staff_name','staff_designation_id','staff_type_id','staff_station_id','email','staff_employee_id','password','staff_contact_no','staff_profile_image','staff_status','deleted','deleted_at','deleted_by','created_by','updated_by'];


    //laravel eloquest relation
    public function user_details()
    {
        return $this->hasOne('App\user','id','created_by');
        // return $this->hasMany('App\Models\Messages','sender_id','id');
        // return $this->BelongsTo(Category::class);
    }

   /* public function getStaffNameAttribute($value)
    {
        return ucwords($value);
    }*/

    public function sendPasswordResetNotification($token)
    {
        // Your your own implementation.
        $this->notify(new AdminResetPasswordNotification($token));
    }
}
