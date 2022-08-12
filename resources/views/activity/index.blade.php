@extends('layouts.base')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12 pt-4 pl-4 pr-4 d-flex justify-content-center align-items-center">
                <div id="counter_box">
                    <h2><b id="counter" class="text-danger"> {{$difference}} </b></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 pl-4 pb-4 pr-4">
                <div class="embed-responsive embed-responsive-21by9">
                    <iframe class="embed-responsive-item" src="https://getbootstrap.com/" sandbox="allow-forms allow-scripts"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    function temporizer() {
        let time = document.getElementById('counter').childNodes[0]['data'];

        let hours = time.split(':')[0];
        let minutes = time.split(':')[1];
        let seconds = time.split(':')[2];

        if(hours == 00 && minutes == 00 && seconds == 00){
            alert('Su sesión ha finalizado');
            let url = window.location.origin;
            window.location.href = url+"/reserva";
        }

        if(seconds == 00){
            if(minutes == 00){
                if(hours > 0){
                    hours -= 1;
                    minutes = 59;
                    seconds = 60;
                } else {
                    hours = 0;
                    minutes = 0;
                    seconds = 60;
                }
            } else {
                minutes -= 1;
                seconds = 60;
            }
        } else {
            seconds -= 1;
        }

        if(hours < 10){
            if(hours.toString().length < 2){
                hours = "0"+hours;
            }
        }

        if(minutes < 10){
            if(minutes.toString().length < 2){
                minutes = "0"+minutes;
            }
        }

        if(seconds < 10){
            if(seconds.toString().length < 2){
                seconds = "0"+seconds;
            }
        }

        document.getElementById('counter').innerHTML = hours+":"+minutes+":"+seconds;
    }

    window.onload = setInterval(temporizer, 1000);
</script>
@endpush
