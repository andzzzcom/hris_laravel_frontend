<?php

namespace App\Http\Controllers\Designations;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Hash;
use Session;

class DesignationController extends Controller{
	
	public function index()
	{
		$designations = $this->_api(5, 'api/v1/designations');
		$settings	 = $this->settings_admin();	
		return view("Admin.designation.list")
				->with("designations", $designations['data']["Value"])
				->with("set", $settings);
	}
	
	public function add()
	{
		$settings	= $this->settings_admin();	
		return view("Admin.designation.add")
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
		$id_department	= $req->post("id_department");
		$status 		= $req->post("status");
		$data			= array(
								"name"=>$name,
								"id_department"=>1,
								//"id_department"=>$id_department,
								"status_active"=>intval($status),
								"creator"=>1,
								"last_updater"=>1,
							);	
		$method	= 'POST';
		$path 	= 'api/v1/designations/create';
		$result = $this->_api(5, $path, $method, $data);

		$msg = 'Successfully Created!';
		if(!empty($result["data"]) && $result["data"]!=="success")
			return redirect("admin/designation")->withErrors($result["data"])->withInput();
		
		return redirect("admin/designation")->withErrors($msg);
	}
	
	public function edit($id)
	{
		$des 		= $this->_api(5, 'api/v1/designations/show/'.$id);
		if($des==-1) return redirect("admin/login");
		
		$settings	= $this->settings_admin();	
		return view("Admin.designation.edit")
				->with("designation", $des['data']["Value"])
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
		
		$id_designation	= $req->post('id_designation');
		$id_department	= $req->post('id_department');
		$name 			= $req->post("name");
		$status 		= $req->post("status");
		$data			= array(
								"id_designation"=>intval($id_designation),
								"id_department"=>1,
								"name"=>$name,
								"status_active"=>intval($status),
								"last_updater"=>1,
							);	
							
		$method	= 'PUT';
		$path 	= 'api/v1/designations/update';
		$result = $this->_api(5, $path, $method, $data);
		
		$msg = 'Successfully Updated!';
		if(!empty($result["data"]) && $result["data"]!=="success")
			$msg = 'Failed Updated!';
		
		return redirect("admin/designation/edit/".$id_designation)->withErrors($msg);
	}
	
	public function delete($id)
	{
		$des 		= $this->_api(5, 'api/v1/designations/show/'.$id);
		if($des==-1) return redirect("admin/login");
		
		$settings	= $this->settings_admin();	
		return view("Admin.designation.delete")
				->with("designation", $des['data']["Value"])
				->with("set", $settings);
	}
	
	public function delete_act(Request $req)
	{
		$id_designation	= $req->post('id_designation');
		$data			= array(
								"id_designation"=>intval($id_designation),
								"status_active"=>-1,
							);	
		$method	= 'PUT';
		$path 	= 'api/v1/designations/delete';
		$result = $this->_api(5, $path, $method, $data);
		
		$msg = 'Successfully Removed!';
		if(!empty($result["data"]) && $result["data"]!=="success")
			$msg = 'Failed Removed!';
		
		return redirect("admin/designation/")->withErrors($msg);
	}
}


