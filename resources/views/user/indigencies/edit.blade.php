@extends("user.layout.default")

@section("content")
	<form class="mt-4" action="{{route('user.indigencies.update', ["id" => $indigent->id])}}" method="POST">
		@method("PUT")
		@csrf

		<div class="form-group row">
			<label for="f_name" class="col-md-4 col-form-label text-md-right">First Name</label>
			<div class="col-md-6">
				<input id="f_name" name="f_name" type="text" class="form-control" value="{{$indigent->firstName}}" required />
			</div>
		</div>

		<div class="form-group row">
			<label for="l_name" class="col-md-4 col-form-label text-md-right">Surname</label>
			<div class="col-md-6">
				<input id="l_name" name="l_name" type="text" class="form-control" value="{{$indigent->surname}}" required />
			</div>
		</div>

		<div class="form-group row">
			<label for="identity" class="col-md-4 col-form-label text-md-right">ID Number</label>
			<div class="col-md-6">
				<input id="identity" name="identity" type="text" class="form-control" value="{{$indigent->id_number}}" required />
			</div>
		</div>

		<div class="form-group row mb-0">
			<div class="col-md-6 offset-md-4">
				<button type="submit" class="btn btn-primary">
					Save and Continue
				</button>
			</div>
		</div>
	</form>
@endsection