@extends('layout')

@section('contenido')

<header class="masthead message-support-header text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              <strong>Soporte de HealthOnline</strong>
            </h1>
            <hr>
          </div>
          <div class="col-lg-8 mx-auto">
            <p class="text-faded mb-5">Envía tu consulta, sugerencia o queja sin temor alguno, te responderemos lo antes posible.</p>
            <a class="btn btn-primary btn-xl ver-mas">Ver más</a>
          </div>
        </div>
      </div>
</header>

<section class="bg-primary primer-bloque" id="about">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading text-white">Bienvenido al contacto de soporte</h2>
            <hr class="light my-4">
            <p class="text-faded mb-4">Envíanos tu sugerencia, queja o duda, te responderemos por correo lo antes posible, pero recuerda mantener el respeto, aceptamos quejas, no faltas de respeto.</p>
          </div>
        </div>
      </div>
</section>

<div class="container" style="margin-top:30px !important">
	@if(session()->has('info'))
	<div class="alert alert-success" style="margin:15px 0px; text-align: center;" role="alert">
          <strong>{{session('info')}}</strong>
    </div>
   	@endif

	<form class="soporte-form" method="POST" action="{{ route('mensajes.store') }}">
		<!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
		{!! csrf_field() !!}
		@if (auth()->guest())
			<p>
			<label for="name">
				Nombre
			</label>
				<input class="form-control" required type="text" name="name" value="{{ old('name') }}" placeholder="Indica el nombre con el que dirigirnos a ti">
				{!! $errors->first('name', '<span class=error>:message</span>')!!}
			
			</p>
			<p>
				<label for="email">
					Email
				</label>
					<input class="form-control" required type="email" name="email" value="{{ old('email') }}" placeholder="El correo es necesario si no estás registrado">
					{!! $errors->first('email','<span class=error>:message</span>')!!}
				
		    </p>
		@endif
		
		<p>
		<label for="mensaje">
			Mensaje
		</label>
			<textarea class="form-control" rows="8" cols="100" required name="mensaje" placeholder="Indica la duda, sugerencia o queja de la forma más concisa posible">{{old('mensaje')}}</textarea>
			{!! $errors->first('mensaje','<span class=error>:message</span>')!!}
		
		</p>
		<p>
			<input class="btn btn-primary" type="submit" value="Enviar">
		</p>
		
	</form>
</div>


@stop