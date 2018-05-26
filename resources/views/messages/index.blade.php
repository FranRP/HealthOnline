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
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Ver más</a>
          </div>
        </div>
      </div>
</header>

<div class="container" style="margin-top:30px !important">

	<h1>Todos los mensajes</h1>
	<table class="table">
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
					<td>{{ $message->user->name}}</td>
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
					<a  class="btn btn-sm btn-secondary" href="{{ route('mensajes.edit', $message->id) }}">Editar</a>
					<form style="display:inline" method="POST" action="{{ route('mensajes.destroy', $message->id) }}">
						{!! csrf_field() !!}
						{!! method_field('DELETE') !!}
						<button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
						
					</form>

				</td>
			</tr>
			@endforeach
			<!--{!! $messages->appends(['sorted' => request('sorted')])->links() !!}-->
			{!! $messages->appends(request()->query())->links() !!}
		</tbody>
	</table>
</div>
@stop