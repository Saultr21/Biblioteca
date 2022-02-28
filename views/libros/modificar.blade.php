@extends("layaouts.tablas")
@section("header")
    <h1>Libros</h1>
@endsection

@section("tabla")
    <h1>Modificar libro</h1>

    <form method="post" action="">
        <p>
            <label for="titulo">Titulo</label>
            <input id="titulo" type="text" name="titulo" value="<?= $datos['titulo'] ?>">
        </p>
        Autor:
        <select name="id_autor">
            <option>Autor</option>
            @foreach($autor as $a)
                <option value="{{$a["id_autor"]}}" {{ $a["id_autor"] == $datos['id_autor'] ? 'selected' : '' }}>{{$a["nombre"]}}</option>
            @endforeach
        </select>
        <br><br>
        Categoria:
        <select name="id_categoria">
            <option>Categoria</option>
            @foreach($categoria as $c)
                <option value="{{$c["id_categoria"]}}" {{ $c["id_categoria"] == $datos['id_categoria'] ? 'selected' : '' }}>{{$c["nombre"]}}</option>
            @endforeach
        </select>
        <br><br>Editorial:
        <select name="id_editorial">
            <option>Editorial</option>
            @foreach($editorial as $e)
                <option value="{{$e["id_editorial"]}}" {{ $e["id_editorial"] == $datos['id_editorial'] ? 'selected' : '' }}>{{$e["nombre"]}}</option>
            @endforeach
        </select>
        <br><br>
        <p>
        <div>
            <h5>Foto de perfil:<br><input class="form-control" id="foto" name="foto" type="file"/></h5>
            <input type="hidden" name="imagen_vieja" value="<?= $datos['foto'] ?>">
        </div>
        </p>
        Disponible:
        <select name="disponible">
            <option>Disponible </option>
            <option value="1" selected>Si</option>
            <option value="0">No</option>
        </select>
        <br><br>



        <p>
            <input type="hidden" name="codigo" value="<?= $codigo ?>">
            <input type="submit" value="Modificar">
            <a href="index.php">Cancelar</a>
        </p>
    </form>
@endsection