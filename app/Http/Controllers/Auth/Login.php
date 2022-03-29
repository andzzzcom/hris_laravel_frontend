<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Admin_m;
use App\Models\User_m;
use App\Models\Category_m;
use App\Models\Discussion_m;
use App\Models\Follow_m;

use Hash;
use Validator;
use Session;
use Cookie;

use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class Login extends Controller
{
	public function _construct()
	{
		
	}
	
    public function login()
	{
		$settings	= $this->settings();
		return view("Admin.login")
			->with("set", $settings);
	}
	
	/*
    public function login_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'username'=>'required|min:6|max:30|regex:/^[A-Za-z0-9]+$/',
			'password'=>'required|min:5'
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors());
		}else
		{
			$username = $req->username;
			$login = (new Admin_m)->get_by_username($username);
			if($login->count() > 0)
			{
				$pass = $login[0]->password_admin;
				if(Hash::check($req->password, $pass))
				{
					$id 		= $login[0]->id_admin;
					$username 	= $login[0]->username_admin;		
					$name 		= $login[0]->name_admin;		
					$phone 		= $login[0]->phone_admin;		
					$gender		= $login[0]->gender_admin;		
					$email 		= $login[0]->email_admin;		
					$avatar 	= $login[0]->avatar_admin;		
					Session::put('id_admin', $id);
					Session::put('username_admin', $username);
					Session::put('email_admin', $email);
					Session::put('name_admin', $name);
					Session::put('phone_admin', $phone);
					Session::put('gender_admin', $gender);
					Session::put('avatar_admin', $avatar);
					Session::put('csrf_admin', csrf_token());
					
					return redirect("/admin/home");
				}else{
					return back()->withErrors("Wrong Eamail/Password!");
				}
			}else{
				return back()->withErrors("Wrong Emaaaaail/Password!");
			}
		}
	}
	*/
	
	public function login_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'email'=>'required|min:6|max:100',
			'password'=>'required|min:5'
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors());
		}else
		{
			$email 		= $req->email;
			$password 	= $req->password;
			$data		= array(
							"email"=>$email,
							"password"=>$password,
						);
			$method		= 'POST';
			$path 		= 'api/v1/login';
			$tool 	= $this->_api(5, $path, $method, $data)["data"];
			if($tool !== "failed")
			{
				$token 	  = $tool["token"];
				Session::put("token_admin", $token);
				//$response = new Response('Set Cookie');
				//Cookie::queue((cookie('token_admin', $token, 99999)));
				
				$admin	   	= $tool["user"];
				$id 		= $admin[0]["id_admin"];
				$name 		= $admin[0]["name"];	
				$email 		= $admin[0]["email"];	
				$phone 		= $admin[0]["phone"];	
				$gender		= $admin[0]["gender"];	
				$avatar		= $admin[0]["avatar"];		
				$role		= $admin[0]["id_role"];		
				Session::put('id_admin', $id);
				Session::put('email_admin', $email);
				Session::put('name_admin', $name);
				Session::put('phone_admin', $phone);
				Session::put('gender_admin', $gender);
				Session::put('avatar_admin', $avatar);
				Session::put('role_admin', $role);
				Session::put('csrf_admin', csrf_token());
				
				//$this->insert_log_user();
				
				return redirect("/admin/home");
			}
			else{
				return back()->withErrors("Wrong Email/Password!");
			}
		}
	}
	
	public function logout()
	{
		session()->flush();
		//Cookie::queue(Cookie::forget('token_admin'));
		return redirect("/admin/login");
	}
	
	public function redirect_login()
	{
		return redirect("admin/login");
	}
	
	private function setCookie(Request $request) {
      $minutes = 1;
      $response = new Response('Hello World');
      $response->withCookie(cookie('name', 'virat', $minutes));
      return $response;
	}
	
	private function getCookie(Request $request) {
      $value = $request->cookie('name');
      echo $value;
	}
	
	private function insert_log_user()
	{
		$id 	= Session::get('id_admin');
		$data	= array(
						"id_admin"=>$id,
					);
		$method	= 'POST';
		$path 	= 'log/add';
		$result = $this->_api(1, $path, $method, $data);
	}
}
