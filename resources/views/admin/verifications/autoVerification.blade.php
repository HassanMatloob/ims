@extends('admin.layout.default')

@section('content')
<div class="container-fluid">
	<form name="contactUsForm" id="contactUsForm" method="POST" action="/admin/indigencies/verifyIdnum">
		@csrf
		<div class="form-group row">
			<label for="idnum" class="col-md-4 col-form-label text-md-right">ID number to verify</label>
			<div class="col-md-6">
				<input id="idnum" type="text" class="form-control" name="id_number" value="{{$indigent->id_number}}" required />
			</div>
		</div>

		<div class="form-group row mb-0">
			<div class="col-md-6 offset-md-4">
				<input type="submit" class="btn btn-primary" id="submit" value="VERIFY ID" />
			</div>
		</div>
	</form>

	<!-- <h1 class="heading">The info</h1> -->
		<div class="queryRes">
			<p id="resStatus"></p>
			<p id="inputInfo"></p>
			<p id="body-of-work-1"></p>
			<p id="body-of-work-2"></p>
			<p id="body-of-work-3"></p>

			<p id="body-of-work-4"></p>

			<p id="body-of-work-5"></p>
		</div>

	<script type="text/javascript">
		// let canvas1 = document.getElementById('resStatus');
		// let canvas2 = document.getElementById('inputInfo');
		// let canvas3 = document.getElementById("body-of-work-1");
		// let canvas4 = document.getElementById("body-of-work-2");
		// let canvas5 = document.getElementById("body-of-work-3");
		// let canvas6 = document.getElementById("body-of-work-4");
		// let canvas7 = document.getElementById("body-of-work-5");
		// let data;


		// const checkID = new XMLHttpRequest();

		// checkID.onreadystatechange = function(){
		// 	if (this.readyState == 4 && this.status == 200) {

		// 		data = JSON.parse(this.response);
		// 		console.log(data);
		// 		canvas1.innerHTML = "STATUS: " + data["0"].Status;
		// 		canvas2.innerHTML = "ID NUMBER: " + data["0"].Express_Score.idNumber;
		// 		canvas3.innerHTML = "This is a " + data["1"].Super_Trace.CC_RESULTS.EnqCC_DMATCHES[0].STATUS + " South African I.D number which belongs to " + data["1"].Super_Trace.CC_RESULTS.EnqCC_DMATCHES[0].NAME + " " + data["1"].Super_Trace.CC_RESULTS.EnqCC_DMATCHES[0].SURNAME;

		// 		data["1"].Super_Trace.CC_RESULTS.EnqCC_DMATCHES[0].DECEASED_DATE == "" ? canvas4.innerHTML = "This person is still alive" : canvas4.innerHTML = "This person died on " + data["1"].Super_Trace.CC_RESULTS.EnqCC_DMATCHES[0].DECEASED_DATE;
				
		// 		canvas6.innerHTML = data["1"].Super_Trace.CC_RESULTS.EnqCC_Deeds_DATA.PROPERTIES[0].PROPERTY_TYPE + " " + data["1"].Super_Trace.CC_RESULTS.EnqCC_Deeds_DATA.PROPERTIES[0].TOWNSHIP;
		// 	}

		// }

		// checkID.open("GET", "admin/indigencies/verifyIdnum");
		// checkID.send();
		


		// const checkID = new XMLHttpRequest();

		// checkID.onreadystatechange = function(){
		// 	if (this.readyState == 4 && this.status == 200) {

		// 		data = JSON.parse(this.response);
		// 		console.log(data);
		// 		canvas1.innerHTML = "STATUS: " + data["0"].Status;
		// 		canvas2.innerHTML = "ID NUMBER: " + data["0"].Express_Score.idNumber;
		// 		canvas3.innerHTML = "This is a " + data["1"].Super_Trace.CC_RESULTS.EnqCC_DMATCHES[0].STATUS + " South African I.D number which belongs to " + data["1"].Super_Trace.CC_RESULTS.EnqCC_DMATCHES[0].NAME + " " + data["1"].Super_Trace.CC_RESULTS.EnqCC_DMATCHES[0].SURNAME;

		// 		data["1"].Super_Trace.CC_RESULTS.EnqCC_DMATCHES[0].DECEASED_DATE == "" ? canvas4.innerHTML = "This person is still alive" : canvas4.innerHTML = "This person died on " + data["1"].Super_Trace.CC_RESULTS.EnqCC_DMATCHES[0].DECEASED_DATE;
				
		// 		canvas6.innerHTML = data["1"].Super_Trace.CC_RESULTS.EnqCC_Deeds_DATA.PROPERTIES[0].PROPERTY_TYPE + " " + data["1"].Super_Trace.CC_RESULTS.EnqCC_Deeds_DATA.PROPERTIES[0].TOWNSHIP;
		// 	}

		// }

		// checkID.open("POST", "admin/indigencies/verifyIdnum");
		// checkID.send();

	</script>
</div>
@endsection