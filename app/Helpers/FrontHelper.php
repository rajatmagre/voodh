<?php 
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Model\Category;
use admin\Auth;


  /**__ Custom date format for admin list show __**/ 
    function getParentCat($cat_id)
    {
        $cat=Category::where(array('deleted'=>'0','cat_id'=>$cat_id))->first();
        if(!empty($cat))
        {
            return $cat->cat_name;
        }
        else
        {
            return '';  
        }
    }
  /**__ Custom date format for admin list show __**/ 
    
  
?>