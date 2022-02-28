@extends("layaouts.tablas")
@section("header")
    <h1>Editoriales</h1>
@endsection

@section("tabla")
    <h1>Modificar Editorial</h1>

    <form method="post">
        <p>
            <label for="nombre">Nombre Editorial</label>
            <input id="nombre" type="text" name="nombre" value="<?= $datos['nombre'] ?>">
        </p>

        <p>
            <input type="hidden" name="id_editorial" value="<?= $id_editorial ?>">
            <input type="submit" value="Modificar">
            <a href="index.php">Cancelar</a>
        </p>
    </form>
@endsection