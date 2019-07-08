<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Auth::routes();

Route::get('locale/{locale}',function($locale){
  Session::put('locale',$locale);

  return redirect()->back();
});

//Created by Vinod M
Route::get('landing_locale/{locale}',function($locale){
  Session::put('locale',$locale);


  return redirect('/');
});

Route::get('/', 'Front\HomeController@index');

Route::get('/verify', 'Auth\UserRegisterController@verify');
Route::get('/unverify', 'Front\HomeController@unverify');
Route::get('/unverified-email', 'Front\HomeController@unverify_throuh_otp');
Route::get('logout', 'Auth\UserLoginController@logout');
Route::get('user-login', 'Auth\UserLoginController@showLoginForm');
Route::get('user-login',['as'=>'user-login','uses'=>'Auth\UserLoginController@showLoginForm']);
Route::post('user-login', 'Auth\UserLoginController@login');

Route::get('user-register', 'Auth\UserRegisterController@showRegistrationForm');
Route::post('user-register', 'Auth\UserRegisterController@registerme');

Route::get('check_unique_field', 'Auth\UserRegisterController@check_unique_field');
Route::get('send_registration_otp', 'Auth\UserRegisterController@send_registration_otp');
Route::get('verify-registration-otp', 'Auth\UserRegisterController@verify_registration_otp');

Route::get('forget-password', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('forget-password', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('user-password/reset/{token}', 'Auth\UserResetPasswordController@showResetForm');

Route::get('user-password/update', 'Auth\UserResetPasswordController@showResetForm');
Route::post('user-password/update', 'Auth\UserResetPasswordController@reset');


// Route::get('/forget-password','Auth\UserForgotPasswordController@showLinkRequestForm');
// Route::post('/forget-password','Auth\ForgotPasswordController@forgetPassword');

Route::get('/change-password/{userId}','Auth\UserForgotPasswordController@ChangePassword');
Route::post('/change-password','Auth\UserForgotPasswordController@ChangePassword');


Route::get('/profile', 'UserController@profile');

Route::get('/send-mail', 'Auth\UserRegisterController@check_mail_templates');


Route::post('ajax-image-edit-profile', 'UserController@edit_user_profile_image');


Route::post('edit-user-profile','UserController@edit_user_details')->name('edit-user-profile');
// Get Category Products
Route::get('/products/{catId}','Front\HomeController@products');
Route::get('/product-detail/{productId}','Front\HomeController@product_detail');
// ***** Front Question Rout*****/