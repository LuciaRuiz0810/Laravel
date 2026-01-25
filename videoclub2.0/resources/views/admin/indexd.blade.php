@extends('layouts.master')
@section('content')

<!-- Mensajes de éxito o error durante 3s -->
@if(session('success'))
<div id="success-message" style="color: green; padding: 10px; border: 1px solid green; margin-bottom: 20px;">
    {{ session('success') }}
</div>
<script>
    setTimeout(function() {
        document.querySelector('#success-message').style.display = 'none';
    }, 3000);
</script>
@endif

@if(session('error'))
<div id="error-message" style="color: red; padding: 10px; border: 1px solid red; margin-bottom: 20px;">
    {{ session('error') }}
</div>
<script>
    setTimeout(function() {
        document.querySelector('#error-message').style.display = 'none';
    }, 3000);
</script>
@endif

<!-- Tabla centrada y más grande -->
<div style="display: flex; justify-content: center; margin-top: 30px;">
    <table style="border-collapse: collapse; width: 80%; font-size: 18px; text-align: left;">
        <thead>
            <tr style="background-color: #f4f4f4;">
                <th style="padding: 12px; border: 1px solid #ddd;">Nombre</th>
                <th style="padding: 12px; border: 1px solid #ddd;">Nacimiento</th>
                <th style="padding: 12px; border: 1px solid #ddd;">Nacionalidad</th>
                <th style="padding: 12px; border: 1px solid #ddd;">Biografía</th>
                <th style="padding: 12px; border: 1px solid #ddd;">Foto</th>
                <th style="padding: 12px; border: 1px solid #ddd;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($directors as $director)
            <tr style="border: 1px solid #ddd;">
                <td style="padding: 12px;">{{ $director->name }}</td>
                <td style="padding: 12px;">{{ $director->birth_date }}</td>
                <td style="padding: 12px;">{{ $director->nationality }}</td>
                <td style="padding: 12px;">{{ $director->biography }}</td>
                <!--Si hay iamgen -->

                @if($director->photo)
                <!-- Si es con URL externa -->
                @if(filter_var($director->photo, FILTER_VALIDATE_URL))

                <td style="padding: 12px;"><img src="{{ $director->photo }}" alt="{{ $director->name }}" class="movie-poster" /></td>
                @else
                <!-- Si es con Ruta local -->
                <td style="padding: 12px;"><img src="{{ asset('storage/' . $director->photo) }}" alt="{{ $director->name }}" class="movie-poster" width="100%" /></td>
                @endif
                @else
                <td style="padding: 12px;">
                    <div class="no-image-placeholder">
                        <div class="no-image-icon">
                            <i class="fas fa-film"></i>
                        </div>
                        <div class="no-image-text">No Image</div>
                    </div>
                </td>
                @endif
                <td style="padding: 12px;">
                    <a href="{{ url('/director/edit/' . $director->id) }}">
                        <button style="padding: 6px 12px; margin-right: 5px; cursor:pointer;">Editar</button>
                    </a>
                </td>
                @if($director->photo)
                <td style="padding: 12px;">
                    <form action="{{ url('/actors/image/' . $director->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar Imagen</button>
                    </form>
                </td>
                @endif
            </tr>
            <!-- {{-- Comentar blade y html
                <td style="padding: 12px;">
                    <a href="{{ url('/tareas/edit/' . $tareas->id) }}">
                        <button style="padding: 6px 12px; margin-right: 5px; cursor:pointer;">Editar</button>
                    </a>
                    <form action="{{ url('/tareas/delete/' . $tareas->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="padding: 6px 12px; margin-right: 5px; cursor:pointer; background-color: #f44336; color: white; border: none; border-radius: 4px;">Eliminar</button>
                    </form>
                    <a href="{{ url('/tareas/show/' . $tareas->id) }}">
                        <button style="padding: 6px 12px; cursor:pointer;">Ver</button>
                    </a>
                </td>
                 --}}
                -->
            @endforeach
        </tbody>
    </table>
</div>

@stop