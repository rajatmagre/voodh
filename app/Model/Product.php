<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

// use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;

class Product extends Model
{
    protected $table='tbl_products';
    protected $fillable = ['product_id', 'product_name', 'product_dec','product_image', 'product_price', 'discount_price', 'product_status', 'deleted', 'deleted_at', 'deleted_by', 'created_at', 'created_by', 'updated_at', 'updated_by'];
}
