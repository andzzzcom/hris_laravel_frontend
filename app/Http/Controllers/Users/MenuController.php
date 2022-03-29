<?php

namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;
use GuzzleHtpp\Exception\GuzzleException;
use GuzzleHttp\Client;

use Illuminate\Http\Request;
use Validator;
use Session;

class MenuController extends Controller
{
	public function __construct()
	{
		
	}
	
	public function index()
	{
		$menus	 	= $this->_api(2, 'api/v1/menu/list');
		if($menus==-1) return redirect("admin/login");
			
		$settings	= $this->settings_admin();	
		return view("Admin.role.menu.list")
			->with("set", $settings)
			->with("menus", $menus['data']);
	}
	
	public function add_act(Request $req)
	{
		$check = Validator::make($req->all(), [
			"name"=>"required|min:3|max:100",
			"status"=>"required|between:0,1",
		]);
		if($check->fails())
			return back()->withErrors($check->errors())->withInput();
		
		$name 		= $req->post("name");
		$status		= $req->post("status");
		$data		= array(
							"name"=>$name,
							"status"=>$status,
						);	
		$method	= 'POST';
		$path 	= 'api/v1/menu/create';
		$result = $this->_api(2, $path, $method, $data);
		
		$msg = 'Successfully Added!';
		if(!empty($result["data"]) && $result["data"]!=="success")
			return redirect("admin/menu/")->withErrors($result["data"])->withInput();
		
		return redirect("admin/menu/")->withErrors($msg);
	}
	
	public function detail(Request $req)
	{
		$id_menu 	= $req->post("id_menu");
		$data		= array(
								"id_role"=>$id_menu,
							);	
		$path 		= 'api/v1/menu/detail/'.$id_menu;
		$menu 		= $this->_api(2, $path)["data"];
		return $menu;
	}
	
	public function edit_act(Request $req)
	{
		$check = Validator::make($req->all(), [
			"name"=>"required|min:3|max:100",
			"status"=>"required|between:0,1",
		]);
		if($check->fails())
			return back()->withErrors($check->errors())->withInput();
		
		$id_menu 	= $req->post("id_menu");
		$name	 	= $req->post("name");
		$status		= $req->post("status");
		$data			= array(
								"id_menu"=>$id_menu,
								"name"=>$name,
								"status"=>$status,
							);	
		$method	= 'PUT';
		$path 	= 'api/v1/menu/update';
		$result = $this->_api(2, $path, $method, $data);
		
		$msg = 'Successfully Added!';
		if(!empty($result["data"]) && $result["data"]!=="success")
			return redirect("admin/menu/")->withErrors($result["data"])->withInput();
		
		return redirect("admin/menu/")->withErrors($msg);
	}
	
	public function delete_act(Request $req)
	{
		$id 	= $req->post("id_menu");
		$data	= array(
							"id_menu"=>$id,
							"status"=>-1,
						);
		$method	= 'delete';
		$path 	= 'api/v1/menu/delete';
		$result = $this->_api(2, $path, $method, $data);
		
		$msg = 'Successfully Removed!';
		if(!empty($result["data"]) && $result["data"]=="fail"){
			$msg = 'Failed Removed!';
		}
		$msg = 'Successfully Removed!';
		return redirect("admin/menu/")->withErrors($msg);
	}
	
	public function menu()
	{
		$path 	= 'api/v1/menu/list';
		$role 	= $this->_api(2, $path);
		if($role["code"]!==200)
			return redirect("admin/login");
			
		$settings	= $this->settings_admin();	
		return view("Admin.role.menu.list")
			->with("set", $settings)
			->with("menu", $menu["data"]);
	}
}
