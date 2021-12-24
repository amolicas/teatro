@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Nuevo usuario</h1>
    <form action="{{ url('/user') }}" method="post">
        @csrf
        @include('user.form')
    </form>
</div>
@endsection