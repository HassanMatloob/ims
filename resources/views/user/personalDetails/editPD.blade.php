@extends('user.layout.default')

@section('content')
	<form class="mt-4" method="POST" action="{{route('user.personalDetails.updatePD', ['id' => $pd->id])}}">
		@method("PUT")
		@csrf

		<div class="form-group row">
			<label for="initial" class="col-md-4 col-form-label text-md-right">Initials</label>
			<div class="col-md-6">
				<input id="initial" type="text" name="initials" class="form-control" value="{{$pd->initials}}" required />
			</div>
		</div>

		<div class="form-group row">
			<label for="m_name" class="col-md-4 col-form-label text-md-right">Maiden name</label>
			<div class="col-md-6">
				<input id="m_name" type="text" name="mname" class="form-control" @if(isset($pd->maiden_name)) value="{{$pd->maiden_name}}" @endif />
			</div>
		</div>

		<div class="form-group row">
			<label for="acc_no" class="col-md-4 col-form-label text-md-right">Account number</label>
			<div class="col-md-6">
				<input id="acc_no" type="text" name="acc_no" class="form-control" value="{{$pd->account_number}}" required />
			</div>
		</div>

		<div class="form-group row">
			<label for="d_o_b" class="col-md-4 col-form-label text-md-right">Date of Birth</label>
			<div class="col-md-6">
				<input id="d_o_b" type="date" name="d_o_b" class="form-control" value="{{$pd->d_o_b}}" required />
			</div>
		</div>

		<div class="form-group row">
			<label for="res_addr" class="col-md-4 col-form-label text-md-right">Residential Address</label>
			<div class="col-md-6">
				<input id="res_addr" type="text" name="res_addr" class="form-control" value="{{$pd->res_address}}" required />
			</div>
		</div>

		<div class="form-group row">
			<label for="postal_code" class="col-md-4 col-form-label text-md-right">Postal code</label>
			<div class="col-md-6">
				<input id="postal_code" type="number" name="res_postal_code" class="form-control" value="{{$pd->res_postal_code}}" required />
			</div>
		</div>

		<div class="form-group row">
			<label for="p_addr" class="col-md-4 col-form-label text-md-right">Postal address</label>
			<div class="col-md-6">
				<input id="p_addr" type="text" name="p_addr" class="form-control" value="{{$pd->postal_address}}" />
			</div>
		</div>

		<div class="form-group row">
			<label for="p_code" class="col-md-4 col-form-label text-md-right">Postal code</label>
			<div class="col-md-6">
				<input id="p_code" type="number" name="p_code" class="form-control" value="{{$pd->postal_code}}" />
			</div>
		</div>

		<div class="row">
			<p class="col-md-4 text-md-right">Are you a pensioner?</p>
			<div class="form-group mb-0 col-md-6">
	            <div class="radio">
	                <label for="pensioner">
	                	<input id="pensioner" type="radio" name="pension" value="true" @if($pd->pensioner == true) checked @endif> Yes</label>
	            </div>
	            <div class="radio">
	                <label for="pensioner">
	                	<input id="pensioner" type="radio" name="pension" value="false" @if($pd->pensioner == false) checked @endif> No</label>
	            </div>
	        </div>
		</div>
		
<br />
		<div class="row">
			<p class="col-md-4 text-md-right">Gender</p>
			<div class="form-group mb-0 col-md-6">
	            <div class="radio">
	                <label for="female">
	                	<input id="female" type="radio" @if($pd->gender == "Female") checked @endif name="gender" value="Female"> Female</label>
	            </div>
	            <div class="radio">
	                <label for="male">
	                	<input id="male" type="radio" @if($pd->gender == "Male") checked @endif name="gender" value="Male"> Male</label>
	            </div>
	        </div>
		</div>
       <br /> 

		<div class="form-group row">
			<label for="ward_no" class="col-md-4 col-form-label text-md-right">Ward number</label>
			<div class="col-md-6">
				<input id="ward_no" type="number" name="ward_no" class="form-control" min="1" max="100" value="{{$pd->ward_number}}" required />
			</div>
		</div>

		<div class="form-group row">
			<label for="emp_status" class="col-md-4 col-form-label text-md-right">Employment status</label>
			<div class="col-md-6">
				<select id="emp_status" type="text" name="emp_status" class="form-control" required>
					<option value="Unemployed" @if($pd->employment_status == "Unemployed") selected @endif>Unemployed</option>
					<option value="Employed" @if($pd->employment_status == "Employed") selected @endif>Employed</option>
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label for="meter_no" class="col-md-4 col-form-label text-md-right">Electricity meter</label>
			<div class="col-md-6">
				<input id="meter_no" type="text" name="meter" class="form-control" value="{{$pd->electricity_meter}}" required />
			</div>
		</div>
<br />
	<div class="row">
		<div class="col-md-4 text-md-right">
			<p>Check boxes where applicable to you:</p>
		</div>
		<div class="col-md-6">
			<div class="custom-control custom-checkbox mb-3">
				<input type="checkbox" class="custom-control-input" @if($pd->alternative_energy == true) checked @endif id="alt_energy" name="alt_energy" value="1">
				<label class="custom-control-label" for="alt_energy">Alternative energy</label>
			</div>

			<div class="custom-control custom-checkbox mb-3">
				<input type="checkbox" class="custom-control-input" @if($pd->rates == true) checked @endif id="rates" name="rates" value="1">
				<label class="custom-control-label" for="rates">Rates</label>
			</div>

			<div class="custom-control custom-checkbox mb-3">
				<input type="checkbox" class="custom-control-input" @if($pd->water == true) checked @endif id="water" name="water" value="1">
				<label class="custom-control-label" for="water">Water</label>
			</div>

			<div class="custom-control custom-checkbox mb-3">
				<input type="checkbox" class="custom-control-input" @if($pd->toilet_facility == true) checked @endif id="toilet_facility" name="toilet" value="1">
				<label class="custom-control-label" for="toilet_facility">Toilet Facility</label>
			</div>
		</div>
		
	</div>
<br />
		<div class="form-group row">
			<label for="erf" class="col-md-4 col-form-label text-md-right">erf</label>
			<div class="col-md-6">
				<input id="erf" type="text" name="erf" class="form-control" @if(isset($pd->erf)) value="{{$pd->erf}}" @endif required />
			</div>
		</div>

		<div class="form-group row">
			<label for="m_status" class="col-md-4 col-form-label text-md-right">Marital status</label>
			<div class="col-md-6">
				<select id="m_status" type="text" name="m_status" class="form-control" required>
					<option value="married" @if($pd->marital_status == "married") selected @endif>Married</option>
					<option value="cohabitation" @if($pd->marital_status == "cohabitation") selected @endif>Cohabitation</option>
					<option value="divorced" @if($pd->marital_status == "divorced") selected @endif>Divorced</option>
					<option value="separated" @if($pd->marital_status == "separated") selected @endif>Separated</option>
					<option value="widow" @if($pd->marital_status == "widow") selected @endif>Widow(er)</option>
					<option value="single" @if($pd->marital_status == "single") selected @endif>Single</option>
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label for="home_tel" class="col-md-4 col-form-label text-md-right">Home telephone</label>
			<div class="col-md-6">
				<input id="home_tel" type="tel" name="home_tel" class="form-control" @if(isset($pd->home_tel)) value="{{$pd->home_tel}}" @endif />
			</div>
		</div>

		<div class="form-group row">
			<label for="cell_no" class="col-md-4 col-form-label text-md-right">Cell no</label>
			<div class="col-md-6">
				<input id="cell_no" type="tel" name="cell" class="form-control" value="{{$pd->cell_number}}" required />
			</div>
		</div>

		<div class="form-group row">
			<label for="other_contact" class="col-md-4 col-form-label text-md-right">Other contact</label>
			<div class="col-md-6">
				<input id="other_contact" type="tel" name="other_contact" class="form-control" name="other_contact" @if(isset($pd->other_contact)) value="{{$pd->other_contact}}" @endif />
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