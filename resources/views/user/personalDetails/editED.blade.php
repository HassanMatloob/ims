@extends('user.layout.default')

@section('content')
	<form class="mt-4" method="POST" action="{{route('user.personalDetails.update', ['id' => $indigent->id])}}">
		
	</form>
@endsection