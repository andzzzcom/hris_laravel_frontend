<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Session;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function _api($type, $path, $method='GET', $data=[])
	{
		$type	= $this->check_type($type);
		//$token  = (request()->cookie('token_admin')!==null)?request()->cookie('token_admin'):Session::get("token");	
		$token  = $this->get_token();	
		$url 	= $type.'/'.$path;
		$params = array( 
					'body'=>json_encode($data), 
					'headers' => [
						'Authorization' => 'Bearer '. $token
					],
				);
		$client = new Client();
		try
		{
			$res = json_decode((string)$client->request($method, $url, $params)->getBody(), true);
			if(!empty($res["code"]) && $res["code"]!==200)
			{
				$res["data"] = [];
				return $res;
			}
			return $res;
		}catch(GuzzleException $e)
		{
			return -1;
		}
	}
	
	private function check_type($type)
	{
		$url = '';
		switch($type){
			case(1):
				$url = env('APP_SERVICE_URL');
				break;
			case(2):
				$url = env('ARTICLE_SERVICE_URL');
				break;
			case(3):
				$url = env('EDITING_SERVICE_URL');
				break;
			case(5):
				$url = 'localhost:8090';
				break;
			default:
				break;
		}
		return $url;
	}
	
	public function settings_admin()
	{
		$path 		= 'api/v1/settings';
		$set	 	= $this->_api(5, $path)["data"]["Value"][0];
		
		/*$id_admin	= Session::get("id_admin");
		if($id_admin == null){
			return -1;
		}*/
		
		//check permission
		//$id_role 	= Session::get("role_admin");
		//$path 		= 'role_menu/detail2/'.$id_role;
		
		$path 		= 'api/v1/role_menu/detail2/1';
		$role_menu	= $this->_api(2, $path);
		
		$settings[0] = $set;
		$settings[1] = $role_menu;
		return $settings;
	}
	
	public function settings()
	{
		$path 		= 'api/v1/settings';
		$settings 	= $this->_api(5, $path)["data"]["Value"][0];
		
		return $settings;
	}
	
	private function get_token()
	{
		$token  = '';
		if(!empty(Session::get("token")))
		{
			$token = Session::get("token");
		}else{
			if(!empty(Session::get("token_admin")))
				$token = Session::get("token_admin");
		}
		return $token;
	}
	
	//check tools
	public function get_tools_details($tools)
	{
		//get all tools
		$path 	= 'tool/list';
		$api 	= $this->_api(2, $path)["data"];
		
		$res=[];
		foreach($tools as $t)
		{
			foreach($api as $a)
			{
				if($a["id_tool"] == $t)
				{
					//check total questions
					$path 	= 'tools/'.$a["db_name"];
					$ntool 	= count($this->_api(2, $path)["data"][1]);
					
					$state	= array(
								"id"=>$a["id_tool"],
								"total_question"=>$ntool,
								"db_model"=>$a["db_model"],
								"db_name"=>$a["db_name"],
								"show_all"=>$a["show_all"],
							);
					array_push($res, $state);
				}
			}
		}
		return $res;
	}
	
    public function send_email($data)
	{
		Mail::to($data["email"])
			->send(new SendEmail($data));
	}
}
