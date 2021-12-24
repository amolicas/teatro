@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Rellene una fecha o/y un usuario y pulse para consultars</h1>

    <form action="{{ url('/reservas/show') }}" method="get">
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" id="usuario">
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha">
        <input type="submit" value="Aceptar">
    </form>

    <a href="{{ url('/reservas') }}">Volver reservas</a>

</div>

@endsection