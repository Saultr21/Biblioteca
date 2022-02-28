@extends("layaouts.modificar")
@section("header")
    <h1>Usarios</h1>
@endsection

@section("tabla")
    <h1>Modificar Usuario</h1>

    <form method="post">
        <p>
            <label for="first_name">Nombre Usuario</label>
            <input id="first_name" type="text" name="first_name" value="<?= $datos['first_name'] ?>">
        </p>
        <p>
            <label for="last_name">Apellidos</label>
            <input id="last_name" type="text" name="last_name" value="<?= $datos['last_name'] ?>">
        </p>
        <p>
            <label for="email">Correo</label>
            <input id="email" type="text" name="email" value="<?= $datos['email'] ?>">
        </p>
        <p>
            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password">
        </p>
        <br><br>

        <p>
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="submit" value="Modificar">
            <a href="index.php">Cancelar</a>
        </p>
    </form>
@endsection