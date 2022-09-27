@extends('admin.layout.default')

@section('content')
<!-- row -->
			<div class="container-fluid">
				<div class="form-head d-flex mb-3 mb-md-4 align-items-start">
					<div class="mr-auto d-none d-lg-block">
						<a href="javascript:void(0)" class="btn btn-primary btn-rounded">+ Add New</a>
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
										<th>Task ID</th>
										<th>Task</th>
										<th>Assigned to</th>
										<th>Indigent</th>
										<th>Completed</th>
									</tr>
								</thead>
								<tbody>
									@foreach($tasks as $task)
									<tr>
										<td><a href="{{ route('admin.tasks.show', ['id' => $task->id])}} ">{{$task->id}}</a></td>
										<td>{{$task->name}}</td>
										<td>{{$task->fname}} {{$task->lname}}</td>
										<td>
											<a href="{{route('admin.indigencies.show', ['id' => $task->target])}}">{{$task->target}}</a>
										</td>
										<td>
											{{$task->is_completed == true ? "True" : "False"}}
										</td>
									</tr>
									@endforeach									
								</tbody>
							</table>
						</div>
					</div>
				</div>
@endsection