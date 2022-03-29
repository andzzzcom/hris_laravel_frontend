<?php

namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Hash;
use Session;

class AdminController extends Controller{
	
	public function index()
	{
		$admins 	= $this->_api(2, 'api/v1/admin');
		if($admins==-1) return redirect("admin/login");
		
		$settings	= $this->settings_admin();	
		return view("Admin.admin.list")
				->with("admins", $admins['data'])
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
		
		$name 			= $req->post("name");
		$email			= $req->post("email");
		$born_date		= $req->post("born_date");
		$born_place		= $req->post("born_place");
		$password 		= '12345678';
		$address		= $req->post("address");
		$description	= $req->post("description");
		$phone 			= $req->post("phone");
		$role	 		= $req->post("id_role");
		$gender 		= $req->post("gender");
		$status 		= $req->post("status");
		$data			= array(
								"email"=>$email,
								"born_date"=>$born_date,
								"born_place"=>$born_place,
								"password"=>Hash::make($password),
								"name"=>$name,
								"phone"=>$phone,
								"description"=>$description,
								"address"=>$address,
								"gender"=>$gender,
								"id_role"=>$role,
								"creator"=>Session::get("id_admin"),
								"last_updater"=>Session::get("id_admin"),
								"status"=>$status,
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
		$path 	= 'api/v1/admin';
		$result = $this->_api(2, $path, $method, $data);
		
		
		$msg = 'Successfully Created!';
		if(!empty($result["data"]) && $result["data"]!=="success")
			return redirect("admin/admin")->withErrors($result["data"])->withInput();
		
		return redirect("admin/admin")->withErrors($msg);
	}
	
	public function edit($id)
	{
		$admin 		= $this->_api(2, 'api/v1/admin/'.$id);
		if($admin==-1) return redirect("admin/login");
			
		$roles		= $this->_api(2, 'api/v1/role/list');
		
		$settings	= $this->settings_admin();	
		return view("Admin.admin.edit")
				->with("admin", $admin['data'][0])
				->with("roles", $roles['data'])
				->with("set", $settings);
	}
	
	public function edit_act(Request $req)
	{
		$id_admin = $req->post('id_admin');
		
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
		
		$name 			= $req->post("name");
		$email			= $req->post("email");
		$born_date		= $req->post("born_date");
		$born_place		= $req->post("born_place");
		$address		= $req->post("address");
		$description	= $req->post("description");
		$phone 			= $req->post("phone");
		$role	 		= $req->post("id_role");
		$gender 		= $req->post("gender");
		$status 		= $req->post("status");
		$data			= array(
								"id_admin"=>$id_admin,
								"email"=>$email,
								"born_date"=>$born_date,
								"born_place"=>$born_place,
								"name"=>$name,
								"phone"=>$phone,
								"address"=>$address,
								"description"=>$description,
								"gender"=>$gender,
								"id_role"=>$role,
								"last_updater"=>Session::get("id_admin"),
								"status"=>$status,
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
		$path 	= 'api/v1/admin/edit';
		$result = $this->_api(2, $path, $method, $data);
		
		$msg = 'Successfully Updated!';
		if(!empty($result["data"]) && $result["data"]!=="success")
			$msg = 'Failed Updated!';
		
		return redirect("admin/admin/edit/".$id_admin)->withErrors($msg);
	}
	
	public function delete($id)
	{
		$admin 		= $this->_api(2, 'api/v1/admin/'.$id);
		if($admin==-1) return redirect("admin/login");
			
		$roles		= $this->_api(2, 'api/v1/role/list');
		$settings	= $this->settings_admin();	
		return view("Admin.admin.delete")
				->with("admin", $admin["data"][0])
				->with("roles", $roles["data"])
				->with("set", $settings);
	}
	
	public function delete_act(Request $req)
	{
		$id = $req->post('id_admin');
		$req->request->add(
			[
				'status'=>-1,
				'last_updater'=>Session::get("id_admin")
			]
		);
		
		$method	= 'DELETE';
		$path 	= 'api/v1/admin/'.$id;
		$result = $this->_api(2, $path, $method, $req->all());
		
		$msg = 'Successfully Removed!';
		if(!empty($result["data"]) && $result["data"]!=="success")
			$msg = 'Failed Updated!';
		
		return redirect("admin/admin/")->withErrors($msg);
	}
}


