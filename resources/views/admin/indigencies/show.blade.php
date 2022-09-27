@extends("admin.layout.default")

@section("content")
				<!--**********************************
            Content body start
        ***********************************-->

            <!-- row -->
			<div class="container-fluid">
				<div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="{{route('admin.indigencies')}}">Indigent</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">#{{$indigent->id}}</a></li>
					</ol>
                </div>
				<div class="d-md-flex d-block mb-3 align-items-center">
					<div class="widget-timeline-icon py-3 py-md-2 px-1 overflow-auto">
						<ul class="timeline">
							<li>
								<div class="icon bg-warning"></div>
								<a class="timeline-panel text-muted" href="javascript:void(0);">
									<h4 class="mb-2 mt-0 text-warning fs-16 font-w600">Incomplete</h4>
									<p class="fs-14 mb-0 ">{{$indigent->created_at}}</p>
								</a>
							</li>
							@if($indigent->status == "Confirmed")
							<li class="border-info">
								<div class="icon bg-info"></div>
								<a class="timeline-panel text-muted" href="javascript:void(0);">
									<h4 class="mb-2 mt-0 text-info fs-16 font-w600">Pending Verification</h4>
									<p class="fs-14 mb-0 ">{{$indigent->updated_at}}</p>
								</a>
							</li>
							@elseif($indigent->status == "Verified")
							<li class="border-info">
								<div class="icon bg-info"></div>
								<a class="timeline-panel text-muted" href="javascript:void(0);">
									<h4 class="mb-2 mt-0 text-info fs-16 font-w600">Pending Approval</h4>
									<p class="fs-14 mb-0 ">{{$indigent->updated_at}}</p>
								</a>
							</li>
							<!-- {{-- <li>
								<div class="icon bg-primary"></div>
								<a class="timeline-panel text-muted" href="javascript:void(0);">
									<h4 class="mb-2 text-primary mt-0 fs-16 font-w600">{{$verdict->first()->verdict}}</h4>
									<p class="fs-14 mb-0 ">{{$verdict->first()->created_at}}</p>
								</a>
							</li> --}} -->
							@elseif($indigent->status == "Rejected")
							<li class="border-info">
								<div class="icon bg-info"></div>
								<a class="timeline-panel text-muted" href="javascript:void(0);">
									<h4 class="mb-2 mt-0 text-info fs-16 font-w600">Pending Approval</h4>
									<p class="fs-14 mb-0 ">{{$indigent->updated_at}}</p>
								</a>
							</li>
							<li>
								<div class="icon bg-danger"></div>
								<a class="timeline-panel text-muted" href="javascript:void(0);">
									<h4 class="mb-2 text-danger mt-0 fs-16 font-w600">{{$verdict->first()->verdict}}</h4>
									<p class="fs-14 mb-0 ">{{$verdict->first()->created_at}}</p>
								</a>
							</li>
							@endif
						</ul>	
					</div>
					<div class="dropdown d-inline-block ml-auto mr-2">
						<button type="button" class="btn btn-outline-primary btn-rounded font-w600">
							@if($indigent->status == "Incomplete" || $indigent->status == "Completed")
							<a href="javascript:void(0)">Verify</a>
							@elseif($indigent->status == "Confirmed")
							<a href="/admin/verification/choose/{{$indigent->id}}">Verify</a>
							@elseif($indigent->status == "Verified" || $indigent->status == "Approved" || $indigent->status == "Rejected")
							<i class="las la-check-circle scale5 mr-3"></i>Verified
							@endif
						</button>
					</div>
					@if($indigent->status == "Verified")
					<a href="{{route('admin.approvals.create', ['id' => $indigent->id])}}" class="btn btn-primary btn-rounded wspace-no"><i class="las scale5 la-pencil-alt mr-2"></i> Approve</a>
					@else
					<a href="javascript:void(0)" class="btn btn-primary btn-rounded wspace-no"><i class="las scale5 la-pencil-alt mr-2"></i> Approve</a>
					@endif
				</div>

				<!-- The whole profile begins here -->
				<div class="row">
					<div class="col-xl-6 col-xxl-8">
						<div class="card">
							<div class="card-body">
								<div class="media d-sm-flex d-block text-center text-sm-left pb-4 mb-4 border-bottom">
									<div class="media-body align-items-center">
										<div class="d-sm-flex d-block justify-content-between my-3 my-sm-0">
											<div>
												<h3 class="fs-22 text-black font-w600 mb-0">{{ $indigent->firstName}} {{ $indigent->surname }}</h3>
												<p class="mb-2 mb-sm-2">Application date {{ $indigent->created_at}}</p>
											</div>
											<span>#{{ $indigent->id }}</span>
										</div>
										<div>
											<p class="mb-2 mb-sm-2">ID Number</p>
											<h3 class="fs-22 text-black font-w600 mb-0">
												{{$indigent->id_number}}
											</h3>
										</div>
										<a href="javascript:void(0);" class="btn bgl-primary btn-rounded text-black mb-2 mr-2">
											@if( isset($pd) && $pd->gender == "Male")
											<svg class="mr-2 scale5" width="14" height="14" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M18 0.500061V3.00006H21.25L16.625 7.62506C15 6.25006 12.875 5.50006 10.5 5.50006C5 5.50006 0.5 10.0001 0.5 15.5001C0.5 21.0001 5 25.5001 10.5 25.5001C16 25.5001 20.5 21.0001 20.5 15.5001C20.5 13.1251 19.75 11.0001 18.375 9.37506L23 4.75006V8.00006H25.5V0.500061H18ZM10.5 23.0001C6.375 23.0001 3 19.6251 3 15.5001C3 11.3751 6.375 8.00006 10.5 8.00006C14.625 8.00006 18 11.3751 18 15.5001C18 19.6251 14.625 23.0001 10.5 23.0001Z" fill="#2BC155"></path>
											</svg>
											Male
											@elseif( isset($pd) && $pd->gender == "Female")
											<svg width="14px" height="20px" viewBox="0 0 14 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
											    <!-- Generator: Sketch 3.8.1 (29687) - http://www.bohemiancoding.com/sketch -->
											    <title>female [#1363]</title>
											    <desc>Created with Sketch.</desc>
											    <defs></defs>
											    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											        <g id="Dribbble-Light-Preview" transform="translate(-103.000000, -2079.000000)" fill="#2BC155">
											            <g id="icons" transform="translate(56.000000, 160.000000)">
											                <path d="M54.010058,1930.97067 C52.6753909,1930.97067 51.421643,1930.45194 50.4775859,1929.51025 C47.3327267,1926.36895 49.5904718,1920.99511 54.010058,1920.99511 C58.4266471,1920.99511 60.6903863,1926.36595 57.5425301,1929.51025 C56.5984729,1930.45194 55.344725,1930.97067 54.010058,1930.97067 M58.9411333,1930.92079 C63.3617184,1926.50661 60.1768991,1919 54.007061,1919 C47.8512088,1919 44.6294265,1926.50661 49.0510106,1930.92079 C50.1609021,1932.02908 51.9840813,1932.67949 52.9830836,1932.88598 L52.9830836,1935.00978 L49.9860767,1935.00978 L49.9860767,1937.00489 L52.9830836,1937.00489 L52.9830836,1939 L54.9810882,1939 L54.9810882,1937.00489 L57.9780951,1937.00489 L57.9780951,1935.00978 L54.9810882,1935.00978 L54.9810882,1932.88598 C56.9790928,1932.67949 57.8302427,1932.02908 58.9411333,1930.92079" id="female-[#1363]"></path>
											            </g>
											        </g>
											    </g>
											</svg>
											Female
											@endif
										</a>
										<a href="javascript:void(0);" class="btn bgl-primary btn-rounded text-black mb-2 mr-2">
										@if( isset($pd) && $pd->employment_status == "Employed")
										<img width="30" height="24" src="{{asset('/images/job_01.jpg')}}" />
										Employed
										@elseif( isset($pd) && $pd->employment_status == "Unemployed")
										<svg id="Layer_1" width="24" height="24" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#2BC155"><title>unemployed_Artboard 1icon_3</title><path d="M12,23.34A11.4,11.4,0,1,1,23.4,12,11.38,11.38,0,0,1,12,23.34ZM19.34,18a9.47,9.47,0,0,0-.9-13.11A9.35,9.35,0,0,0,6.08,4.53c.86.92,1.73,1.83,2.58,2.75a.57.57,0,0,1,.18.45c0,.1-.28.16-.44.19A5.29,5.29,0,0,0,7.34,8a.61.61,0,0,1-.73-.19C6,7.18,5.32,6.54,4.67,5.89a9.48,9.48,0,0,0,13.42,13.3l-2-2L17.48,16Z"/><path d="M9.89,9.08A3.57,3.57,0,0,1,10,8a1.29,1.29,0,0,1,1.44-.83c.9.06,2-.36,2.53.8a3.37,3.37,0,0,1,.12,1.12h1.66c.9,0,1.18.28,1.18,1.18,0,1.41,0,1.41-1.4,1.55L13.4,12c-.09-.45,0-.94-1.16-1-.33,0-1.31,0-1.36.25a2.64,2.64,0,0,0-.2.64s-2.28-.15-3.18-.24c-.33,0-.51-.19-.49-.54v-.06C7,9.58,6.8,9,9,9.08Zm1.09,0h2c.1-.82.08-.84-.65-.84H11.6C10.88,8.21,10.87,8.24,11,9.05Z"/><rect x="11.34" y="11.68" width="1.36" height="1.36" rx="0.57"/><path d="M7.7,12.42l2.93.28c.14.85,0,1,1.91,1,.29,0,.55,0,.66-.23a6.77,6.77,0,0,0,.25-.74c.81-.06,2-.17,2.86-.25,0,1,0,1.86,0,2.77a.83.83,0,0,1-.94.81H8.64a.87.87,0,0,1-.93-.88,3,3,0,0,1,0-.42Z"/></svg>
										Unemployed
										@endif
										</a>
									</div>
								</div>
								<div class="row">
									@if(isset($pd))
									<div class="col-lg-6 mb-3">
										<div class="media">
											<span class="p-3 border border-primary-light rounded-circle mr-3">
												<svg width="22" height="22" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
													<g clip-path="url(#clip0)">
													<path d="M27.5716 13.4285C27.5716 22.4285 16.0001 30.1428 16.0001 30.1428C16.0001 30.1428 4.42871 22.4285 4.42871 13.4285C4.42871 10.3596 5.64784 7.41637 7.8179 5.24631C9.98797 3.07625 12.9312 1.85712 16.0001 1.85712C19.0691 1.85712 22.0123 3.07625 24.1824 5.24631C26.3524 7.41637 27.5716 10.3596 27.5716 13.4285Z" stroke="#2BC155" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
													<path d="M16.0002 17.2857C18.1305 17.2857 19.8574 15.5588 19.8574 13.4286C19.8574 11.2983 18.1305 9.57141 16.0002 9.57141C13.87 9.57141 12.1431 11.2983 12.1431 13.4286C12.1431 15.5588 13.87 17.2857 16.0002 17.2857Z" stroke="#2BC155" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
													</g>
													<defs>
													<clipPath id="clip0">
													<rect width="30.8571" height="30.8571" fill="white" transform="translate(0.571533 0.571411)"></rect>
													</clipPath>
													</defs>
												</svg>
											</span>
											<div class="media-body">
												<span class="d-block text-light mb-2">Address</span>
												<p class="fs-18 text-dark">{{ $pd->res_address }}, <strong>{{ $pd->res_postal_code }}</strong></p>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="media">
											<div class="media-body">
												<span class="d-block text-light mb-2">ERF</span>
												<p class="fs-18 text-dark">{{$pd->erf}}</strong></p>
											</div>
											<div class="media-body">
												<span class="d-block text-light mb-2">Ward Number</span>
												<p class="fs-18 text-dark">{{$pd->ward_number}}</strong></p>
											</div>
										</div>
									</div>
									<div class="col-lg-6 mb-md-0 mb-3">
										<div class="media">
											<span class="p-3 border border-primary-light rounded-circle mr-3">
												<svg width="22" height="22" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M28.2884 21.7563V25.6138C28.2898 25.9719 28.2165 26.3264 28.073 26.6545C27.9296 26.9826 27.7191 27.2771 27.4553 27.5192C27.1914 27.7613 26.8798 27.9456 26.5406 28.0604C26.2014 28.1751 25.8419 28.2177 25.4853 28.1855C21.5285 27.7555 17.7278 26.4035 14.3885 24.238C11.2817 22.2638 8.64771 19.6297 6.67352 16.523C4.50043 13.1685 3.14808 9.34928 2.72601 5.37477C2.69388 5.0192 2.73614 4.66083 2.8501 4.32248C2.96405 3.98413 3.14721 3.67322 3.38792 3.40953C3.62862 3.14585 3.92159 2.93517 4.24817 2.79092C4.57475 2.64667 4.9278 2.57199 5.28482 2.57166H9.14232C9.76634 2.56552 10.3713 2.78649 10.8445 3.1934C11.3176 3.60031 11.6267 4.16538 11.714 4.78329C11.8768 6.01778 12.1788 7.22988 12.6141 8.39648C12.7871 8.85671 12.8245 9.35689 12.722 9.83775C12.6194 10.3186 12.3812 10.76 12.0354 11.1096L10.4024 12.7426C12.2329 15.9617 14.8983 18.6271 18.1174 20.4576L19.7504 18.8246C20.1001 18.4789 20.5414 18.2406 21.0223 18.1381C21.5031 18.0355 22.0033 18.073 22.4636 18.246C23.6302 18.6813 24.8423 18.9832 26.0767 19.1461C26.7014 19.2342 27.2718 19.5488 27.6796 20.0301C28.0874 20.5113 28.304 21.1257 28.2884 21.7563Z" stroke="#2BC155" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
												</svg>
											</span>
											<div class="media-body">
												<span class="d-block text-light mb-2">Phone</span>
												<p class="fs-18 text-dark font-w600 mb-0">{{ $pd->cell_number }}</p>
											</div>
										</div>
									</div>
									@else
									<div class="media-body">
										<p class="d-block text-light mb-2">Personal Details have not been supplied</p>
										<a class="btn btn-secondary" href="{{route("admin.personalDetails.createPersonalDetails", ["id" => $indigent->id])}}">
											Take me there
										</a>
									</div>
									
									@endif
									<div class="col-lg-6">
										<div class="media">
											<span class="p-3 border border-primary-light rounded-circle mr-3">
												<svg width="22" height="22" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M5.14344 5.14331H25.7168C27.1312 5.14331 28.2884 6.30056 28.2884 7.71498V23.145C28.2884 24.5594 27.1312 25.7166 25.7168 25.7166H5.14344C3.72903 25.7166 2.57178 24.5594 2.57178 23.145V7.71498C2.57178 6.30056 3.72903 5.14331 5.14344 5.14331Z" stroke="#2BC155" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
													<path d="M28.2884 7.71503L15.4301 16.7159L2.57178 7.71503" stroke="#2BC155" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
												</svg>
											</span>
											@if($user1->is_admin == false)
											<div class="media-body">
												<span class="d-block text-light mb-2">Email</span>
												<p class="fs-18 text-dark font-w600 mb-0">{{ $user1->email }}</p>
											</div>
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-xxl-4 col-md-6">
						<div class="card">	
							<div class="card-header border-0 pb-0">
								<h4 class="fs-20 font-w600">Household Information</h4>
							</div>
							<div class="card-body">
								<div class="widget-timeline-icon2">
									<ul class="timeline">
										@if( isset($pd))
										<li>
											<!--<div class="icon bg-primary"><i class="las la-stethoscope"></i></div>-->
											<a class="timeline-panel text-muted" href="javascript:void(0);">
												<h4 class="mb-2 mt-1">Account Number</h4>
												<p class="fs-15 mb-0 ">{{$pd->account_number}}</p>
											</a>
										</li>
										<li>
											<!--<div class="icon bg-primary"><i class="las la-stethoscope"></i></div>-->
											<a class="timeline-panel text-muted" href="javascript:void(0);">
												<h4 class="mb-2 mt-1">Meter Number</h4>
												<p class="fs-15 mb-0 ">{{$pd->electricity_meter}}</p>
											</a>
										</li>
										@else
										<p>There is no household condition information. Please provide that here</p>
										<a href="{{route("admin.householdConditions.create", ["id" => $indigent->id])}}">Conditions</a>
										@endif
										@if(count($householdInfo) > 0)

										<li>
											<!--<div class="icon bg-primary"><i class="las la-stethoscope"></i></div>-->
											<a class="timeline-panel text-muted" href="javascript:void(0);">
												<h4 class="mb-2 mt-1">Main Water Source</h4>
												<p class="fs-15 mb-0 ">{{$householdInfo->first()->main_water_src}}</p>
											</a>
										</li>
										<li>
											<!--<div class="icon bg-primary las"><i class="las la-stethoscope"></i></div>-->
											<a class="timeline-panel text-muted" href="javascript:void(0);">
												<h4 class="mb-2 mt-1">Toilet Facility</h4>
												<p class="fs-15 mb-0 ">{{$householdInfo->first()->toilet_facility}}</p>
											</a>
										</li>
										@else
										<p>There is no household condition information. Please provide that here</p>
										<a href="{{route("admin.householdConditions.create", ["id" => $indigent->id])}}">Conditions</a>
										@endif
									</ul>	
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-xxl-12 col-md-6">
						<div class="card">	
							<div class="card-header border-0 pb-0">
								<h4 class="fs-20 font-w600">Household Incomes</h4>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example5" class="table table-striped patient-list mb-4 dataTablesCard fs-14">
										<thead>
											<tr>
												<th>
													<div class="checkbox text-right align-self-center">
														<div class="custom-control custom-checkbox ">
															<input type="checkbox" class="custom-control-input" id="checkAll" required="">
															<label class="custom-control-label" for="checkAll"></label>
														</div>
													</div>
												</th>
												<th>Full Name</th>
												<th>Relationship</th>
												<th>Gender</th>
												<th>DoB</th>
												<th>Income</th>
												<th></th>
											</tr>
										</thead>

										<tbody>
											@if(count($incomes) > 0)
											@foreach($incomes as $income)
											<tr>
												<td>
													<div class="checkbox text-right align-self-center">
														<div class="custom-control custom-checkbox ">
															<input type="checkbox" class="custom-control-input" id="customCheckBox1" required="">
															<label class="custom-control-label" for="customCheckBox1"></label>
														</div>
													</div>
												</td>
												<td>{{$income->full_name}}</td>
												<td>{{$income->relationship}}</td>
												<td>{{$income->gender}}
												</td>
												<td>{{$income->date_of_birth}}</td>
												<td>R{{$income->total_income}}</td>
												<td>
													<a href="#">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M17 3C17.2626 2.73735 17.5744 2.52901 17.9176 2.38687C18.2608 2.24473 18.6286 2.17157 19 2.17157C19.3714 2.17157 19.7392 2.24473 20.0824 2.38687C20.4256 2.52901 20.7374 2.73735 21 3C21.2626 3.26264 21.471 3.57444 21.6131 3.9176C21.7553 4.26077 21.8284 4.62856 21.8284 5C21.8284 5.37143 21.7553 5.73923 21.6131 6.08239C21.471 6.42555 21.2626 6.73735 21 7L7.5 20.5L2 22L3.5 16.5L17 3Z" stroke="#3E4954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
														</svg>
													</a>
												</td>
											</tr>
											@if($indigent->status !== "Confirmed" && $user1->is_admin == true)
											<tr>
												<td>
													<a href="{{route("admin.householdIncomes.create", ["id" => $indigent->id])}}" class="btn btn-primary">
														+ Add
													</a>
												</td>
											</tr>
											@endif
											@endforeach	
											@else
												<tr>
													<td> No Income Details yet. </td>
													@if($indigent->status !== "Confirmed" && $user1->is_admin == true)
													<form>
														
													</form>
													<td>
														<a href="{{route("admin.householdIncomes.create", ["id" => $indigent->id])}}" class="btn btn-primary">
															+ Add
														</a>
													</td>
													@endif
												</tr>
											@endif							
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-xxl-6">
						@if($user1->is_admin == true)
						<div class="card">
							<div class="card-header border-0 pb-0">
								<h4 class="fs-20 font-w600">Captured by</h4>
							</div>
							<div class="card-body">
								<div class="media d-sm-flex text-sm-left d-block text-center">
									<img alt="image" class="rounded mr-sm-4 mr-0 mb-2 mb-sm-0" width="130" src="{{asset('storage/pro_photos/'.$assistantPro->pro_pic)}}" />
									<div class="media-body">
										<h3 class="fs-22 text-black font-w600">{{$assistantPro->fname}} {{$assistantPro->lname}}</h3>
										<p class="text-primary">{{$assistantPro->position}}</p>
										<div class="social-media mb-sm-0 mb-3 justify-content-sm-start justify-content-center">
											<a href="javascript:void(0);"><i class="lab la-instagram ml-0"></i></a>
											<a href="javascript:void(0);"><i class="lab la-facebook-f"></i></a>
											<a href="javascript:void(0);"><i class="lab la-twitter"></i></a>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						@endif
					</div>
					<div class="col-xl-6 col-xxl-6">
						<div class="card patient-detail">
							<div class="card-header border-0 pb-0">
								<h4 class="fs-20 font-w600 text-white">Comments by Official</h4>
								<a href="javascript:void(0);">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<g clip-path="url(#clip1)">
									<path d="M22.4455 1.55474C20.3795 -0.516293 17.0199 -0.516293 14.9539 1.55474L1.21862 15.2849C1.11124 15.3923 1.04476 15.5304 1.0243 15.6787L0.00668299 23.2162C-0.023999 23.431 0.052706 23.6458 0.201002 23.7941C0.328844 23.9219 0.507822 23.9986 0.686801 23.9986C0.717483 23.9986 0.748165 23.9986 0.778847 23.9935L5.31978 23.3798C5.6982 23.3287 5.96411 22.981 5.91297 22.6026C5.86183 22.2242 5.5141 21.9583 5.13569 22.0094L1.49476 22.5003L2.20556 17.2435L7.73855 22.7764C7.86639 22.9043 8.04537 22.981 8.22435 22.981C8.40333 22.981 8.5823 22.9094 8.71015 22.7764L22.4455 9.04625C23.4477 8.04398 24 6.71442 24 5.29794C24 3.88146 23.4477 2.5519 22.4455 1.55474ZM15.2198 3.24225L17.5261 5.54851L4.99251 18.0821L2.68624 15.7758L15.2198 3.24225ZM8.22946 21.3139L5.97433 19.0588L18.5079 6.52522L20.7631 8.78034L8.22946 21.3139ZM21.7244 7.79341L16.2068 2.27577C16.9074 1.69792 17.7818 1.38088 18.7023 1.38088C19.7506 1.38088 20.7324 1.78997 21.4739 2.52634C22.2153 3.2627 22.6193 4.24964 22.6193 5.29794C22.6193 6.22351 22.3023 7.09284 21.7244 7.79341Z" fill="white"/>
									</g>
									<defs>
									<clipPath id="clip1">
									<rect width="24" height="24" fill="white"/>
									</clipPath>
									</defs>
									</svg>
								</a>
							</div>
							<div class="card-body fs-14 font-w300">
								@if(count($verdict) > 0)
								<p>
									{{$verdict->first()->comment}}
								</p>
								<p> -</p>
								@else
								@endif
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-xxl-8">
						<div class="card">
							<div class="card-body">
								<div class="media d-sm-flex d-block text-center text-sm-left pb-4 mb-4 border-bottom">
									<div class="row">
										
										@if(isset($docs))

										 @if($docs->municipal_acc_doc == "no document uploaded")
										 @else
										<div class="col-lg-12 mb-3">
											<div class="media-body">
												<span class="d-block text-light mb-2">Municipal Account</span>
											<a href="{{asset('storage/'.$indigent->id.'/'.$docs->municipal_acc_doc)}}" >{{$docs->municipal_acc_doc}}
											</a>
											</div>
										</div>
										 @endif

										 @if($docs->id_doc == "no document uploaded")
										 @else
										<div class="col-lg-12 mb-3">
											<div class="media-body">
												<span class="d-block text-light mb-2">Copy of ID</span>
											<a href="{{asset('storage/'.$indigent->id.'/'.$docs->id_doc)}}" >{{$docs->id_doc}}
											</a>
											</div>
										</div>
										 @endif

										 @if($docs->confirmation_of_pension == "no document uploaded")
										 @else
										<div class="col-lg-12 mb-3">
											<div class="media-body">
												<span class="d-block text-light mb-2">Proof of Pension Status</span>
											<a href="{{asset('storage/'.$indigent->id.'/'.$docs->confirmation_of_pension)}}" >{{$docs->confirmation_of_pension}}
											</a>
											</div>
										</div>
										 @endif

										 @if($docs->proof_of_income == "no document uploaded")
										 @else
										<div class="col-lg-12 mb-3">
											<div class="media-body">
												<span class="d-block text-light mb-2">Proof of Income</span>
											<a href="{{asset('storage/'.$indigent->id.'/'.$docs->proof_of_income)}}" >{{$docs->proof_of_income}}
											</a>
											</div>
										</div>
										 @endif

										 @if($docs->affidavit == "no document uploaded")
										 @else
										<div class="col-lg-12 mb-3">
											<div class="media-body">
												<span class="d-block text-light mb-2">Affidavit</span>
											<a href="{{asset('storage/'.$indigent->id.'/'.$docs->affidavit)}}" >{{$docs->affidavit}}
											</a>
											</div>
										</div>
										 @endif

										 @if($docs->death_cert == "no document uploaded")
										 @else
										<div class="col-lg-12 mb-3">
											<div class="media-body">
												<span class="d-block text-light mb-2">Death Certificate</span>
											<a href="{{asset('storage/'.$indigent->id.'/'.$docs->death_cert)}}" >{{$docs->death_cert}}
											</a>
											</div>
										</div>
										 @endif

										 @if($docs->letter_from_council == "no document uploaded")
										 @else
										<div class="col-lg-12 mb-3">
											<div class="media-body">
												<span class="d-block text-light mb-2">Letter form Council</span>
											<a href="{{asset('storage/'.$indigent->id.'/'.$docs->letter_from_council)}}" >{{$docs->letter_from_council}}
											</a>
											</div>
										</div>
										 @endif
										@else
											<div class="media">
												<div class="media-body">
													<p class="d-block text-light mb-2">No documents uploaded yet.</p>
													<a href="{{route("admin.documents.create", ["id" => $indigent->id])}}" class="btn btn-secondary">Take me there</a>
												</div>
											</div>
										
										@endif
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				@if($indigent->status == "Completed" && $user1->is_admin == true)
				<form action="{{route("admin.indigencies.confirm", ["id" => $indigent->id])}}" method="POST">
					@method("PUT")
					@csrf
					<button class="btn btn-secondary">
						Confirm and Submit
					</button>
				</form>
		        @endif
            </div>

        <!--**********************************
            Content body end
        ***********************************-->
@endsection