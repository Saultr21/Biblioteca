@extends("layaouts.tablas")
@section("header")
    <h1>Usuarios</h1>
@endsection

@section("tabla")
    <h1>Añadir usuario</h1>

    <form action="" method="post">
        <p>
            <label for="first_name">Nombre Usuario</label>
            <input id="first_name" type="text" name="first_name">
        </p>
        <p>
            <label for="last_name">Apellidos</label>
            <input id="last_name" type="text" name="last_name">
        </p>
        <p>
            <label for="email">Correo</label>
            <input id="email" type="text" name="email">
        </p>
        <p>
            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password">
        </p>
        <select name="tipo">
            <option>Tipo </option>
            <option value="admin">Admin</option>
            <option value="usuario">Usuario</option>
        </select>
        <br><br>

        <p>
            <input class="btn btn-primary btn-sm" type="submit" value="Guardar">
            <a class="btn btn-secondary btn-sm" href="index.php">Cancelar</a>
        </p>
    </form>
@endsection