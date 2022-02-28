@extends("layaouts.tablas")
@section("header")
    <h1>Categorias</h1>
@endsection

@section("tabla")
    <h1>Añadir categoria</h1>

    <form action="" method="post">
        <p>
            <label for="nombre">Nombre categoria</label>
            <input class="form-control" id="nombre" type="text" name="nombre">
        </p>


        <p>
            <input class="btn btn-primary btn-sm" type="submit" value="Guardar">
            <a class="btn btn-secondary btn-sm" href="../../../Blog/admin/categorias/index.php">Cancelar</a>
        </p>
    </form>
@endsection