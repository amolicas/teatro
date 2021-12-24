@extends('layouts.app')

@section('content')
<div class="container">
    <h1>MENU PRINCIPAL</h1>
    <form action="{{ url('/user') }}" method="get">
        <input type="submit" value="Usuarios">
    </form>

    <form action="{{ url('/reservas') }}" method="get">
        <input type="submit" value="Reservas">
    </form>
</div>
@endsection