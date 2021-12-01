@extends('layouts.base')

@section('content')
<div class="content" style="margin-top: 3%;">
    <div class="row">
        <div class="col-md-12">
            <div class="card center" style="width: 80%; margin-left:10%;">
                <div class="card-header mb-2" style="background-color: #033e82; color: white ;">
                    <h4> Registrarse </h4>
                </div>
                @include('layouts.alerts')
                <div class="card-body">
                    <form action="{{route('registro.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col md-4">
                                <label for=""> Nombre </label>
                                <input type="text" class="form-control" placeholder="Nombre" name="name" value="{{old('name')}}">
                            </div>
                            <div class="col md-4">
                                <label for=""> Apellido </label>
                                <input type="text" class="form-control" placeholder="Apellido" name="last_name" value="{{old('last_name')}}">
                            </div>
                            <div class="col md-4">
                                <label for=""> Teléfono </label>
                                <input type="text" class="form-control" placeholder="Teléfono" name="phone" value="{{old('phone')}}">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col md-4">
                                <label for=""> Correo </label>
                                <input type="email" class="form-control" placeholder="user@example.com" name="email" value="{{old('email')}}">
                            </div>
                            <div class="col md-4">
                                <label for=""> Contraseña </label>
                                <input type="password" class="form-control" placeholder="Contraseña" name="password" value="{{old('password')}}">
                            </div>
                            <div class="col md-4">
                                <label for=""> Verificar Contraseña </label>
                                <input type="password" class="form-control" placeholder="Verificar contraseña" name="verify_password" value="{{old('verify_password')}}">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-block" style="background-color: #033E82; color:white"> Registrar </button>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
