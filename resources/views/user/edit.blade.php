@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar usuario</h1>
    <form action="{{ url('/user/' . $user->id) }}" method="post">
        @csrf
        {{ method_field('PATCH') }}
        @include('user.form')
    </form>
</div>
@endsection