<style>
    /* Navbar principal */
    .navbar {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%) !important;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        padding: 15px 0;
    }

    /* Brand/Logo */
    .navbar-brand {
        color: white !important;
        font-size: 24px;
        font-weight: 700;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .navbar-brand:hover {
        color: #ecf0f1 !important;
        transform: translateY(-2px);
    }

    .navbar-brand span {
        font-size: 28px;
        margin-right: 8px;
    }

    /* Botón toggle en móvil */
    .navbar-toggler {
        border-color: rgba(255, 255, 255, 0.3);
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    /* Items del navbar */
    .nav-item {
        margin: 0 5px;
    }

    .nav-link {
        color: rgba(255, 255, 255, 0.85) !important;
        font-weight: 500;
        padding: 10px 18px !important;
        border-radius: 6px;
        transition: all 0.3s ease;
        font-size: 15px;
    }

    .nav-link:hover {
        color: white !important;
        background-color: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
    }

    .nav-link span {
        margin-right: 6px;
    }

    /* Item activo */
    .nav-item.active .nav-link {
        background-color: rgba(255, 255, 255, 0.15);
        color: white !important;
        font-weight: 600;
    }

    /* Botón de cerrar sesión */
    .btn-link.nav-link {
        color: rgba(255, 255, 255, 0.85) !important;
        text-decoration: none;
        font-weight: 500;
        padding: 10px 20px !important;
        border-radius: 6px;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .btn-link.nav-link:hover {
        color: white !important;
        background-color: rgba(231, 76, 60, 0.9);
        border-color: rgba(231, 76, 60, 0.9);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
    }

    /* Alineación derecha */
    .navbar-right {
        margin-left: auto;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .navbar-collapse {
            background-color: rgba(44, 62, 80, 0.95);
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
        }

        .nav-item {
            margin: 5px 0;
        }

        .navbar-right {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-link.nav-link {
            width: 100%;
            text-align: left;
        }
    }

    /* Animación suave al cargar */
    .navbar {
        animation: slideDown 0.5s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/" style="color:#777"><span style="font-size:15pt">&#9820;</span> Videoclub</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Request::is('index') && ! Request::is('/create/movie')? 'active' : ''}}">
                    <a class="nav-link" href="{{url('/index')}}">
                        <span class="glyphicon glyphicon-film" aria-hidden="true"></span>
                        Catálogo
                    </a>
                </li>
                @auth
                @if(auth()->user()->role)
                <li class="nav-item {{  Request::is('/create/movie') ? 'active' : ''}}">
                    <a class="nav-link" href="{{url('/create/movie')}}">
                        <span>&#10010</span> Nueva película
                    </a>
                </li>
                <li class="nav-item {{  Request::is('/user') ? 'active' : ''}}">
                    <a class="nav-link" href="{{url('/user')}}">
                        Gestión Usuarios
                    </a>
                </li>
                 <li class="nav-item {{  Request::is('/directors') ? 'active' : ''}}">
                    <a class="nav-link" href="{{url('/directors')}}">
                        Gestión Directores
                    </a>
                </li>
                @endif
                @endauth
            </ul>

            <ul class="navbar-nav navbar-right">
                <li class="nav-item">
                    <form action="{{ url('/logout') }}" method="POST" style="display:inline">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-link nav-link" style="display:inline;cursor:pointer">
                            Cerrar sesión
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>