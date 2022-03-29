<?php

namespace App\Http\Controllers\Departments;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Hash;
use Session;

class DepartmentController extends Controller{
	
	public function index()
	{
		$departments= $this->_api(5, 'api/v1/departments');
		$settings	= $this->settings_admin();	
		return view("Admin.department.list")
				->with("departments", $departments['data']["Value"])
				->with("set", $settings);
	}
	
	public function add()
	{
		$settings	= $this->settings_admin();	
		return view("Admin.department.add")
				->with("set", $settings);
	}
	
	public function add_act(Request $req)
	{
		/*
		$check = Validator::make($req->all(), [
			"name"=>"required|min:3",
			"status"=>"required",
		]);
		if($check->fails())
			return back()->withErrors($check->errors())->withInput();
		*/
		$name 			= $req->post("name");
		$status 		= $req->post("status");
		$data			= array(
								"name"=>$name,
								"status_active"=>intval($status),
								"creator"=>1,
								"last_updater"=>1,
							);	
		$method	= 'POST';
		$path 	= 'api/v1/departments/create';
		$result = $this->_api(5, $path, $method, $data);

		$msg = 'Successfully Created!';
		if(!empty($result["data"]) && $result["data"]!=="success")
			return redirect("admin/department")->withErrors($result["data"])->withInput();
		
		return redirect("admin/department")->withErrors($msg);
	}
	
	public function edit($id)
	{
		$dep 		= $this->_api(5, 'api/v1/departments/show/'.$id);
		if($dep==-1) return redirect("admin/login");
		
		$settings	= $this->settings_admin();	
		return view("Admin.department.edit")
				->with("department", $dep['data']["Value"])
				->with("set", $settings);
	}
	
	public function edit_act(Request $req)
	{
		
		/*
		$check = Validator::make($req->all(), [
			"id_department"=>"required",
			"name"=>"required|min:3",
			"status"=>"required",
		]);
		if($check->fails())
			return back()->withErrors($check->errors())->withInput();
		*/

		$id_department	= $req->post('id_department');
		$name 			= $req->post("name");
		$status 		= $req->post("status");
		$data			= array(
								"id_department"=>intval($id_department),
								"name"=>$name,
								"status_active"=>intval($status),
								"last_updater"=>1,
							);	
							
		$method	= 'PUT';
		$path 	= 'api/v1/departments/update';
		$result = $this->_api(5, $path, $method, $data);
		
		$msg = 'Successfully Updated!';
		if(!empty($result["data"]) && $result["data"]!=="success")
			$msg = 'Failed Updated!';
		
		return redirect("admin/department/edit/".$id_department)->withErrors($msg);
	}
	
	public function delete($id)
	{
		$dep 		= $this->_api(5, 'api/v1/departments/show/'.$id);
		if($dep==-1) return redirect("admin/login");
		
		$settings	= $this->settings_admin();	
		return view("Admin.department.delete")
				->with("department", $dep['data']["Value"])
				->with("set", $settings);
	}
	
	public function delete_act(Request $req)
	{
		$id_department	= $req->post('id_department');
		$data			= array(
								"id_department"=>intval($id_department),
								"status_active"=>-1,
							);	
		$method	= 'PUT';
		$path 	= 'api/v1/departments/delete';
		$result = $this->_api(5, $path, $method, $data);
		
		$msg = 'Successfully Removed!';
		if(!empty($result["data"]) && $result["data"]!=="success")
			$msg = 'Failed Removed!';
		
		return redirect("admin/department/")->withErrors($msg);
	}
}


