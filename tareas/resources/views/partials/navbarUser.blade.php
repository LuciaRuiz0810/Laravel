<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/" style="color:#777">
            <span style="font-size:15pt">&#9820;</span> Videoclub
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        @if(Auth::check())
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item {{ Request::is('/user/index') }}">
                    <a class="nav-link" href="{{ url('/user/index') }}">
                        <span class="glyphicon glyphicon-film" aria-hidden="true"></span>
                        Tareas
                    </a>
                </li>
            </ul>

            <!-- Aquí centramos el texto -->
            <span class="navbar-text mx-auto">
                Bienvenido al Gestor de Tareas!
            </span>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <form action="{{ url('/logout') }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link" style="display:inline;cursor:pointer">
                            Cerrar sesión
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        @endif
    </div>
</nav>
