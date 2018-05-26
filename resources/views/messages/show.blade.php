@extends('layout')

@section('contenido')

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
            <p class="text-faded mb-5">Administración de mensajes - Ver</p>
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Ver más</a>
          </div>
        </div>
      </div>
</header>

<div class="container" style="margin-top:30px !important">

	<h1>Mensaje</h1>

	@if ($message->user_id)
		<p>Enviado por {{ $message->user->name}} - {{$message->user->email}}</p>
	@else 
		<p>Enviado por {{ $message->name}} - {{$message->email}}</p>
	@endif
	<p>{{$message->mensaje}}</p>

</div>

@stop