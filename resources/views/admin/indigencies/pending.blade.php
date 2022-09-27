@extends('admin.layout.default')

@section('content')

<!-- row -->
			<div class="container-fluid">
				<div class="form-head d-flex mb-3 mb-md-4 align-items-start">
					<div class="mr-auto d-none d-lg-block">
						<a href="indigencies/create" class="btn btn-primary btn-rounded">+ Add New</a>
					</div>
					
					<div class="input-group search-area ml-auto d-inline-flex mr-3">
						<input type="text" class="form-control" placeholder="Search here">
						<div class="input-group-append">
							<button type="button" class="input-group-text"><i class="flaticon-381-search-2"></i></button>
						</div>
					</div>
					<a href="javascript:void(0);" class="settings-icon"><i class="flaticon-381-settings-2 mr-0"></i></a>
				</div>
				<div class="row">
					<div class="col-xl-12">
						<div class="table-responsive">
							<table id="example5" class="table table-striped patient-list mb-4 dataTablesCard fs-14">
								<thead>
									<tr>
										<th>Indigent ID</th>
										<th>Date Submitted</th>
										<th>Name</th>
										<th>Assisted By</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									@foreach($indigents as $indigent)
									<tr>
										<td>{{$indigent->id}}</td>
										<td>{{$indigent->created_at}}</td>
										<td>
										<a href="{{ route("admin.indigencies.show", ["id" => $indigent->id]) }}">{{$indigent->firstName}}</a>
										</td>
										<td>
											@if($indigent->is_admin == true)
											{{$indigent->fname}} {{$indigent->lname}}
											@endif
										</td>
										<td>
											@if($indigent->status == "Incomplete" || $indigent->status == "Completed")
											<span class="text-nowrap">
												<svg class="mr-2" width="9" height="9" viewBox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg">
													<circle cx="4.5" cy="4.5" r="4.5" fill="#FFB800"/>
												</svg>
												
												<span class="text-warning">Incomplete</span>
											</span>
											@elseif($indigent->status == "Confirmed")
											<span class="text-nowrap">
												<svg class="mr-2" width="9" height="9" viewBox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg">
													<circle cx="4.5" cy="4.5" r="4.5" fill="#369DC9"/>
												</svg>
												
												<span class="text-info">Pending Verification</span>
											</span>
											@elseif($indigent->status == "Approved")
											<span class="text-nowrap">
												<svg class="mr-2" width="9" height="9" viewBox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg">
													<circle cx="4.5" cy="4.5" r="4.5" fill="#2BC155"/>
												</svg>
												
												<span class="text-primary">Approved</span>
											</span>
											@elseif($indigent->status == "Rejected")
											<span class="text-nowrap">
												<svg class="mr-2" width="9" height="9" viewBox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg">
													<circle cx="4.5" cy="4.5" r="4.5" fill="#F46B68"/>
												</svg>
												
												<span class="text-danger">Rejected</span>
											</span>
											@endif
											
										</td>
										<!--
										<td>
											<a href="#">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M17 3C17.2626 2.73735 17.5744 2.52901 17.9176 2.38687C18.2608 2.24473 18.6286 2.17157 19 2.17157C19.3714 2.17157 19.7392 2.24473 20.0824 2.38687C20.4256 2.52901 20.7374 2.73735 21 3C21.2626 3.26264 21.471 3.57444 21.6131 3.9176C21.7553 4.26077 21.8284 4.62856 21.8284 5C21.8284 5.37143 21.7553 5.73923 21.6131 6.08239C21.471 6.42555 21.2626 6.73735 21 7L7.5 20.5L2 22L3.5 16.5L17 3Z" stroke="#3E4954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
												</svg>
											</a>
										</td>
									-->
									</tr>
									@endforeach									
								</tbody>
							</table>
						</div>
					</div>
				</div>
            </div>


@endsection