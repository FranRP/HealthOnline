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
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Ver más</a>
          </div>
        </div>
      </div>
</header>

<div class="container" style="margin-top:15px !important">
		<h1>Preguntas</h1>

	<div class="row">
        <div class="col-4">
            <select id="orden-filtro" data-show-content="true" class="form-control">
                <option value="desc">Orden descendente</option>
                <option value="asc">Orden ascendente</option>
            </select>
        </div>
    </div>
	<div class="scroll-block">
		<?php $idprimera = 1 ?>
		@foreach ($questions as $question)
			<div style="padding:10px; border:1px solid black; margin-bottom:10px">
				<h3><a href="{{route('usuarios.show', $question->user->id)}}">{{$question->user->name}}</a></h3>
				<h4><a href="{{route('preguntas.show', $question->id)}}">{{$question->title}}</a></h4>
				<p>{{$question->body}}</p>
			</div>
			<?php $id = $question->id ?>
			@if ($idprimera < $id )
				<?php $idprimera = $id ?>
			@endif
		@endforeach
	</div>

	<div style="display:flex; justify-content: center" class="before">
		
		
	</div> 	
	{!! Form::open(['route' => ['preguntas.store'], 'method'=> 'POST']) !!}
	 <div class="form-group">
	  {!! Form::label('titulo' , 'Titulo:'); !!}
	  {!! Form::text('titulo' , null, ['class' =>'form-control',  'placeholder' => 'Título de la pregunta' , 'required' ]); !!}
	  <p class="alerta-titulo" style="color:red; display:none">Debes dar un título a la consulta</p>
	  {!! Form::label('pregunta' , 'Preguntar:'); !!}
	  {!! Form::text('pregunta' , null, ['class' =>'form-control',  'placeholder' => 'Formula tu consulta' , 'required' ]); !!}
	  <p class="alerta-pregunta" style="color:red; display:none">Debes formular una pregunta para los profesionales</p>
	 </div>

	<button class="btn btn-sm btn-danger btn-preguntar">Enviar pregunta</button>
	{!! Form::close() !!}

	
	@if (count($questions) != 0)
    	<div class="lastId" style="display:none" id="{{ $id }}"></div>
    	<div class="firstId" style="display:none" id="{{ $idprimera }}"></div>
    @endif
</div>



@stop
@section('scriptQuestion')
	<script src="/js/question.js"></script>
@stop