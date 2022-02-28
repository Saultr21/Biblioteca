@extends("layaouts.tablas")
@section("header")
    <h1>Autores</h1>
@endsection

@section("tabla")
    <h1>Añadir autor</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <p>
            <label for="nombre">Nombre Autor</label>
            <input id="nombre" type="text" name="nombre">
        </p>
        <p>
            <label for="apellidos">Apellidos</label>
            <input id="apellidos" type="text" name="apellidos">
        </p>
        <p>
            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento">
        </p>
        <p>
            <label for="fecha_fallecimiento">Fecha de fallecimiento</label>
            <input type="date" id="fecha_fallecimiento" name="fecha_fallecimiento">
        </p>
        <p>
            <label for="lugar_nacimiento">Lugar de nacimiento</label>
            <input id="lugar_nacimiento" type="text" name="lugar_nacimiento">
        </p>
        <p>
            <label for="biografia">Biografia</label>
            <input id="biografia" type="text" name="biografia">
        </p>
        <p>
        <div>
            <h5>Foto de perfil:<br><input class="form-control" id="foto" name="foto" type="file"/></h5>
        </div>
        </p>


        <p>
            <input class="btn btn-primary btn-sm" type="submit" value="Guardar">
            <a class="btn btn-secondary btn-sm" href="index.php">Cancelar</a>
        </p>
    </form>
@endsection