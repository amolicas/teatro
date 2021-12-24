@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reservas</h1>

    @if (Session::has('mensaje'))
    {{ Session::get('mensaje')}}
    @endif

    <form action="{{ url('/reservas/consultar') }}" method="get">
        <input type="submit" value="Consultar reservas">
    </form>

    <form action="{{ url('/reservas/fecha') }}" method="get">
        <input type="submit" value="Nueva reserva">
    </form>

    <a href="{{ url('/') }}">Menu principal</a>

</div>

@endsection