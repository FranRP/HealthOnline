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
            <p class="text-faded mb-5">Administración de reportes - Borrar y ver</p>
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
            <h2 class="section-heading">Todos los reportes</h2>
            <hr class="my-4">
            <p class="mb-5">{!! $reports->appends(request()->query())->links() !!}</p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 mr-auto text-center">
           	
           	<div class="table-responsive">
				<table class="table administracion-section">
					<thead>
						<tr>
							<th>ID</th>
							<th>Reportador</th>
							<th>Reportado</th>
							<th>Tipo de report</th>
							<th>Cuerpo</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($reports as $report)
						<tr class="tabla-reportes">
							<td>{{$report->id}}</td>
							@if ($report->user_id && $report->user != null)
								<td><a href="{{route('usuarios.show', $report->user_id)}}">{{$report->user->name}}</a></td>
							@else 
								<td style="color:red;">Eliminado</td>
							@endif
							@if ($report->reportable != null)
								@if ($report->reportable->user_id && $report->reportable->user != null)
									<td><a href="{{route('usuarios.show', $report->reportable->user_id)}}">{{$report->reportable->user->name}}</a></td>
								@else
									<td style="color:red;">Eliminado</td>
								@endif
							@else 
								<td style="color:red;">Eliminado</td>
							@endif

							@if ($report->reportable_type == 'App\Question')
								@if ($report->reportable != null)
									<td><a href="{{route('preguntas.show', $report->reportable->id)}}">{{$report->reportable_type}}</a></td>
									<td data-toggle="modal" data-target="#myModal{{$report->id}}">{{$report->reportable->body}}</td>
								@else
									<td>{{$report->reportable_type}}</td>
									<td style="color:red;">Eliminado</td>
								@endif
							@else
								@if ($report->reportable != null)
									@if($report->reportable->question != null)
										<td><a href="{{route('preguntas.show', $report->reportable->question_id)}}">{{$report->reportable_type}}</a></td>
										<td data-toggle="modal" data-target="#myModal{{$report->id}}">{{$report->reportable->body}}</td>
									@else
										<td>{{$report->reportable_type}}</td>
										<td data-toggle="modal" data-target="#myModal{{$report->id}}">{{$report->reportable->body}}</td>
									@endif
								@else 
									<td>{{$report->reportable_type}}</td>
									<td style="color:red;">Eliminado</td>
								@endif
							@endif
							<td>
								{!! Form::open(['route' => ['reportes.destroy', $report->id], 'method'=> 'DELETE']) !!}
									<button class="btn btn-sm btn-danger btn-delete">Eliminar</button>
								{!! Form::close() !!}
							</td>
								
						</tr>
						@endforeach
						
					</tbody>
				</table>
			</div>
		
			@foreach ($reports as $report)
			@if ($report->reportable != null)
				<div class="modal fade" id="myModal{{$report->id}}">
				  <div class="modal-dialog">
				    <div class="modal-content">
				    	<div class="modal-header">
					        <h4 class="modal-title">{{$report->reportable_type}}</h4>
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					    </div>

						<div class="modal-body">
					        {{$report->reportable->body}}
					    </div>
					</div>
  				   </div>
				</div>
			@endif

			@endforeach

          </div>
        </div>
      </div>
    </section>

	

	
	
</div>
@stop