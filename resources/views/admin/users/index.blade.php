@extends("admin.layout.default")

@section("content")
<!-- Row starts here -->
<div class="row">
	<div class="col-xl-3 col-xxl-12 col-md-6">
		<div class="card">	
			<div class="card-header border-0 pb-0">
				<h4 class="fs-20 font-w600">User</h4>
			</div>
			<div class="card-body">
				<div class="mr-auto d-none d-lg-block">
					<a href="{{route("admin.users.create")}}" class="btn btn-primary btn-rounded">+ Add New</a>
				</div>
				<div class="table-responsive">
					<table id="example5" class="table table-striped patient-list mb-4 dataTablesCard fs-14">
						<thead>
							<tr>
								<th>Email</th>
								<th>Admin Status</th>
								<th>Role</th>
								<th></th>
							</tr>
						</thead>

						<tbody>
						@if(count($users) > 0)
							@foreach($users as $user)
							<tr>
								
								<td>
									<a href="{{ route("admin.users.show", ["id" => $user->id]) }}">
									{{$user->email}}
									</a>
								</td>
								<td>{{$user->is_admin == 0 ? "False" : "True"}}</td>
								<td>
									@if($user->role_id == 4)
										Indigent Officer
									@elseif($user->role_id == 3)
										Supervisor
									@elseif($user->role_id == 2)
										CFO
									@elseif($user->role_id == 1)
									 	Super User
									@endif
								</td>
								
								<td>
									<a href="{{ route("admin.users.edit", ["id" => $user->id]) }}">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M17 3C17.2626 2.73735 17.5744 2.52901 17.9176 2.38687C18.2608 2.24473 18.6286 2.17157 19 2.17157C19.3714 2.17157 19.7392 2.24473 20.0824 2.38687C20.4256 2.52901 20.7374 2.73735 21 3C21.2626 3.26264 21.471 3.57444 21.6131 3.9176C21.7553 4.26077 21.8284 4.62856 21.8284 5C21.8284 5.37143 21.7553 5.73923 21.6131 6.08239C21.471 6.42555 21.2626 6.73735 21 7L7.5 20.5L2 22L3.5 16.5L17 3Z" stroke="#3E4954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									</a>
								</td>
							</tr>
							
							@endforeach	
						@else
								<tr>
									<td colspan="2"> No Users </td>
									
									<form>
										
									</form>
									<td>
										<a href="{{route("admin.users.create")}}" class="btn btn-primary">
											+ Add
										</a>
									</td>
							
								</tr>
						@endif						
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div> <!-- Row ends here -->
@endsection