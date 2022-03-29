<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
   
	<meta name="description" content="{{$set['meta_description']}}">
	<meta name="keywords" content="{{$set['meta_keywords']}}">
	<meta name="title" content="{{$set['meta_title']}}">
	
	<title> Admin: Set New Password </title>
	<link rel="icon" type="image/x-icon" href="{{ asset('assets/theme1/images/settings/'.$set['favicon_website'] ) }}"/>
		
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('assets_admin/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets_admin/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets_admin/assets/css/authentication/form-2.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_admin/assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_admin/assets/css/forms/switches.css') }}">
</head>
<body class="form">
    

    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
						<img style="width:150px;height:auto;" src="{{asset('assets/images/settings/'.$set['logo_website'])}}"><br>
                        <br><p class="">Set New Password</p>
                        
                        <form class="text-left" method="post" action="{{ url('admin/reset_pass') }}">
                            @csrf
							<div class="form">
								
								@if($errors->any())
									@foreach($errors->all() as $err)
										<div class="form-group text-center">
											<h5 class="fbold cred2">
											{{ $err }}
											</h5>
										</div>
									@endforeach
								@endif
								<input type="hidden" value="{{$id}}" name="id">
								<input type="hidden" value="{{$token}}" name="token">
								<input type="hidden" value="{{$email}}" name="email">
                                <div id="password-field" class="field-wrapper input">
                                    <label for="password" style="font-size:14px">New Password</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="enter your password here">
                                </div>
                                <div id="password-field" class="field-wrapper input">
                                    <label for="password" style="font-size:14px">New Password (confirm)</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password_confirm" name="password_confirmation" type="password" class="form-control" placeholder="enter your password here (confirm)">
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>                    
                </div>
            </div>
        </div>
    </div>

    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets_admin/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('assets_admin/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets_admin/bootstrap/js/bootstrap.min.js') }}"></script>
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets_admin/assets/js/authentication/form-2.js') }}"></script>

</body>
</html>