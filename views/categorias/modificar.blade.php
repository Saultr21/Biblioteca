@extends("layaouts.tablas")
@section("header")
    <h1>Categorias</h1>
@endsection

@section("tabla")
    <h1>Modificar Libro</h1>

    <form method="post">
        <p>
            <label for="nombre">Nombre Categoría</label>
            <input id="nombre" type="text" name="nombre" value="{{$datos['nombre']}}">
        </p>

        <p>
            <input type="hidden" name="id" value="{{$id_categoria}}">
            <input type="submit" value="Modificar">
            <a href="../../../Biblioteca/admin/categorias/index.php">Cancelar</a>
        </p>
    </form>
@endsection