<?php

namespace App\Http\Controllers\Settings;
use App\Http\Controllers\Controller;
use GuzzleHtpp\Exception\GuzzleException;
use GuzzleHttp\Client;

use Illuminate\Http\Request;
use Validator;
use Session;

class SettingController extends Controller
{
	public function __construct()
	{
		
	}
	
	public function general()
	{
		$path 		= 'api/v1/settings';
		$setting 	= $this->_api(5, $path)['data'];
		
		$settings	= $this->settings_admin();	
		return view("Admin.setting.general")
			->with("set", $settings)
			->with("setting", $setting["Value"]);
	}
	
	public function general_act(Request $req)
	{
		$check = Validator::make($req->all(), [
			"id_setting"=>"required",
			"title_web"=>"required|min:5",
			"subtitle_web"=>"required|min:5",
		]);
		if($check->fails())
			return back()->withErrors($check->errors())->withInput();
			
		$id_setting		= $req->post("id_setting");
		$title_web		= $req->post("title_web");
		$subtitle_web	= $req->post("subtitle_web");
		$data			= array(
									"id_setting"=>intval($id_setting),
									"title_web"=>$title_web,
									"subtitle_web"=>$subtitle_web,
								);
		
		if($req->hasFile("favicon_web")){
			$img					= $req->file("favicon_web");
			$name					= time().".".$img->getClientOriginalExtension();
			$path					= public_path("assets/images/settings/");
			$img->move($path, $name);
			$data["favicon_web"] = $name;
		}
		
		if($req->hasFile("logo_web")){
			$img					= $req->file("logo_web");
			$name2					= md5(time()).".".$img->getClientOriginalExtension();
			$path					= public_path("assets/images/settings/");
			$img->move($path, $name2);
			$data["logo_web"] = $name2;
		}
		$method	= 'PUT';
		$path 	= 'api/v1/settings/update';
		$result = $this->_api(5, $path, $method, $data);
		
		$msg = 'Successfully Updated!';
		return redirect("admin/setting/general")->withErrors($msg);
	}

}
