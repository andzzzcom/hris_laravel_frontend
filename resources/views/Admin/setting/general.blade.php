@extends("Admin.incl.layout")

	@section("content")
	<!--  BEGIN CONTENT AREA  -->
	<div id="content" class="main-content">
		<div class="layout-px-spacing">

			<nav class="breadcrumb-one layout-top-spacing" aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="{{ url('admin/home') }}">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
						</a>
					</li>
                    <li class="breadcrumb-item active" aria-current="page">
						<span>General Settings</span>
					</li>
				</ol>
			</nav>
				
			<div class="row" id="cancel-row">
				<div id="flStackForm" class="col-lg-6 layout-spacing">
					<div class="statbox widget box box-shadow">
						<div class="widget-header">                                
							<div class="row">
								<div class="col-xl-12 col-md-12 col-sm-12 col-12">
									<h4>General Settings</h4>
								</div>                                                                        
							</div>
						</div>
						<div class="widget-content widget-content-area">
							@if($errors->any())
								@foreach($errors->all() as $err)
									<p> {{$err}} </p>
								@endforeach
							@endif
							<form method="post" enctype="multipart/form-data" action="{{ url('admin/setting/general') }}">
								@csrf
								<input type="hidden" value="{{ $setting[0]['id_setting'] }}" name="id_setting">
								<label for="titleWebsite">Title Website</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-file"></i></span>
									</div>
									<input value="{{ $setting[0]['title_web'] }}" placeholder="Insert Title Website" type="text" name="title_web" class="form-control" id="titleWebsite">
								</div>

								<label for="subTitleWebsite">Subtitle Website</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-file"></i></span>
									</div>
									<input value="{{ $setting[0]['subtitle_web'] }}" placeholder="Insert Title Website" type="text" name="subtitle_web" class="form-control" id="titleWebsite">
								</div>
								
								<label for="favicon">Favicon</label>
								<br>
								<img style="width:150px;height:auto" src="{{ asset('assets/images/settings/'.$setting[0]['favicon_web']) }}">
								<br>	
								<br>	
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-image"></i></span>
									</div>
									<br>
									<input type="file" class="form-control" name="favicon_web" id="favicon">
								</div>
								
								<label for="logoWebsite">Logo</label>
								<br>
								<img style="width:150px;height:auto" src="{{ asset('assets/images/settings/'.$setting[0]['logo_web']) }}">
								<br>	
								<br>	
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-image"></i></span>
									</div>
									<br>
									<input type="file" class="form-control" name="logo_web" id="logoWebsite">
								</div>
								<a href="{{ url('admin/setting/general') }}" class="btn btn-danger mt-3">
									<i class="fa fa-arrow-left"></i> 
									Cancel
								</a>
								<button type="submit" class="btn btn-primary mt-3">
									<i class="fa fa-save"></i>
									Update
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!--  END CONTENT AREA  -->
	@endsection