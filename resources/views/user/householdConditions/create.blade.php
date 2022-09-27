@extends('user.layout.default')

@section('content')
<div class="container-fluid">
	<form method="POST" action="{{ route('user.householdConditions.store') }}">
		@csrf
		<div class="form-group row">
			<label for="water-main" class="col-md-4 col-form-label text-md-right">Main source of water</label>
			<div class="col-md-6">
				<select id="water-main" type="text" name="water-main" class="form-control" required>
					<option value="Pipe Dwelling">Pipe Dwelling</option>
					<option value="Pipe Inside Yard">Pipe Inside Yard</option>
					<option value="Community Standpipe">Community Standpipe</option>
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label for="toilet-facility" class="col-md-4 col-form-label text-md-right">Toilet Facility</label>
			<div class="col-md-6">
				<select id="toilet-facility" type="text" name="toilet-facility" class="form-control" required>
					<option value="Flush Toilet">Flush Toilet</option>
					<option value="Sceptic Tank">Sceptic Tank</option>
					<option value="Pit Latrine">Pit Latrine</option>
					<option value="Other">Other</option>
				</select>
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