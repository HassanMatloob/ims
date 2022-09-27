@extends('admin.layout.default')

@section('content')
<div class="container-fluid">
	<form method="POST" action="/admin/indigencies/verifyIdnumBidder">
		@csrf
		<div class="form-group row">
			<label for="idnum" class="col-md-4 col-form-label text-md-right">Enter ID Number to Display Employee CIPC Information</label>
			<div class="col-md-6">
				<input id="idnum"  type="text" name="id_number" class="form-control" value="" required />
			</div>
		</div>

		<div class="form-group row mb-0">
			<div class="col-md-6 offset-md-4">
				<input type="submit" class="btn btn-primary" id="submit" value="Verify ID" />
			</div>
		</div>
	</form>

</div>
@endsection