@extends('layout')

@section('contenido')


<header class="masthead users-header text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              <strong>Bienvenido a tu perfil</strong>
            </h1>
            <hr>
          </div>
          <div class="col-lg-8 mx-auto">
            <p class="text-faded mb-5">Aquí puedes editarlo a tu gusto.</p>
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
            <p class="text-faded mb-4">Piensa que esto también sirve para darte a conocer. Si eres un profesional o una clínica, intenta resaltar datos que te resulten de interés como por ejemplo tu propia web, un teléfono, un contacto más personal, o una dirección más específica.</p>
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

		  	@if (session()->has('info'))
				<div class="alert alert-success" role="alert">
					<strong>{{session('info')}}</strong>
				</div>
				
			@endif

			<form enctype="multipart/form-data" method="POST" action="{{ route('usuarios.update', $user->id) }}">
				<!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
				{!! method_field('PUT') !!}
				{!! csrf_field() !!}
			
			<table class="table table-profile">

				

				<tr>
					<th style="color:#45bbce; font-weight:bold;">Modificar nombre:</th>
					<td><input class="form-control" type="text" name="name" maxlength="25" required value="{{ $user->name }}">
						{!! $errors->first('name', '<span class=error>El :message</span>')!!}</td>
				</tr>
				<tr>
					<th style="color:#45bbce; font-weight:bold;">Modificar email:</th>
					<td><input class="form-control" type="email" name="email" maxlength="28" required value="{{ $user->email }}">
						{!! $errors->first('email','<span class=error>El :message</span>')!!}</td>
				</tr>
				<tr>
					<th style="color:#45bbce; font-weight:bold;">Modificar avatar:</th>
					<td><input class="form-control cambio-avatar" type="file" name="avatar" value="{{ $user->avatar }}">
						{!! $errors->first('file', '<span class=error>El :message</span>')!!}</td>
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

			@if (auth()->user()->hasRoles(['admin']))
			<div class="btn-group usuarios-roles" data-toggle="buttons">
		    	@foreach ($roles as $id => $name)
			    	<label class="btn btn-info active edit-usuarios">
			    		<input name=role[] type="checkbox" {{$user->roles->pluck('id')->contains($id) ? 'checked' : ''}} value="{{$id}}">
			    		{{$name}}
			    	</label>
			    @endforeach
		    </div>
		    @endif

		    <div class="alert alert-warning alert-fallo-edit" role="alert">
		      <strong>Piensa que al editar tu nombre, ¡perderás todos los correos recibidos!</strong>
		    </div>

			<h5 class="card-text" style="color:#45bbce; font-weight:bold; margin-bottom:20px;">Perfil del usuario</h5>

			<div class="perfil-usuario">
				@if ($user->perfil)
					<textarea class="form-control" rows="6" cols="30" type="text" name="perfil">{{ $user->perfil }}</textarea>
			    @else
					<textarea class="form-control" rows="6" cols="30" type="text" name="perfil" placeholder="Introduce una descripción adicional"></textarea>
			    @endif
			</div>
			
		    <input class="btn btn-primary actualizar-user-btn" type="submit" value="Enviar">
			</form>
		  </div>
		  <div class="card-footer text-muted">
			<a href="{{ route('usuarios.show', $user->id) }}" class="btn btn-info">Volver</a>
			@can('destroy', $user)
			<form style="display:inline" method="POST" action="{{ route('usuarios.destroy', $user->id) }}">
				{!! csrf_field() !!}
				{!! method_field('DELETE') !!}
				<button class="btn btn btn-danger" type="submit">Eliminar</button>
									
			</form>
			@endcan
		  </div>
		</div>
	
		
		

	</div>
</section>

@stop