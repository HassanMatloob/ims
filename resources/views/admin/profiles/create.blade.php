@extends('admin.layout.default')

@section('content')
	<div class="fluid-container">

		<form method="POST" class="mt-3" action="{{route('admin.profiles.store')}}" enctype="multipart/form-data" file=true>
			@csrf

			<div class="form-group row">
				<label for="fname" class="col-md-4 col-form-label text-md-right">Name</label>
				<div class="col-md-6">
					<input id="fname" type="text" name="fname" class="form-control" />
				</div>
			</div>

			<div class="form-group row">
				<label for="lname" class="col-md-4 col-form-label text-md-right">Surname</label>
				<div class="col-md-6">
					<input id="lname" type="text" name="lname" class="form-control" required />
				</div>
			</div>

			<div class="form-group row">
				<label for="cell" class="col-md-4 col-form-label text-md-right">Cell no.</label>
				<div class="col-md-6">
					<input id="cell" type="text" name="cell" class="form-control" required />
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
				<label for="position" class="col-md-4 col-form-label text-md-right">Position</label>
				<div class="col-md-6">
					<input id="position" type="text" class="form-control" name="position" value="{{$role->name}}" readonly />
				</div>
			</div>

			<div class="form-group row">
				<label for="pro_pic" class="col-md-4 col-form-label text-md-right">Profile photo</label>
				<div class="col-md-6">
					<input id="pro_pic" name="pro_pic" type="file" class="form-control" />
				</div>
			</div>

			<div class="form-group row">
				<label for="c_img" class="col-md-4 col-form-label text-md-right">Cover image</label>
				<div class="col-md-6">
					<input id="c_img" name="c_img" type="file" class="form-control" />
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