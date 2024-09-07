@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 login-card">
            <div class="login-header">
                <img src="{{asset('images/Banner.png')}}" class="img-responsive" style="width: 50%;">
                @include('layouts.alerts')
            </div>
            <hr>
            <div class="login-header d-flex flex-column mt-4">
                <div>
                    <label> ¡Identificate con tu correo institucional para iniciar sesión en el sistema! </label>
                </div>
                <div class="mt-3">
                    <a
                        class="btn btn-sm btn-login"
                        href="{{ route('microsoft.oAuth') }}"
                    >
                        <img src="{{ asset('images/office.png') }}" style="width: 4%">
                            Iniciar Sesión con Microsoft
                    </a>
                </div>
            </div>
            <hr>
            {{-- <div class="card">
                <div class="card-header">
                    <div class="col-md-12 text-center">
                        <img src="{{asset('images/Banner.png')}}" class="img-responsive" style="">
                    </div>
                </div>
                @include('layouts.alerts')
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small> Recuerda registrarte oprimiendo en el botón que se encuentra en la parte superior derecha. </small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn" style="width: 100%; background-color: #033e82 !important; color: white;">Ingresar</button>
                        </div>
                    </form>
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection
