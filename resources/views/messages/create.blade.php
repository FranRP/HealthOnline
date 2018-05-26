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
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Ver más</a>
          </div>
        </div>
      </div>
</header>

<div class="container" style="margin-top:30px !important">
	<h1> Bienvenido al contacto</h1>

	<h2>Escríbeme</h2>
	@if(session()->has('info'))
		<h3>{{ session('info')}}</h3>
	@else
	<form method="POST" action="{{ route('mensajes.store') }}">
		<!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
		{!! csrf_field() !!}
		@if (auth()->guest())
			<p>
			<label for=name>
				Nombre
				<input class="form-control" required type="text" name="name" value="{{ old('name') }}">
				{!! $errors->first('name', '<span class=error>:message</span>')!!}
			</label>
			</p>
			<p>
				<label for=email>
					Email
					<input class="form-control" required type="email" name="email" value="{{ old('email') }}">
					{!! $errors->first('email','<span class=error>:message</span>')!!}
				</label>
		    </p>
		@endif
		
		<p>
		<label for=mensaje>
			Mensaje
			<textarea class="form-control" required name="mensaje">{{old('mensaje')}}</textarea>
			{!! $errors->first('mensaje','<span class=error>:message</span>')!!}
		</label>
		</p>

		<input class="btn btn-primary" type="submit" value="Enviar">
	</form>
</div>
@endif

@stop