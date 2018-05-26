@extends('layout')

@section('contenido')
	<h1>Registrarse en HealhOnline</h1>



	<form class="form-usuario" method="POST" action="{{route('usuarios.store')}}">
		{!! csrf_field() !!}

		@foreach ($roles as $id => $name)
			@if ($name != 'Administrador')
				<div class="form-check form-check-inline">
	  				<input class="form-check-input" type="radio" name="rolelegido" id="check-{{$name}}" value="{{$id}}" {{old('rolelegido') == $id ? 'checked' : ''}}>
	  				<label class="form-check-label" for="rol-elegido">{{$name}}</label>
	  			</div>
			@endif
		@endforeach


		<br>
			<p>
				<label for="name">
					Nombre
					<input class="form-control" type="text" name="name" required>
					{!! $errors->first('name', '<span class=error>:message</span>')!!}
				</label>
				&nbsp;&nbsp;&nbsp;
				<label for="email">
					Email
					<input class="form-control" type="email" name="email" value="" required>
					{!! $errors->first('email', '<span class=error>:message</span>')!!}
				</label>
			</p>
				<div class="form-group profesion-form">
				    <label for="profesion">¿Cuál es tu especialidad?</label>
				    <select class="form-control" id="espec" name="profesion">
				      @foreach ($profession as $id => $name)
				      	<option value="{{$id}}">{{$name}}</option>
					  @endforeach
				    </select>
				    {!! $errors->first('profesion', '<span class=error>Selecciona tu especialidad como profesional</span>')!!}
				</div>
				<div class="form-group localizacion-form">
				    <label for="localizacion">¿En qué ciudad está la clínica?</label>
				    <select class="form-control" id="localizacion" name="localizacion">
				      @foreach ($city as $id => $name)
				      	<option value="{{$id}}">{{$name}}</option>
					  @endforeach
				    </select>
				    {!! $errors->first('localizacion', '<span class=error>Debes indicar la localidad de clínica</span>')!!}
				</div>
			<p>
				<label for="password">
					Password
					<input class="form-control" type="password" name="password" value="" required>
					{!! $errors->first('password', '<span class=error>:message</span>')!!}
				</label>
				&nbsp;&nbsp;&nbsp;
				<label for="password_confirmation">
					Password confirmation
					<input class="form-control" type="password" name="password_confirmation" value="" required>
					{!! $errors->first('password_confirmation', '<span class=error>:message</span>')!!}
				</label>
			</p>
		    
		    <br>
			<input class="btn btn-primary" type="submit" value="Guardar">
	</form>
@stop