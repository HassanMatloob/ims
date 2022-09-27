@extends('layout.default')

@section('content')
	<div class="container-fluid">
		<form method="POST" action="{{ route('user.documents.store') }}" enctype="multipart/form-data" file=true>
		@csrf
		<div class="form-group row">
			<label for="municipal_acc" class="col-md-4 col-form-label text-md-right">Copy of Municipal Account</label>
			<div class="col-md-6">
				<input id="municipal_acc" name="municipal_acc" type="file" class="form-control" required />
			</div>
		</div>

		<div class="form-group row">
			<label for="id_doc" class="col-md-4 col-form-label text-md-right">Copy of ID</label>
			<div class="col-md-6">
				<input id="id_doc" name="id_doc" type="file" class="form-control" required />
			</div>
		</div>

		<div class="form-group row">
			<label for="confirm_pension" class="col-md-4 col-form-label text-md-right">Confirmation of Pension Status</label>
			<div class="col-md-6">
				<input id="confirm_pension" name="confirm_pension" type="file" class="form-control" />
			</div>
		</div>

		<div class="form-group row">
			<label for="income_proof" class="col-md-4 col-form-label text-md-right">Copy of Proof of Income</label>
			<div class="col-md-6">
				<input id="income_proof" name="income_proof" type="file" class="form-control" />
			</div>
		</div>

		<div class="form-group row">
			<label for="affidavit" class="col-md-4 col-form-label text-md-right">Affidavit</label>
			<div class="col-md-6">
				<input id="affidavit" name="affidavit" type="file" class="form-control" />
			</div>
		</div>

		<div class="form-group row">
			<label for="death_cert" class="col-md-4 col-form-label text-md-right">Copy of Death Certificate if owner is deceased</label>
			<div class="col-md-6">
				<input id="death_cert" name="death_cert" type="file" class="form-control" />
			</div>
		</div>

		<div class="form-group row">
			<label for="council_testimony" class="col-md-4 col-form-label text-md-right">Letter from the Council</label>
			<div class="col-md-6">
				<input id="council_testimony" name="council_testimony" type="file" class="form-control" />
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