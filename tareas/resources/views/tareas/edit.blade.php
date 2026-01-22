@extends('layouts.master')
@section('content')
<h2>Modificar Tarea {{ $tarea->nombre }}</h2>

<form action="/tareas/edit/{{ $tarea->id }}/new" method="POST">
    @method('PUT')
    @csrf
    
    <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->

    <label for="nombre">Nombre de la tarea:</label><br>
    <input type="text" id="nombre" name="nombre" value="{{ $tarea->nombre }}"><br><br>

    <label for="estado">Estado:</label><br>
    <select id="estado" name="estado" value="{{ $tarea->estado }}">
        <option value="completada">Completada</option>
        <option value="incompletada">Incompletada</option>
    </select><br><br>


    <label for="responsable">Responsable:</label><br>
    <input type="text" id="responsable" name="responsable"  value="{{ $tarea->responsable }}"><br><br>


    <button type="submit">Modificar Tarea</button>
    <br>
    @error('nombre')<span style="color: red">{{ $message }}</span>@enderror
    <br>
    @error('responsable')<span style="color: red">{{ $message }}</span>@enderror

</form>
@stop