@extends("layaouts.tablas")
@section("header")
    <h1>Autores</h1>
@endsection

@section("tabla")
    <h1>Modificar Autor</h1>

    <form method="post">
        <p>
            <label for="nombre">Nombre Autor</label>
            <input id="nombre" type="text" name="nombre" value="<?= $datos['nombre'] ?>">
        </p>
        <p>
            <label for="apellidos">Apellidos</label>
            <input id="apellidos" type="text" name="apellidos" value="<?= $datos['apellidos'] ?>">
        </p>
        <p>
            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= $datos['fecha_nacimiento'] ?>">
        </p>
        <p>
            <label for="fecha_fallecimiento">Fecha de fallecimiento</label>
            <input type="date" id="fecha_fallecimiento" name="fecha_fallecimiento" value="<?= $datos['fecha_fallecimiento'] ?>">
        </p>
        <p>
            <label for="lugar_nacimiento">Lugar de nacimiento</label>
            <input id="lugar_nacimiento" type="text" name="lugar_nacimiento" value="<?= $datos['lugar_nacimiento'] ?>">
        </p>
        <p>
        <p>Biografia:</p>
        <p><textarea name="biografia" cols="40" rows="5"><?= $datos['biografia'] ?></textarea></p>
        <div>
            <p>Foto de perfil:<br><input class="form-control" id="foto" name="foto" type="file"/></p>
        </div>
        </p>

        <p>
            <input type="hidden" name="id_autor" value="<?= $id_autor ?>">
            <input type="submit" value="Modificar">
            <a href="index.php">Cancelar</a>
        </p>
    </form>
@endsection