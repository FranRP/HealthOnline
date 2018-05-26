<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mensaje recibido</title>
</head>
<body>
	
	<h1>Te responderemos lo antes posible</h1>
	<table class="table table-inverse">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Email</th>
				<th>Mensaje</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>{{$msg->name}}</td>
				<td>{{$msg->email}}</td>
				<td>{{$msg->mensaje}}</td>
			</tr>
		</tbody>
	</table>

</body>
</html>