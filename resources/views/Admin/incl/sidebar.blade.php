
	<!--  BEGIN SIDEBAR  -->
	<div class="sidebar-wrapper sidebar-theme">
		
		<nav id="sidebar">

			<ul class="navbar-nav theme-brand flex-row  text-center">
				<li class="nav-item theme-logo">
					<a href="{{ url('admin/home') }}">
						<img class="img-thumbnail" style="margin:5px;width:50px;height:auto;" src="{{asset('assets/images/settings/'.$set[0]['logo_web'])}}"><br>
                    </a>
				</li>
				<li class="nav-item theme-text">
					<a href="{{ url('admin/home') }}" class="nav-link" style="font-size:16px !important"> 
						{{$set[0]["title_web"]}}
					</a>
				</li>
			</ul>

			<ul class="list-unstyled menu-categories" id="accordionExample">
				<li class="menu">
					<a href="#dashboard" id="dashboard-menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
						<div class="">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
							<span>Dashboard</span>
						</div>
						<div>
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
						</div>
					</a>
					<ul class="collapse submenu list-unstyled" id="dashboard" data-parent="#accordionExample">
						<li>
							<a href="{{ url('admin/home') }}"> Home </a>
						</li>
					</ul>
				</li>
				
				<li class="menu menu-heading">
					<div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg><span>Administrative Dashboard</span></div>
				</li>

				<li class="menu">
					<a href="{{ url('admin/home') }}" aria-expanded="true" class="dropdown-toggle">
						<div class="">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
							<span>Dashboard</span>
						</div>
					</a>
				</li>
			
			@php
				$check		= true;

				$articles	= true;
				$categories	= true;
				$comments	= true;
				$pages		= true;
				$subscribes	= true;
				$admins		= true;
				$adss		= true;
				$settings	= true;
				$article	= "admin/article";
				$category	= "admin/category";
				$comment	= "admin/comment";
				$page		= "admin/page";
				$subscribe	= "admin/subscribe";
				$admin 		= "admin/admin";
				$ads 		= "admin/ads";
				$setting	= "admin/setting";
			@endphp
			{{--
			@foreach($set[1]["data"] as $t)
				@if($article==$t["name"])
					@php
						$articles = true;
					@endphp
				@endif
				@if($category==$t["name"])
					@php
						$categories = true;
					@endphp
				@endif
				@if($comment==$t["name"])
					@php
						$comments = true;
					@endphp
				@endif
				@if($admin==$t["name"])
					@php
						$admins = true;
					@endphp
				@endif
				@if($page==$t["name"])
					@php
						$pages = true;
					@endphp
				@endif
				@if($subscribe==$t["name"])
					@php
						$subscribes = true;
					@endphp
				@endif
				@if($ads==$t["name"])
					@php
						$adss = true;
					@endphp
				@endif
				@if($setting==$t["name"])
					@php
						$settings = true;
					@endphp
				@endif
			@endforeach
			--}}
			@if($check == $articles)
				<li class="menu">
					<a href="#tool1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
						<div class="">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
							<span>Employees</span>
						</div>
						<div>
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
						</div>
					</a>
					<ul class="collapse submenu list-unstyled" id="tool1" data-parent="#accordionExample">
						<li>
							<a href="{{ url('admin/employee') }}"> All </a>
						</li>
						<li>
							<a href="{{ url('admin/employee/add') }}"> Add New </a>
						</li>
						<!--<li>
							<a href="#rmib" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> 
								13. RMIB Indonesia 2020
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> 
							</a>
                           	<li> <ul class="collapse list-unstyled sub-submenu" id="rmib" data-parent="#tool1"> 
							
									<a href="{{ url('admin/tool/seven') }}"> List Question </a>
								</li>
							</ul>
						</li>-->
					</ul>
				</li>
			@endif
			
			
			@if($check == $categories)
				<li class="menu">
					<a href="#code" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
						<div class="">
							<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path></svg>
							<span>Department</span>
						</div>
						<div>
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
						</div>
					</a>
					<ul class="collapse submenu list-unstyled" id="code" data-parent="#accordionExample">
						<li>
							<a href="{{ url('admin/department') }}"> List Department </a>
						</li>
						<li>
							<a href="{{ url('admin/department/add') }}"> Add New </a>
						</li>
					</ul>
				</li>
			@endif

			@if($check == $comments)
				<li class="menu">
					<a href="#result" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
						<div class="">
							<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
							<span>Designation</span>
						</div>
						<div>
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
						</div>
					</a>
					<ul class="collapse submenu list-unstyled" id="result" data-parent="#accordionExample">
						<li>
							<a href="{{ url('admin/designation') }}"> List Designation </a>
						</li>
						<li>
							<a href="{{ url('admin/designation/add') }}"> Add New </a>
						</li>
					</ul>
				</li>
			@endif


			@if($check == $admins)
				<li class="menu">
					<a href="#admin" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
						<div class="">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
							<span>Admin</span>
						</div>
						<div>
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
						</div>
					</a>
					<ul class="collapse submenu list-unstyled" id="admin" data-parent="#accordionExample">
						<li>
							<a href="{{ url('admin/admin') }}"> List Admin </a>
						</li>
					</ul>
				</li>
			@endif

			@if($check == $settings)

				<li class="menu">
					<a href="#Settings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
						<div class="">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
							<span>Settings</span>
						</div>
						<div>
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
						</div>
					</a>
					<ul class="collapse submenu list-unstyled" id="Settings" data-parent="#accordionExample">
						<li>
							<a href="{{ url('admin/setting/general') }}"> General </a>
						</li>
					</ul>
				</li>
			@endif
				
				
			</ul>
			
		</nav>

	</div>
	<!--  END SIDEBAR  -->