@extends('layout')

@section('contenido')
<h1> Bienvenido al contacto</h1>

<h2>Escríbeme</h2>
@if(session()->has('info'))
	<h3>{{ session('info')}}</h3>
@else
<form method="POST" action="contacto">
	<!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
	{!! csrf_field() !!}
	<p>
		<label for=nombre>
			Nombre
			<input type="text" required name="nombre" value="{{ old('nombre') }}">
		</label>
	</p>
	<p>
		<label for=correo>
			Email
			<input type="text" required name="correo" value="{{ old('correo') }}">
		</label>
    </p>
	<p>
	<label for=mensaje>
		Mensaje
		<textarea required name="mensaje">{{old('mensaje')}}</textarea>
	</label>
	</p>

	<input type="submit" value="Enviar">
</form>
@endif

@stop