@extends('layout')


@section('contenido')

<header class="masthead users-header text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              <strong>Perfil de {{$user->name}}</strong>
            </h1>
            <hr>
          </div>
          <div class="col-lg-8 mx-auto">
            <p class="text-faded mb-5">Este perfil es personal y personalizado por su dueño</p>
            <button class="btn btn-primary btn-xl ver-mas">Ver más</button>
          </div>
        </div>
      </div>
</header>

 <section class="bg-primary primer-bloque" id="about">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading text-white">¡Consejo!</h2>
            <hr class="light my-4">
            <p class="text-faded mb-4">Todos los usuarios se merecen un respeto, no envies mensajes ni abuses de los datos que pueden proporcionar en sus perfiles.</p>
          </div>
        </div>
      </div>
</section>

<section class="personal-profile">
	<div class="container">
		<div class="card text-center">
		  <div class="card-header">
		    <img src="/uploads/{{$user->avatar}}" style="width:150px; height:150px; float:left; border-radius:50%;" alt="">
		  </div>
		  <div class="card-body">
			
			<table class="table table-profile">
				<tr>
					<th style="color:#45bbce; font-weight:bold;">Nombre</th>
					<td>{{$user->name}}</td>
				</tr>
				<tr>
					<th style="color:#45bbce; font-weight:bold;">Email</th>
					<td>{{$user->email}}</td>
				</tr>
				<tr>
					<th style="color:#45bbce; font-weight:bold;">Roles</th>
					<td>{{$user->roles->pluck('display_name')->implode(', ')}}</td>
				</tr>
				@if ($user->hasRoles(['profesional','clinica']))
				<tr>
					<th style="color:#45bbce; font-weight:bold;">Especialización</th>
					<td>{{$user->profession->display_name}}</td>
				</tr>
				@endif
				@if ($user->hasRoles(['clinica']))
				<tr>
					<th style="color:#45bbce; font-weight:bold;">Localización</th>
					<td>{{$user->city->name}}</td>
				</tr>
				@endif
			</table>

			<h5 class="card-text texto-perfil" style="color:#45bbce; font-weight:bold; margin-bottom:20px;">Últimas preguntas en las que ha participado</h5>

			@if (count($answers) == 0) 
				<p class="card-text texto-perfil text-center"> No hay registros actualmente </p>
			@endif

			<p class="texto-perfil">
			@foreach ($answers as $answer)
				-
				@if ($answer->question != null)
					<a href="{{route('preguntas.show', $answer->question->id)}}" class="card-text text-center"> {{$answer->question->title}} </a>
				@else
					<p class="card-text texto-perfil text-center" style="color:red;"> Pregunta eliminada </p>
				@endif
			@endforeach
			-
			</p>

			<h5 class="card-text texto-perfil perfil-user-title" style="color:#45bbce; font-weight:bold; margin-bottom:20px;">Perfil del usuario</h5>
			@if ($user->perfil)
		    	<p class="card-text texto-perfil text-justify"> {{$user->perfil}} </p>
		    @else
				<p class="card-text texto-perfil"> No se ha definido ninguna descripción adicional </p>
		    @endif
		  </div>
		  <div class="card-footer text-muted">
		    @can('edit', $user)
			<a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-info">Editar</a>
			@endcan
			@can('destroy', $user)
			<form style="display:inline" method="POST" action="{{ route('usuarios.destroy', $user->id) }}">
				{!! csrf_field() !!}
				{!! method_field('DELETE') !!}
				<button class="btn btn btn-danger" type="submit">Eliminar</button>
									
			</form>
			@endcan
		  </div>
		</div>

		@if (auth()->check())
		@if (auth()->user()->id != $user->id)
		<section id="contact" class="personal-mensaje">
	      <div class="container-fluid">
	        <div class="row">
	          <div class="col-lg-8 mx-auto text-center">
	            <h2 class="section-heading">Enviar mensaje</h2>
	            <hr class="my-4">
	            <p class="mb-5">Recuerda, ¡respeto ante todo!</p>
	          </div>
	        </div>
	        <div class="row">
	          <div class="col-lg-12 mr-auto text-center" style="margin-bottom:20px !important;">
	            <a style="color:black;" data-toggle="collapse" href="#mensaje-form" role="button" aria-expanded="false" aria-controls="mensaje-form"><i class="fa fa-envelope-o fa-3x mb-3 sr-contact"></i></a>
	            <div class="alert alert-success alert-mensaje-enviado-perfil" style="margin:15px 0px; display:none;" role="alert">
				     <strong>¡El mensaje se ha enviado!</strong>
				</div>
	          </div>
	          <div class="collapse multi-collapse col-lg-12" id="mensaje-form">
			      <div>
			        {!! Form::open(['route' => ['correos.store'], 'method'=> 'POST']) !!}
		           <div class="form-group formulario-mensajes">
		           	{!! Form::hidden('destinatario', $user->name) !!}
		           	{!! Form::label('asunto' , 'Asunto del mensaje', ['class' => 'asunto-danger']); !!}
		            {!! Form::text('asunto' , null, ['class' =>'form-control',  'placeholder' => 'Asunto de la pregunta' , 'required' ]); !!}
		            {!! Form::label('body' , 'Cuerpo del mensaje', ['class' => 'cuerpo-danger']); !!}
		            {!! Form::textarea('body' , null, ['size' => '30x5', 'class' =>'form-control',  'placeholder' => 'Formula tu consulta' , 'required' ]); !!}
		            <p class="alerta-body" style="color:red; display:none">El cuerpo del mensaje no puede estar vacío.</p>
		           </div>

		          <button class="btn btn-sm btn-danger btn-enviar-mensaje">Enviar mensaje</button>
		          {!! Form::close() !!}
			      </div>
			  </div>
	        </div>
	      </div>
	    </section>
	    @endif
	    @endif
		
		

		

	
		
		

	</div>
</section>

	
@stop
@section('scriptQuestion')
  <script src="/js/correos.js"></script>
@stop