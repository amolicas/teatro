@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Listado de reservas</h1>

    @if (Session::has('mensaje'))
    {{ Session::get('mensaje')}}
    @endif
    <br>

    <a href="{{ url('/reservas/fecha') }}">Crear nueva reserva</a>

    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Cantidad</th>
                <th>Butacas</th>
            </tr>
        </thead>

        <tbody>
            @foreach($reservas as $reserva)
            <tr>
                <td>{{ $reserva->id }}</td>
                <td>{{ $reserva->usuario_nombre }}</td>
                <td>{{ $reserva->fecha }}</td>
                <td>{{ $reserva->cantidad }}</td>
                <td>{{ $reserva->butacas }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ url('/reservas/consultar') }}">Volver a consultar</a>

</div>
@endsection