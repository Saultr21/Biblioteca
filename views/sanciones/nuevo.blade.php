@extends("layaouts.tablas")
@section("header")
    <h1>Sanciones</h1>
@endsection

@section("tabla")
    <h1>Añadir sanción</h1>

    <form action="" method="post">
        <form method="post" action="">
            <br>
            Usuario:
            <select name="id_usuario">
                <option>Usuario</option>
                @foreach($usuarios as $u)
                    <option value="{{$u["id"]}}">{{$u["first_name"]}}</option>
                @endforeach
            </select>
            <br><br>
            <p>
                <label for="motivo">Motivo</label>
                <input type="text" id="motivo" name="motivo">
            </p>
            <br><br>


        <p>
            <input class="btn btn-primary btn-sm" type="submit" value="Guardar">
            <a class="btn btn-secondary btn-sm" href="index.php">Cancelar</a>
        </p>
    </form>
@endsection