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
                                            <td>{{date('g:i A', strtotime($reserve->start_time))}}</td>
                                            <td>{{date('g:i A', strtotime($reserve->end_time))}}</td>
                                            <td>
                                                {{-- Comparando las fechas --}}
                                                @if ((strtotime(date('j/M/Y')) >= strtotime(date('j/M/Y', strtotime($reserve->start_date)))) && (strtotime(date('j/M/Y')) <= strtotime(date('j/M/Y', strtotime($reserve->end_date)))))
                                                    @if ((strtotime(date('h:i:s')) >= strtotime(date('h:i:s', strtotime($reserve->start_time)))) && ((strtotime(date('h:i:s')) <= strtotime(date('h:i:s', strtotime($reserve->end_time))))))
                                                        <a onclick="sendCredentials({{$reserve->id}})" class="btn btn-primary" style="background-color: #033e82; color: white;"> Continuar </a>
                                                    @endif
                                                @endif
                                            </td>
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
@push('scripts')
    <script>
        async function sendCredentials(id) {
            let response = await requestSendCredentials(id);
            if(response.state == 200){
                alert(response.message);
                window.location.href = '/actividad';
            } else {
                alert(response.message);
                console.log(response.error);
            }
        }
        async function requestSendCredentials(id){
            let response = {
                'state': 500
            };
            await fetch("/credenciales/"+id)
                .then(response => response.json())
                .then(data => {
                    response = data
                })
                .catch(e => console.log(e));
            return response;
        }
    </script>
@endpush

