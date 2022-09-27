@extends('user.layout.default')

@section('content')
<div class="container-fluid">
	<h1>Employer Details</h1>

	<form method="POST" action="{{ route('user.personalDetails.storeEmploymentDetails') }}">
		@csrf

			<div class="form-group row">
				<label for="employer" class="col-md-4 col-form-label text-md-right">Name of Employer</label>
				<div class="col-md-6">
					<input id="employer" type="text" name="employer" class="form-control" />
				</div>
			</div>

			<div class="form-group row">
				<label for="emp_addr" class="col-md-4 col-form-label text-md-right">Employer address</label>
				<div class="col-md-6">
					<input id="emp_addr" type="text" name="emp_addr" class="form-control" />
				</div>
			</div>

			<div class="form-group row">
				<label for="emp_tel" class="col-md-4 col-form-label text-md-right">Employer telephone</label>
				<div class="col-md-6">
					<input id="emp_tel" type="tel" name="emp_tel" class="form-control" />
				</div>
			</div>

			<div class="form-group row">
				<label for="work_tel" class="col-md-4 col-form-label text-md-right">Work telephone</label>
				<div class="col-md-6">
					<input id="work_tel" type="tel" name="work_tel" class="form-control" name="work_tel" />
				</div>
			</div>

		<div class="form-group row mb-0">
			<div class="col-md-6 offset-md-4">
				<a type="button" href="{{route('user.personalDetails.createPersonalDetails')}}" class="btn btn-warning">Previous</a>

				<button type="submit" class="btn btn-primary">
					Save and Continue
				</button>
			</div>
		</div>
	</form>
	
</div>
	
@endsection