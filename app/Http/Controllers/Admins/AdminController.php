<?php

namespace App\Http\Controllers\Admins;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Hash;
use Session;

class AdminController extends Controller{
	
	public function index()
	{
		$admins		= $this->_api(5, 'api/v1/admins');
		$settings	= $this->settings_admin();	
		return view("Admin.admin.list")
				->with("admins", $admins['data']["Value"])
				->with("set", $settings);
	}
	
	public function add()
	{
		$settings	= $this->settings_admin();	
		return view("Admin.admin.add")
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
		$email			= $req->post("email");
		$born_place		= $req->post("born_place");
		$password 		= '12345678';
		$address		= $req->post("address");
		$phone 			= $req->post("phone");
		$gender 		= $req->post("gender");
		$status 		= $req->post("status");
		$data			= array(
								"name"=>$name,
								"email"=>$email,
								"password"=>Hash::make($password),
								"born_place"=>$born_place,
								"gender"=>intval($gender),
								"phone"=>$phone,
								"address"=>$address,
								"status_active"=>intval($status),
								"creator"=>1,
								"last_updater"=>1,
							);	
							
		//check image
		if($req->hasFile("avatar")){
			$img					= $req->file("avatar");
			$name					= time().".".$img->getClientOriginalExtension();
			$path					= public_path("assets/images/admin/");
			$img->move($path, $name);
			
			$data["avatar"] = $name;
		}
		
		$method	= 'POST';
		$path 	= 'api/v1/admins/create';
		$result = $this->_api(5, $path, $method, $data);
		
		$msg = 'Successfully Created!';
		if(!empty($result["data"]) && $result["data"]!=="success")
			$msg = 'Failed Created!';
		
		return redirect("admin/admin/")->withErrors($msg);
	}
	
	public function edit($id)
	{
		$admin 		= $this->_api(5, 'api/v1/admins/show/'.$id);
		if($admin==-1) return redirect("admin/login");
		
		$settings	= $this->settings_admin();	
		return view("Admin.admin.edit")
				->with("admin", $admin['data']["Value"])
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

		$id_admin		= $req->post('id_admin');
		
		$name 			= $req->post("name");
		$email			= $req->post("email");
		$born_place		= $req->post("born_place");
		$address		= $req->post("address");
		$phone 			= $req->post("phone");
		$gender 		= $req->post("gender");
		$status 		= $req->post("status");
		$data			= array(
								"id_admin"=>intval($id_admin),
								"name"=>$name,
								"email"=>$email,
								"born_place"=>$born_place,
								"gender"=>intval($gender),
								"phone"=>$phone,
								"address"=>$address,
								"status_active"=>intval($status),
								"last_updater"=>1,
							);	
							
		//check image
		if($req->hasFile("avatar")){
			$img					= $req->file("avatar");
			$name					= time().".".$img->getClientOriginalExtension();
			$path					= public_path("assets/images/admin/");
			$img->move($path, $name);
			
			$data["avatar"] = $name;
		}
		$method	= 'PUT';
		$path 	= 'api/v1/admins/update';
		$result = $this->_api(5, $path, $method, $data);
		
		$msg = 'Successfully Updated!';
		if(!empty($result["data"]) && $result["data"]!=="success")
			$msg = 'Failed Updated!';
		
		return redirect("admin/admin/edit/".$id_admin)->withErrors($msg);
	}
	
	public function delete($id)
	{
		$admin 		= $this->_api(5, 'api/v1/admins/show/'.$id);
		if($admin==-1) return redirect("admin/login");
		
		$settings	= $this->settings_admin();	
		return view("Admin.admin.delete")
				->with("admin", $admin['data']["Value"])
				->with("set", $settings);
	}
	
	public function delete_act(Request $req)
	{
		$id_admin		= $req->post('id_admin');
		$data			= array(
								"id_admin"=>intval($id_admin),
								"status_active"=>-1,
							);	
		$method	= 'PUT';
		$path 	= 'api/v1/admins/delete';
		$result = $this->_api(5, $path, $method, $data);
		
		$msg = 'Successfully Removed!';
		if(!empty($result["data"]) && $result["data"]!=="success")
			$msg = 'Failed Removed!';
		
		return redirect("admin/admin/")->withErrors($msg);
	}
}


