@extends('layout')

@section('contenido')

<header class="masthead question-header text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              <strong>Consulta online</strong>
            </h1>
            <hr>
          </div>
          <div class="col-lg-8 mx-auto">
            <p class="text-faded mb-5">¡Haz tus preguntas o resuelve las del resto de usuarios sin temor alguno!</p>
            <a class="btn btn-primary btn-xl ver-mas">Ver más</a>
          </div>
        </div>
      </div>
</header>

@if (auth()->check())
<div id="slideout">
		<h4 class="alterna" style="transform: rotate(-91deg); white-space: nowrap;">Nueva consulta</h4>
        
        <div id="slideout_inner">
            {!! Form::open(['route' => ['preguntas.store'], 'method'=> 'POST']) !!}
			 <div class="form-group formulario-consulta-desktop">
			  {!! Form::label('titulo' , 'Titulo'); !!}
			  {!! Form::text('titulo' , null, ['class' =>'form-control titulo-slide',  'placeholder' => 'Título de la pregunta' , 'required' ]); !!}
			  
			  {!! Form::label('pregunta' , 'Preguntar'); !!}
			  {!! Form::text('pregunta' , null, ['class' =>'form-control pregunta-slide',  'placeholder' => 'Formula tu consulta' , 'required' ]); !!}
			  
			 </div>

			<button class="btn btn-sm btn-danger btn-preguntar">Enviar pregunta</button>
			{!! Form::close() !!}
        </div>
</div>
@endif
<section class="bg-dark text-white primer-bloque" style="border-top: 2px solid #d1ecf1;">
      <div class="container text-center">
        <h2 class="mb-4">Normas</h2>
        <p class="mb-0">Cada usuario es libre de realizar toda consulta sin pudor alguno, sin embargo, toda pregunta debe procurar no faltar el respeto al resto de usuarios. Si te sientes ofendido ante la respuesta o consulta de algún usuario, puedes reportarlas individualmente.</p>
      </div>
    </section>

<div class="container">

	<section id="contact" style="padding:3rem !important;">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading">Formula tu consulta</h2>
            <hr class="my-4">
            <p class="mb-5">Puedes filtrar el orden de las consultas</p>
            <select id="orden-filtro" data-show-content="true" class="form-control custom-select" style="width:50%;">
                <option value="desc">Orden descendente</option>
                <option value="asc">Orden ascendente</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 ml-auto text-center">
            
          </div>
        </div>
      </div>
    </section>

	@if (auth()->check())
    <div class="row consulta-movil">
    	<div class="col-12">
    		{!! Form::open(['route' => ['preguntas.store'], 'method'=> 'POST']) !!}
			 <div class="form-group formulario-consulta-movil">
			  {!! Form::label('titulo' , 'Titulo'); !!}
			  {!! Form::text('titulo' , null, ['class' =>'form-control titulo-normal',  'placeholder' => 'Título de la pregunta' , 'required' ]); !!}
			  
			  {!! Form::label('pregunta' , 'Preguntar'); !!}
			  {!! Form::text('pregunta' , null, ['class' =>'form-control pregunta-normal',  'placeholder' => 'Formula tu consulta' , 'required' ]); !!}
			  
			 </div>

			<button class="btn btn-sm btn-danger btn-preguntar">Enviar pregunta</button>
			{!! Form::close() !!}
    	</div>
    </div>
    @endif

	<div class="scroll-block container-fluid">
		<?php $idprimera = 1 ?>
		@foreach ($questions as $question)
		  <div class="container-consultas">
			<div class="consulta-ind-img">
				@if ($question->user_id && $question->user != null)
				<img src="/uploads/{{$question->user->avatar}}" style="width:60px; margin-right: 15px; height:64px; float:left; border-radius:50%;" alt="">
				@else
				<img src="/uploads/default_avatar.png" style="width:60px; margin-right: 15px; height:64px; float:left; border-radius:50%;" alt="">
				@endif
			</div>

		  	<div class="consulta-ind">
		  		@if ($question->user_id && $question->user != null)
					<h3><a href="{{route('usuarios.show', $question->user->id)}}">{{$question->user->name}}</a></h3>
				@else
					<h3 style="color:red;">Usuario eliminado</h3>
				@endif
				<div>
					<h4><a href="{{route('preguntas.show', $question->id)}}">{{$question->title}}</a></h4>
					<p>{{$question->body}}</p>
				</div>
				
			</div>
		  	
		  </div>
			



			<?php $id = $question->id ?>
			@if ($idprimera < $id )
				<?php $idprimera = $id ?>
			@endif
		@endforeach
	</div>

	<div style="display:flex; justify-content: center" class="before">
		
		
	</div> 	
	

	
	@if (count($questions) != 0)
    	<div class="lastId" style="display:none" id="{{ $id }}"></div>
    	<div class="firstId" style="display:none" id="{{ $idprimera }}"></div>
    @else
		<div class="lastId" style="display:none" id="0"></div>
    	<div class="firstId" style="display:none" id="0"></div>
    @endif
</div>



@stop
@section('scriptQuestion')
	<script src="/js/question.js"></script>
@stop