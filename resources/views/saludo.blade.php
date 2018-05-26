@extends('layout')

@section('contenido')

<header class="masthead text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              <strong>Bienvenido a HealthOnline</strong>
            </h1>
            <hr>
          </div>
          <div class="col-lg-8 mx-auto">
            <p class="text-faded mb-5">Resuelve tus dudas y preocupaciones preguntando a los mejores profesionales de nuestro país sin necesidad de desplazarte.</p>
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Find Out More</a>
          </div>
        </div>
      </div>
    </header>

    
<h1>Saludos para {{ $nombre }}</h1>
	<!--{!! $html !!}
	{!! $script !!}-->
	<ul>
		<!--@foreach($consolas as $consola)
			<li>{{ $consola }} </li>
		@endforeach-->
		@forelse($consolas as $consola)
			<li>{{ $consola }} </li>
		@empty
			<p>No hay consolas :(</p>
		@endforelse
	</ul>
	@if(count($consolas) === 1)
		<p>Solo tienes una consola</p>
	@elseif(count($consolas) > 1)
		<p>Tienes varias consolas</p>
	@else 
		<p>No tienes consolas</p>
	@endif
@stop