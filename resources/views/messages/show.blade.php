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
            <a class="btn btn-primary btn-xl ver-mas">Ver más</a>
          </div>
        </div>
      </div>
</header>

<div class="container primer-bloque">

  <section id="contact">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            @if ($message->user_id && $message->user != null)
              <h2 class="section-heading">Mensaje de {{$message->user->name}}</h2>
              <hr class="my-4">
              <p class="mb-5">Correo <em>{{$message->user->email}}</em></p>
            @else
              <h2 class="section-heading">Mensaje de {{$message->name}}</h2>
              <hr class="my-4">
              <p class="mb-5">Correo <em>{{$message->email}}</em></p>
            @endif
            
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 ml-auto text-center">
            <p>{{$message->mensaje}}</p>
          </div>
          <div class="col-lg-12 ml-auto text-center">
            <a class="btn btn-info" role="button" href="<?php echo route('mensajes.index')?>">Volver</a>
          </div>
        </div>
      </div>
    </section>


</div>

@stop