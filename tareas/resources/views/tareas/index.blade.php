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
                <th style="padding: 12px; border: 1px solid #ddd;">Responsable</th>
                <th style="padding: 12px; border: 1px solid #ddd;">Estado</th>
                <th style="padding: 12px; border: 1px solid #ddd;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($array_listado_tareas as $tareas)
            <tr style="border: 1px solid #ddd;">
                <td style="padding: 12px;">{{ $tareas->nombre }}</td>
                <td style="padding: 12px;">{{ $tareas->responsable }}</td>
                <td style="padding: 12px;">{{ $tareas->estado }}</td>
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
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@stop
