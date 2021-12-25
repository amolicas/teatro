@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Usuarios</h1>

    @if (Session::has('mensaje'))
    {{ Session::get('mensaje')}}
    @endif
    <br>

    <a href="{{ url('/user/create') }}">Crear nuevo usuario</a>

    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th colspan="2" class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->nombre }}</td>
                <td>{{ $user->apellidos }}</td>
                <td>{{ $user->email }}</td>
                <td class="text-center">
                    <form action="{{ url('/user/' . $user->id . '/edit') }}" method="get">
                        @csrf
                        <input type="submit" value="Editar">
                    </form>
                </td>
                <td class="text-center">
                    <form action="{{ url('/user/' . $user->id) }}" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input type="submit" onclick="return confirm('¿Estas seguro que quieres borrar?')" value="Borrar">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ url('/') }}">Menu principal</a>

</div>
@endsection