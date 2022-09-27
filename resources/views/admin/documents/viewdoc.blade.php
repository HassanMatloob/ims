<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Document</title>
</head>
<body>
	<h1>DOCUMENT VIEW - {{$field}}</h1>
	
	{{ $filename = asset('storage/'.$indigent->id.'/'.$doc->$field) }}
	{{ $handles = fopen($filename, "r") }}
	
	{{ fclose($handles) }}
</body>
</html>