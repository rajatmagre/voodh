<?php

namespace App\Http\Controllers\admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth,Session;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $guard = 'admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getLogin(){
       
        if (\Auth::guard('admin')->check())
        {  
             
            return \Redirect::intended('admin/dashboard');
        }  

        return view('admin.auth.login');
    }

    public function adminlogin(Request $request)
    {
        if (\Auth::guard('admin')->check())
        {  
            return \Redirect::intended('admin-dashboard');
        }  
        $this->validateLogin($request);

       
        $admin_cookie=\Auth::guard('admin')->getRecallerName();


        if($admin_cookie!=null)
        {
            \Auth::guard('admin')->viaRemember();
        }


            if(!empty($request['remember_me']))
            {
                $remember_me=true;
            }
            else
            {
                 $remember_me=false;
            }

         if (\Auth::guard('admin')->attempt(['email' => $request['email'],'password' => $request['password'],'staff_status' => 'active'],$remember_me)){

             $userSession = [

                        'staff_name'          => Auth::guard('admin')->user()->staff_name,
                        'staff_profile_image' => Auth::guard('admin')->user()->staff_profile_image,
                    ];
                    
            Session::put($userSession);

            return redirect()->intended('admin-dashboard');
        }

         return $this->sendFailedLoginResponse($request);
        

       
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);

        return $this->authenticated($request, \Auth::guard('admin')->user())
                ?: redirect()->intended('admin/dashboard');
    }


    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required', 
            'password' => 'required',
        ]);
    }

    public function logout(Request $request)
    {   
        //return $request->all();
        
        \Auth::guard('admin')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        // $admin_cookie=\Auth::guard('admin')->getRecallerName();
        // $cookie = \Cookie::forget($admin_cookie);

        //return redirect('admin-login')->withCookie($cookie);;

        return redirect('admin-login');
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }
}
