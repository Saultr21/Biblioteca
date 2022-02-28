@extends("layaouts.tablas")
@section("header")
    <h1>Sanciones</h1>
@endsection

@section("tabla")
    <h1>Modificar sanción</h1>

    <form method="post" action="">
        Usuario:
        <select name="id_usuario">
            <option>Usuario</option>
            @foreach($usuarios as $u)
                <option value="{{$u["id"]}}" {{ $u["id"] == $datos['id_usuario'] ? 'selected' : '' }}>{{$u["first_name"]}}</option>
            @endforeach
        </select>
        <br><br>
        <p>
            <label for="motivo">Motivo: </label>
            <input type="text" id="motivo" name="motivo" value="{{$datos['motivo']}}">
        </p>
        <p>
            <label for="fecha_inicio">Fecha de inicio: </label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{$datos['fecha_inicio']}}">
        </p>
        <p>
            <label for="fecha_fin">Fecha de fin: </label>
            <input type="date" id="fecha_fin" name="fecha_fin" value="{{$datos['fecha_fin']}}">
        </p>

        <br><br>



        <p>
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="submit" value="Modificar">
            <a href="index.php">Cancelar</a>
        </p>
    </form>
@endsection