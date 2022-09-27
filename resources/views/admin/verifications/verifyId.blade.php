@extends('admin.layout.default')

@section('content')
<div class="container-fluid">
	<form method="POST" action="verifyIdnum">
		@csrf
		<div class="form-group row">
			<label for="idnum" class="col-md-4 col-form-label text-md-right">ID number to verify</label>
			<div class="col-md-6">
				<input id="idnum" type="text" class="form-control" name="id_number" value="{{$indigent->id_number}}" required />
			</div>
		</div>

		<div class="form-group row mb-0">
			<div class="col-md-6 offset-md-4">
				<input type="submit" class="btn btn-primary" value="VERIFY ID" />
			</div>
		</div>
	</form>
</div>
@endsection