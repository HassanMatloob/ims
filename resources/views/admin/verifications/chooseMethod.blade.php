@extends('admin.layout.default')

@section('content')
<div class="container-fluid">
	<form method="POST" action="/admin/verification/chosen">
		@csrf
		<div class="row">
			<p class="col-md-4 text-md-right">Verification Method</p>
		@if (\Session::has('message'))
        <div class="alert alert-info">
            <ul>
                <li>{{ \Session::get('message') }}</li>
            </ul>
        </div>
        @endif
			<div class="form-group mb-0 col-md-6">
	            <div class="radio">
	                <label for="manualVer">
	                	<input id="manualVer" type="radio" name="verification_method" value="manualVer"> Manual Verification</label>
	            </div>
	            <div class="radio">
	                <label for="autoVer">
	                	<input id="autoVer" type="radio" name="verification_method" value="autoVer"> Auto Verification</label>
	            </div>
	        </div>
		</div>

		<input type="hidden" name="indigent_id" value="{{$indigent->id}}" required />

		<div class="form-group row mb-0">
			<div class="col-md-6 offset-md-4">
				<input type="submit" class="btn btn-primary" value="PROCEED TO VERIFICATION" />
			</div>
		</div>
	</form>
</div>
@endsection