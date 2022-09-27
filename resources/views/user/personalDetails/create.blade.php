@extends('user.layout.default')

@section('content')
<div class="container-fluid">

	<form method="POST" action="{{ route('user.personalDetails.store') }}">
		@csrf

		<!-- Personal Details tab begins here -->
		<div class="tab">
			<div class="form-group row">
				<label for="initial" class="col-md-4 col-form-label text-md-right">Initials</label>
				<div class="col-md-6">
					<input id="initial" type="text" value="{{old('initials')}}" name="initials" class="form-control" required />
				</div>
			</div>

			<div class="form-group row">
				<label for="m_name" class="col-md-4 col-form-label text-md-right">Maiden name</label>
				<div class="col-md-6">
					<input id="m_name" type="text" value="{{old('mname')}}" name="mname" class="form-control" />
				</div>
			</div>

			<div class="form-group row">
				<label for="acc_no" class="col-md-4 col-form-label text-md-right">Account number</label>
				<div class="col-md-6">
					<input id="acc_no" type="text" value="{{old('acc_no')}}" name="acc_no" class="form-control" required />
				</div>
			</div>

			<div class="form-group row">
				<label for="d_o_b" class="col-md-4 col-form-label text-md-right">Date of Birth</label>
				<div class="col-md-6">
					<input id="d_o_b" type="date" value="{{old('d_o_b')}}" name="d_o_b" class="form-control" required />
				</div>
			</div>

			<div class="form-group row">
				<label for="res_addr" class="col-md-4 col-form-label text-md-right">Residential Address</label>
				<div class="col-md-6">
					<input id="res_addr" type="text" value="{{old('res_addr')}}" name="res_addr" class="form-control" required />
				</div>
			</div>

			<div class="form-group row">
				<label for="postal_code" class="col-md-4 col-form-label text-md-right">Postal code</label>
				<div class="col-md-6">
					<input id="postal_code" type="number" value="{{old('res_postal_code')}}" name="res_postal_code" class="form-control" required />
				</div>
			</div>

			<div class="form-group row">
				<label for="p_addr" class="col-md-4 col-form-label text-md-right">Postal address</label>
				<div class="col-md-6">
					<input id="p_addr" type="text" value="{{old('p_addr')}}" name="p_addr" class="form-control" />
				</div>
			</div>

			<div class="form-group row">
				<label for="p_code" class="col-md-4 col-form-label text-md-right">Postal code</label>
				<div class="col-md-6">
					<input id="p_code" type="number" value="{{old('p_code')}}" name="p_code" class="form-control" />
				</div>
			</div>

			<div class="row">
				<p class="col-md-4 text-md-right">Are you a pensioner?</p>
				<div class="form-group mb-0 col-md-6">
		            <div class="radio">
		                <label for="pensioner">
		                	<input id="pensioner" type="radio" name="pension" value="true"> Yes</label>
		            </div>
		            <div class="radio">
		                <label for="pensioner">
		                	<input id="pensioner" type="radio" name="pension" value="false"> No</label>
		            </div>
		        </div>
			</div>
			
	<br />
			<div class="row">
				<p class="col-md-4 text-md-right">Gender</p>
				<div class="form-group mb-0 col-md-6">
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
	       <br /> 

			<div class="form-group row">
				<label for="ward_no" class="col-md-4 col-form-label text-md-right">Ward number</label>
				<div class="col-md-6">
					<input id="ward_no" type="number" name="ward_no" class="form-control" min="1" max="100" required />
				</div>
			</div>

			<div class="form-group row">
				<label for="emp_status" class="col-md-4 col-form-label text-md-right">Employment status</label>
				<div class="col-md-6">
					<select id="emp_status" type="text" name="emp_status" class="form-control" required>
						<option value="Unemployed">Unemployed</option>
						<option value="Employed">Employed</option>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="meter_no" class="col-md-4 col-form-label text-md-right">Electricity meter</label>
				<div class="col-md-6">
					<input id="meter_no" type="text" name="meter" class="form-control" required />
				</div>
			</div>
	<br />
		<div class="row">
			<div class="col-md-4 text-md-right">
				<p>Check boxes where applicable to you:</p>
			</div>
			<div class="col-md-6">
				<div class="custom-control custom-checkbox mb-3">
					<input type="checkbox" class="custom-control-input" id="alt_energy" name="alt_energy" value="1">
					<label class="custom-control-label" for="alt_energy">Alternative energy</label>
				</div>

				<div class="custom-control custom-checkbox mb-3">
					<input type="checkbox" class="custom-control-input" id="rates" name="rates" value="1">
					<label class="custom-control-label" for="rates">Rates</label>
				</div>

				<div class="custom-control custom-checkbox mb-3">
					<input type="checkbox" class="custom-control-input" id="water" name="water" value="1">
					<label class="custom-control-label" for="water">Water</label>
				</div>

				<div class="custom-control custom-checkbox mb-3">
					<input type="checkbox" class="custom-control-input" id="toilet_facility" name="toilet" value="1">
					<label class="custom-control-label" for="toilet_facility">Toilet Facility</label>
				</div>
			</div>
			
		</div>
	<br />
			<div class="form-group row">
				<label for="erf" class="col-md-4 col-form-label text-md-right">erf</label>
				<div class="col-md-6">
					<input id="erf" type="text" name="erf" class="form-control" required />
				</div>
			</div>

			<div class="form-group row">
				<label for="m_status" class="col-md-4 col-form-label text-md-right">Marital status</label>
				<div class="col-md-6">
					<select id="m_status" type="text" name="m_status" class="form-control" required>
						<option value="Married">Married</option>
						<option value="Cohabitation">Cohabitation</option>
						<option value="Divorced">Divorced</option>
						<option value="Separated">Separated</option>
						<option value="Widow">Widow(er)</option>
						<option value="Single">Single</option>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="deceased" class="col-md-4 col-form-label text-md-right">Deceased</label>
				<div class="col-md-6">
					<select id="deceased" type="text" name="deceased" class="form-control" required>
						<option value="Deceased">Deceased</option>
						<option value="Not Deceased">Not Deceased</option>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="home_tel" class="col-md-4 col-form-label text-md-right">Home telephone</label>
				<div class="col-md-6">
					<input id="home_tel" type="tel" value="{{old('home_tel')}}" name="home_tel" class="form-control" />
				</div>
			</div>

			<div class="form-group row">
				<label for="cell_no" class="col-md-4 col-form-label text-md-right">Cell no</label>
				<div class="col-md-6">
					<input id="cell_no" type="tel" value="{{old('cell')}}" name="cell" class="form-control" required />
				</div>
			</div>

			<div class="form-group row">
				<label for="other_contact" class="col-md-4 col-form-label text-md-right">Other contact</label>
				<div class="col-md-6">
					<input id="other_contact" type="tel" value="{{old('other_contact')}}" name="other_contact" class="form-control" name="other_contact" />
				</div>
			</div>
		</div>
		<!-- End of Personal Details tab -->

		<!-- Employment Details tab starts here -->
		<div class="tab">
			<div class="form-group row">
				<label for="employer" class="col-md-4 col-form-label text-md-right">Name of Employer</label>
				<div class="col-md-6">
					<input id="employer" type="text" value="{{old('employer')}}" name="employer" class="form-control" />
				</div>
			</div>

			<div class="form-group row">
				<label for="emp_addr" class="col-md-4 col-form-label text-md-right">Employer address</label>
				<div class="col-md-6">
					<input id="emp_addr" type="text" value="{{old('emp_addr')}}" name="emp_addr" class="form-control" />
				</div>
			</div>

			<div class="form-group row">
				<label for="emp_tel" class="col-md-4 col-form-label text-md-right">Employer telephone</label>
				<div class="col-md-6">
					<input id="emp_tel" type="tel" value="{{old('emp_tel')}}" name="emp_tel" class="form-control" />
				</div>
			</div>

			<div class="form-group row">
				<label for="work_tel" class="col-md-4 col-form-label text-md-right">Work telephone</label>
				<div class="col-md-6">
					<input id="work_tel" type="tel" value="{{old('work_tel')}}" name="work_tel" class="form-control" name="work_tel" />
				</div>
			</div>
		</div>
		<!-- End of Employment Details tab -->
		
		<div style="overflow: auto;">
			<div style="float: right;">
				<button type="button" class="btn btn-light" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
				<button type="button" id="nextBtn" class="btn btn-dark" onclick="nextPrev(1)">Next</button>
			</div>
		</div>

		<div id="prog" style="text-align: center;">
			<span class="step"></span>
			<span class="step"></span>
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