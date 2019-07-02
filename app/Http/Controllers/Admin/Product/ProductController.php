<?php
/*
	Created By Kp
*/
namespace App\Http\Controllers\admin\Product;

use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;
use App\Model\Product;
use App\Model\Category;
use Mail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    function __construct()
	{

	}
    //Global Function for upload Single image
    function upload_file($file,$path)
    {
       $image = $file;
       $imagename = Str::slug($image->getClientOriginalName(), '-').'.'.$image->getClientOriginalExtension();
       $destinationPath = public_path($path);
       $image->move($destinationPath, $imagename);

       return $imagename;
    }
    public function get_sub_cat(Request $request)
    {
         $cat_id=$request->cat_id;
         $all_category    =   Category::where(array('parent_cat_id'=>$cat_id,'deleted'=>'0'))->get();
         return view('Admin/ajax_category',compact(['all_category']));
    }
	public function product_list()
	{	
		$all_products = Product::where(['deleted' => '0'])->orderBy('product_id','ASC')->get();
        // echo "<pre>";
        // print_r($all_products);die();
		return view('Admin.Product.product_list',compact('all_products'));
	}

	public function add_product(Request $request)
	{	
		if ($request->method() == 'POST') {
            /**__ Check Validation __**/ 
                $validatedData = $request->validate(
                    [
                        'product_name'         	    => 'required|unique:tbl_products',
                        'product_des'               => 'required',
                        'product_price'             => 'required',
                        'discount_price'            => 'required',
                    ],
                    [
                        'product_name.unique'       =>  'Product already exist.',
                        'product_name.required'     =>  'Please enter category name.',
                        'product_des.required'      =>  'Please enter product description.',
                        'product_price.required'    =>  'Please enter product price.',
                        'discount_price.required'   =>  'Please enter discount price.',
                    ]
                );
            if($request->hasfile('product_main_image')){

                $product_main_image = $this->upload_file($request->file('product_main_image'),'/uploads/admin/product_images');
            }else{

                $product_main_image = '';
            }
            /**__ Check Validation __**/ 

            $admin_id = Auth::guard('admin')->user()->id;//get set session Id


            $insert =   Product::create([
	                        'product_name'  	   => $request['product_name'],
                            'product_des'          => $request['product_des'],
                            'product_price'        => $request['product_price'],
                            'discount_price'       => $request['discount_price'],
	                        'product_image'        => $product_main_image,
                            'product_status'       => $request['product_status'],
	                        'created_at'           => date('Y-m-d H:i:s'),
	                        'created_by'           => $admin_id,
	                    ]);
	        if ($insert) {

                $files = $request->file('product_image');

                foreach ($files as $key => $file) {

                    $product_image = $this->upload_file($file,'/uploads/admin/product_images');
                    
                    $arrImage = array(
                                'product_id'     => $insert->id,
                                'image'          => $product_image
                            );
                    DB::table('tbl_product_images')->insertGetId($arrImage);
                }
                    $arrcats = array(
                                'product_id'        => $insert->id,
                                'category_id'       => $request['main_category'],
                                'sub_cat_id'        => $request['sub_cat'],
                                'resub_cat_id'      => $request['resub_cat']
                            );
                    DB::table('tbl_products_category_rel')->insertGetId($arrcats);

	            return redirect('/product-list')->with('success', 'Product details added successfully.');
	            exit;

	        }else{

	            return redirect('/add-product')->with('error', 'Something went wrong please try again.');
	            exit;
	        }
        }

        $data['all_parent_cats'] = Category::where(['parent_cat_id' => 0,'deleted' => '0'])->orderBy('cat_id','ASC')->get();

		return view('Admin.Product.add_product',$data );
	}

	public function edit_product(Request $request,$product_id)
	{	
		$decode_product_id = base64_decode($product_id);
		if ($request->method() == 'POST') {



            $admin_id = Auth::guard('admin')->user()->id;//get set session Id
           
            if($request->hasfile('product_main_image')){

                $product_main_image = $this->upload_file($request->file('product_main_image'),'/uploads/admin/product_images');
            }else{

                $product_main_image = $request['old_product_image'];
            }

            $update =   Product::where('product_id',$decode_product_id)->update([
                            'product_name'         => $request['product_name'],
                            'product_des'          => $request['product_des'],
                            'product_price'        => $request['product_price'],
                            'discount_price'       => $request['discount_price'],
                            'product_image'        => $product_main_image,
                            'product_status'       => $request['product_status'],
                            'updated_at'           => date('Y-m-d H:i:s'),
                            'updated_by'           => $admin_id,//insert login session id
                        ]);
            /*_____ Update _____*/ 

            if ($update) {
                if (!empty($request->file('product_image'))) {


    	            $files = $request->file('product_image');

                    foreach ($files as $key => $file) {

                        $product_image = $this->upload_file($file,'/uploads/admin/product_images');
                        
                        $arrImage = array(
                                    'product_id'     => $decode_product_id,
                                    'image'          => $product_image
                                );
                        DB::table('tbl_product_images')->insertGetId($arrImage);
                    }
                }
	            return redirect('/product-list')->with('success', 'Product details updated successfully.');
	            exit;

	        }else{

	            return redirect('/edit-product/'.$cat_id)->with('error', 'Something went wrong please try again.');
	            exit;
	        }
        }
        $data['edit_product_details'] = DB::table('tbl_products')
                        ->join('tbl_products_category_rel AS cat_ral', 'tbl_products.product_id', '=', 'cat_ral.product_id')
                        ->select('tbl_products.*','cat_ral.*')
                        ->where(['tbl_products.product_id' => $decode_product_id,'tbl_products.deleted' => '0'])
                        ->first();
        $data['prod_images'] = DB::table('tbl_product_images')
                        ->select('tbl_product_images.*')
                        ->where(['tbl_product_images.product_id' => $decode_product_id])
                        ->get();


        $data['all_parent_cats'] = Category::where(['parent_cat_id' => 0,'deleted' => '0'])->orderBy('cat_id','ASC')->get();
        $data['all_cats'] = Category::where(['deleted' => '0'])->orderBy('cat_id','ASC')->get();

        // echo "<pre>";
        // print_r($data['all_cats']);die();
		return view('Admin.Product.edit_product',$data);
	}

	/*___ Staff Delete ___*/
    public function delete_product($product_id)
    {
        $decode_product_id = base64_decode($product_id);

        $admin_id = Auth::guard('admin')->user()->id;//get set session Id

        $delete =   Product::where('product_id',$decode_product_id)->update([
                            'deleted'       => '1',
                            'product_status' => 'inactive',
                            'deleted_at'    => date('Y-m-d H:i:s'),
                            'deleted_by'    => $admin_id,//insert login session id
                        ]);
        if ($delete) {

            return redirect('/product-list')->with('success','Product details deleted successfully.');
            exit;

        }else{

            return redirect('/product-list')->with('error', 'Something went wrong. please try again.');
            exit;
        }

    }

}
