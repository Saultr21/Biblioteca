@extends("layaouts.tablas")
@section("header")
    <h1>Libros</h1>
@endsection

@section("tabla")
    <?php
    if (isset($_SESSION["mensaje"])) { ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?= $_SESSION["mensaje"] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    </div>

    <?php } ?>
    <div class="d-flex justify-content-between mb-2">
        <form action="../../../Biblioteca/admin/libros/index.php" method="post">
            <div class="input-group">
                <label>
                    <input class="form-control" type="text" name="buscar">
                </label>
                <button class="btn btn-primary" type="submit"><i class="fa fa-search" aria-hidden="true"> Buscar</i>
                </button>
            </div>
        </form>

        <p><a class="btn btn-success btn-sm" href="../../../Biblioteca/admin/libros/nuevo.php"><i class="fa fa-plus-circle" aria-hidden="true"> Crear</i></a>
        </p>
    </div>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Codigo</th>
            <th>Titulo</th>
            <th>Autor</th>
            <th>Categoria</th>
            <th>Editorial</th>
            <th>Foto</th>
            <th>Disponible</th>
            <th colspan="2">Opciones</th>

        </tr>
        @foreach ($datos as $dato => $valor)
            <tr>
                <td>{{$valor['codigo']}}</td>
                <td>{{$valor['titulo']}}</td>
                <td>{{$valor['autor']}}</td>
                <td>{{$valor['categoria']}}</td>
                <td>{{$valor['editorial']}}</td>
                <td><img src="../imagenes/{{$valor['foto']}}" width="100px" height="100px"></td>
                <td><?=$valor['disponible'] ? "Si" : "No"; ?> </td>
                <!-- Se utilizará más adelante para indicar si se quiere modificar o eliminar el registro -->
                <td><a class="btn btn-primary btn.sm" href="../../../Biblioteca/admin/libros/modificar.php?codigo={{$valor['codigo']}}"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                <td><a class="btn btn-danger btn.sm" onclick="alerta()"
                       href="../../../Biblioteca/admin/libros/borrar.php?codigo={{$valor['codigo']}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
            </tr>
        @endforeach
    </table>


    </div>
    <div class="container text-center mt-5">
        <p><a class="btn btn-primary text-center" href="../../../Biblioteca/admin/index.php">Volver</a></p>
    </div>


    <script>
        function alerta() {
            let mensaje;
            const opcion = confirm("Clicka en Aceptar o Cancelar");
            if (opcion === true) {
                mensaje = "Has clickado OK";
            } else {
                mensaje = "Has clickado Cancelar";
            }
            document.getElementById("ejemplo").innerHTML = mensaje;
        }
    </script>
@endsection