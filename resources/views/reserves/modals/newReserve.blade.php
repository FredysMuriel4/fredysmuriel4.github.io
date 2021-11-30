<div class="modal fade" id="addReserve" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reservar Laboratorio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('reserva.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for=""><b> Hora Inicio *</b> </label> <br>
                            <input type="time" class="form-control" name="start_time">
                        </div>
                        <div class="col-md-6">
                            <label for=""><b> Hora Fin *</b> </label> <br>
                            <input type="time" class="form-control" name="end_time">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for=""><b> Fecha Inicio *</b> </label> <br>
                            <input type="date" class="form-control" name="start_date" readonly="" id="start_date">
                        </div>
                        <div class="col-md-6">
                            <label for=""><b> Fecha Fin *</b> </label> <br>
                            <input type="date" class="form-control" name="end_date" readonly="" id="end_date">
                        </div>
                    </div>
                    <input type="hidden" id="lesson_id" value="" name="lesson_id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
