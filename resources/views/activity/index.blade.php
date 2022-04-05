@extends('layouts.base')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12 pt-4 pl-4 pr-4 d-flex justify-content-center align-items-center">
                <div id="counter_box">
                    <h2><b id="counter" class="text-danger"> 02:00:00 </b></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 pl-4 pb-4 pr-4">
                <div class="embed-responsive embed-responsive-21by9">
                    <iframe class="embed-responsive-item" src="https://getbootstrap.com/"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
</script>
@endpush
