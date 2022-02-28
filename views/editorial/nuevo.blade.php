@extends("layaouts.tablas")
@section("header")
    <h1>Edioriales</h1>
@endsection

@section("tabla")
    <h1>Añadir editorial</h1>

    <form action="" method="post">
        <p>
            <label for="nombre">Nombre editorial</label>
            <input class="form-control" id="nombre" type="text" name="nombre">
        </p>


        <p>
            <input class="btn btn-primary btn-sm" type="submit" value="Guardar">
            <a class="btn btn-secondary btn-sm" href="index.php">Cancelar</a>
        </p>
    </form>
@endsection