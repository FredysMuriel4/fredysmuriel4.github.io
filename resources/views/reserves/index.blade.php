@extends('layouts.base')
@section('content')
	<div class="content" style="margin-top: 3%;">
		<div class="row">
			<div class="col-md-12">
				<div class="card center" style="width: 80%; margin-left:10%;">
					<div class="card-header mb-2" style="background-color: #033e82; color: white ;">
						<h4> Reservas </h4>
						<small> Aquí encontrarás todas tus reservas programadas.</small>
					</div>
					@include('layouts.alerts')
					<div class="card-body">
						@if(count($reserves) > 0)
							<table class="table">
								<thead>
									<th scope="col"> Actividad </th>
									<th scope="col"> Fecha Inicio</th>
									<th scope="col"> Fecha Fin</th>
									<th scope="col"> Hora Inicio</th>
									<th scope="col"> Hora Fin</th>
									<th scope="col">  </th>
								</thead>
								<tbody>
                                    @foreach($reserves as $reserve)
                                        <tr>
                                            <td>{{$reserve->getLesson->name}}</td>
                                            <td>{{date('j/M/Y', strtotime($reserve->start_date))}}</td>
                                            <td>{{date('j/M/Y', strtotime($reserve->end_date))}}</td>
                                            <td>{{date('g:m A', strtotime($reserve->start_time))}}</td>
                                            <td>{{date('g:m A', strtotime($reserve->end_time))}}</td>
                                            <td></td>
                                        </tr>
									@endforeach
								</tbody>
							</table>
						@else
							<div class="alert alert-primary alert-dismissible fade show" role="alert">
								No tienes reservas realizadas aún.
							</div>
						@endif
					</div>
					<div class="card-footer">
						{{-- <button type="button" data-toggle="modal" data-target="#exampleModalCenter" class="btn float-right" style="background-color: #033e82; color: white;"> Nueva Reserva </button> --}}
						<a href="{{route('reserva.create')}}"type="button" class="btn float-right" style="background-color: #033e82; color: white;"> Nueva Reserva </a>
					</div>
				</div>
			</div>
		</div>
	</div>
</button>
@endsection

