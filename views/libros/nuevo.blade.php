@extends("layaouts.tablas")
@section("header")
    <h1>Libros</h1>
@endsection

@section("tabla")
    <h1>Añadir libro</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <form method="post" action="">
            <p>
                <label for="titulo">Titulo</label>
                <input id="titulo" type="text" name="titulo">
            </p>
            Autor:
            <select name="id_autor">
                <option>Autor</option>
                @foreach($autor as $a)
                    <option value="{{$a["id_autor"]}}">{{$a["nombre"]}}</option>
                @endforeach
            </select>
            <br><br>
            Categoria:
            <select name="id_categoria">
                <option>Categoria</option>
                @foreach($categoria as $c)
                    <option value="{{$c["id_categoria"]}}">{{$c["nombre"]}}</option>
                @endforeach
            </select>
            <br><br>
            Editorial:
            <select name="id_editorial">
                <option>Editorial</option>
                @foreach($editorial as $e)
                    <option value="{{$e["id_editorial"]}}">{{$e["nombre"]}}</option>
                @endforeach
            </select>
            <br><br>
            <p>
            <div>
                <h5>Foto de perfil:<br><input class="form-control" id="foto" name="foto" type="file"/></h5>
            </div>
            </p>
            Disponible
            <select name="disponible">
                <option>Disponible </option>
                <option value="1">Si</option>
                <option value="0">No</option>
            </select>
            <br><br>


        <p>
            <input class="btn btn-primary btn-sm" type="submit" value="Guardar">
            <a class="btn btn-secondary btn-sm" href="index.php">Cancelar</a>
        </p>
    </form>
@endsection