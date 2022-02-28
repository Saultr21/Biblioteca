
@extends("layaouts.plantilla")
{{--Cabecera--}}
@section("header")
    <h1>Biblioteca</h1>
    @if(empty($_SESSION['usuario']['id']))
    <div class="container text-center mt-5">
        <p>No estás logeado</p>
        <p><a class="btn btn-primary text-center" href="../../../Biblioteca/login.php">Login</a></p>
    </div>
    @else
        <p class="mt-3">Sesión iniciada con: <?php echo ucfirst($_SESSION['usuario']['first_name']); ?></p>
        <p><a href="../usuario/index.php" class="btn btn-primary">Panel de usuario</a></p>
        <p><a href="../../../logout.php" class="btn btn-primary">Cerrar sesión</a></p>

    @endif
@endsection

{{--Entradas--}}
@section("content")
    @foreach ($libros as $libro)
        <div class="col">
        <div class="mt-4 p-4 border text-center">
            <img src="../../admin/imagenes/{{$libro['foto']}}" width="150px" height="150px">
            <br><br>
            <p>Titulo: {{$libro["titulo"]}}</p>
            <p>Autor: {{$libro["autor"]}}</p>
            <p>Disponible: <?=$libro['disponible'] ? "Si" : "No"; ?></p>
                </div>
        </div>
    @endforeach
@endsection