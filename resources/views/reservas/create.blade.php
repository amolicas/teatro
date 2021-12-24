@extends('layouts.app')

@section('content')
<div class="container">
    <form action="" method="post">
        <table class="table table-light">
            <?php
                for ($f=1; $f < 6; $f++) {
                    echo "<tr>"; 
                    for ($c=1; $c < 11; $c++) { 
                        echo "<td>" . "B" . $f . "-" . $c . "</td>";
                    }
                    echo "</tr>";
                }
            ?>
        </table>
        <label for="usuario_id">Usuario</label>
        <input type="text" name="Usuario">
        <br>
        <label for="usuario_id">Usuario</label>
        <input type="text" name="Usuario">
        <br>
        
        <h1>Butaca</h1>
        <label for="fila">Fila</label>
        <input type="text" name="NumeroPersonas">
        <br>

        <label for="columna">Columna</label>
        <input type="text">
        <br>
    </form>
</div>
@endsection