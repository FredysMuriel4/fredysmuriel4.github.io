@extends('layouts.base')
@section('content')
	<div class="content" style="margin-top: 3%;">
		<div class="row">
			<div class="col-md-12">
				<div class="card center" style="width: 60%; margin-left: 20%;">
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
									<th scope="col"> Fecha </th>
									<th scope="col"> Hora </th>
									<th scope="col"> Horas </th>
									<th scope="col">  </th>
								</thead>
								<tbody>
								 	@foreach($reserves as $reserve)
										<tr>
											<td scope="col"> {{$reserve->getLesson->name}} </td>
											<td scope="col"> {{explode(" ",$reserve->reserve_date)[0]}} </td>
											<td scope="col"> {{explode(" ",$reserve->reserve_date)[1]}} </td>
											<td scope="col"> {{$reserve->quantity}} </td>
											<td scope="col"> <a href="#" class="button btn float-right" style="background-color: #033e82; color: white;"> Continuar </a> </td>
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
						<button type="button" data-toggle="modal" data-target="#exampleModalCenter" class="btn float-right" style="background-color: #033e82; color: white;"> Nueva Reserva </button>
					</div>
				</div>
			</div>
		</div>
	</div>
</button>
@include('reserves.create')
@endsection