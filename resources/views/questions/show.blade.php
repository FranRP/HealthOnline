@extends('layout')

@section('contenido')

<header class="masthead question-header text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              <strong>Consulta de {{$question->user->name}}</strong>
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

<div class="container primer-bloque" style="margin-top:15px !important">

	<h1>Pregunta: {{$question->title}}</h1>

  <div class="alert alert-success alert-report-question" style="margin:15px 0px; display:none;" role="alert">
      <strong>{{session('info')}}</strong>
  </div>


	<p class="body-question">{{$question->body}}</p>

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
  <button class="btn btn btn-success editar-question">Editar</button>



  @endif
  @if (auth()->user()->id != $question->user_id || auth()->user()->hasRoles(['admin']))
  <button class="btn btn btn-sucess reportar-question" id="{{$question->id}}">Reportar</button>
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



@if (auth()->check())
@if (auth()->user()->hasRoles(['admin','profesional','clinica']))
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



<div class="container respuestas" style="margin-top:25px !important">
  <div class="float-right">
    {!! $answers->appends(request()->query())->links() !!}
  </div>
  <h2>Respuestas:</h2>

  <div class="alert alert-success alert-report-answer" style="margin:15px 0px; display:none;" role="alert">
      <strong>{{session('info')}}</strong>
  </div>

  @foreach ($answers as $answer)
  <div  data-consulta="{{ $answer->id}}"> 
    @if ($answer->user_id && $answer->user != null)
        <h3>{{$answer->user->name}}</h3>
        <p id="{{$answer->id}}body">{{$answer->body}}</p>
    @else
        <h3 style="color:red;">Usuario elimiando</h3>
        <p>{{$answer->body}}</p>
    @endif
  
    @if (auth()->check())
    @if (auth()->user()->id == $answer->user_id || auth()->user()->hasRoles(['admin']))
    <form style="display:inline" method="POST" action="{{ route('respuestas.destroy', $answer->id) }}">
      {!! csrf_field() !!}
      {!! method_field('DELETE') !!}
      <button class="btn btn btn-danger" type="submit">Eliminar</button>
                
    </form>

    <div class="col-12" data-respuesta="{{$answer->id}}">
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
      <button type="button" class="like btn btn-primary">Like</button>
      <button type="button" class="like btn btn-secondary">Dislike</button>
      @if (auth()->user()->id == $answer->user_id || auth()->user()->hasRoles(['admin']))
        <button class="btn btn btn-success editar-answer" id="answer-{{$answer->id}}">Editar</button>
      @endif
      @if (auth()->user()->id != $answer->user_id || auth()->user()->hasRoles(['admin']))
        <button class="btn btn btn-sucess reportar-answer" id="{{$answer->id}}">Reportar</button>
      @endif
    </div>
  @endif

  </div>      
  @endforeach
</div>


@section('scriptQuestion')
  <script src="/js/likes.js"></script>
  <script src="/js/answer-question.js"></script>
@stop
@stop