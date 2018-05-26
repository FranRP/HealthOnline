@extends('layout')

@section('contenido')
	<h1>Editar mensaje de {{$message->nombre}}</h1>


<header class="masthead admin-header text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              <strong>Zona de administración</strong>
            </h1>
            <hr>
          </div>
          <div class="col-lg-8 mx-auto">
            <p class="text-faded mb-5">Administración de mensajes - Editar</p>
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Ver más</a>
          </div>
        </div>
      </div>
</header>
	
<div class="container" style="margin-top:30px !important">

	<form method="POST" action="{{ route('mensajes.update', $message->id) }}">
		<!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
		{!! method_field('PUT') !!}
		{!! csrf_field() !!}
		<p>
			<label for=nombre>
				Nombre
				<input class="form-control" required type="text" name="nombre" value="{{ $message->nombre }}">
				{!! $errors->first('nombre', '<span class=error>:message</span>')!!}
			</label>
		</p>
		<p>
			<label for=email>
				Email
				<input class="form-control" required type="text" name="correo" value="{{ $message->correo }}">
				{!! $errors->first('email','<span class=error>:message</span>')!!}
			</label>
	    </p>
		<p>
		<label for=mensaje>
			Mensaje
			<textarea class="form-control" required name="mensaje">{{$message->mensaje}}</textarea>
			{!! $errors->first('mensaje','<span class=error>:message</span>')!!}
		</label>
		</p>

		<input class="btn btn-primary" type="submit" value="Enviar">
	</form>
</div>
@stop