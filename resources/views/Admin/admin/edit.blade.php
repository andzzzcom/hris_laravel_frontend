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
					<li class="breadcrumb-item">
						<a href="{{ url('admin/admin') }}">Admin List</a>
					</li>
                    <li class="breadcrumb-item active" aria-current="page">
						<span>Update Admin</span>
					</li>
				</ol>
			</nav>
			
			<form method="post" enctype="multipart/form-data" action="{{ url('admin/admin/edit') }}">
			@csrf
			<div class="row" id="cancel-row">
				<input type="hidden" name="id_admin" value="{{$admin[0]['id_admin']}}">
				<div id="flStackForm" class="col-lg-6 layout-spacing">
					<div class="statbox widget box box-shadow">
						<div class="widget-header">                                
							<div class="row">
								<div class="col-xl-12 col-md-12 col-sm-12 col-12">
									<h4>Update Admin</h4>
								</div>                                                                        
							</div>
						</div>
						<div class="widget-content widget-content-area">
						@if($errors->any())
							@foreach($errors->all() as $err)
								<p> {{$err}} </p>
							@endforeach
						@endif
							<label for="nameAdmin">Name</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon5"><i class="fa fa-user"></i></span>
								</div>
								<input type="text" value="{{$admin[0]['name']}}" class="form-control" required placeholder="Insert Admin Name" name="name">
							</div>
							
							<label for="emailAdmin">Email</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon5"><i class="fa fa-envelope"></i></span>
								</div>
								<input type="email" value="{{$admin[0]['email']}}" class="form-control" required placeholder="Insert Admin Email" name="email">
							</div>
							
							<label for="phoneAdmin">Phone</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon5"><i class="fa fa-phone"></i></span>
								</div>
								<input type="text" value="{{$admin[0]['phone']}}" class="form-control" required placeholder="Insert Admin Phone" name="phone">
							</div>
							
							<label for="addressAdmin">Address</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon5"><i class="fa fa-home"></i></span>
								</div>
								<input type="text" value="{{$admin[0]['address']}}" class="form-control" required placeholder="Insert Admin Address" name="address">
							</div>
							
							<label for="bornPlaceAdmin">Born Place</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon5"><i class="fa fa-home"></i></span>
								</div>
								<input type="text" value="{{$admin[0]['born_place']}}" class="form-control" required placeholder="Insert Admin Born Place" name="born_place">
							</div>
						</div>
					</div>
				</div>
				<div id="flStackForm" class="col-lg-6 layout-spacing">
					<div class="statbox widget box box-shadow">
						<div class="widget-content widget-content-area">
							<label for="photoAdmin">Photo</label>
							<br>
							<img src="{{asset('assets/images/admin/'.$admin[0]['avatar'])}}" style="width:100px;height:auto">
							<br>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon5"><i class="fa fa-user"></i></span>
								</div>
								<input name="avatar" type="file" class="form-control">
							</div>
							
							<label for="genderAdmin">Gender</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon5"><i class="fa fa-user-alt"></i></span>
								</div>
								<select name="gender" class="form-control">
									<option @if($admin[0]['gender']==1) selected @endif value="1">Male</option>
									<option @if($admin[0]['gender']==0) selected @endif value="0">Female</option>
								</select>
							</div>
														
							<label for="statusAdmin">Status</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon5"><i class="fa fa-toggle-on"></i></span>
								</div>
								<select name="status" class="form-control">
									<option @if($admin[0]['status_active']==1) selected @endif value="1">Active</option>
									<option @if($admin[0]['status_active']==0) selected @endif value="0">Not Active</option>
								</select>
							</div>
							
							<a href="{{ url('admin/admin') }}" class="btn btn-danger mt-3">
								<i class="fa fa-arrow-left"></i> 
								Cancel
							</a>
							<button type="submit" class="btn btn-primary mt-3">
								<i class="fa fa-save"></i>
								Update
							</button>
						</div>
					</div>
				</div>
			</div>
			</form>
			
		</div>
	</div>
	<!--  END CONTENT AREA  -->
	@endsection