<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::get('/admin-login', 'Admin\AdminController@login')->name('admin-login');
Route::get('/admin-logout', 'Admin\Auth\LoginController@logout')->name('adminlogout');

Route::post('/adminlogin', 'Admin\Auth\LoginController@adminlogin')->name('adminlogin');

Route::get('/change-pass', 'Admin\AdminController@change_password')->name('change-pass');
Route::post('/change-pass', 'Admin\AdminController@change_pass')->name('changepass');

Route::get('/forget-pass', 'Admin\AdminController@forget_password')->name('forgetpass');

Route::post('forgot-pass', ['as'=>'admin.forgot-pass','uses'=>'Admin\Auth\ForgotPasswordController@sendResetLinkEmail']);
//to reset password of admin

Route::get('admin-password/reset/{token}', ['as'=>'admin_password.reset','uses'=>'Admin\Auth\ResetPasswordController@showResetForm']);
Route::post('admin-password/reset', 'admin\Auth\ResetPasswordController@reset');

Route::get('state-list','Admin\AdminController@stateList');
Route::get('city-list','Admin\AdminController@cityList');
Route::post('get-sub-cat','Admin\Product\ProductController@get_sub_cat')->name('get-sub-cat');

//Admin Middleware route start
Route::group(['middleware' => 'admin'], function () {  

		Route::get('/admin-dashboard', 'Admin\DashboardController@index')->name('admin-dashboard');

		Route::get('/add-designation', 'Admin\Designation\DesignationController@index');
		Route::post('/add-designation', 'Admin\Designation\DesignationController@create');
		Route::get('/edit-designation/{id}', 'Admin\Designation\DesignationController@edit');
		Route::post('/edit-designation/{id}', 'Admin\Designation\DesignationController@update');

		Route::get('/designation-list', 'Admin\Designation\DesignationController@designation_list');
		Route::get('/delete-designation/{id}', 'Admin\Designation\DesignationController@delete');



	/* Route for AuthorityController ADD edit Authority  in admin */
		Route::get('add-authority', 'Admin\Authority\AuthorityController@index');
		Route::post('add-authority', 'Admin\Authority\AuthorityController@store');

		Route::get('edit-authority/{id}', 'Admin\Authority\AuthorityController@edit');
		Route::post('edit-authority/{id}', 'Admin\Authority\AuthorityController@update');

		Route::get('authority-list', 'Admin\Authority\AuthorityController@authority_list');
		Route::get('delete-authority/{id}', 'Admin\Authority\AuthorityController@delete');


	/**menu route links start**/
		Route::get('add-side-menu','Admin\SideMenus\SideMenuController@add_side_menu');
		Route::post('add-menu-post','Admin\SideMenus\SideMenuController@store');
		Route::get('side-menu-list','Admin\SideMenus\SideMenuController@side_menu_list');
		Route::get('/delete-menu/{id}','Admin\SideMenus\SideMenuController@delete_menu');

		Route::get('/edit-menu/{id}','Admin\SideMenus\SideMenuController@edit_menu');
		Route::post('edit-menu-post/{id}','Admin\SideMenus\SideMenuController@edit_menu_post');
	/**menu route links end**/



  	/*************Role managemet**************/
  	
	  	Route::get('/role-asign-management','Admin\RoleManagement\RoleManagementController@index');

	  	Route::post('/get-all-staff','Admin\RoleManagement\RoleManagementController@getAllStaff');
	  	Route::post('/get-alloted-menu','Admin\RoleManagement\RoleManagementController@getAllotedMenu');
	  	Route::post('/update-menu','Admin\RoleManagement\RoleManagementController@updateMenu');

  	/*_ Start Staff _*/
	  	Route::get('/staff-list','Admin\Staff\StaffController@staff_list');
		Route::get('/add-staff', 'Admin\Staff\StaffController@add_staff');
		Route::post('/add-staff','Admin\Staff\StaffController@add_staff');
		Route::get('/edit-staff/{staff_id}','Admin\Staff\StaffController@edit_staff');
		Route::post('/edit-staff/{staff_id}','Admin\Staff\StaffController@edit_staff');
		Route::get('/delete-staff/{staff_id}','Admin\Staff\StaffController@delete_staff');
	/*_ End Staff _*/
	/*_ Start Category _*/
	  	Route::get('/category-list','Admin\Category\CategoryController@category_list');
		Route::get('/add-category', 'Admin\Category\CategoryController@add_category');
		Route::post('/add-category','Admin\Category\CategoryController@add_category');
		Route::get('/edit-category/{category_id}','Admin\Category\CategoryController@edit_category');
		Route::post('/edit-category/{category_id}','Admin\Category\CategoryController@edit_category');
		Route::get('/delete-category/{category_id}','Admin\Category\CategoryController@delete_category');
	/*_ End Category _*/
		
	/*_ Start Category _*/
	  	Route::get('/product-list','Admin\Product\ProductController@product_list');
		Route::get('/add-product', 'Admin\Product\ProductController@add_product');
		Route::post('/add-product','Admin\Product\ProductController@add_product');
		Route::get('/edit-product/{product_id}','Admin\Product\ProductController@edit_product');
		Route::post('/edit-product/{product_id}','Admin\Product\ProductController@edit_product');
		Route::get('/delete-product/{product_id}','Admin\Product\ProductController@delete_product');
	/*_ End Category _*/

	/*_ Start Staff Update Profile */
		Route::get('/staff-update-profile','Admin\AdminController@staff_update_profile');
		Route::post('/staff-update-profile','Admin\AdminController@staff_update_profile');
		Route::get('/staff-view-profile','Admin\AdminController@staff_view_profile');
	/*_ End Staff Update Profile  _*/ 

	/**___ Start Kamlesh Routs ___**/ 
		
	/**___ Users Details ___**/
		Route::get('users-list','Admin\Users\UserController@users_list');
		Route::get('users-view-details/{user_id}','Admin\Users\UserController@users_view_details');
		Route::get('user-accident-details/{user_id}','Admin\Users\UserController@user_accident_details');
	/**___ Users Details ___**/




 }); /*-- Admin Middleware end --*/