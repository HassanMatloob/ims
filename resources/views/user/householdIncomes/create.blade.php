@extends('user.layout.default')

@section('content')
<div class="container-fluid">
	<form method="POST" action="{{ route('user.householdIncomes.store') }}">
		@csrf
		<div class="form-group row">
			<label for="f_name" class="col-md-4 col-form-label text-md-right">Full name</label>
			<div class="col-md-6">
				<input id="f_name" name="f_name" type="text" class="form-control" required />
			</div>
		</div>

		<div class="form-group row">
			<label for="relation" class="col-md-4 col-form-label text-md-right">Relationship</label>
			<div class="col-md-6">
				<select id="relation" type="text" name="relation" class="form-control" required>
					<option value="Father">Father</option>
					<option value="Mother">Mother</option>
					<option value="Child">Child</option>
					<option value="Uncle">Uncle</option>
					<option value="Aunt">Aunt</option>
					<option value="Self">Myself</option>
					<option value="other">Other</option>
				</select>
			</div>
		</div>
		
<br />
		<div class="row">
			<div class="col-md-4 text-md-right">
				<p>Gender</p>
			</div>
			<div class="col-md-6">
				<div class="form-group mb-0">
		            <div class="radio">
		                <label for="female">
		                	<input id="female" type="radio" name="gender" value="Female"> Female</label>
		            </div>
		            <div class="radio">
		                <label for="male">
		                	<input id="male" type="radio" name="gender" value="Male"> Male</label>
		            </div>
		        </div>
			</div>
		</div>
	<br />	

		<div class="form-group row">
			<label for="d_o_b" class="col-md-4 col-form-label text-md-right">Date of Birth</label>
			<div class="col-md-6">
				<input id="d_o_b" type="date" name="d_o_b" class="form-control" required />
			</div>
		</div>

		<div class="form-group row">
			<label for="emp_income" class="col-md-4 col-form-label text-md-right">Employment Income</label>
			<div class="col-md-6">
				<input id="emp_income" name="emp_income" type="number" step=".01" class="form-control" />
			</div>
		</div>

		<div class="form-group row">
			<label for="old_age_pension" class="col-md-4 col-form-label text-md-right">Old age pension</label>
			<div class="col-md-6">
				<input id="old_age_pension" name="old_age_pension" type="number" step=".01" class="form-control" />
			</div>
		</div>

		<div class="form-group row">
			<label for="dis_pension" class="col-md-4 col-form-label text-md-right">Disability pension</label>
			<div class="col-md-6">
				<input id="dis_pension" name="dis_pension" type="number" step=".01" class="form-control" />
			</div>
		</div>

		<div class="form-group row">
			<label for="child_support_grant" class="col-md-4 col-form-label text-md-right">Child Support Grant</label>
			<div class="col-md-6">
				<input id="child_support_grant" name="child_support_grant" type="number" step=".01" class="form-control" />
			</div>
		</div>

		<div class="form-group row">
			<label for="cash_from_relatives" class="col-md-4 col-form-label text-md-right">Cash from relatives</label>
			<div class="col-md-6">
				<input id="cash_from_relatives" name="cash_from_relatives" type="number" step=".01" class="form-control" />
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

	<a href="{{ route('user.householdConditions.create') }}" class="btn btn-secondary">Skip and Continue</a>
</div>

@endsection