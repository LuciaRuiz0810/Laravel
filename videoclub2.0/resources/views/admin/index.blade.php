@extends('layouts.master')
@section('content')

<style>
    /* Mensajes de alerta */
    .alert-message {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 25px;
        font-weight: 500;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
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

    /* Contenedor de películas */
    .movies-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 25px;
        padding: 20px 0;
    }

    /* Card de película */
    .movie-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
    }

    .movie-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        text-decoration: none;
    }

    .movie-poster {
        width: 100%;
        height: 380px;
        object-fit: cover;
        background-color: #f0f0f0;
    }

    .movie-title {
        padding: 15px;
        text-align: center;
        min-height: 65px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: #333;
        line-height: 1.4;
    }

    /* Estado vacío */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .empty-state i {
        font-size: 64px;
        color: #ddd;
        margin-bottom: 20px;
    }

    .empty-state p {
        font-size: 18px;
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .movies-container {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
        }

        .movie-poster {
            height: 280px;
        }

        .movie-title {
            padding: 12px;
            min-height: 55px;
            font-size: 14px;
        }


        
    }
    .no-image-placeholder {
        width: 100%;
        height: 380px; /* Ajusta según el height de tu .movie-poster */
        background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #9e9e9e;
        border: 2px dashed #d0d0d0;
        transition: all 0.3s ease;
    }

    .no-image-placeholder:hover {
        background: linear-gradient(135deg, #eeeeee 0%, #d5d5d5 100%);
        border-color: #b0b0b0;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .no-image-icon {
        font-size: 48px;
        margin-bottom: 15px;
        opacity: 0.7;
    }

    .no-image-text {
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #757575;
    }

    /* Para mantener consistencia con movie-poster */
    .movie-poster {
        width: 100%;
        height: 380px;
        object-fit: cover;
        background-color: #f0f0f0;
        border-radius: 8px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .no-image-placeholder,
        .movie-poster {
            height: 280px;
        }
        
        .no-image-icon {
            font-size: 36px;
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

@if($movies->isEmpty())
<div class="empty-state">
    <i class="fas fa-film"></i>
    <p>No hay películas para listar!</p>
</div>
@else
<div class="movies-container">
    @foreach( $movies as $movie => $pelicula )
    <a href="{{ url('/movie/show/' . $pelicula->id ) }}" class="movie-card">
        <!--Si hay iamgen -->
        @if($pelicula->poster)
         <!-- Si es con URL externa -->
        @if(filter_var($pelicula->poster, FILTER_VALIDATE_URL))
        
        <img src="{{ $pelicula->poster }}" alt="{{ $pelicula->title }}" class="movie-poster" />
        @else
        <!-- Si es con Ruta local -->
        <img src="{{ asset('storage/' . $pelicula->poster) }}" alt="{{ $pelicula->title }}" class="movie-poster" />
        @endif
        @else
      <div class="no-image-placeholder">
        <div class="no-image-icon">
            <i class="fas fa-film"></i>
        </div>
        <div class="no-image-text">No Image</div>
    </div>
        @endif
        <div class="movie-title">
            {{$pelicula->title}}
        </div>
    </a>
    @endforeach
</div>
@endif

@stop