<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

// use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;

class CatRelation extends Model
{
    protected $table='tbl_products_category_rel';
    protected $fillable = ['rel_id', 'product_id', 'category_id', 'sub_cat_id', 'resub_cat_id'];

    function cat_product()
    {
    	return $this->hasMany('App\Model\Product','product_id','product_id');  
    }
    function cat_info()
    {
    	return $this->hasMany('App\Model\Category','cat_id','sub_cat_id');  
    }
}
