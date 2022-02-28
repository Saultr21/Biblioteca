@extends("layaouts.tablas")
@section("header")
    <h1>Préstamos</h1>
@endsection

@section("tabla")
    <h1>Añadir préstamo</h1>

    <form action="" method="post">
        <form method="post" action="">
            <select name="id_libro">
                <option>Libro</option>
                @foreach($libro as $l)
                    <option value="{{$l["codigo"]}}">{{$l["titulo"]}}</option>
                @endforeach
            </select>
            <br><br>

            <select name="id_usuario">
                <option>Usuario</option>
                @foreach($usuarios as $u)
                    @foreach($max_prestamos as $max)
                        @if($max['id_usuario'] != $u['id'])
                        <option value="{{$u["id"]}}">{{$u["first_name"]}}</option>
                        @endif
                    @endforeach
                @endforeach
            </select>
            <br><br>
            <p>
                <label for="fecha_devolucion">Fecha de devolución</label>
                <input type="date" id="fecha_devolucion" name="fecha_devolucion">
            </p>
            <br><br>



        <p>
            <input class="btn btn-primary btn-sm" type="submit" value="Guardar">
            <a class="btn btn-secondary btn-sm" href="index.php">Cancelar</a>
        </p>
    </form>
@endsection

