@extends("admin.layout.default")

@section("content")

<form class="mt-4" action="{{ route('admin.users.store') }}" method="POST">
	@csrf
	<div class="form-group row">
		<label for="mail" class="col-md-4 col-form-label text-md-right">Email</label>
		<div class="col-md-6">
			<input id="mail" name="email" type="email" class="form-control" required />
		</div>
	</div>

	@error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
    </div>

	<input type="hidden" name="admin_status" value=1 readonly required />
	<br />

	<div class="row">
			<p class="col-md-4 text-md-right">Role</p>
			<div class="form-group mb-0 col-md-6">
	            <div class="radio">
	                <label for="mm">
	                	<input id="mm" type="radio" name="position" value=5> MM</label>
	            </div>
	            <div class="radio">
	                <label for="indigent_officer">
	                	<input id="indigent_officer" type="radio" name="position" value=4> Indigent Officer</label>
	            </div>
	            <div class="radio">
	                <label for="supervisor">
	                	<input id="supervisor" type="radio" name="position" value=3> Supervisor</label>
	            </div>
	            <div class="radio">
	                <label for="cfo">
	                	<input id="cfo" type="radio" name="position" value=2> CFO</label>
	            </div>
	        </div>
	</div>
	<br />

	<div class="form-group row mb-0">
		<div class="col-md-6 offset-md-4">
			<button type="submit" class="btn btn-primary">
				Save and Continue
			</button>
		</div>
	</div>
</form>

@endsection