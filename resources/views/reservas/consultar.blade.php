@extends('layouts.app')

@section('content')
<div class="container">
    @if (Session::has('mensaje'))
    {{ Session::get('mensaje')}}
    @endif

    <h1>Rellene una fecha o/y un usuario y pulse para consultar</h1>

    <form action="{{ url('/reservas/show') }}" method="get">
        <label for="usuario">Usuario</label>
        <select name="usuario" id="usuario">
            <option value="">Sin seleccion</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->nombre . ' '  .  $user->apellidos }}</option>
            @endforeach
        </select>
        <input type="hidden" name="fecha" id="fecha" value="{{ $fechaformat }}">
        <br>
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha">
        <input type="submit" value="Aceptar">
    </form>

    <a href="{{ url('/reservas') }}">Volver reservas</a>

</div>

@endsection