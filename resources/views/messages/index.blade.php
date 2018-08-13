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
            <p class="text-faded mb-5">Administración de mensajes - Editar, borrar y ver</p>
            <a class="btn btn-primary btn-xl ver-mas">Ver más</a>
          </div>
        </div>
      </div>
</header>

<div class="container primer-bloque administracion-section">

	
	<section id="contact">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading">Todos los mensajes</h2>
            <hr class="my-4">
            <p class="mb-5">{!! $messages->appends(request()->query())->links() !!}</p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 mr-auto text-center">
            
			<div class="table-responsive">
				<table class="table administracion-section administracion-section-messages">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Email</th>
							<th>Mensaje</th>
							<th>Etiquetas</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($messages as $message)
						<tr>
							<td>{{ $message->id }}</td>
							@if ($message->user_id && $message->user != null)
								<td><a href="{{route('usuarios.show', $message->user->id)}}">{{$message->user->name}}</a></td>
								<td>{{ $message->user->email}}</td>
							@elseif ($message->user_id && $message->user == null)
								<td style="color:red;">Eliminado</td>
								<td style="color:red;">Eliminado</td>
							@else
								<td>{{ $message->name }}</td>
								<td>{{ $message->email }}</td>
							@endif
							<td> <a href="{{route('mensajes.show', $message->id)}}">{{ $message->mensaje }}</a></td>
							<td>{{$message->tags->pluck('name')->implode(', ')}}</td>
							<td>

								{!! Form::open(['route' => ['mensajes.destroy', $message->id], 'method'=> 'DELETE']) !!}
									<button class="btn btn-sm btn-danger btn-delete">Eliminar</button>
								{!! Form::close() !!}

							</td>
						</tr>
						@endforeach
						<!--{!! $messages->appends(['sorted' => request('sorted')])->links() !!}-->
						
					</tbody>
				</table>
			</div>


          </div>
        </div>
      </div>
    </section>

	

	
	
</div>
@stop