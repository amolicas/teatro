@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reservas</h1>

    Estado teatro por fecha
    Consultar reserva por usuario
    Nueva reserva

    <form action="{{ url('/user') }}" method="get">
        <input type="submit" value="Usuarios">
    </form>

    <form action="{{ url('/reservas') }}" method="get">
        <input type="submit" value="Reservas">
    </form>
</div>
@endsection