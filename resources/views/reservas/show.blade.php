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
                <th colspan="2" class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($reservas as $reserva)
            <tr>
                <td>{{ $reserva->id }}</td>
                <td>{{ $reserva->email }}</td>
                <td>{{ $reserva->fecha }}</td>
                <td>{{ $reserva->cantidad }}</td>
                <td>{{ $reserva->butacas }}</td>
                <td class="text-center">
                    <form action="{{ url('/reservas/' . $reserva->id . '/edit') }}" method="get">
                        @csrf
                        <input type="hidden" name='fecha' id="fecha" value="{{ $reserva->fecha }}">
                        <input type="submit" onclick="return confirm('Se borrará la reserva y se abrirá una nueva. ¿Deseas continuar?')" value="Editar">
                    </form>
                </td>
                <td class="text-center">
                    <form action="{{ url('/reservas/' . $reserva->id) }}" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input type="submit" onclick="return confirm('¿Estas seguro que quieres borrar?')" value="Borrar">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ url('/reservas/consultar') }}">Volver a consultar</a>

</div>
@endsection