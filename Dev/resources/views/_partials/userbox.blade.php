<div class="dropdown" style="position: absolute; top: 0;right: 60px;z-index: 99;">

    @if (Auth::check())
    <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->username }} <span class="caret"></span></button>
    <div class="dropdown-menu dropdown-menu-right">
        @if(Auth::user()->rols_id==1)
        <a class="dropdown-item" href="{{ url('admin') }}">Administració</a>
        <a class="dropdown-item" href="{{ url('operator') }}">CECOS</a>
        <a class="dropdown-item" href="{{ url('mobile') }}">Recursos</a>
        <div class="dropdown-divider"></div>
        @endif
        <a class="dropdown-item" href="{{ action([App\Http\Controllers\UsuariController::class, 'logout']) }}">
            <i class="fa fa-sign-out" aria-hidden="true"></i> Sortir
        </a>
    </div>

    @else

    <a class="btn btn-danger" type="button" href="{{ url('/login') }}">
        <i class="fa fa-sign-in" aria-hidden="true"></i> Login
    </a>

    @endif

</div>
