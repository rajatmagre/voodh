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

// ***** Front Question Rout*****/