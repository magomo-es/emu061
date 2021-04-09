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

        {{-- <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">{{ Auth::user()->username }} <span class="caret"></span></button>
            <ul class="dropdown-menu">
                @if(Auth::user()->rols_id==1)<li><a href="{{ url('admin.index') }}">Administració</a></li>@endif
                @if(Auth::user()->rols_id==1 || Auth::user()->rols_id==2)<li><a href="{{ url('operator.index') }}">CECOS</a></li>
                @if(Auth::user()->rols_id==1 || Auth::user()->rols_id==3)<li><a href="{{ url('mobile.index') }}">Recursos</a></li>
                <li><hr></li>
                <li><a href="{{ action([App\Http\Controllers\UsuariController::class, 'logout']) }}">Sortir</a></li>
            </ul>
        </div> --}}

        <nav class="navbar navbar-expand-lg bg-primary">

            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('/img/logo.png') }}" style="max-height: 50px;" /></a>

            <h5 class="text-white px-4 m-0">Mobil</h5>

        </nav>

        @include('_partials.userbox')

        <div class="container-fluid mt-3 mb-5">@yield('pageContent')</div>

    </body>

{{--     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('pageModalScript')

</html>
