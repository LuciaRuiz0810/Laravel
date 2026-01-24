@extends('layouts.master')
@section('content')

<style>
    /* Mensajes de alerta */
    .alert-message {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 25px;
        font-weight: 500;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        animation: slideDown 0.3s ease-out;
    }
    
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    
    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
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

    /* Contenedor principal */
    .movie-detail-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
        margin: 20px 0;
    }

    .row {
        margin: 0;
    }

    /* Columna del póster */
    .poster-column {
        padding: 30px;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .poster-column img {
        width: 100%;
        max-width: 400px;
        border-radius: 8px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        transition: transform 0.3s ease;
    }

    .poster-column img:hover {
        transform: scale(1.02);
    }

    /* Columna de información */
    .info-column {
        padding: 40px;
    }

    .info-column h3 {
        font-size: 32px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 20px;
    }

    .info-column p {
        font-size: 16px;
        color: #555;
        margin-bottom: 12px;
        line-height: 1.6;
    }

    .info-column p strong {
        color: #2c3e50;
        font-weight: 600;
    }

    /* Badge de estado */
    .status-badge {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .status-rented {
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    .status-available {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    /* Botones */
    .action-buttons {
        margin-top: 30px;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 6px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .btn-info {
        background-color: #17a2b8;
        color: white;
    }

    .btn-info:hover {
        background-color: #138496;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .btn-warning {
        background-color: #ffc107;
        color: #212529;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
        cursor: not-allowed;
    }

    .btn-light {
        background-color: #f8f9fa;
        color: #495057;
        border: 1px solid #dee2e6;
    }

    .btn-light:hover {
        background-color: #e2e6ea;
    }

    /* Separador de información */
    .info-divider {
        height: 1px;
        background: linear-gradient(to right, transparent, #ddd, transparent);
        margin: 25px 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .poster-column {
            padding: 20px;
        }

        .info-column {
            padding: 25px;
        }

        .info-column h3 {
            font-size: 24px;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }
    }
</style>

<!-- Mensajes de éxito o error durante 3s -->
@if(session('success'))
<div id="success-message" class="alert-message alert-success">
    {{ session('success') }}
</div>
<script>
    setTimeout(function() {
        document.querySelector('#success-message').style.display = 'none';
    }, 3000);
</script>
@endif

@if(session('error'))
<div id="error-message" class="alert-message alert-error">
    {{ session('error') }}
</div>
<script>
    setTimeout(function() {
        document.querySelector('#error-message').style.display = 'none';
    }, 3000);
</script>
@endif

<div class="movie-detail-container">
    <div class="row">
        <div class="col-sm-4 poster-column">
            <img width=80% src="{{ $movies->poster }}" alt="{{ $movies->title }}">
        </div>
        <div class="col-sm-8 info-column">
            <h3>{{ $movies->title }}</h3>
            
            <p><strong>Año:</strong> {{ $movies->year }}</p>
            <p><strong>Director:</strong> {{ $movies->director }}</p>

            <div class="info-divider"></div>

            <p><strong>Resumen:</strong></p>
            <p>{{ $movies->synopsis }}</p>

            <div class="info-divider"></div>

            <p>
                <span class="status-badge {{ $movies->rented ? 'status-rented' : 'status-available' }}">
                    {{ $movies->rented ? '🎬 Película actualmente alquilada' : '✅ Película disponible' }}
                </span>
            </p>

            <div class="action-buttons">
                @if ($movies->rented && $movies->id_usuario !== Auth::id())
                <button class="btn btn-secondary" disabled>No disponible</button>

                @elseif ($movies->rented && $movies->id_usuario == Auth::id())
                <form action="{{ url('/return/movie/' . $movies->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger">Devolver Película</button>
                </form>
                @else
                <form action="{{ url('/rent/movie/' . $movies->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-info">Alquilar Película</button>
                </form>
                @endif

                @auth
                @if(auth()->user()->role)
                <a href="{{ url('/edit/movie/' . $movies->id) }}" class="btn btn-warning">Editar Película</a>

                <form action="{{ url('/delete/movie/' . $movies->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
                @endif
                @endauth

                <a href="{{ url('/index') }}"><button type="button" class="btn btn-light">← Volver al listado</button></a>
            </div>
        </div>
    </div>
</div>

@stop