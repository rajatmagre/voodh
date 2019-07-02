<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth,Redirect;
use Alert;
use App\Model\User;
use session;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function login(Request $request){

    	if ($request->method() == 'POST') {
				$validator = Validator::make($request->all(), [
	            'email' 		=> 'required',
	            'password' 		=> 'required',
	        ]);

	        if ($validator->fails()) {
	            return redirect('admin-login')
	                        ->withErrors($validator);
	                        exit;
	        }

	      		
			$email = $request['email'];
			$password = $request['password'];

			$result = Auth::attempt(['email' => $email, 'password' => $password]);
			
			if ($result == true) {
                
            	$infos = Auth::user();


		 		$request->session()->put([
					'adminEmail' => $infos['email'],
					'adminUserId' => (string) $infos['user_id'],
				]);

				
				return Redirect::to('dashboard');
               

            }else{

                return redirect('admin-login')->with('error', 'Something went wrong please try again.');
                exit;
            }

		}
		
    	return view('auth.login'); 
    }



}
