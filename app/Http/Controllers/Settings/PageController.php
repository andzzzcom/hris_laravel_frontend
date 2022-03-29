<?php

namespace App\Http\Controllers\Apps;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Session;

class PageController extends Controller{
	
	public function index()
	{
		$pages 	= $this->_api(1, 'api/v1/page');
		if($pages==-1) return redirect("admin/login");
			
		$settings	= $this->settings_admin();	
		return view("Admin.page.list")
				->with("pages", $pages['data'])
				->with("set", $settings);
	}
	
	public function add()
	{
		$settings	= $this->settings_admin();	
		return view("Admin.page.add")
				->with("set", $settings);
	}
	
	public function add_act(Request $req)
	{
		$rules	= [
			"name"=>"required|min:3",
			"slug"=>"required|min:3",
			"content"=>"required|min:3",
			"meta_title"=>"required|min:5",
			"meta_keywords"=>"required|min:5",
			"meta_description"=>"required|min:5",
			"status"=>"required",
		];
		$check = Validator::make($req->all(), $rules);
		if($check->fails())
			return back()->withErrors($check->errors())->withInput();
			
		//add request params
		$req->request->add(
			[
				'creator'=>Session::get("id_admin"),
				'last_updater'=>Session::get("id_admin")
			]
		);
		
		$method	= 'POST';
		$path 	= 'api/v1/page';
		$result = $this->_api(1, $path, $method, $req->all());
		
		$msg = 'Successfully Created!';
		if(!empty($result["data"]) && $result["data"]!=="success")
			return redirect("admin/page")->withErrors($result["data"])->withInput();
		
		return redirect("admin/page")->withErrors($msg);
	}
	
	public function edit($id)
	{
		$page 		= $this->_api(1, 'api/v1/page/'.$id);
		if($page==-1) return redirect("admin/login");
			
		$settings	= $this->settings_admin();	
		return view("Admin.page.edit")
				->with("page", $page['data'])
				->with("set", $settings);
	}
	
	public function edit_act(Request $req)
	{
		$id = $req->post('id_page');
		$rules	= [
			"name"=>"required|min:3",
			"slug"=>"required|min:3",
			"content"=>"required|min:3",
			"meta_title"=>"required|min:5",
			"meta_keywords"=>"required|min:5",
			"meta_description"=>"required|min:5",
			"status"=>"required",
		];
		$check = Validator::make($req->all(), $rules);
		if($check->fails())
			return back()->withErrors($check->errors())->withInput();
					
		//add request params
		$req->request->add(
			[
				'last_updater'=>Session::get("id_admin")
			]
		);
		
		$method	= 'PUT';
		$path 	= 'api/v1/page/'.$id;
		$result = $this->_api(1, $path, $method, $req->all());
		
		$msg = 'Successfully Updated!';
		if(!empty($result["data"]) && $result["data"]!=="success")
			$msg = 'Failed Updated!';
		
		return redirect("admin/page/edit/".$id)->withErrors($msg);
	}
	
	public function delete($id)
	{
		$page 		= $this->_api(1, 'api/v1/page/'.$id)['data'];
		if($page==-1) return redirect("admin/login");
					
		$settings	= $this->settings_admin();	
		return view("Admin.page.delete")
				->with("page", $page)
				->with("set", $settings);
	}
	
	public function delete_act(Request $req)
	{
		$id = $req->post('id_page');
		$req->request->add(
			[
				'status'=>-1,
				'last_updater'=>Session::get("id_admin")
			]
		);
		
		$method	= 'DELETE';
		$path 	= 'api/v1/page/'.$id;
		$result = $this->_api(1, $path, $method, $req->all());
		
		$msg = 'Successfully Removed!';
		if(!empty($result["data"]) && $result["data"]!=="success")
			$msg = 'Failed Updated!';
		
		return redirect("admin/page/")->withErrors($msg);
	}
}


