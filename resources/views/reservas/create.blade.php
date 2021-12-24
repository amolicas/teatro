@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nueva reserva para {{ $fecha }}</h1>

    <form action="{{ url('/reservas') }}" method="post">
    @csrf
        <div>Selecciona el usuario</div>
        <select name="usuario" id="usuario">
            @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->nombre . ' '  .  $user->apellidos }}</option>
            @endforeach
        </select>
        <input type="hidden" name="fecha" id="fecha" value="{{ $fechaformat }}">
        <br>

        <div>Selecciona las butacas</div>
        <table class="table table-light">
            <thead class="thead-dark center">
                <tr>
                    <th class="text-center" colspan="10">ESCENARIO</th>
                </tr>
            </thead>
            <tbody>
                @for($f=1; $f < 6; $f++)
                    <tr>
                    @for ($c=1; $c < 11; $c++)
                    <td>
                        @if(!in_array('F' . $f . 'C' . $c, $butacas))
                            <input type="checkbox" name="{{ 'F' . $f . 'C' . $c }}" id="{{ 'F' . $f . 'C' . $c }}" value="{{ 'F' . $f . 'C' . $c }}">
                            <label class="text-succes" for="{{ 'F' . $f . 'C' . $c }}">{{ 'F' . $f . 'C' . $c }}</label>
                        @else
                            &nbsp;&nbsp;<label class="text-danger" for="{{ 'F' . $f . 'C' . $c }}">{{ 'F' . $f . 'C' . $c }}</label>
                        @endif
                        
                    </td>
                    @endfor
                    </tr>
                @endfor
            </tbody>
        </table>
        <input type="submit" value="Aceptar">
    </form>
    <a href="{{ url('/reservas') }}">Volver</a>
</div>
@endsection

