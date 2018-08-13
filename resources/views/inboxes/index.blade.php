@extends('layout')

@section('contenido')

<header class="masthead inbox-header text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              <strong>Tu bandeja de entrada personal</strong>
            </h1>
            <hr>
          </div>
          <div class="col-lg-8 mx-auto">
            <p class="text-faded mb-5">Bienvenido a tu bandeja de correo personal. Comunícate con el resto de usuarios de la web pero recuerda, siempre con respeto.</p>
            <button class="btn btn-primary btn-xl ver-mas">Ver más</button>
          </div>
        </div>
      </div>
</header>

<section class="bg-primary primer-bloque" id="about">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading text-white">Recomendación</h2>
            <hr class="light my-4">
            <p class="text-faded mb-4">Recuerda, que aunque te ofrezcamos la oportunidad de preguntar personalmente a profesionales sobre tus dudas, si ves oportuno resolver esta duda en comunidad, será mucho más útil para aquellas personas que se encuentren en la misma situación. Gracias y como siempre, el respeto por delante. </p>
          </div>
        </div>
      </div>
</section>
<div class="container-fluid correo-section">
  <ul id="tabs" class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">Mensajes enviados</a>
    </li>
    <li class="nav-item">
      <a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">Mensajes recibidos</a>
    </li>
    <li class="nav-item">
      <a id="tab-C" href="#pane-C" class="nav-link" data-toggle="tab" role="tab">Enviar mensaje</a>
    </li>
  </ul>


  <div id="content" class="tab-content" role="tablist">
    <div id="pane-A" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-A">
      <div class="card-header" role="tab" id="heading-A">
        <h5 class="mb-0">
          <a data-toggle="collapse" href="#collapse-A" data-parent="#content" aria-expanded="true" aria-controls="collapse-A">
            Mensajes enviados
          </a>
        </h5>
      </div>
      <div id="collapse-A" class="collapse show" role="tabpanel" aria-labelledby="heading-A">
        <div class="card-body mensajes-enviados">
          
          @if (count($enviados) != 0)
            @foreach ($enviados as $enviado)
              <div class="correo-ind">
                <h5>Destinatario: <a href="{{route('usuarios.show', $enviado->destId)}}">{{$enviado->destinatario}}</a></h5>
                <p>Fecha: {{$enviado->created_at}}</p>
                <p>Asunto: <a style="cursor:pointer;" class="asunto-message" data-toggle="modal" data-target="#modal{{$enviado->id}}" role="button">{{$enviado->asunto}}</a></p>
                <p><span style="font-weight: bold;">Mensaje:</span> {{$enviado->body}}</p>
                <div class="modal fade" id="modal{{$enviado->id}}">
                  <div class="modal-dialog modal-dialog-centered">
				      <div class="modal-content">
						<div class="modal-header">
				          <h4 class="modal-title">{{$enviado->asunto}}</h4>
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				        </div>
				        <div class="modal-body">
				          {{$enviado->body}}
				        </div>
				      
				      </div>
				    </div>
                </div>
                <hr style="max-width: inherit !important;">
              </div>


            @endforeach
          @else
              <div class="sin-registro">
                <p>No hay mensajes enviados</p>
              </div>
              
          @endif

          {!! $enviados->appends(request()->query())->links() !!}
        </div>
      </div>
    </div>

    <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
      <div class="card-header" role="tab" id="heading-B">
        <h5 class="mb-0">
          <a class="collapsed" data-toggle="collapse" href="#collapse-B" data-parent="#content" aria-expanded="false" aria-controls="collapse-B">
            Mensajes recibidos
          </a>
        </h5>
      </div>
      <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
        <div class="card-body mensajes-recibidos">
          
          @if (count($recibidos) != 0)
            @foreach ($recibidos as $recibido)
            <div class="correo-ind-recibidos">
            	@if ($recibido->user != null)
                	<h5>Enviado por: <a href="{{route('usuarios.show', $recibido->user_id)}}">{{$recibido->user->name}}</a></h5>
                @else
					<h5>Enviado por: <span style="color:red;">Usuario eliminado</span></h5>
                @endif
                <p>Fecha: {{$recibido->created_at}}</p>
                <p>Asunto: <a style="cursor:pointer;" class="asunto-message" data-toggle="modal" data-target="#modal{{$recibido->id}}" role="button">{{$recibido->asunto}}</a></p>
                <p><span style="font-weight: bold;">Mensaje:</span> {{$recibido->body}}</p>
                <div class="modal fade" id="modal{{$recibido->id}}">
                  <div class="modal-dialog modal-dialog-centered">
				      <div class="modal-content">
						<div class="modal-header">
				          <h4 class="modal-title">{{$recibido->asunto}}</h4>
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				        </div>
				        <div class="modal-body">
				          {{$recibido->body}}
				        </div>
				      
				      </div>
				    </div>
                </div>
                <hr style="max-width: inherit !important;">
              </div>
            @endforeach
          @else
              <div class="sin-registro">
                <p>No hay mensajes recibidos</p>
              </div>
          @endif

          {!! $recibidos->appends(request()->query())->links() !!}
        </div>
      </div>
    </div>

    <div id="pane-C" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-C">
      <div class="card-header" role="tab" id="heading-C">
        <h5 class="mb-0">
          <a class="collapsed" data-toggle="collapse" href="#collapse-C" data-parent="#content" aria-expanded="false" aria-controls="collapse-C">
            Enviar mensaje
          </a>
        </h5>
      </div>
      <div id="collapse-C" class="collapse" role="tabpanel" aria-labelledby="heading-C">
        <div class="card-body">
          
          <div class="alert alert-danger alert-destinatario" style="display:none;" role="alert">
            <strong></strong>
          </div>
          <div class="alert alert-success alert-exito" style="display:none;" role="alert">
            <strong>Mensaje enviado con éxito!</strong>
          </div>

          {!! Form::open(['route' => ['correos.store'], 'method'=> 'POST']) !!}
           <div class="form-group formulario-mensajes scroll-effect-mensajes">
            {!! Form::label('destinatario' , 'Destinatario'); !!}
            {!! Form::text('destinatario' , null, ['class' =>'form-control',  'placeholder' => 'Usuario al que enviar el mensaje' , 'required' ]); !!}
            <p class="alerta-destinatario" style="color:red; display:none">El destinatario es necesario</p>
            {!! Form::label('asunto' , 'Asunto del mensaje'); !!}
            {!! Form::text('asunto' , null, ['class' =>'form-control',  'placeholder' => 'Asunto de la pregunta' , 'required' ]); !!}
            <p class="alerta-asunto" style="color:red; display:none">El asunto es necesario</p>
            {!! Form::label('body' , 'Cuerpo del mensaje'); !!}
            {!! Form::textarea('body' , null, ['size' => '30x5', 'class' =>'form-control',  'placeholder' => 'Formula tu consulta' , 'required' ]); !!}
            <p class="alerta-body" style="color:red; display:none">El cuerpo del mensaje no puede estar vacío.</p>
           </div>

          <button class="btn btn-sm btn-danger btn-preguntar">Enviar mensaje</button>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>


@stop
@section('scriptQuestion')
  <script src="/js/correos.js"></script>
@stop
