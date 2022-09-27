@extends('admin.layout.default')

@section('content')
	<div class="container-fluid">
		<h1 class="heading">The info</h1>
		<p>Input ID number: {{$identityNumber}}</p>

		<h2>Results</h2>
		<h3>CIPC Information</h3>
        <h6>ENTERPRISE INFORMATION</h6>
		<table>
			<tr>
				<th>Registration Number: </th>
				<td></td>
			</tr>
			<tr>
				<th>Enterprise Name: </th>
				<td></td>
			</tr>
			<tr>
				<th style="padding-right:10px ;">Registration Date :</th>
				<td></td>
			</tr>
            <tr>
				<th>Enterprise Type: </th>
				<td></td>
			</tr>
            <tr>
				<th>Enterprise Status: </th>
				<td></td>
			</tr>
		</table>
		<br />

		<h3>Active Members/Directors</h3>
		<table id="example5" class="table table-striped patient-list mb-4 dataTablesCard fs-14">
			<tr>
				<th>First Name and Surname</th>
				<th>Type</th>
				<th>ID Number</th>
				<th>Date of Birth</th>
				<th>Appointment</th>
				<th>Address</th>
			</tr>
			<tr>
				<td>{{ $indigent->firstName.' '.$indigent->surname }}</td>
				<td>Director</td>
				<td>{{ $identityNumber }}</td>
				<td>{{ $personal_details->d_o_b }}</td>
				<td>06/04/2019</td>
				<td>{{ $personal_details->res_address }}</td>
			</tr>
		</table>

		<br />

		<form method="POST" action="">
		@csrf
		<div class="form-group row">
			<label for="water-main" class="col-md-4 col-form-label text-md-right">Verdict</label>
			<div class="col-md-6">
				<select id="verdict" type="text" name="verdict" class="form-control" required>
					<option value="Verify">Verify</option>
					<option value="Unverify">Unverify</option>
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label for="toilet-facility" class="col-md-4 col-form-label text-md-right">Comments</label>
			<div class="col-md-6">
				<div class="form-group">
                    <textarea class="form-control" name="comment" rows="4" id="comment"></textarea>
                </div>
			</div>
		</div>	

		<div class="form-group row mb-0">
			<div class="col-md-6 offset-md-4">
				<button type="submit" class="btn btn-primary">
					Submit
				</button>
			</div>
		</div>
	</form>
	</div>

@endsection