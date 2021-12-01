@extends('layouts.base')


@section('content')
<div class="content" style="margin-top: 3%;">
    <div class="row">
        <div class="col-md-12">
            <div class="card center" style="width: 80%; margin-left:10%;">
                <div class="card-header mb-2" style="background-color: #033e82; color: white ;">
                    <h4> Perfil del usuario </h4>
                    <small> Aquí encontrarás todas tu información personal.</small>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 border-right">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="130px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"></div>
                        </div>
                        <div class="col-md-9 border-right">
                            <div class="p-3 py-5">
                                <div class="row mt-2">
                                    <div class="col-md-6"><label class="labels">Nombre</label>
                                        <input type="text" class="form-control" placeholder="first name" value="{{Auth()->user()->name}}" readonly="">
                                    </div>
                                    <div class="col-md-6"><label class="labels">Apellido</label>
                                        <input type="text" class="form-control" value="{{Auth()->user()->last_name}}" placeholder="surname" readonly="">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6"><label class="labels">Teléfono</label>
                                        <input type="text" class="form-control" placeholder="first name" value="{{Auth()->user()->phone}}" readonly="">
                                    </div>
                                    <div class="col-md-6"><label class="labels">Correo</label>
                                        <input type="text" class="form-control" value="{{Auth()->user()->email}}" placeholder="surname" readonly="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
