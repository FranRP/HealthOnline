@extends('layout')

@section('contenido')

<header class="masthead question-header text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              <strong>Nuestros profesionales</strong>
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

<section class="bg-dark text-white primer-bloque" style="border-top: 2px solid #d1ecf1;">
      <div class="container text-center">
        <h2 class="mb-4">Consejo</h2>
        <p class="mb-0">Los profesionales están ordenados por la diferencia entre likes y dislikes recibidos. Esto es algo a tener en cuenta pero no debe ser la única referencia para los usuarios. Dad una oportunidad y confiad en aquellos que os intentan ayudar.</p>
      </div>
</section>

<div class="container profesionales-section" style="margin-top:50px;">
	{!! $users->appends(request()->query())->links() !!}

	<div class="card-columns lista-profesionales">

@foreach ($users as $user)

		<div class="card">
			<a class="enlace-profesional" href="{{route('usuarios.show', $user->id)}}">
			<div class="bloque-card">
				<div class="imagen-profesionales">
				<img alt="Card image cap" class="card-img-top img-fluid"  src="/uploads/{{$user->avatar}}" style="width:150px; height:150px; float:left; margin-right: 20px;">	
				</div>
				
				<div class="card-block tarjetas-profesionales">
					<h4 class="card-title">{{$user->name}}</h4>
					<h5 class="card-text">{{$user->profession->display_name}}</h5>
					@if ($user->likes >= 0)
						<p class="card-text"><i class="fa fa-thumbs-up" style="color:#1aca1a;"></i> {{$user->likes}} likes</p>
					@else
						<p class="card-text"><i class="fa fa-thumbs-down" style="color:red;"></i> {{$user->likes}} likes</p>
					@endif

				</div>
			</div>
			</a>
			
			<div class="card-footer text-muted">
			    <p class="card-text">Ha participado con {{count($user->answers)}} respuestas</p>
			</div>
		</div>

@endforeach

	</div>
</div>


@stop