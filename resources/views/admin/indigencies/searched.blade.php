@extends('admin.layout.default')
@section('content')
	<div class="container-fluid">
		<h1 class="heading">The info</h1>
		<p>Input ID number: {{$identityNumber}}</p>

		<h2>Results</h2>
		<h3>Personal Information</h3>
		@if($verificationResult != '')
		
		<table>
			<tr>
				<th>First Name: </th>
				<td>{{$verificationResult->firstNames}}</td>
			</tr>
			<tr>
				<th>Surname: </th>
				<td>{{ $verificationResult->surName }}</td>
			</tr>
			<tr>
				<th>Date of Birth: </th>
				<td>{{ $verificationResult->dob }}</td>
			</tr>
			<tr>
				<th>Age: </th>
				<td>{{ $verificationResult->age }}</td>
			</tr>
			<tr>
				<th>Gender: </th>
				<td>{{ $verificationResult->gender }}</td>
			</tr>
			<tr>
				<th>Citizenship: </th>
				<td>{{ $verificationResult->citizenship }}</td>
			</tr>
			<tr>
				<th>Country of Birth: </th>
				<td>{{ $verificationResult->countryofBirth }}</td>
			</tr>
			<tr>
				<th style="padding-right:10px ;">Marital Status:</th>
				<td>{{ $verificationResult->maritalStatus }}</td>
			</tr>
			<tr>
				<th>Deceased Status:</th>
				<td>{{ $verificationResult->deceasedStatus }}</td>
			</tr>
		</table>
		@else
		<table>
			<tr>
				<th>First Name: </th>
				<td></td>
			</tr>
			<tr>
				<th>Surname: </th>
				<td></td>
			</tr>
			<tr>
				<th style="padding-right:10px ;">Contact Number :</th>
				<td></td>
			</tr>
			<tr>
				<th style="padding-right:10px ;">Marital Status:</th>
				<td></td>
			</tr>
			<tr>
				<th>Deceased:</th>
				<td></td>
			</tr>
		</table>
		@endif
		<br />

		<h3>Deeds Information</h3>
		<table id="example5" class="table table-striped patient-list mb-4 dataTablesCard fs-14">
			<tr>
				<th>ERF No</th>
				<th>Property Type</th>
				<th>Township</th>
				<th>Property ID</th>
				<th>Registration Date</th>
				<th>Purchace Date</th>
				<th>Purchase Price</th>
				<th>Title Share</th>
				<th>Title Deed No</th>
				<th>Institution</th>
				<th>Bond Amount</th>
				<th>Bond No</th>
				<th>Bond Registration Date</th>
			</tr>
			<tr>
				<td>{{ $refined[1]->Super_Trace->CC_RESULTS->EnqCC_Deeds_DATA->PROPERTIES[0]->ERF_NO }}</td>
				<td>{{ $refined[1]->Super_Trace->CC_RESULTS->EnqCC_Deeds_DATA->PROPERTIES[0]->PROPERTY_TYPE }}</td>
				<td>{{ $refined[1]->Super_Trace->CC_RESULTS->EnqCC_Deeds_DATA->PROPERTIES[0]->TOWNSHIP }}</td>
				<td>{{ $refined[1]->Super_Trace->CC_RESULTS->EnqCC_Deeds_DATA->PROPERTIES[0]->PROPERTY_ID }}</td>
				<td>{{ $refined[1]->Super_Trace->CC_RESULTS->EnqCC_Deeds_DATA->PROP_DETAILS[0]->REGISTRATION_DATE }}</td>
				<td>{{ $refined[1]->Super_Trace->CC_RESULTS->EnqCC_Deeds_DATA->PROP_DETAILS[0]->PURCHASE_DATE }}</td>
				<td>{{ $refined[1]->Super_Trace->CC_RESULTS->EnqCC_Deeds_DATA->PROP_DETAILS[0]->PURCH_PRICE }}</td>
				<td>{{ $refined[1]->Super_Trace->CC_RESULTS->EnqCC_Deeds_DATA->PROP_DETAILS[0]->TITLE_SHARE }}</td>
				<td>{{ $refined[1]->Super_Trace->CC_RESULTS->EnqCC_Deeds_DATA->PROP_DETAILS[0]->TITLE_DEED_NO }}</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</table>

		<br />

		<form method="POST" action="{{ route('admin.verification.store') }}">
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