<?php
namespace App\Http\Middleware;
use App\Http\Controllers\Controller;
use Closure;
use Exception;
use App\Models\User;
use Session;
use Request;
use Cookie;
class isAdmin extends Controller
{
    public function handle($request, Closure $next, $guard = null)
    {
		//check session and cookie
        //if(empty(Session::get("id_admin"))||$request->cookie('token_admin')=="")
        if(empty(Session::get("id_admin")))
			return redirect("admin/login");
		
		//check role permissions
		$allow 	= false;
		if(empty($this->settings_admin()[1]))
			return redirect("admin/login");
			
		$perm 	= $this->settings_admin()[1]["data"];
		if(empty($perm))
			return redirect("admin/login");
			
		$path 	= explode("/", Request::path())[0]."/".explode("/", Request::path())[1];
		foreach($perm as $p)
		{
			if($path !== "admin/home" && $path !== "admin/logout")
			{
				if($p["name"] == $path){
					$allow = true;
					break;
				}
			}else{
				$allow = true;
				break;
			}
		}
		if($allow == false)
		{
			//session()->flush();
			//Cookie::queue(Cookie::forget('token_admin'));
			return redirect("admin/login")->withErrors("You don't have access to this page!");;
		}
			
        return $next($request);
    }
}