@extends('layout')

@section('contenido')

<header class="masthead question-header text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              @if ($question->user_id && $question->user != null)
                <strong>Consulta de {{$question->user->name}}</strong>
              @else 
                <strong>Consulta de un Usuario Eliminado</strong>
              @endif
            </h1>
            <hr>
          </div>
          <div class="col-lg-8 mx-auto">
            <p class="text-faded mb-5">Pregunta: {{$question->title}}</p>
            <button class="btn btn-primary btn-xl ver-mas">Ver más</button>
          </div>
        </div>
      </div>
</header>

<section class="bg-primary primer-bloque" id="about">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading text-white">Recuerda respetar lo siguiente:</h2>
            <hr class="light my-4">
            <p class="text-faded mb-4">Intenta respetar siempre las preguntas de los usuarios. Todo el mundo tiene derecho a preguntar y ser respondido siempre con educación, si crees que la pregunta está fuera de lugar no dudes en reportar y nosostros nos ocuparemos. Como usuario, valora positivamente las respuestas que tu consideres útiles, los profesionales te lo agradecerán.</p>
          </div>
        </div>
      </div>
</section>

<div class="container primer-bloque" style="margin-top:45px !important; margin-bottom:25px !important;">

  <div>
    @if ($question->user_id && $question->user != null)
      <img src="/uploads/{{$question->user->avatar}}" style="width:64px; margin-right: 15px; height:64px; float:left; border-radius:50%;" alt="">
    @else
      <img src="/uploads/default_avatar.png" style="width:64px; margin-right: 15px; height:64px; float:left; border-radius:50%;" alt="">
    @endif
    <div>
      @if ($question->user_id && $question->user != null)
        <h2 class="question-title"><span><a href="{{route('usuarios.show', $question->user->id)}}">{{$question->user->name}} </a>&nbsp;- {{$question->title}}</span></h2>
      @else
        <h2 class="question-title"><span style="color:red;">Usuario eliminado &nbsp;</span> - {{$question->title}}</h2>
      @endif
      <div class="alert alert-success alert-report-question" style="margin:15px 0px; display:none;" role="alert">
          <strong>{{session('info')}}</strong>
      </div>

      <p class="body-question">{{$question->body}}</p>
    </div>
  </div>
	

  

	

  <div class="container" style="margin:15px 0px;">
    <div class="alert alert-info alert-fallo-edit" style="display:none;" role="alert">
      <strong></strong>
    </div>
  </div>

  <div class="question-edit col-12" style="display:none; margin:20px 0px;">
    {!! Form::open(['route' => ['preguntas.update',$question->id], 'method'=> 'POST']) !!}
      <p class="alerta-editar" style="color:red; display:none">No puedes dejar el campo vacío</p>
    {!! Form::textarea('pregunta' , $question->body, ['size' => '30x5', 'class' =>'form-control', 'id' => 'pregunta',  'placeholder' => 'Formula tu consulta' , 'required' ]); !!}
      

      <button style="margin:15px 0px;" class="btn btn-guardar" id="{{$question->user_id}}">Guardar</button>
    {!! Form::close() !!}
  </div>
  

  @if (auth()->check())
  @if (auth()->user()->id == $question->user_id || auth()->user()->hasRoles(['admin']))
  <form style="display:inline" method="POST" action="{{ route('preguntas.destroy', $question->id) }}">
    {!! csrf_field() !!}
    {!! method_field('DELETE') !!}
    <button class="btn btn btn-danger" type="submit">Eliminar</button>
              
  </form>

  @if ($question->status != 'cerrado')
    <form style="display:inline" method="GET" action="{{ route('preguntas.edit', $question->id) }}">
        {!! csrf_field() !!}
        <button class="btn btn btn-info" type="submit">Cerrar</button>
                
    </form>
  @endif

  @if ($question->user_id && $question->user != null)
    <button class="btn btn btn-success editar-question">Editar</button>

    
  @endif



  @endif
  @if (auth()->user()->id != $question->user_id || auth()->user()->hasRoles(['admin']))
  <button class="btn btn btn-warning reportar-question" id="{{$question->id}}">Reportar</button>
  @endif
  @endif

</div>

<div class="container" style="margin-top:15px; margin-bottom:15px;">
  <div class="alert alert-danger" style="display:none;" role="alert">
    <strong></strong>
  </div>
  @if (session()->has('info'))
    <div class="alert alert-success" role="alert">
      <strong>{{session('info')}}</strong>
    </div>
    
  @endif
</div>


@if ($question->status != 'cerrado')
@if (auth()->check())
@if (auth()->user()->hasRoles(['admin','profesional','clinica']) || auth()->user()->id == $question->user_id)
<div class="container" style="margin-top:25px !important; margin-bottom:25px !important;">
  {!! Form::open(['route' => ['respuestas.store'], 'method'=> 'POST']) !!}
     <div class="form-group">
      {!! Form::hidden('questionId', $question->id); !!}
      {!! Form::label('respuesta' , 'Responder:'); !!}
      {!! Form::text('respuesta' , null, ['class' =>'form-control respuesta-consulta',  'placeholder' => 'Formula tu respuesta' , 'required' ]); !!}
      <p class="alerta-respuesta" style="color:red; display:none">¡Debes enviar una respuesta!</p>
     </div>

    <button class="btn btn-sm btn-danger btn-responder">Enviar respuesta</button>
  {!! Form::close() !!}
</div>
@endif
@endif
@else

<div class="container">
  <div class="alert alert-warning text-center" style="margin:15px;" role="alert">
      <strong>Esta consulta ha sido cerrada por el usuario que la realizó o un administrador</strong>
  </div>
</div>

@endif



<div class="container respuestas" style="margin-top:25px !important">
  <div class="float-right">
    {!! $answers->appends(request()->query())->links() !!}
  </div>
  <h2 class="question-title">Respuestas</h2>

  <div class="alert alert-success alert-report-answer" style="margin:15px 0px; display:none;" role="alert">
      <strong>{{session('info')}}</strong>
  </div>
  <div class="container" style="margin:15px 0px;">
    <div class="alert alert-info alert-fallo-answer-edit" style="display:none;" role="alert">
      <strong></strong>
    </div>
  </div>

  @if (count($answers) == 0)
    <p style="font-style:italic; text-align: center;">No hay respuestas actualmente</p>
  @endif

  @foreach ($answers as $answer)
  <div class="respuestas-ind" data-consulta="{{ $answer->id}}"> 
    @if ($answer->user_id && $answer->user != null)
        <img src="/uploads/{{$answer->user->avatar}}" style="width:64px; margin-right: 15px; height:64px; float:left;" alt="">
        <div>
          <h3><a href="{{route('usuarios.show', $answer->user->id)}}">{{$answer->user->name}}</a></h3>
          <p class="answer-body-style" id="{{$answer->id}}body">{{$answer->body}}</p>
        </div>
        
    @else
        <img src="/uploads/default_avatar.png" style="width:54px; margin-right: 15px; height:64px; float:left;" alt="">
        <div>
          <h3 style="color:red;">Usuario elimiando</h3>
          <p class="answer-body-style">{{$answer->body}}</p>
        </div>
        
    @endif
  
    @if (auth()->check())
    @if (auth()->user()->id == $answer->user_id || auth()->user()->hasRoles(['admin']))
    <form style="display:inline;" method="POST" action="{{ route('respuestas.destroy', $answer->id) }}">
      {!! csrf_field() !!}
      {!! method_field('DELETE') !!}
      <button class="btn btn btn-danger" type="submit">Eliminar</button>
                
    </form>

    <div class="col-12" data-respuesta="{{$answer->id}}" style="margin-top:15px;">
      <div class="col-12" style="display:none; margin:20px 0px;" id="answer-{{$answer->id}}">
        {!! Form::open(['route' => ['respuestas.update',$answer->id], 'method'=> 'POST']) !!}
          <p class="alerta-editar-answer" style="color:red; display:none">No puedes dejar el campo vacío</p>
        {!! Form::textarea('respuesta' , $answer->body, ['size' => '30x5', 'class' =>'form-control', 'id' => 'respuesta-'.$answer->id,  'placeholder' => 'Formula tu consulta' , 'required' ]); !!}

          <button style="margin:15px 0px;" class="btn btn-guardar-answer" id="{{$answer->user_id}}">Guardar</button>
        {!! Form::close() !!}
      </div>
    </div>
    
    @endif
    @endif


  @if (auth()->check())
    <div>
      @if ($answer->user_id && $answer->user != null)
      @if (Auth::user()->likes()->where('answer_id',$answer->id)->first())
        @if (Auth::user()->likes()->where('answer_id',$answer->id)->first()->like == 1)
          <i class="fa fa-thumbs-up like iconos-likes-true answer-like-true-{{$answer->id}}" style="color:#45bbce;"></i>
          <i class="fa fa-thumbs-down like iconos-likes-false answer-like-false-{{$answer->id}}"></i>
        @else
          <i class="fa fa-thumbs-up like iconos-likes-true answer-like-true-{{$answer->id}}"></i>
          <i class="fa fa-thumbs-down like iconos-likes-false answer-like-false-{{$answer->id}}" style="color:red;"></i>
        @endif
      @else 
          <i class="fa fa-thumbs-up like iconos-likes-true answer-like-true-{{$answer->id}}"></i>
          <i class="fa fa-thumbs-down like iconos-likes-false answer-like-false-{{$answer->id}}"></i>
      @endif
      @endif
      @if (auth()->user()->id == $answer->user_id || auth()->user()->hasRoles(['admin']))
      @if ($answer->user_id && $answer->user != null)
        <button class="btn btn btn-success editar-answer" id="answer-{{$answer->id}}">Editar</button>
      @endif
      @endif
      @if (auth()->user()->id != $answer->user_id || auth()->user()->hasRoles(['admin']))
        <button class="btn btn btn-warning reportar-answer" id="{{$answer->id}}">Reportar</button>
      @endif
    </div>
  @endif
  <hr>
  </div>
     
  @endforeach
</div>


@section('scriptQuestion')
  <script src="/js/likes.js"></script>
  <script src="/js/answer-question.js"></script>
@stop
@stop