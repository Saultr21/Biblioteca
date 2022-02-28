@extends("layaouts.usuario")
@section("header")
    <h1>Panel de usuario</h1>

@endsection

@section("content")
    @if(isset($_SESSION['usuario']['id']))
    <div class="mt-4 border">
        <h3>Información del usuario: </h3>
        @foreach($datos as $dato)
        <p>Nombre: {{$dato['first_name']}}</p>
        <p>Apellidos: {{$dato['last_name']}}</p>
        <p>Correo: {{$dato['email']}}</p>
        @endforeach
    </div>

    <div>
        <div class="mt-4 border">
        <h3>Préstamos Activos: </h3>
            <hr>
            @if(empty($prestamos))
                No hay préstamos activos
            @endif
        @foreach($nombres as $nombre)
            <div>
           <p>Libro: {{$nombre['titulo']}}</p>
            <p>Fecha de préstamo: {{$nombre['fecha_prestamo']}}</p>
                <p>Fecha de devolución: {{$nombre['fecha_devolucion']}}</p>
            </div>
            <hr>
        @endforeach
        </div>
        <div class="mt-4 border">
            <h3>Sanciones: </h3>
            <hr>
            @if(empty($sanciones))
                No hay sanciones activas
            @endif
            @foreach($sanciones as $sancion)
                <div>
                    <p>Fecha de inicio: {{$sancion['fecha_inicio']}}</p>
                    <p>Fecha de fin: {{$sancion['fecha_fin']}}</p>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
    @else
    <p>No se ha iniciado la sesión</p>
    @endif
@endsection
@section("contenido")
    <p><a class="btn btn-primary text-center" href="../../../Biblioteca/index.php">Volver</a></p>
@endsection