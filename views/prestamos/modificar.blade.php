@extends("layaouts.tablas")
@section("header")
    <h1>Préstamos</h1>
@endsection

@section("tabla")
    <h1>Modificar préstamos</h1>

    <form method="post" action="">
        <p>
            <label for="titulo">Titulo</label>
            <input id="titulo" type="text" name="titulo" value="<?= $_REQUEST['libro'] ?>" disabled>
        </p>
        <p>
            <input type="hidden" id="id_libro" name="id_libro" value="{{$datos['id_libro']}}">
        </p>
        <select name="id_usuario">
            <option>Usuario</option>
            @foreach($usuarios as $u)
                <option value="{{$u["id"]}}" {{ $u["id"] == $datos['id_usuario'] ? 'selected' : '' }}>{{$u["first_name"]}}</option>
            @endforeach
        </select>
        <br><br>
        <p>
            <label for="fecha_prestamo">Fecha de prestamo</label>
            <input type="date" id="fecha_prestamo" name="fecha_prestamo" value="{{$datos['fecha_prestamo']}}">
        </p>
        <p>
            <label for="fecha_devolucion">Fecha de devolución</label>
            <input type="date" id="fecha_devolucion" name="fecha_devolucion" value="{{$datos['fecha_devolucion']}}">
        </p>
        <p>
            <label for="devuelto">Devuelto el: </label>
            <input type="date" id="devuelto" name="devuelto" value="{{$datos['devuelto']}}">
        </p>
        <br><br>

        <p>
            <input type="hidden" name="codigo" value="<?= $id ?>">
            <input type="submit" value="Modificar">
            <a href="index.php">Cancelar</a>
        </p>
    </form>
@endsection