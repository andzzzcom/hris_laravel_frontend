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
						<span>List Roles</span>
					</li>
				</ol>
			</nav>

			<div class="row layout-top-spacing" id="cancel-row">
				<div class="col-xl-12 col-lg-12 col-md-8 col-12 layout-spacing">
					<div class="widget-content-area br-4">
						<div class="widget-one">
							<h5>List Roles</h5>
						</div>
					</div>
				</div>
				<div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
					<div class="widget-content widget-content-area br-6">
						<a data-toggle="modal" data-target="#add-role" class="btn btn-primary">
							<i class="fa fa-edit"></i>
							Add New Role
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
									@foreach($roles as $role)
									<tr>
										<td>{{ $i }}</td>
										<td>{{ $role['name'] }}</td>
										<td>{{ date("d-F-Y H:i:s a", strtotime($role['created_date'])) }}</td>
										<td>{{ date("d-F-Y H:i:s a", strtotime($role['last_updated'])) }}</td>
										<td>
											@if($role['status']==1)
												<span class="badge badge-success"> Active </span>
											@else
												<span class="badge badge-danger"> Not Active </span>
											@endif
										</td>
										<td>
											<a title="permission" onclick="editRolePerm('{{ $role['id_role'] }}')" data-toggle="modal" data-target="#edit-perm" href="#">
												<i class="fa fa-user"></i>
											</a>
											<a title="edit" onclick="editRole('{{ $role['id_role'] }}')" data-toggle="modal" data-target="#edit-role" href="#">
												<i class="fa fa-edit"></i>
											</a>
											<a title="delete" onclick="deleteRole('{{ $role['id_role'] }}')" data-toggle="modal" data-target="#delete-role" href="#">
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
	
	
	<!-- Modal -->
	<div id="add-role" class="text-center modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add New Role</h5>
				</div>
				<div class="modal-body text-left">
					<form action="{{url('admin/role/add')}}" method="post" class="mt-2">
						@csrf
						<div class="form-group">
							<input required name="name" type="text" class="form-control" placeholder="Insert Name Role">
						</div>
						<div class="form-group">
							<select name="status" class="form-control">
								<option value="1">Active</option>
								<option value="0">Not Active</option>
							</select>
						</div>
						<div class="form-group mt-4">
							<button type="submit" class="btn btn-success">
								<i class="fa fa-plus-circle"></i> Add
							</button>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>
	<div id="edit-role" class="text-center modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edit Role</h5>
				</div>
				<div class="modal-body text-left">
					<form action="{{url('admin/role/edit')}}" method="post" class="mt-2">
						@csrf
						<input required type="hidden" name="id_role" id="id_role">
						<div class="form-group">
							<input required name="name" id="name_role" type="text" class="form-control" placeholder="Insert Name Role">
						</div>
						<div class="form-group">
							<select name="status" id="status_role" class="form-control">
								<option value="1">Active</option>
								<option value="0">Not Active</option>
							</select>
						</div>
						<div class="form-group mt-4">
							<button type="submit" class="btn btn-success">
								<i class="fa fa-plus-circle"></i> Update
							</button>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>
	  
	<div id="delete-role" class="text-center modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Remove Role</h5>
				</div>
				<div class="modal-body text-left">
					<form action="{{url('admin/role/delete')}}" method="post" class="mt-2">
						@csrf
						<input required type="hidden" name="id_role" id="id_role_r">
						<div class="form-group">
							<input readonly required name="name" id="name_role_r" type="text" class="form-control" placeholder="Insert Name Role">
						</div>
						<div class="form-group">
							<select readonly name="status" id="status_role_r" class="form-control">
								<option value="1">Active</option>
								<option value="0">Not Active</option>
							</select>
						</div>
						<div class="form-group mt-4">
							<button type="submit" class="btn btn-success">
								<i class="fa fa-plus-circle"></i> Remove
							</button>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>
	
	<div id="edit-perm" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">List Menu Role</h5>
				</div>
				<div class="modal-body text-left">
					<div id="PermissionList" style="padding:25px;padding-top:5px"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>
	
	<script>
		function deleteRole(idRole)
		{
			var c = confirm("Are you sure remove this role?");
			if(!c)
				return false;
			
			$.ajax({
				headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				method:'POST',
				data: {id_role:idRole},
				cache:false,
				url:'{{url("/admin/delete_role")}}',
				success:function(result)
				{
					if(result == 1)
					{
						alert("Successfully Removed!");
					}
					else
					{
						alert("Failed Removed!");
					}
					location.reload();
				}
			});
		}
		
		function editRole(idRole)
		{
			$.ajax({
				headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				method:'POST',
				data: {id_role:idRole},
				cache:false,
				url:'{{url("admin/role/detail")}}',
				success:function(result)
				{
					$("#id_role").val(result[0].id_role);
					$("#name_role").val(result[0].name);
					$("#status_role").val(result[0].status);
				}
			});
		}
		
		function deleteRole(idRole)
		{
			$.ajax({
				headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				method:'POST',
				data: {id_role:idRole},
				cache:false,
				url:'{{url("admin/role/detail")}}',
				success:function(result)
				{
					$("#id_role_r").val(result[0].id_role);
					$("#name_role_r").val(result[0].name);
					$("#status_role_r").val(result[0].status);
				}
			});
		}
		
		function editRolePerm(idRole)
		{
			$("#PermissionList").empty();
			$.ajax({
				headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				method:'POST',
				data: {id_role:idRole},
				cache:false,
				url:'{{url("admin/role_menu")}}',
				success:function(result)
				{
					var results = result.split("-----");
					var data = results[0];
					var perm = results[1];
					
					data = JSON.parse(data);
					perm = JSON.parse(perm);
					
					//alert(data.length);
					for(var i = 0; i<data.length; i++)
					{					
						var bool = 0;
						for(var j = 0; j<perm.length; j++)
						{
							if(perm[j].id_menu == data[i].id_menu)
							{
								bool = 1;
							}
						}
						if(bool == 1)
						{
							var appended = "<p>"+(i+1)+". "+data[i].name+" : <span id='label-text"+data[i].id_menu+"'>ok</span></p> <p><button id='statBtn"+data[i].id_menu+"' onclick='updateStatusRole(0, "+idRole+", "+data[i].id_menu+")' class='btn btn-danger'>Set Not Ok</button></p><br>";
							$("#PermissionList").append(appended);
						}
						if(bool == 0)
						{
							var appended = "<p>"+(i+1)+". "+data[i].name+" : <span id='label-text"+data[i].id_menu+"'>not ok</span></p> <p><button id='statBtn"+data[i].id_menu+"' onclick='updateStatusRole(1, "+idRole+", "+data[i].id_menu+")' class='btn btn-success'>Set Ok</button> </p><br>";
							$("#PermissionList").append(appended);
						}
					}
					
				}
			});
		}
			
		function updateStatusRole(stat, idRole, idMenu)
		{
			//alert(idRole + "->" + idMenu);
			//return false;
			$.ajax({
				headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				method:'POST',
				data: {stat:stat, id_role:idRole, id_menu:idMenu},
				cache:false,
				url:'{{url("admin/role/status")}}',
				success:function(result)
				{
					if(result == 0)
					{
						$("#statBtn"+idMenu).attr('class', 'btn btn-success');
						$("#statBtn"+idMenu).text('Set Ok').attr("onclick", "updateStatusRole(1, "+idRole+", "+idMenu+")");
						$("#label-text"+idMenu).html('Not Ok');
						
					}else if(result == 1)
					{
						$("#statBtn"+idMenu).attr('class', 'btn btn-danger');
						$("#statBtn"+idMenu).text('Set Not Ok').attr("onclick", "updateStatusRole(0, "+idRole+", "+idMenu+")");
						$("#label-text"+idMenu).html('Ok');
					}else
					{
						alert("Failed Updated!");
					}
				}
			});
		}
	</script>
	@endsection