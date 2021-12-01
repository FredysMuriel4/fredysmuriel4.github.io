@yield('navbar')
<nav class="navbar navbar-expand-lg navbar-light bg-light p-3" style="background-color: #033e82 !important; color: white !important;">
  <a class="navbar-brand"> Laboratorio de Virtualización</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        {{-- <a class="nav-link" href="#" style="color:white;">Inicio <span class="sr-only">(current)</span></a> --}}
      </li>
      @auth
      <li class="nav-item">
        <a class="nav-link" href="{{route('reserva.index')}}" style="color:white;" title="Inicio"><i class="fad fa-home-alt"></i></a>
      </li>
      @endauth
      @auth
      <li class="nav-item">
        <a class="nav-link" href="{{route('reserva.create')}}" style="color:white;" title="Reservar"><i class="fad fa-calendar-alt"></i></a>
      </li>
      @endauth
      @auth
      <li class="nav-item">
        <a class="nav-link" href="#" style="color:white;" title="Perfil"><i class="fad fa-user-circle"></i></a>
      </li>
      @endauth
      @auth
      <li class="nav-item dropdown">
        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color:white;" title="Salir"><i class="fad fa-sign-out"></i></a>
      </li>
      @endauth
      @guest
      <li class="nav-item">
        <a class="nav-link" href="{{route('registro.index')}}"" style="color:white;">Registrarse</a>
        {{-- {{route('register')}} --}}
      </li>
      @endguest
    </ul>
  </div>
</nav>

<form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
  @csrf
</form>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
