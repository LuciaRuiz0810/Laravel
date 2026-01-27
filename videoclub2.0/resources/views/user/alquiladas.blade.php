@extends('layouts.master')
@section('content')

<!-- Mensajes de éxito o error durante 3s -->
@if(session('success'))
<div id="success-message" style="color: green; padding: 10px; border: 1px solid green; margin-bottom: 20px; border-radius: 5px; background-color: #f0fff0;">
    {{ session('success') }}
</div>
<script>
    setTimeout(function() {
        document.querySelector('#success-message').style.display = 'none';
    }, 3000);
</script>
@endif

@if(session('error'))
<div id="error-message" style="color: red; padding: 10px; border: 1px solid red; margin-bottom: 20px; border-radius: 5px; background-color: #fff0f0;">
    {{ session('error') }}
</div>
<script>
    setTimeout(function() {
        document.querySelector('#error-message').style.display = 'none';
    }, 3000);
</script>
@endif

<!-- Cabecera del usuario -->
<div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; border-radius: 10px; margin-bottom: 40px; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <h1 style="margin: 0; font-size: 28px; display: flex; align-items: center; gap: 10px;">
        <i class="fas fa-user-circle"></i> {{ $user->name }}
    </h1>
    <p style="margin: 10px 0 0 0; opacity: 0.9; display: flex; align-items: center; gap: 10px;">
        <i class="fas fa-envelope"></i> {{ $user->email }}
    </p>
    <div style="margin-top: 15px; display: flex; align-items: center; gap: 10px; background: rgba(255,255,255,0.1); padding: 10px 15px; border-radius: 20px; width: fit-content;">
        <i class="fas fa-film"></i>
        <span>{{ $peliculas->count() }} películas alquiladas</span>
    </div>
</div>

@if($peliculas->count() > 0)
<!-- Grid de películas -->
<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 25px; padding: 20px 0;">
    
    @foreach($peliculas as $pelicula)
    <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.08); transition: all 0.3s ease; position: relative;">
        
        <!-- Badge de alquilada -->
        <div style="position: absolute; top: 10px; right: 10px; background: #4CAF50; color: white; padding: 5px 10px; border-radius: 15px; font-size: 12px; font-weight: bold; z-index: 2; display: flex; align-items: center; gap: 5px;">
            <i class="fas fa-check-circle"></i> Alquilada
        </div>
        
        <!-- Imagen de la película -->
        <div style="height: 250px; overflow: hidden; position: relative;">
            @if($pelicula->poster && filter_var($pelicula->poster, FILTER_VALIDATE_URL))
            <img src="{{ $pelicula->poster }}" 
                 alt="{{ $pelicula->title }}"
                 style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
            @elseif($pelicula->poster)
            <img src="{{ asset('storage/' . $pelicula->poster) }}" 
                 alt="{{ $pelicula->title }}"
                 style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
            @else
            <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); display: flex; flex-direction: column; align-items: center; justify-content: center; color: #666;">
                <i class="fas fa-film" style="font-size: 48px; margin-bottom: 10px;"></i>
                <span style="font-size: 14px;">Sin imagen</span>
            </div>
            @endif
            
            <!-- Efecto hover -->
            <div style="position: absolute; inset: 0; background: rgba(0,0,0,0); transition: background 0.3s ease;"></div>
        </div>
        
        <!-- Información de la película -->
        <div style="padding: 20px;">
            <h3 style="margin: 0 0 10px 0; font-size: 18px; color: #333; line-height: 1.3; height: 46px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                {{ $pelicula->title }}
            </h3>
            
            <div style="display: flex; flex-direction: column; gap: 8px; font-size: 14px; color: #666;">
                <div style="display: flex; align-items: center; gap: 5px;">
                    <i class="fas fa-calendar-alt" style="color: #667eea;"></i>
                    <span>{{ $pelicula->year }}</span>
                </div>
                
                <div style="display: flex; align-items: center; gap: 5px;">
                    <i class="fas fa-user-tie" style="color: #667eea;"></i>
                    <span style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $pelicula->director }}</span>
                </div>
            </div>
            
      
        </div>
        
        <!-- Efecto hover en toda la tarjeta -->
        <div style="position: absolute; inset: 0; border: 2px solid transparent; border-radius: 12px; transition: border-color 0.3s ease; pointer-events: none;"></div>
    </div>
    
    <style>
        /* Efectos hover */
        div[style*="background: white; border-radius: 12px;"]:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        
        div[style*="background: white; border-radius: 12px;"]:hover img {
            transform: scale(1.05);
        }
        
        div[style*="background: white; border-radius: 12px;"]:hover div[style*="position: absolute; inset: 0; background: rgba(0,0,0,0);"] {
            background: rgba(0,0,0,0.1);
        }
        
        div[style*="background: white; border-radius: 12px;"]:hover div[style*="position: absolute; inset: 0; border: 2px solid transparent;"] {
            border-color: #667eea;
        }
        
        button[style*="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"]:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }
    </style>
    @endforeach
</div>

@else
<!-- Estado vacío -->
<div style="text-align: center; padding: 60px 20px; background: white; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
    <div style="font-size: 80px; color: #e0e0e0; margin-bottom: 20px;">
        <i class="fas fa-film"></i>
    </div>
    <h3 style="color: #666; margin-bottom: 10px;">No hay películas alquiladas</h3>
    <p style="color: #999; max-width: 400px; margin: 0 auto 30px;">
        {{ $user->name }} no tiene películas alquiladas en este momento.
    </p>
</div>
@endif


@stop