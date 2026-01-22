@extends('layouts.master')
@section('content')

<h2>Detalles de la Tarea</h2>

    <p><strong>Nombre:</strong> {{ $tarea->nombre }}</p>
    <p><strong>Estado:</strong> {{ $tarea->estado }}</p>
    <p><strong>Responsable:</strong> {{ $tarea->responsable }}</p>

    <a href="{{ url('/index') }}">Volver a la lista de tareas</a>
@stop