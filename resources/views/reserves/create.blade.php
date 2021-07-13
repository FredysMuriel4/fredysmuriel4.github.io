@yield('create')
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
              <input type="number" name="quantity" class="form-control" value="{{old('quantity')}}">
            </div>
          </div>
          <div class="col mt-3">
            <button type="submit" class="btn float-right" style="background-color: #033e82; color: white ;"> Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>