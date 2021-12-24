<label for="nombre">Nombre</label>
<input type="text" name="nombre" id="nombre" value="{{ isset($user->nombre)?$user->nombre:'' }}">
<br>

<label for="apellidos">Apellidos</label>
<input type="text" name="apellidos" id="apellidos" value="{{ isset($user->apellidos)?$user->apellidos:'' }}">
<br>

<label for="email">Email</label>
<input type="text" name="email" id="email" value="{{ isset($user->email)?$user->email:'' }}">
<br>
<input type="submit" value="Guardar usuario">
<br>

<a href="{{ url('/user') }}">Volver</a>