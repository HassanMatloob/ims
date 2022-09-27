@extends('admin.layout.default')

@section('content')
<table class="table table-striped patient-list mb-4 dataTablesCard fs-14">
	<tr>
		<th>Task</th>
		<th>Indigent ID</th>
		<th>Assigned to</th>
		<th>Created at</th>
		<th>Assigned by</th>
		<th>Completed</th>
	</tr>

	<tr>
		<td>{{$task->name}}</td>
		<td>{{$task->id}}</td>
		<td>{{$task->user_id}}</td>
		<td>{{$task->created_at}}</td>
		<td></td>
		<td>{{$task->is_completed == true ? "True" : "False"}}</td>
	</tr>
</table>
@endsection