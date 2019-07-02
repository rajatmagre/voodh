<?php
/* Create By Kamlesh */ 

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Auth;


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
        return view('Front.home');
    }

}
