
@extends('layout')

@section('contenido')

<header class="masthead message-support-header text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              <strong>¡Bienvenido!</strong>
            </h1>
            <hr>
          </div>
          <div class="col-lg-8 mx-auto">
            <p class="text-faded mb-5">Recuerda revisar con frecuencia tu bandeja de correo personal</p>
            <button class="btn btn-primary btn-xl ver-mas">Ver más</button>
          </div>
        </div>
      </div>
</header>

<section class="bg-primary primer-bloque" id="about">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading text-white">¿Has olvidado tu correo o contraseña?</h2>
            <hr class="light my-4">
            <p class="text-faded mb-4">Si tienes algún problema con el login de tu usuario, ponte en contacto con soporte desde su correspondiente sección. Los administradores nos encargaremos de resolver tus problemas lo antes posible.</p>
          </div>
        </div>
      </div>
</section>

<div class="limiter">
    <div class="container-login">
      <div class="wrap-login">
        <div class="login-form-title">
          <span class="login-form-title-1">
            Conectarse
          </span>
          <p class="mt-4 mb-0 text-white text-center">¡Si no has creado tu cuenta previamente no dudes en hacerlo ya desde la sección de registro!</p>

        </div>

        <form class="login-form" method="POST" action="/login">
          {!! csrf_field() !!}
          <div class="wrap-input-login validate-input m-b-26">
            <span class="label-input-login"><i style="color:#345562;" class="fa fa-envelope"></i></span>
            <input class="input-login" type="email" name="email" required placeholder="Introduce tu correo">
            <span class="focus-input-login"></span>
            {!! $errors->first('email', '<span class=error>Ha ocurrido algún error, comprueba el email y contraseña.</span>')!!}
          </div>

          <div class="wrap-input-login m-b-18">
            <span class="label-input-login"><i style="color:#345562;" class="fa fa-lock"></i></span>
            <input class="input-login" type="password" name="password" required placeholder="Introduce tu contraseña">
            <span class="focus-input-login"></span>
            {!! $errors->first('password', '<span class=error>Debes indicar la contraseña correcta para este usuario</span>')!!}
          </div>

          <div class="container-login-form-btn">
            <button class="btn btn-info float-right" type="submit">
              Login
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

@stop