async function loadCalendar(lesson){
    var reserves = [];
    await $.get('/reserves/'+lesson, function(data){
        for (let i = 0; i < data.length; i++) {
            let format = {
                title: data[i].get_lesson.name,
                start: data[i].start_date+"T"+data[i].start_time,
                end: data[i].end_date+"T"+data[i].end_time,
            }
            reserves.push(format);
        }
    })

    var calendarEl = document.getElementById('calendarMod');

    var calendarMod = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        initialDate: new Date(),
        height: 550,
        width: 700,
        locale: "es",
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek',

        },
        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            list: 'Lista'
        },
        editable: false,
        selectable: true,
        events: reserves,
        eventClick: function(info) {
            //Eventos
            // console.log(info.event);
        },
        dateClick: function(info) {
            $("#start_date").val(info.dateStr);
            $("#end_date").val(info.dateStr);
            $("#lesson_id").val(lesson);
            $("#addReserve").modal('show');
        }
    });
    calendarMod.render();
    $("#modalCalendar").modal('show');
};
