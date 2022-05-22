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
                            <input type="time" class="form-control" name="start_time" id="start_time" onchange="calcDifferenceTime()">
                        </div>
                        <div class="col-md-6">
                            <label for=""><b> Hora Fin *</b> </label> <br>
                            <input type="time" class="form-control" name="end_time" id="end_time" onchange="calcDifferenceTime()">
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

<script>
    function calcDifferenceTime() {
        let start_time = document.getElementById("start_time").value;
        let end_time = document.getElementById("end_time").value;

        // Expresión regular para comprobar formato
        let formatohora = /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/;

        // Si algún valor no tiene formato correcto sale
        if (!(start_time.match(formatohora)
            && end_time.match(formatohora))){
            return;
        }

        // Calcula los mins de cada hora
        let start_mins = start_time.split(':')
            .reduce((p, c) => parseInt(p) * 60 + parseInt(c));
        let end_mins = end_time.split(':')
            .reduce((p, c) => parseInt(p) * 60 + parseInt(c));

        // Si la hora final es anterior a la hora inicial sale
        if (end_mins < start_mins) return;

        // Diferencia de mins
        let diferencia = end_mins - start_mins;

        // Cálculo de hours y mins de la diferencia
        let hours = Math.floor(diferencia / 60);
        let mins = diferencia % 60;

        if(hours > 2 || (hours == 2 && mins > 00)){
            document.getElementById("start_time").value = "";
            document.getElementById("end_time").value = "";
            alert('Error. No se pueden solicitar más de dos horas de reserva');
        }
    }
</script>
