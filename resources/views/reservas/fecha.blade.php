@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Seleccione una fecha</h1>

    <form action="{{ url('/reservas/create') }}" method="get">
        <input type="date" name="fecha" id="fecha">
        <input type="submit" value="Aceptar">
    </form>

    <a href="{{ url('/reservas') }}">Volver reservas</a>

</div>

@endsection