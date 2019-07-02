<?php

namespace App\Http\Controllers\admin\Station;

use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;
use App\Model\Staff;
use App\Model\Designation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StaffController extends Controller
{
    function __construct()
	{
		// $this->staff=$staff;
		// $this->designation=$designation;
	}

	public function index()
	{	
		// $designation=$this->designation->where('deleted','0')->get();
		// return view('admin.Staff.add_staff',compact('designation'));
	}

	public function store(Request $request)
	{
		//return $request->all();
	}
}