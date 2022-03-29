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

class Forgot extends Controller
{
	public function _construct()
	{
		
	}
	
    public function forgot()
	{
		$settings	= $this->settings();
		return view("Admin.auth.forgot.forgot")
			->with("set", $settings);
	}
	
	public function forgot_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'email'=>'required|min:5|max:200',
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors());
		}else
		{
			$email 		= $req->email;
			$data		= array(
							"email"=>$email,
						);
			$path 		= 'forgot_password';
			$method		= 'Post';
			$user 		= $this->_api(2, $path, $method, $data)["data"];
			if(!empty($user["status"]) && $user["status"] == "success")
			{
				$datas["token"]	= $user["token"];
				$datas["email"] = $email;
				$datas["link"] 	= url('admin/reset_pass/'.$email.'/'.$user["token"]);
				$this->send_email($datas);
				return back()->withErrors("Check Your Email to Reset Password!");
			}
			else{
				return back()->withErrors("Wrong Email/Password!");
			}
		}
	}
	
	public function reset_pass($email, $token)
	{
		$msg = "";
		$data		= array(
						"email"=>$email,
						"token_reset"=>$token,
						"status_reset"=>1,
						"expired_reset"=>date("Y-m-d H:i:s"),
					);
		$path 		= 'check_reset_password';
		$method		= 'Post';
		$user 		= $this->_api(2, $path, $method, $data)["data"];
		if(!empty($user[0]["status"]) && $user[0]["status"] == 1)
		{
			$settings	= $this->settings();
			return view("Admin.auth.forgot.reset_pass")
				->with("id", $user[0]["id_admin"])
				->with("email", $email)
				->with("token", $token)
				->with("set", $settings);
		}
		else{
			return redirect("not_found");
		}
	}
	
	public function reset_pass_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'password' => 'min:5|required_with:password_confirmation|same:password_confirmation',
			'password_confirmation'=>'required|min:5',
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors());
		}else
		{
			$id		 					= $req->id;
			$email	 					= $req->email;
			$token	 					= $req->token;
			$password 					= $req->password;
			$password_confirmation 		= $req->password_confirmation;
			$data						= array(
											"id_admin"=>$id,
											"password"=>$password,
											"email"=>$email,
											"token"=>$token,
											"expired_reset"=>date("Y-m-d H:i:s"),
										);
			$path 		= 'reset_password';
			$method		= 'put';
			$user 		= $this->_api(2, $path, $method, $data)["data"];
			if($user == "success")
			{
				return back()->withErrors("Successfully Reset Password!");
			}
			else{
				return back()->withErrors("Failed Reset Password!");
			}
		}
	}
}
