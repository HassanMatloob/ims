@extends('layout.default')

@section('content')
<div class="container-fluid">
	<div id="prog">
		<span class="step"></span>
		<span class="step"></span>
		<span class="step"></span>
		<span class="step"></span>
	</div>

	<form method="POST" action="{{ route('user.indigencies.store') }}" enctype="multipart/form-data" file=true>
		@csrf
		<div class="form-group row">
			<label for="f_name" class="col-md-4 col-form-label text-md-right">First Name</label>
			<div class="col-md-6">
				<input id="f_name" name="f_name" type="text" class="form-control" required />
			</div>
		</div>

		<div class="form-group row">
			<label for="l_name" class="col-md-4 col-form-label text-md-right">Surname</label>
			<div class="col-md-6">
				<input id="l_name" name="l_name" type="text" class="form-control" required />
			</div>
		</div>

		<div class="form-group row">
			<label for="identity" class="col-md-4 col-form-label text-md-right">ID Number</label>
			<div class="col-md-6">
				<input id="identity" name="identity" type="text" class="form-control" required />
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
</div>

@endsection