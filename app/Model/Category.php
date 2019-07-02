<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

// use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;

class Category extends Model
{
    protected $table='tbl_category';
    protected $fillable = ['cat_id', 'parent_cat_id', 'cat_name', 'cat_url', 'cat_image', 'cat_status', 'deleted', 'deleted_at', 'deleted_by', 'created_at', 'created_by', 'updated_at', 'updated_by'];
}
