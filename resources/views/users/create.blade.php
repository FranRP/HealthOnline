@extends('layout')

@section('contenido')

<header class="masthead question-header text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              <strong>Registro en HealthOnline</strong>
            </h1>
            <hr>
          </div>
          <div class="col-lg-8 mx-auto">
            <p class="text-faded mb-5"></p>
            <a class="btn btn-primary btn-xl ver-mas">Ver más</a>
          </div>
        </div>
      </div>
</header>

<section class="bg-dark text-white primer-bloque mb-5" style="border-top: 2px solid #d1ecf1;">
      <div class="container text-center">
        <h2 class="mb-4">Consejo</h2>
        <p class="mb-0">Procura registrarte con una dirección de correo válida. No es necesaria la confirmación, pero en caso de problemas con la cuenta o tener la necesidad de ponerte en contacto más directo con un profesional u otro usuario vía correo, la dirección de correo deberá ser válida.</p>
      </div>
</section>

<div class="limiter">
    <div class="container-login">
      <div class="wrap-login">
        <div class="login-form-title">
          <span class="login-form-title-1">
            Registrarse
          </span>
          <p class="mt-4 mb-0 text-white text-center">En HealthOnline buscamos ayudar tanto a usuarios, como a los profesionales y clínicas que contribuyan en las consultas.</p>

        </div>

        @if (session()->has('info'))
			    <div class="alert alert-danger m-5 text-center" style="margin-bottom:20px; margin-top:10px;" role="alert">
			      <strong>{{session('info')}}</strong>
			    </div>
			    
		    @endif

        <form class="login-form form-usuario" method="POST" action="{{route('usuarios.store')}}">
          {!! csrf_field() !!}

          @foreach ($roles as $id => $name)
					@if ($name != 'Administrador')
						<div class="form-check form-check-inline roles-registro">
			  				<input class="form-check-input" type="radio" required name="rolelegido" id="check-{{$name}}" value="{{$id}}" {{old('rolelegido') == $id ? 'checked' : ''}}>
			  				<label class="form-check-label label-checkbox" for="rol-elegido">{{$name}}</label>
			  		</div>
					@endif
		      @endforeach
			
		  <div class="wrap-input-login mb-4">
            <span class="label-input-login"><i style="color:#345562;" class="fa fa-user"></i></span>
            <input class="input-login" type="name" name="name" required maxlength="25" placeholder="Introduce tu nombre">
            <span class="focus-input-login"></span>
            {!! $errors->first('name', '<span class=error>Este :message</span>')!!}
          </div>

          <div class="wrap-input-login mb-4">
            <span class="label-input-login"><i style="color:#345562;" class="fa fa-envelope"></i></span>
            <input class="input-login" type="email" name="email" required maxlength="28" placeholder="Introduce tu correo">
            <span class="focus-input-login"></span>
            {!! $errors->first('email', '<span class=error>:message</span>')!!}
          </div>

          <div class="wrap-input-login mb-4 profesion-form">
            <span class="label-input-login"><i style="color:#345562;" class="fa fa-briefcase"></i></span>
            <select class="form-control input-login" id="espec" name="profesion">
					@foreach ($profession as $id => $name)
						<option value="{{$id}}">{{$name}}</option>
					@endforeach
			</select>
			<span class="focus-input-login"></span>
			{!! $errors->first('profesion', '<span class=error>Selecciona tu especialidad como profesional</span>')!!}
          </div>

          <div class="wrap-input-login mb-4 localizacion-form">
            <span class="label-input-login"><i style="color:#345562;" class="fa fa-map"></i></span>
            <select class="form-control input-login" id="localizacion" name="localizacion">
					@foreach ($city as $id => $name)
						<option value="{{$id}}">{{$name}}</option>
					@endforeach
			</select>
			<span class="focus-input-login"></span>
			{!! $errors->first('localizacion', '<span class=error>Debes indicar la localidad de clínica</span>')!!}
          </div>

          <div class="wrap-input-login mb-5">
            <span class="label-input-login"><i style="color:#345562;" class="fa fa-lock"></i></span>
            <input class="input-login" type="password" name="password" required placeholder="Introduce tu contraseña">
            {!! $errors->first('password', '<span class=error>:message</span>')!!}
            <input class="input-login" type="password" name="password_confirmation" required placeholder="Repite la contraseña">
            {!! $errors->first('password_confirmation', '<span class=error>:message</span>')!!}
			<span class="focus-input-login"></span>
          </div>

          <div class="container-login-form-btn">
            <button class="btn btn-info float-left" type="submit">
              Registrarse
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>


	
@stop