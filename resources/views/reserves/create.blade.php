{{-- @yield('create')
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="width: 150%">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #033e82; color: white ;">
        <h5 class="modal-title" id="exampleModalLongTitle"> Reservar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: white;">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('reserva.store')}}" method="POST">
          @csrf
          <div class="row mt-3">
            <div class="col-md-6">
              <label> <b>Actividad *</b> </label> <br>
              <select class="form-control" name="lesson_id">
                <option disabled="" selected=""> Seleccione</option>
                @foreach($lessons as $lesson)
                  <option {{old('lesson_id') == $lesson->id ? 'selected' : ''}} value="{{$lesson->id}}"> {{$lesson->name}} </option>
                @endforeach
              </select>
            </div>
            <div class="col md-6">
              <label> <b> Fecha *</b> </label> <br>
              <input type="date" name="date" class="form-control" value="{{old('date')}}">
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-6">
              <label> <b> Hora *</b> </label> <br>
              <input type="time" name="time" class="form-control" value="{{old('time')}}">
            </div>
            <div class="col-md-6">
              <label> <b> Cantidad de horas *</b> </label> <br>
              <input type="number" name="quantity" class="form-control" value="{{old('quantity')}}" max="5">
            </div>
          </div>
          <div class="col mt-3">
            <button type="submit" class="btn float-right" style="background-color: #033e82; color: white ;"> Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div> --}}

@extends('layouts.base')
@section('content')
    <div class="content" style="margin-top: 3%;">
        <div class="row">
            <div class="col-md-12">
                <div class="card center" style="width: 80%; margin-left:10%;">
                    <div class="card-header mb-2" style="background-color: #033e82; color: white ;">
                        <h4> Actividades </h4>
						<small> Selecciona la actividad que quieras reservar.</small>
                    </div>
                    @include('layouts.alerts')
                    <div class="card-body">
                        @isset($lessons)
                            <div class="row">
                                @foreach ($lessons as $lesson)
                                <div class="col">
                                    <div class="card" style="height:400px;">
                                        <div class="card-header mb-2" style="background-color: #033e82; color: white ;">
                                            {{$lesson->name}}
                                        </div>
                                        <div class="card-body">
                                            {{$lesson->description}}
                                        </div>
                                        <div class="card-footer">
                                            <button type="button" class="btn float-right" style="background-color: #033e82; color: white;" onclick="loadCalendar({{$lesson->id}})"> Reserva </button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('reserves.modals.calendar')
    @include('reserves.modals.newReserve')
@endsection
@push('styles')
    <style>
        .fc-col-header {
            width: 400px !important;
        }

        table.fc-scrollgrid-sync-table {
            width: 400px !important;
            height: 300px !important;
        }

    </style>
@endpush
