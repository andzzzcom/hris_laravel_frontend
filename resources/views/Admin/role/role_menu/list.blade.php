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
						<span>List Roles Menus</span>
					</li>
				</ol>
			</nav>

			<div class="row layout-top-spacing" id="cancel-row">
				<div class="col-xl-12 col-lg-12 col-md-8 col-12 layout-spacing">
					<div class="widget-content-area br-4">
						<div class="widget-one">
							<h5>List Roles Menus</h5>
						</div>
					</div>
				</div>
				<div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
					<div class="widget-content widget-content-area br-6">
						<a href="{{ url('admin/menu/add') }}" class="btn btn-primary">
							<i class="fa fa-edit"></i>
							Add New Role Menu
						</a>
						<div class="table-responsive mb-4 mt-4">
							<table id="multi-column-ordering" class="table table-hover" style="width:100%">
								<thead>
									<tr>
										<th width="15%">No</th>
										<th width="25%">Name</th>
										<th>Created Date</th>
										<th>Last Updated</th>
										<th>Status</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@php $i=1; @endphp
									@foreach($menus as $menu)
									<tr>
										<td>{{ $i }}</td>
										<td>{{ $menu['name'] }}</td>
										<td>{{ date("d-F-Y H:i:s a", strtotime($menu['last_updated'])) }}</td>
										<td>
											@if($menu['status']==1)
												<span class="badge badge-success"> Active </span>
											@else
												<span class="badge badge-danger"> Not Active </span>
											@endif
										</td>
										<td>
											<a title="edit" href="{{ url('admin/menu/edit/'.$menu['id_menu']) }}">
												<i class="fa fa-edit"></i>
											</a>
											<a title="delete" href="{{ url('admin/menu/delete/'.$menu['id_menu']) }}">
												<i class="fa fa-trash"></i>
											</a>
										</td>
									</tr>
									@php $i++; @endphp
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	@endsection