<div>
    <div class="card">
        <div class="card-body">
        <table class="table table-striped" id="cliente">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Direccion</th>
                <th>Numero De Celular</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articulos as $articulo)
            <tr>
                <td>{{$articulo->id}}</td>
                <td>{{$articulo->Nombre_articulo}}</td>
                <td>{{$articulo->Descripcion_articulo}}</td>
                <td>{{$articulo->Cantidad_articulo}}</td>
                <td>
                    <a href="#" class="btn btn-info">Ver</a>
                    <a  href="#" class="btn btn-secondary text-white" href="#">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>