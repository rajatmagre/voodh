<?php
/* Create By Kamlesh */ 

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Auth;
use App\Model\Product;
use App\Model\Category;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        // dd(\Auth()->user());
        return view('Front.home');
    }
    public function products($catId)
    {
        $decodeCatId = base64_decode($catId);
        $all_products = Product::where(['resub_category' => $decodeCatId])
                                ->get();
        return view('Front.Product.products',compact('all_products'));
    }
    public function product_detail($productId)
    {
        $decodeproductId = base64_decode($productId);
        $product = Product::where(['product_id' => $decodeproductId])
                                ->first();
        $productImages = DB::table('tbl_product_images')
                        ->select('tbl_product_images.*')
                        ->where(['tbl_product_images.product_id' => $decodeproductId])
                        ->get();
        // dd($productImages);
        return view('Front.Product.product_detail',compact('product','productImages'));
    }

}
