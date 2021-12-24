@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reservas</h1>

    @if (Session::has('mensaje'))
    {{ Session::get('mensaje')}}
    @endif

    <form action="{{ url('/reservas/show') }}" method="get">
        <input type="submit" value="Consulta reserva (por usuario)">
    </form>

    <form action="{{ url('/reservas/create') }}" method="get">
        <input type="submit" value="Nueva reserva">
        <input type="date" name="fecha" id="fecha">
    </form>

    <a href="{{ url('/') }}">Menu principal</a>

</div>

@endsection