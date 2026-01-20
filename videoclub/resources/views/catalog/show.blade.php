@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-sm-4">
        <img width=80% src="{{ $movies->poster }}" alt="{{ $movies->title }}">
    </div>
    <div class="col-sm-8">
        <h3>{{ $movies->title }}</h3>
        <p>Año: {{ $movies->year }}</p>
        <p>Director: {{ $movies->director }}</p>

        <p><strong>Resumen: </strong>{{ $movies->synopsis }}</p>
        <p>Estado: {{ $movies->rented ? 'Película actualmente alquilada' : 'Película sin alquilar' }}</p>

        @if ($movies->rented)
        <button type="button" class="btn btn-danger">Devolver Película</button>
        @else
        <button type="button" class="btn btn-info">Alquilar Película</button>
        @endif

        <!--url con el id de la película-->
        <a href="{{ url('catalog/edit/' . $movies->id) }}"><button type="button" class="btn btn-warning">Editar Película</button></a>
        <a href="{{ url('catalog/') }}"><button type="button" class="btn btn-light">Volver al listado</button></a>
    </div>
</div>

@stop