<?php

namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;
use GuzzleHtpp\Exception\GuzzleException;
use GuzzleHttp\Client;

use Illuminate\Http\Request;
use Validator;
use Session;

class RoleController extends Controller
{
	public function __construct()
	{
		
	}
	
	public function index()
	{
		$roles	 	= $this->_api(2, 'api/v1/role/list');
		if($roles==-1) return redirect("admin/login");
			
		$settings	= $this->settings_admin();	
		return view("Admin.role.list")
			->with("set", $settings)
			->with("roles", $roles['data']);
	}
	
	public function add_act(Request $req)
	{
		$check = Validator::make($req->all(), [
			"name"=>"required|min:3|max:25",
			"status"=>"required|between:0,1",
		]);
		if($check->fails())
			return back()->withErrors($check->errors())->withInput();
		
		$name 		= $req->post("name");
		$status		= $req->post("status");
		$data			= array(
								"name"=>$name,
								"status"=>$status,
							);	
		$method	= 'POST';
		$path 	= 'api/v1/role/create';
		$result = $this->_api(2, $path, $method, $data);
		
		$msg = 'Successfully Added!';
		if(!empty($result["data"]) && $result["data"]!=="success")
			return redirect("admin/role/")->withErrors($result["data"])->withInput();
		
		return redirect("admin/role/")->withErrors($msg);
	}
	
	public function detail(Request $req)
	{
		$id_role 	= $req->post("id_role");
		$data		= array(
								"id_role"=>$id_role,
							);	
		$path 		= 'api/v1/role/detail/'.$id_role;
		$role 		= $this->_api(2, $path)["data"];
		return $role;
	}
	
	public function edit_act(Request $req)
	{
		$check = Validator::make($req->all(), [
			"name"=>"required|min:3|max:25",
			"status"=>"required|between:0,1",
		]);
		if($check->fails())
			return back()->withErrors($check->errors())->withInput();
		
		$id_role 	= $req->post("id_role");
		$name 		= $req->post("name");
		$status		= $req->post("status");
		$data			= array(
								"id_role"=>$id_role,
								"name"=>$name,
								"status"=>$status,
							);	
		$method	= 'PUT';
		$path 	= 'api/v1/role/update';
		$result = $this->_api(2, $path, $method, $data);
		
		$msg = 'Successfully Added!';
		if(!empty($result["data"]) && $result["data"]!=="success")
			return redirect("admin/role/")->withErrors($result["data"])->withInput();
		
		return redirect("admin/role/")->withErrors($msg);
	}
	
	public function delete_act(Request $req)
	{
		$id 	= $req->post("id_role");
		$data	= array(
							"id_role"=>$id,
						);
		$method	= 'delete';
		$path 	= 'api/v1/role/delete';
		$result = $this->_api(2, $path, $method, $data);
		
		$msg = 'Successfully Removed!';
		if(!empty($result["data"]) && $result["data"]=="fail"){
			$msg = 'Failed Removed!';
		}
		$msg = 'Successfully Removed!';
		return redirect("admin/role/")->withErrors($msg);
	}
	
	public function role_menu(Request $req)
	{
		$id_role	= $req->post("id_role");
		$path 		= 'api/v1/role_menu/detail/'.$id_role;
		$role_menu	= $this->_api(2, $path)["data"];
		return $role_menu;
	}
	
	public function role_menu_detail($id_role)
	{
		$path 		= 'api/v1/role_menu/detail2/'.$id_role;
		$role_menu	= $this->_api(2, $path)["data"];
		return $role_menu;
	}
	
	public function status(Request $req)
	{
		$stat 		= request()->post("stat");
		$id_role 	= request()->post("id_role");
		$id_menu 	= request()->post("id_menu");
		$data_role 	= array(
						"id_role"=>$id_role,
						"id_menu"=>$id_menu,
					);
		if($stat == 1)
		{
			$data_role["status"] = 1;
			$method	= 'POST';
			$path 	= 'api/v1/role_menu/create';
			$result = $this->_api(2, $path, $method, $data_role);
			
			echo 1;
		}else
		{
			$data_role["status"] = -1;
			$method	= 'PUT';
			$path 	= 'api/v1/role_menu/update';
			$result = $this->_api(2, $path, $method, $data_role);
			
			echo 0;
		}
	}
}
