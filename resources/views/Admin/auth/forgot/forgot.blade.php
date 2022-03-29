<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
   
	<meta name="description" content="{{$set['meta_description']}}">
	<meta name="keywords" content="{{$set['meta_keywords']}}">
	<meta name="title" content="{{$set['meta_title']}}">
	
	<title> Admin: Reset Password </title>
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
                        <br><p class="">Reset Password</p>
                        
                        <form class="text-left" method="post" action="{{ url('admin/forgot') }}">
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

                                <div id="username-field" class="field-wrapper input">
                                    <div class="d-flex justify-content-between">
										<label for="email" style="font-size:14px">Email</label>
										<a href="{{url('admin/login')}}" class="forgot-pass-link">Have account? Login Now</a>
									</div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="email" name="email" type="email" class="form-control" placeholder="enter your email here">
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">Forgot</button>
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