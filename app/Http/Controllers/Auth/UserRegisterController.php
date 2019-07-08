<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Mail;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class UserRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required','confirmed', 'string', 'min:6'],
            'password_confirmation'=>['required']
        ]);
    }


    public function showRegistrationForm()
    {   
        return view('Auth.register');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

       
        $register=User::create([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])

        ]);


            if($register){

                // $email=$data['email'];


                
                // Mail::send('emails.reg_emails',['name'=>$data['first_name'].' '.$data['last_name'],'email'=>$data['email'] ], function ($message) use ($email){

                //           $message->from('questtestmail@gmail.com', 'Indian Aviation Academy');
                //           $message->to($email);
                //           $message->subject('IAA Registration');

                //  }); 


                return $register;
                // return redirect('/user-login');
          }


    }


  


    public function verify(){

        $email=$_GET['id'];
        $email=base64_decode($email);

        $where      = array('email'=>$email);            
        $get_name   = DB::table('users')->where($where)->get();
           
        $updateData = array(
                           'email_verification_status' => 'yes',
                           'updated_at' => date('Y-m-d H:i:s')
                   );

        DB::table('users')->where('email', $email)->update($updateData);

   
        return view('verify_email');

    }

    public function registerme(Request $request)
    {
        // return $request->all();
        //dd($this->redirectPath());

         $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }    

}
