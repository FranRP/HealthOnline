@extends('layout')

@section('contenido')
	<h1>Editar usuario</h1>

	@if (session()->has('info'))
		<div class="alert alert-success" role="alert">
			<strong>{{session('info')}}</strong>
		</div>
		
	@endif

	<form enctype="multipart/form-data" method="POST" action="{{ route('usuarios.update', $user->id) }}">
	<!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
	{!! method_field('PUT') !!}
	{!! csrf_field() !!}
	<p>
		<label for=name>
			Nombre
			<input class="form-control" type="text" name="name" value="{{ $user->name }}">
			{!! $errors->first('name', '<span class=error>:message</span>')!!}
		</label>
	</p>
	<p>
		<label for=email>
			Email
			<input class="form-control" type="email" name="email" value="{{ $user->email }}">
			{!! $errors->first('email','<span class=error>:message</span>')!!}
		</label>
    </p>
    <p>
		<label for=avatar>
			Avatar
			<img src="/uploads/{{$user->avatar}}" alt="" style="width:100px; height:100px">
			<input class="form-control" type="file" name="avatar" value="{{ $user->avatar }}">
			{!! $errors->first('file', '<span class=error>:message</span>')!!}
		</label>
	</p>
    <div class="btn-group" data-toggle="buttons">
    	@foreach ($roles as $id => $name)
	    	<label class="btn btn-danger active">
	    		<input name=role[] type="checkbox" {{$user->roles->pluck('id')->contains($id) ? 'checked' : ''}} value="{{$id}}">
	    		{{$name}}
	    	</label>
	    @endforeach
    </div>
    <br>
	<input class="btn btn-primary" type="submit" value="Enviar">
</form>
@stop