<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mensaje recibido</title>
</head>
<body>
	
	<h3>¡Gracias por ponerte en contacto con nosotros!</h3>
	<p>Mensaje enviado por: {{$msg->name}}</p>
	<p>Correo: {{$msg->email}}</p>
	<p>Mensaje: {{$msg->mensaje}}</p>
	<br>
	<p>Si estos no son tus datos, porfavor, ignora este mensaje. Si eres el dueño, ¡no dudes en que te responderemos lo antes posible!</p>

</body>
</html>