@extends('layouts.user')
@section('content')


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

            
                    <a href="{{ url('/user/show/' . $tareas->id) }}">
                        <button style="padding: 6px 12px; cursor:pointer;">Ver</button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@stop
