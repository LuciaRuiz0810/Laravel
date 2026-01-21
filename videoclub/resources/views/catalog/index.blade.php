@extends('layouts.master')
@section('content')
<!-- Mensajes de éxito o error durante 3s -->
@if(session('success'))
<div id="success-message" style="color: green; padding: 10px; border: 1px solid green;">
    {{ session('success') }}
</div>
<script>
    setTimeout(function() {
        document.querySelector('success-message').style.display = 'none';
    }, 3000);
</script>
@endif

@if(session('error'))
<div id="error-message" style="color: red; padding: 10px; border: 1px solid red;">
    {{ session('error') }}
</div>
<script>
    setTimeout(function() {
        document.querySelector('error-message').style.display = 'none';
    }, 3000);
</script>
@endif
<div class="row">

    @if($movies->isEmpty())
    <p>No hay películas para listar!</p>
    @else
    @foreach( $movies as $movie => $pelicula )
    <div class="col-xs-6 col-sm-4 col-md-3 text-center">
        <a href="{{ url('/catalog/show/' . $pelicula->id ) }}">
            <img src="{{ $pelicula->poster }}" style="height:380px" />
            <span style="min-height:45px;margin:5px 0 10px 0">
                {{$pelicula->title}}
            </span>
        </a>
    </div>
    @endforeach
    @endif
</div>
@stop