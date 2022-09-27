@extends('admin.layout.default')

@section('content')
<div class="container-fluid">
    <!-- Alert bar. Only appears to display alert message then disappear. -->
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <!-- End of Alert bar -->

    
    <div class="row">	
		<div class="col-xl-3 col-xxl-6 col-sm-6">
			<div class="card gradient-bx text-white bg-success rounded">	
				<div class="card-body">
					<a style="color: #fff" href="{{route('admin.indigencies.approved')}}" style="text-decoration: none">
					<div class="media align-items-center">
						<div class="media-body">
							<p class="mb-1">Total Approved</p>
							<div class="d-flex flex-wrap">
								<h2 class="fs-40 font-w600 text-white mb-0 mr-3">{{count($approved)}}</h2>
								<div>	
									<svg width="28" height="19" viewBox="0 0 28 19" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M8.56244 9.25C6.35869 11.6256 2.26214 16.0091 0.999939 17.5H26.4374V1L16.8124 13.375L8.56244 9.25Z" fill="url(#paint0_linear4)"/>
										<path d="M0.999939 17.5C2.26214 16.0091 6.35869 11.6256 8.56244 9.25L16.8124 13.375L26.4374 1" stroke="white" stroke-width="2"/>
										<defs>
										<linearGradient id="paint0_linear4" x1="13.7187" y1="3.0625" x2="14.7499" y2="17.5" gradientUnits="userSpaceOnUse">
										<stop stop-color="white" stop-opacity="0.73" offset="0.1"/>
										<stop offset="1" stop-color="white" stop-opacity="0"/>
										</linearGradient>
										</defs>
									</svg>
									<div class="fs-14">+4%</div>
								</div>
							</div>
						</div>
						<!-- <span class="border rounded-circle p-4"> -->
							<img src="{{asset('icons/it-is-done.png')}}" height="52" width="64" />
						<!-- </span> -->
					</div>
				</a>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-xxl-6 col-sm-6">
			<div class="card gradient-bx text-white bg-danger rounded">	
				<div class="card-body">
					<a style="color: #fff" href="{{route('admin.indigencies.rejected')}}">
					<div class="media align-items-center">
						<div class="media-body">
							<p class="mb-1">Total Rejected</p>
							<div class="d-flex flex-wrap">
								<h2 class="fs-40 font-w600 text-white mb-0 mr-3">{{count($rejects)}}</h2>
								<div>	
									<svg width="28" height="19" viewBox="0 0 28 19" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M18.875 9.25C21.0787 11.6256 25.1753 16.0091 26.4375 17.5H1V1L10.625 13.375L18.875 9.25Z" fill="url(#paint0_linear1)"/>
										<path d="M26.4375 17.5C25.1753 16.0091 21.0787 11.6256 18.875 9.25L10.625 13.375L1 1" stroke="white" stroke-width="2"/>
										<defs>
										<linearGradient id="paint0_linear1" x1="13.7188" y1="3.0625" x2="12.6875" y2="17.5" gradientUnits="userSpaceOnUse">
										<stop stop-color="white" stop-opacity="0.73" offset="0.1"/>
										<stop offset="1" stop-color="white" stop-opacity="0"/>
										</linearGradient>
										</defs>
									</svg>
									<div class="fs-14">-4%</div>
								</div>
							</div>
						</div>
						<!-- <span class="border rounded-circle p-4"> -->
							<img src="{{asset('icons/cancel-icon2.png')}}" width="48" height="48" />
						<!-- </span> -->
					</div>
					</a>
				</div>

			</div>
		</div>
		<div class="col-xl-3 col-xxl-6 col-sm-6">
			<div class="card gradient-bx text-white bg-info rounded">	
				<div class="card-body">
					<a style="color: #fff" href="{{route('admin.indigencies.pending')}}">
					<div class="media align-items-center">
						<div class="media-body">
							<p class="mb-1">Pending Verification</p>
							<div class="d-flex flex-wrap">
								<h2 class="fs-40 font-w600 text-white mb-0 mr-3">{{ count($pendings) }}</h2>
								<div>	
									<svg width="28" height="19" viewBox="0 0 28 19" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M18.875 9.25C21.0787 11.6256 25.1753 16.0091 26.4375 17.5H1V1L10.625 13.375L18.875 9.25Z" fill="url(#paint0_linear2)"/>
										<path d="M26.4375 17.5C25.1753 16.0091 21.0787 11.6256 18.875 9.25L10.625 13.375L1 1" stroke="white" stroke-width="2"/>
										<defs>
										<linearGradient id="paint0_linear2" x1="13.7188" y1="3.0625" x2="12.6875" y2="17.5" gradientUnits="userSpaceOnUse">
										<stop stop-color="white" stop-opacity="0.73" offset="0.1"/>
										<stop offset="1" stop-color="white" stop-opacity="0"/>
										</linearGradient>
										</defs>
									</svg>
									<div class="fs-14">-4%</div>
								</div>
							</div>
						</div>
						<!--
						<span class="border rounded-circle p-4"> -->
							<svg width="34" height="34" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g clip-path="url(#clip0)">
								<path d="M35 5H33.3333C33.3333 3.67392 32.8065 2.40215 31.8689 1.46447C30.9312 0.526784 29.6594 0 28.3333 0C27.0072 0 25.7355 0.526784 24.7978 1.46447C23.8601 2.40215 23.3333 3.67392 23.3333 5H16.6667C16.6667 3.67392 16.1399 2.40215 15.2022 1.46447C14.2645 0.526784 12.9927 7.45058e-08 11.6667 7.45058e-08C10.3406 7.45058e-08 9.06881 0.526784 8.13113 1.46447C7.19345 2.40215 6.66667 3.67392 6.66667 5H5C3.67392 5 2.40215 5.52678 1.46447 6.46447C0.526784 7.40215 0 8.67392 0 10L0 35C0 36.3261 0.526784 37.5979 1.46447 38.5355C2.40215 39.4732 3.67392 40 5 40H35C36.3261 40 37.5979 39.4732 38.5355 38.5355C39.4732 37.5979 40 36.3261 40 35V10C40 8.67392 39.4732 7.40215 38.5355 6.46447C37.5979 5.52678 36.3261 5 35 5ZM5 8.33333H6.66667C6.66667 9.65942 7.19345 10.9312 8.13113 11.8689C9.06881 12.8065 10.3406 13.3333 11.6667 13.3333C12.1087 13.3333 12.5326 13.1577 12.8452 12.8452C13.1577 12.5326 13.3333 12.1087 13.3333 11.6667C13.3333 11.2246 13.1577 10.8007 12.8452 10.4882C12.5326 10.1756 12.1087 10 11.6667 10C11.2246 10 10.8007 9.8244 10.4882 9.51184C10.1756 9.19928 10 8.77536 10 8.33333V5C10 4.55797 10.1756 4.13405 10.4882 3.82149C10.8007 3.50893 11.2246 3.33333 11.6667 3.33333C12.1087 3.33333 12.5326 3.50893 12.8452 3.82149C13.1577 4.13405 13.3333 4.55797 13.3333 5V6.66667C13.3333 7.10869 13.5089 7.53262 13.8215 7.84518C14.134 8.15774 14.558 8.33333 15 8.33333H23.3333C23.3333 9.65942 23.8601 10.9312 24.7978 11.8689C25.7355 12.8065 27.0072 13.3333 28.3333 13.3333C28.7754 13.3333 29.1993 13.1577 29.5118 12.8452C29.8244 12.5326 30 12.1087 30 11.6667C30 11.2246 29.8244 10.8007 29.5118 10.4882C29.1993 10.1756 28.7754 10 28.3333 10C27.8913 10 27.4674 9.8244 27.1548 9.51184C26.8423 9.19928 26.6667 8.77536 26.6667 8.33333V5C26.6667 4.55797 26.8423 4.13405 27.1548 3.82149C27.4674 3.50893 27.8913 3.33333 28.3333 3.33333C28.7754 3.33333 29.1993 3.50893 29.5118 3.82149C29.8244 4.13405 30 4.55797 30 5V6.66667C30 7.10869 30.1756 7.53262 30.4882 7.84518C30.8007 8.15774 31.2246 8.33333 31.6667 8.33333H35C35.442 8.33333 35.866 8.50893 36.1785 8.82149C36.4911 9.13405 36.6667 9.55797 36.6667 10V16.6667H3.33333V10C3.33333 9.55797 3.50893 9.13405 3.82149 8.82149C4.13405 8.50893 4.55797 8.33333 5 8.33333ZM35 36.6667H5C4.55797 36.6667 4.13405 36.4911 3.82149 36.1785C3.50893 35.866 3.33333 35.442 3.33333 35V20H36.6667V35C36.6667 35.442 36.4911 35.866 36.1785 36.1785C35.866 36.4911 35.442 36.6667 35 36.6667Z" fill="white"/>
								<path d="M20 26.6667C20.9205 26.6667 21.6667 25.9205 21.6667 25C21.6667 24.0795 20.9205 23.3333 20 23.3333C19.0795 23.3333 18.3333 24.0795 18.3333 25C18.3333 25.9205 19.0795 26.6667 20 26.6667Z" fill="white"/>
								<path d="M30 26.6667C30.9205 26.6667 31.6667 25.9205 31.6667 25C31.6667 24.0795 30.9205 23.3333 30 23.3333C29.0796 23.3333 28.3334 24.0795 28.3334 25C28.3334 25.9205 29.0796 26.6667 30 26.6667Z" fill="white"/>
								<path d="M9.99995 26.6667C10.9204 26.6667 11.6666 25.9205 11.6666 25C11.6666 24.0795 10.9204 23.3333 9.99995 23.3333C9.07947 23.3333 8.33328 24.0795 8.33328 25C8.33328 25.9205 9.07947 26.6667 9.99995 26.6667Z" fill="white"/>
								<path d="M20 33.3334C20.9205 33.3334 21.6667 32.5872 21.6667 31.6667C21.6667 30.7462 20.9205 30 20 30C19.0795 30 18.3333 30.7462 18.3333 31.6667C18.3333 32.5872 19.0795 33.3334 20 33.3334Z" fill="white"/>
								<path d="M30 33.3334C30.9205 33.3334 31.6667 32.5872 31.6667 31.6667C31.6667 30.7462 30.9205 30 30 30C29.0796 30 28.3334 30.7462 28.3334 31.6667C28.3334 32.5872 29.0796 33.3334 30 33.3334Z" fill="white"/>
								<path d="M9.99995 33.3334C10.9204 33.3334 11.6666 32.5872 11.6666 31.6667C11.6666 30.7462 10.9204 30 9.99995 30C9.07947 30 8.33328 30.7462 8.33328 31.6667C8.33328 32.5872 9.07947 33.3334 9.99995 33.3334Z" fill="white"/>
								</g>
								<defs>
								<clipPath id="clip0">
								<rect width="40" height="40" fill="white"/>
								</clipPath>
								</defs>
							</svg> <!--
						</span>
					-->
					</div>
				</a>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-xxl-6 col-sm-6">
			<div class="card gradient-bx text-white bg-secondary rounded">	
				<div class="card-body">
					<a style="color: #fff" href="#">
					<div class="media align-items-center">
						<div class="media-body">
							<p class="mb-1">Pending Approval</p>
							<div class="d-flex flex-wrap">
								<h2 class="fs-40 font-w600 text-white mb-0 mr-3">{{count($approved)}}</h2>
								<div>	
									<svg width="28" height="19" viewBox="0 0 28 19" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M8.56244 9.25C6.35869 11.6256 2.26214 16.0091 0.999939 17.5H26.4374V1L16.8124 13.375L8.56244 9.25Z" fill="url(#paint0_linear3)"/>
										<path d="M0.999939 17.5C2.26214 16.0091 6.35869 11.6256 8.56244 9.25L16.8124 13.375L26.4374 1" stroke="white" stroke-width="2"/>
										<defs>
										<linearGradient id="paint0_linear3" x1="13.7187" y1="3.0625" x2="14.7499" y2="17.5" gradientUnits="userSpaceOnUse">
										<stop stop-color="white" stop-opacity="0.73" offset="0.1"/>
										<stop offset="1" stop-color="white" stop-opacity="0"/>
										</linearGradient>
										</defs>
									</svg>
									<div class="fs-14">+4%</div>
								</div>
							</div>
						</div>
						<!--
						<span class="border rounded-circle p-4"> -->
							<svg width="34" height="34" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g clip-path="url(#clip0)">
								<path d="M35 5H33.3333C33.3333 3.67392 32.8065 2.40215 31.8689 1.46447C30.9312 0.526784 29.6594 0 28.3333 0C27.0072 0 25.7355 0.526784 24.7978 1.46447C23.8601 2.40215 23.3333 3.67392 23.3333 5H16.6667C16.6667 3.67392 16.1399 2.40215 15.2022 1.46447C14.2645 0.526784 12.9927 7.45058e-08 11.6667 7.45058e-08C10.3406 7.45058e-08 9.06881 0.526784 8.13113 1.46447C7.19345 2.40215 6.66667 3.67392 6.66667 5H5C3.67392 5 2.40215 5.52678 1.46447 6.46447C0.526784 7.40215 0 8.67392 0 10L0 35C0 36.3261 0.526784 37.5979 1.46447 38.5355C2.40215 39.4732 3.67392 40 5 40H35C36.3261 40 37.5979 39.4732 38.5355 38.5355C39.4732 37.5979 40 36.3261 40 35V10C40 8.67392 39.4732 7.40215 38.5355 6.46447C37.5979 5.52678 36.3261 5 35 5ZM5 8.33333H6.66667C6.66667 9.65942 7.19345 10.9312 8.13113 11.8689C9.06881 12.8065 10.3406 13.3333 11.6667 13.3333C12.1087 13.3333 12.5326 13.1577 12.8452 12.8452C13.1577 12.5326 13.3333 12.1087 13.3333 11.6667C13.3333 11.2246 13.1577 10.8007 12.8452 10.4882C12.5326 10.1756 12.1087 10 11.6667 10C11.2246 10 10.8007 9.8244 10.4882 9.51184C10.1756 9.19928 10 8.77536 10 8.33333V5C10 4.55797 10.1756 4.13405 10.4882 3.82149C10.8007 3.50893 11.2246 3.33333 11.6667 3.33333C12.1087 3.33333 12.5326 3.50893 12.8452 3.82149C13.1577 4.13405 13.3333 4.55797 13.3333 5V6.66667C13.3333 7.10869 13.5089 7.53262 13.8215 7.84518C14.134 8.15774 14.558 8.33333 15 8.33333H23.3333C23.3333 9.65942 23.8601 10.9312 24.7978 11.8689C25.7355 12.8065 27.0072 13.3333 28.3333 13.3333C28.7754 13.3333 29.1993 13.1577 29.5118 12.8452C29.8244 12.5326 30 12.1087 30 11.6667C30 11.2246 29.8244 10.8007 29.5118 10.4882C29.1993 10.1756 28.7754 10 28.3333 10C27.8913 10 27.4674 9.8244 27.1548 9.51184C26.8423 9.19928 26.6667 8.77536 26.6667 8.33333V5C26.6667 4.55797 26.8423 4.13405 27.1548 3.82149C27.4674 3.50893 27.8913 3.33333 28.3333 3.33333C28.7754 3.33333 29.1993 3.50893 29.5118 3.82149C29.8244 4.13405 30 4.55797 30 5V6.66667C30 7.10869 30.1756 7.53262 30.4882 7.84518C30.8007 8.15774 31.2246 8.33333 31.6667 8.33333H35C35.442 8.33333 35.866 8.50893 36.1785 8.82149C36.4911 9.13405 36.6667 9.55797 36.6667 10V16.6667H3.33333V10C3.33333 9.55797 3.50893 9.13405 3.82149 8.82149C4.13405 8.50893 4.55797 8.33333 5 8.33333ZM35 36.6667H5C4.55797 36.6667 4.13405 36.4911 3.82149 36.1785C3.50893 35.866 3.33333 35.442 3.33333 35V20H36.6667V35C36.6667 35.442 36.4911 35.866 36.1785 36.1785C35.866 36.4911 35.442 36.6667 35 36.6667Z" fill="white"/>
								<path d="M20 26.6667C20.9205 26.6667 21.6667 25.9205 21.6667 25C21.6667 24.0795 20.9205 23.3333 20 23.3333C19.0795 23.3333 18.3333 24.0795 18.3333 25C18.3333 25.9205 19.0795 26.6667 20 26.6667Z" fill="white"/>
								<path d="M30 26.6667C30.9205 26.6667 31.6667 25.9205 31.6667 25C31.6667 24.0795 30.9205 23.3333 30 23.3333C29.0796 23.3333 28.3334 24.0795 28.3334 25C28.3334 25.9205 29.0796 26.6667 30 26.6667Z" fill="white"/>
								<path d="M9.99995 26.6667C10.9204 26.6667 11.6666 25.9205 11.6666 25C11.6666 24.0795 10.9204 23.3333 9.99995 23.3333C9.07947 23.3333 8.33328 24.0795 8.33328 25C8.33328 25.9205 9.07947 26.6667 9.99995 26.6667Z" fill="white"/>
								<path d="M20 33.3334C20.9205 33.3334 21.6667 32.5872 21.6667 31.6667C21.6667 30.7462 20.9205 30 20 30C19.0795 30 18.3333 30.7462 18.3333 31.6667C18.3333 32.5872 19.0795 33.3334 20 33.3334Z" fill="white"/>
								<path d="M30 33.3334C30.9205 33.3334 31.6667 32.5872 31.6667 31.6667C31.6667 30.7462 30.9205 30 30 30C29.0796 30 28.3334 30.7462 28.3334 31.6667C28.3334 32.5872 29.0796 33.3334 30 33.3334Z" fill="white"/>
								<path d="M9.99995 33.3334C10.9204 33.3334 11.6666 32.5872 11.6666 31.6667C11.6666 30.7462 10.9204 30 9.99995 30C9.07947 30 8.33328 30.7462 8.33328 31.6667C8.33328 32.5872 9.07947 33.3334 9.99995 33.3334Z" fill="white"/>
								</g>
								<defs>
								<clipPath id="clip0">
								<rect width="40" height="40" fill="white"/>
								</clipPath>
								</defs>
							</svg>
						<!-- </span> -->
					</div>
					</a>
				</div>
			</div>
		</div>
        <div class="col-xl-9 col-xxl-8 col-lg-7">
						<div class="card">	
							<div class="card-header border-0 pb-0">
								<h3 class="fs-20 mb-0 text-black">Top Rated Doctors</h3>
								<a href="page-review.html" class="text-primary font-w500">View more >></a>
							</div>
							<div class="card-body">
								<div class="assigned-doctor owl-carousel">
									<div class="items">
										<div class="text-center">
											<img src="images/doctors/5.jpg" alt="" >
											<div class="dr-star"><i class="las la-star"></i> 4.2</div>
											<h5 class="fs-16 mb-1 font-w600"><a class="text-black" href="page-review.html">Dr. Alexandro Jr.</a></h5>
											<span class="text-primary mb-2 d-block">Dentist</span>
											<p class="fs-12">795 Folsom Ave, Suite 600 San Francisco, CADGE 94107</p>
											<div class="social-media">
												<a href="javascript:void(0);"><i class="lab la-instagram"></i></a>
												<a href="javascript:void(0);"><i class="lab la-facebook-f"></i></a>
												<a href="javascript:void(0);"><i class="lab la-twitter"></i></a>
											</div>
										</div>
									</div>
									<div class="items">
										<div class="text-center">
											<img src="images/doctors/1.jpg" alt="" >
											<div class="dr-star"><i class="las la-star"></i> 4.2</div>
											<h5 class="fs-16 mb-1 font-w600"><a class="text-black" href="page-review.html">Dr. Samantha</a></h5>
											<span class="text-primary mb-2 d-block">Physical Therapy</span>
											<p class="fs-12">795 Folsom Ave, Suite 600 San Francisco, CADGE 94107</p>
											<div class="social-media">
												<a href="javascript:void(0);"><i class="lab la-instagram"></i></a>
												<a href="javascript:void(0);"><i class="lab la-facebook-f"></i></a>
												<a href="javascript:void(0);"><i class="lab la-twitter"></i></a>
											</div>
										</div>
									</div>
									<div class="items">
										<div class="text-center">
											<img src="images/doctors/2.jpg" alt="" >
											<div class="dr-star"><i class="las la-star"></i> 4.2</div>
											<h5 class="fs-16 mb-1 font-w600"><a class="text-black" href="page-review.html">Dr. Aliandro M</a></h5>
											<span class="text-primary mb-2 d-block">Nursing</span>
											<p class="fs-12">795 Folsom Ave, Suite 600 San Francisco, CADGE 94107</p>
											<div class="social-media">
												<a href="javascript:void(0);"><i class="lab la-instagram"></i></a>
												<a href="javascript:void(0);"><i class="lab la-facebook-f"></i></a>
												<a href="javascript:void(0);"><i class="lab la-twitter"></i></a>
											</div>
										</div>
									</div>
									<div class="items">
										<div class="text-center">
											<img  src="images/doctors/3.jpg" alt="" >
											<div class="dr-star"><i class="las la-star"></i> 4.2</div>
											<h5 class="fs-16 mb-1 font-w600"><a class="text-black" href="page-review.html">Dr. Samuel</a></h5>
											<span class="text-primary mb-2 d-block">Gynecologist</span>
											<p class="fs-12">795 Folsom Ave, Suite 600 San Francisco, CADGE 94107</p>
											<div class="social-media">
												<a href="javascript:void(0);"><i class="lab la-instagram"></i></a>
												<a href="javascript:void(0);"><i class="lab la-facebook-f"></i></a>
												<a href="javascript:void(0);"><i class="lab la-twitter"></i></a>
											</div>
										</div>
									</div>
									<div class="items">
										<div class="text-center">
											<img src="images/doctors/4.jpg" alt="" >
											<div class="dr-star"><i class="las la-star"></i> 4.2</div>
											<h5 class="fs-16 mb-1 font-w600"><a class="text-black" href="page-review.html">Dr. Melinda</a></h5>
											<span class="text-primary mb-2 d-block">Dentist</span>
											<p class="fs-12">795 Folsom Ave, Suite 600 San Francisco, CADGE 94107</p>
											<div class="social-media">
												<a href="javascript:void(0);"><i class="lab la-instagram"></i></a>
												<a href="javascript:void(0);"><i class="lab la-facebook-f"></i></a>
												<a href="javascript:void(0);"><i class="lab la-twitter"></i></a>
											</div>
										</div>
									</div>
									<div class="items">
										<div class="text-center">
											<img src="images/doctors/1.jpg" alt="" >
											<div class="dr-star"><i class="las la-star"></i> 4.2</div>
											<h5 class="fs-16 mb-1 font-w600"><a class="text-black" href="page-review.html">Dr. Alexandro Jr.</a></h5>
											<span class="text-primary mb-2 d-block">Dentist</span>
											<p class="fs-12">795 Folsom Ave, Suite 600 San Francisco, CADGE 94107</p>
											<div class="social-media">
												<a href="javascript:void(0);"><i class="lab la-instagram"></i></a>
												<a href="javascript:void(0);"><i class="lab la-facebook-f"></i></a>
												<a href="javascript:void(0);"><i class="lab la-twitter"></i></a>
											</div>
										</div>
									</div>
									<div class="items">
										<div class="text-center">
											<img  src="images/doctors/2.jpg" alt="" >
											<div class="dr-star"><i class="las la-star"></i> 4.2</div>
											<h5 class="fs-16 mb-1 font-w600"><a class="text-black" href="page-review.html">Dr. Aliandro M</a></h5>
											<span class="text-primary mb-2 d-block">Nursing</span>
											<p class="fs-12">795 Folsom Ave, Suite 600 San Francisco, CADGE 94107</p>
											<div class="social-media">
												<a href="javascript:void(0);"><i class="lab la-instagram"></i></a>
												<a href="javascript:void(0);"><i class="lab la-facebook-f"></i></a>
												<a href="javascript:void(0);"><i class="lab la-twitter"></i></a>
											</div>
										</div>
									</div>
									<div class="items">
										<div class="text-center">
											<img src="images/doctors/3.jpg" alt="" >
											<div class="dr-star"><i class="las la-star"></i> 4.2</div>
											<h5 class="fs-16 mb-1 font-w600"><a class="text-black" href="page-review.html">Dr. Samuel</a></h5>
											<span class="text-primary mb-2 d-block">Gynecologist</span>
											<p class="fs-12">795 Folsom Ave, Suite 600 San Francisco, CADGE 94107</p>
											<div class="social-media">
												<a href="javascript:void(0);"><i class="lab la-instagram"></i></a>
												<a href="javascript:void(0);"><i class="lab la-facebook-f"></i></a>
												<a href="javascript:void(0);"><i class="lab la-twitter"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-xxl-4 col-lg-5">
                        <div class="card border-0 pb-0">
                            <div class="card-header flex-wrap border-0 pb-0">
                                <h3 class="fs-20 mb-0 text-black">Recent Indigents</h3>
								<a href="patient-list.html" class="text-primary font-w500">View more >></a>
                            </div>
                            <div class="card-body"> 
                                <div id="DZ_W_Todo2" class="widget-media dz-scroll ps ps--active-y height320">
                                    <ul class="timeline">
                                    	@foreach($approved as $appr)
                                        <li>
                                            <div class="timeline-panel flex-wrap">
												<div class="media-body">
													<h5 class="mb-1"><a class="text-black" href="patient-details.html">{{ $appr->firstName }} {{ $appr->surname }}</a></h5>
													<span class="fs-14">24 Years</span>
												</div>
												<a href="javascript:void(0);" class="text-success mt-2">{{$appr->status}}</a>
											</div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
					</div>
    </div>
    
</div>
                    
                    
@endsection
