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
						<span>List Designation</span>
					</li>
				</ol>
			</nav>

			<div class="row layout-top-spacing" id="cancel-row">
				<div class="col-xl-12 col-lg-12 col-md-8 col-12 layout-spacing">
					<div class="widget-content-area br-4">
						<div class="widget-one">
							<h5>List Designation</h5>
						</div>
					</div>
				</div>
				<div class="col-xl-8 col-lg-12 col-sm-12 layout-spacing">
					<div class="widget-content widget-content-area br-6">
						<a href="{{ url('admin/designation/add') }}" class="btn btn-primary">
							<i class="fa fa-edit"></i>
							Add New Designation
						</a>
						<div class="table-responsive mb-4 mt-4">
							<table id="multi-column-ordering" class="table table-hover" style="width:100%">
								<thead>
									<tr>
										<th>No</th>
										<th width="30%">Name</th>
										<th width="25%">Department</th>
										<th>Status</th>
										<th width="10%"></th>
									</tr>
								</thead>
								<tbody>
									@php $i=1; @endphp
									@foreach($designations as $designation)
									<tr>
										<td>{{ $i }}</td>
										<td>
											{{ $designation['name'] }}<br>
										</td>
										<td>
											{{ $designation['id_department'] }}<br>
										</td>
										<td>
											@if($designation['status_active']==1)
												<span class="badge badge-success"> Active </span>
											@else
												<span class="badge badge-danger"> Not Active </span>
											@endif
										</td>
										<td>
											<a title="edit" href="{{ url('admin/designation/edit/'.$designation['id_designation']) }}">
												<i class="fa fa-edit"></i>
											</a>
											<a title="delete" href="{{ url('admin/designation/delete/'.$designation['id_designation']) }}">
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