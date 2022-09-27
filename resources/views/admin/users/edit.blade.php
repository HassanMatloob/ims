@extends("admin.layout.default")

@section("content")

	<form method="POST" class="mt-4" action="{{route('admin.users.update', ["id" => $user->id])}}">
		@method("PUT")
		@csrf

		<div class="form-group row">
			<label for="mail" class="col-md-4 col-form-label text-md-right">Email</label>
			<div class="col-md-6">
				<input id="mail" type="text" name="email_addr" value="{{$user->email}}" class="form-control" readonly />
			</div>
		</div>

		<div class="form-group row">
			<label for="admin_status" class="col-md-4 col-form-label text-md-right">Admin Status</label>
			<div class="col-md-6">
				<input id="admin_status" type="text" name="admin_status" value="{{ $user->id == 0 ? "Fallse" : "True"}}" class="form-control" required />
			</div>
		</div>


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
	                	<input id="indigent_officer" type="radio" name="position" value="4"> Indigent Officer</label>
	            </div>
	            <div class="radio">
	                <label for="supervisor">
	                	<input id="supervisor" type="radio" name="position" value="3"> Supervisor</label>
	            </div>
	            <div class="radio">
	                <label for="cfo">
	                	<input id="cfo" type="radio" name="position" value="2"> CFO</label>
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