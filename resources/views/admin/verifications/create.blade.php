@extends("admin.layout.default")

@section("content")
	<div class="container-fluid">
		<form method="POST" action="{{ route('admin.verifications.store') }}">
		@csrf
		<div class="form-group row">
			<label for="water-main" class="col-md-4 col-form-label text-md-right">Verdict</label>
			<div class="col-md-6">
				<select id="verdict" type="text" name="approval" class="form-control" required>
					<option value="Approved">Verify</option>
					<option value="Rejected">Unverify</option>
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

		<input type="hidden" name="indigent_id" value="{{$indigent->id}}" readonly />		

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