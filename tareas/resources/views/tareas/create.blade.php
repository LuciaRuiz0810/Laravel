@extends('layouts.master')
@section('content')
<h2>Crear Nueva Tarea</h2>

<form action="/tareas/create/new" method="POST">
    @csrf
    <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->

    <label for="nombre">Nombre de la tarea:</label><br>
    <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"><br><br>

    <label for="estado">Estado:</label><br>
    <select id="estado" name="estado" value="{{ old('estado') }}">
        <option value="completada">Completada</option>
        <option value="incompletada">Incompletada</option>
    </select><br><br>


    <label for="responsable">Responsable:</label><br>
    <input type="text" id="responsable" name="responsable" value="{{ old('responsable') }}"><br><br>


    <button type="submit">Crear Tarea</button>
    <br>
    @error('nombre')<span style="color: red">{{ $message }}</span>@enderror
    <br>
    @error('responsable')<span style="color: red">{{ $message }}</span>@enderror

</form>
@stop