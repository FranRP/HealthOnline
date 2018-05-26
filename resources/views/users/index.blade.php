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
            <p class="text-faded mb-5">Administración de usuarios - Crear, actualizar y eliminar</p>
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Ver más</a>
          </div>
        </div>
      </div>
</header>


<div class="container" style="margin-top:30px !important">
		<h1>Usuarios</h1>
	<a class="btn btn-success float-right" href="{{route('usuarios.create')}}">Crear nuevo usuario</a>

	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Email</th>
				<th>Role</th>
				<th>Etiquetas</th>
				<th>Acciones</th>
				<th>Acciones2</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
				<tr id="user{{$user->id}}">
					<td>{{$user->id}}</td>
					<td><a href="{{route('usuarios.show', $user->id)}}">{{$user->name}}</a></td>
					<td>{{$user->email}}</td>
					<td>
						{{$user->roles->pluck('display_name')->implode(', ')}}
						<!--
						@foreach ($user->roles as $rol)
						{{$rol->display_name}}
						@endforeach
						-->
					</td>
					<td>{{ $user->tags->pluck('name')->implode(', ')}}</td>
					<td>
						<a  class="btn btn-sm btn-secondary" href="{{ route('usuarios.edit', $user->id) }}">Editar</a>
					</td>
					<td>
						{!! Form::open(['route' => ['usuarios.destroy', $user->id], 'method'=> 'DELETE']) !!}
						<button class="btn btn-sm btn-danger btn-delete">Eliminar</button>
						{!! Form::close() !!}
					</td>
	
						<!--
						<button class="btn btn-sm btn-warning delete-user" value="{{$user->id}}">Eliminar</button>
						-->

						<!--
						<form style="display:inline" method="POST" action="{{ route('usuarios.destroy', $user->id) }}">
							{!! csrf_field() !!}
							{!! method_field('DELETE') !!}
							<button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
							
						</form>
					-->
						

					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>


@stop