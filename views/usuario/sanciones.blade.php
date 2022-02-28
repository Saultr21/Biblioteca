@extends("layaouts.usuario")
@section("header")
    <h1>Panel de usuario</h1>

@endsection

@section("content")
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
@endsection
@section("contenido")
    <p><a class="btn btn-primary text-center" href="../../../Biblioteca/index.php">Volver</a></p>
@endsection