<!DOCTYPE html><!-- MAIN TEMPLATE -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('pageTitle')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
{{--        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
{{--    <link rel="stylesheet" href="{ { asset('/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{ { asset('/css/style.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/all.css') }}">

        <!-- Styles -->
        <style></style>

    </head>

    <body>

        <?php date_default_timezone_set('Europe/Madrid'); ?>

         <nav class="navbar navbar-expand-lg bg-primary">

            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('/img/logo.png') }}" style="max-height: 50px;" /></a>

            <h5 class="text-white px-4 m-0">Administració</h5>

            <div class="collapse navbar-collapse" id="navbarColor01">

              <ul class="navbar-nav mr-auto">

                <li class="nav-item">

                    <a class="nav-link text-white"  href="{{ url('admin/incidencies') }}" role="button">Incidencies</a>

                </li>

                <li class="nav-item">

                    <a class="nav-link text-white"  href="{{ url('admin/afectats') }}" role="button">Afectats</a>

                  </li>

                  <li class="nav-item">

                    <a class="nav-link text-white"  href="{{ url('admin/alertants') }}" role="button">Alertants</a>

                  </li>

                  <li class="nav-item">

                    <a class="nav-link text-white"  href="{{ url('admin/recursos') }}" role="button">Recursos</a>

                  </li>

                  <li class="nav-item">

                    <a class="nav-link text-white"  href="{{ url('admin/usuaris') }}" role="button">Usuaris</a>

                  </li>

                  <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Taules Tipus</a>

                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ url('admin/tipus/tipus_alertants') }}">Tipus Alertants</a>
                      <a class="dropdown-item" href="{{ url('admin/tipus/tipus_incidencies') }}">Tipus Incidencies</a>
                      <a class="dropdown-item" href="{{ url('admin/tipus/tipus_recursos') }}">Tipus Recursos</a>
                    </div>

                  </li>

                  <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Altres taules</a>

                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ url('admin/xtras/rols') }}">Rols</a>
                      <a class="dropdown-item" href="{{ url('admin/xtras/municipis') }}">Municipis</a>
                      <a class="dropdown-item" href="{{ url('admin/xtras/comarques') }}">Comarques</a>
                      <a class="dropdown-item" href="{{ url('admin/xtras/provincies') }}">Provincies</a>
                      <a class="dropdown-item" href="{{ url('admin/xtras/sexes') }}">Sexes</a>
                      <a class="dropdown-item" href="{{ url('admin/xtras/codis/interco') }}">Codis Interco</a>
                      <a class="dropdown-item" href="{{ url('admin/xtras/codis/sem3') }}">Codis 3 SEM</a>
                      <a class="dropdown-item" href="{{ url('admin/xtras/codis/gravetat') }}">Codis Gravetat</a>
                      <a class="dropdown-item" href="{{ url('admin/xtras/codis/valoracio') }}">Codis Valoració</a>

                    </div>

                  </li>

                  <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Videos</a>

                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ url('admin/video/videos') }}">Videos de Valoracions</a>
                      <a class="dropdown-item" href="{{ url('admin/video/play') }}">Assignació de Videos</a>
                      <a class="dropdown-item" href="{{ url('admin/video/events') }}">Esdeveniments de Vídeos</a>
                    </div>

                  </li>

                  <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Ajudes</a>

                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ url('admin/help/valoracio') }}">Anglés Valoracións</a>
                      <a class="dropdown-item" href="{{ url('admin/help/simptomes') }}">Anglés Símptomes</a>
                      <a class="dropdown-item" href="{{ url('admin/help/formelements') }}">Elements Formulari</a>
                    </div>

                  </li>

              </ul>

            </div>

        </nav>

        @include('_partials.userbox')

        <div class="container-fluid mt-3 mb-5">@yield('pageContent')</div>

        {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> --}}
        <script src="{{ asset('js/app.js') }}"></script>

        @yield('pageModalScript')

    </body>

</html>
