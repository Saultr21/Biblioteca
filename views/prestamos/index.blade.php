@extends("layaouts.tablas")
@section("header")
    <h1>Préstamos</h1>
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
        <form action="../../../Biblioteca/admin/prestamos/index.php" method="post">
            <div class="input-group">
                <label>
                    <input class="form-control" type="text" name="buscar">
                </label>
                <button class="btn btn-primary" type="submit"><i class="fa fa-search" aria-hidden="true"> Buscar</i>
                </button>
            </div>
        </form>

        <p><a class="btn btn-success btn-sm" href="../../../Biblioteca/admin/prestamos/nuevo.php"><i class="fa fa-plus-circle" aria-hidden="true"> Crear</i></a>
        </p>
    </div>

    <table class="table table-striped table-bordered">
        <tr>
            <th>Codigo</th>
            <th>Libro</th>
            <th>Usuario</th>
            <th>Fecha préstamo</th>
            <th>Fecha devolución</th>
            <th>Devuelto</th>
            <th colspan="2">Opciones</th>

        </tr>
        @foreach ($datos as $dato => $valor)
            <tr>
                <td>{{$valor['id']}}</td>
                <td>{{$valor['libro']}}</td>
                <td>{{$valor['usuario']}}</td>
                <td>{{$valor['fecha_prestamo']}}</td>
                <td>{{$valor['fecha_devolucion']}}</td>
                <?php $negativo = $valor['dias_restantes'] * -1 ?>
                <td>
                    @if($valor['devuelto'] !="0000-00-00")
                        {{$valor['devuelto']}}
                    @elseif($valor['dias_restantes'] >= 0)
                            Dias restantes: {{$valor['dias_restantes']}}
                    @elseif($valor['dias_restantes'] < 0)
                            Dias de retraso: {{$negativo}}
                    @endif

                </td>
            <!-- Se utilizará más adelante para indicar si se quiere modificar o eliminar el registro -->
                <td><a class="btn btn-primary btn.sm" href="../../../Biblioteca/admin/prestamos/modificar.php?id={{$valor['id']}}&libro={{$valor['libro']}}"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                <td><a class="btn btn-danger btn.sm" onclick="alerta()"
                       href="../../../Biblioteca/admin/prestamos/borrar.php?id={{$valor['id']}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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