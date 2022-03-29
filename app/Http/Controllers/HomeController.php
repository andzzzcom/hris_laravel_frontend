<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHtpp\Exception\GuzzleException;
use GuzzleHttp\Client;

class HomeController extends Controller
{
	public function __construct()
	{
		
	}
	
	public function index()
	{
		$departments 	= $this->_api(5, 'api/v1/departments');
		if($departments==-1) return redirect("admin/login");
		
		$designations 	= $this->_api(5, 'api/v1/designations');
		if($designations==-1) return redirect("admin/login");
		
		$employees 	= $this->_api(5, 'api/v1/employees');
		if($employees==-1) return redirect("admin/login");

		$settings	= $this->settings_admin();	
		return view("Admin.home")
				->with("departments", $departments["data"]["Value"])
				->with("designations", $designations["data"]["Value"])
				->with("employees", $employees["data"]["Value"])
				->with("set", $settings);
	}
}
