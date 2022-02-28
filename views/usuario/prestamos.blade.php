@extends("layaouts.usuario")
@section("header")
    <h1>Panel de usuario</h1>

@endsection

@section("content")
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
@endsection
@section("contenido")
    <p><a class="btn btn-primary text-center" href="../../../Biblioteca/index.php">Volver</a></p>
@endsection