<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Validator,Mail,Auth,Hash;
use App\Model\User;
use Illuminate\Support\Facades\Password;
use DB;
use Session;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        
        return view('Auth.ForgetPassword');
    }
    // public function forgetPassword(Request $request){

    //     if ($request->method() == 'POST') {

    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required',
            
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect('forget-password')
    //                     ->withErrors($validator);
    //                     exit;
    //     }
            
    //         $exist = User::where(['email' => $request->email])->first();


    //         if(isset($exist)){

    //             $email = $exist['email'];

    //             $url = 'http://192.168.1.22/iaa/change-password/'.base64_encode($exist['id']);

    //             Mail::send('emails.forgetpassword',['url' => $url, 'email'=>$email ], function ($message) use ($email){

    //                           $message->from('questtestmail@gmail.com', 'Indian Aviation Academy');
    //                           $message->to($email);
    //                           $message->subject('Forget Password');

    //                 }); 
    //         }

    //          return redirect('/forget-password')->with('success', 'We have send link for your registred Email for iaa.');
    //     }

    //     return view('auth.ForgetPassword');

    // }

    public function sendResetLinkEmail(Request $request)
    {   
        $this->validateEmail($request);

       
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

       

        /**New customize code**/
        // return $response==Password::RESET_LINK_SENT
        //             ? $this->sendResetLinkResponse($response):0;
        /**New customize code**/

        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($request, $response)
                    : $this->sendResetLinkFailedResponse($request, $response);
        // return $request->all();
    }

    public function ChangePassword(Request $request){

        if ($request->method() == 'POST') {

        $validator = Validator::make($request->all(), [
            'new_password'      => 'required',
            'confirm_password'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/change-password/'.$request->user_id)
                        ->withErrors($validator);
                        exit;
        }
                
            $userId = base64_decode($request->user_id);
            $password = $request['new_password'];

               
            $userInfo = User::where(['id' => $userId])->first();

        
            if(isset($userInfo)){
            
                $data = User::where('id',$userId)->update(['password' => bcrypt($password)]);
                
                if(isset($data)){

                    return redirect('/login')->with('success', 'your password has been change successfully.');        
                }    

            }else{
               
                 return redirect('/change-password/'.$request->user_id)->with('error', 'your old password is wrong.');
            }               
                       
        }

        return view('auth.ChangePassword');

    }

     
}
