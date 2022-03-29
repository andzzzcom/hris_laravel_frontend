<?php

namespace App\Http\Controllers\Employees;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Hash;
use Session;

class EmployeeController extends Controller{
	
	public function index()
	{
		$employees 	= $this->_api(5, 'api/v1/employees');
		$settings	= $this->settings_admin();	
		return view("Admin.employee.list")
				->with("employees", $employees['data']["Value"])
				->with("set", $settings);
	}
	
	public function add()
	{
		$settings	= $this->settings_admin();	
		return view("Admin.employee.add")
				->with("set", $settings);
	}
	
	public function add_act(Request $req)
	{
		/*
		$check = Validator::make($req->all(), [
			"name"=>"required|min:3",
			"email"=>"required|min:5",
			"phone"=>"required|min:3",
			"description"=>"required|min:5",
			"address"=>"required|min:5",
			"born_place"=>"required|min:5",
			"born_date"=>"required",
			"avatar"=>"required",
			"gender"=>"required",
			"id_role"=>"required",
			"status"=>"required",
		]);
		if($check->fails())
			return back()->withErrors($check->errors())->withInput();
		*/
		$name 			= $req->post("name");
		$email			= $req->post("email");
		$born_date		= $req->post("born_date");
		//$born_place		= $req->post("born_place");
		$password 		= '12345678';
		$address		= $req->post("address");
		//$description	= $req->post("description");
		$phone 			= $req->post("phone");
		//$role	 		= $req->post("id_role");
		$gender 		= $req->post("gender");
		$status 		= $req->post("status");
		$data			= array(
								"id_designation"=>1,
								"name"=>$name,
								"email"=>$email,
								"born_date"=>'2022-09-09',
								"gender"=>intval($gender),
								"phone"=>$phone,
								"address"=>$address,
								"salary"=>"1234567",
								"status_active"=>intval($status),
								"creator"=>1,
								"last_updater"=>1,
							);	
							
		//check image
		if($req->hasFile("photo")){
			$img					= $req->file("photo");
			$name					= time().".".$img->getClientOriginalExtension();
			$path					= public_path("assets/images/employee/");
			$img->move($path, $name);
			
			$data["photo"] = $name;
		}
		$method	= 'POST';
		$path 	= 'api/v1/employees/create';
		$result = $this->_api(5, $path, $method, $data);

		$msg = 'Successfully Created!';
		if(!empty($result["data"]) && $result["data"]!=="success")
			return redirect("admin/employee")->withErrors($result["data"])->withInput();
		
		return redirect("admin/employee")->withErrors($msg);
	}
	
	public function edit($id)
	{
		$emp 		= $this->_api(5, 'api/v1/employees/show/'.$id);
		if($emp==-1) return redirect("admin/login");
		
		$settings	= $this->settings_admin();	
		return view("Admin.employee.edit")
				->with("employee", $emp['data']["Value"])
				->with("set", $settings);
	}
	
	public function edit_act(Request $req)
	{
		
		/*
		$check = Validator::make($req->all(), [
			"name"=>"required|min:3",
			"email"=>"required|min:5",
			"phone"=>"required|min:3",
			"address"=>"required|min:5",
			"description"=>"required|min:5",
			"born_place"=>"required|min:5",
			//"born_date"=>"required",
			"gender"=>"required",
			"id_role"=>"required",
			"status"=>"required",
		]);
		if($check->fails())
			return back()->withErrors($check->errors())->withInput();
		*/

		$id_employee	= $req->post('id_employee');
		$name 			= $req->post("name");
		$email			= $req->post("email");
		$born_date		= $req->post("born_date");
		//$born_place		= $req->post("born_place");
		$password 		= '12345678';
		$address		= $req->post("address");
		//$description	= $req->post("description");
		$phone 			= $req->post("phone");
		//$role	 		= $req->post("id_role");
		$gender 		= $req->post("gender");
		$status 		= $req->post("status");
		$data			= array(
								"id_employee"=>intval($id_employee),
								"id_designation"=>1,
								"name"=>$name,
								"email"=>$email,
								"born_date"=>'2022-09-09',
								"gender"=>intval($gender),
								"phone"=>$phone,
								"address"=>$address,
								"salary"=>"1234567",
								"status_active"=>intval($status),
								"creator"=>1,
								"last_updater"=>1,
							);	
							
		//check image
		if($req->hasFile("photo")){
			$img					= $req->file("photo");
			$name					= time().".".$img->getClientOriginalExtension();
			$path					= public_path("assets/images/employee/");
			$img->move($path, $name);
			
			$data["photo"] = $name;
		}
		
		$method	= 'PUT';
		$path 	= 'api/v1/employees/update';
		$result = $this->_api(5, $path, $method, $data);
		
		$msg = 'Successfully Updated!';
		if(!empty($result["data"]) && $result["data"]!=="success")
			$msg = 'Failed Updated!';
		
		return redirect("admin/employee/edit/".$id_employee)->withErrors($msg);
	}
	
	public function delete($id)
	{
		$emp 		= $this->_api(5, 'api/v1/employees/show/'.$id);
		if($emp==-1) return redirect("admin/login");
		
		$settings	= $this->settings_admin();	
		return view("Admin.employee.delete")
				->with("employee", $emp['data']["Value"])
				->with("set", $settings);
	}
	
	public function delete_act(Request $req)
	{
		$id_employee	= $req->post('id_employee');
		$data			= array(
								"id_employee"=>intval($id_employee),
								"status_active"=>-1,
							);	
		$method	= 'PUT';
		$path 	= 'api/v1/employees/delete';
		$result = $this->_api(5, $path, $method, $data);
		
		$msg = 'Successfully Removed!';
		if(!empty($result["data"]) && $result["data"]!=="success")
			$msg = 'Failed Removed!';
		
		return redirect("admin/employee/")->withErrors($msg);
	}
}


