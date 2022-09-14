
<div>
    <div class="card"> 
            <div class="card-body">
            <button class="btn btn-sm btn-primary" style="float: right;" data-toggle="modal" data-target="#addArticuloModal">Add Articulo</button>
        <table class="table table-striped" id="cliente">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Especificacion</th>
                <th>cantidad</th>
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
                    <button wire:click="ver({{$articulo->id}})" class="btn btn-secondary text-white">Ver</button>
                    <button wire:click="editar({{$articulo->id}})" class="btn btn-sm btn-primary" >Editar</button>
                    <button wire:click="borrar({{$articulo->id}})" class="btn btn-danger text-white">Borrar</button>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>
<!-- Modal Add Articulo -->
<div wire:ignore.self class="modal fade" id="addArticuloModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Articulo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="storeStudentData">
                    <div class="form-group row">
                        <label for="Nombre_articulo" class="col-3">Nombre Articulo</label>
                        <div class="col-9">
                            <input type="text" id="Nombre_articulo" class="form-control" wire:model="Nombre_articulo">
                            @error('Nombre_articulo')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Descripcion_articulo" class="col-3">Descripcion Articulo</label>
                        <div class="col-9">
                            <input type="text" id="Descripcion_articulo" class="form-control" wire:model="Descripcion_articulo"
                            @error('Descripcion_articulo')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Cantidad_articulo" class="col-3">Cantidad Articulo</label>
                        <div class="col-9">
                            <input type="number" id="Cantidad_articulo" class="form-control" wire:model="Cantidad_articulo">
                            @error('Cantidad_articulo')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                            <button wire:click.prevent="guardar()" type="button">Guardar</button>
                        </span>

                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                            <button data-dismiss="modal" type="button">Cancelar</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Articulo -->
<div wire:ignore.self class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

</div>

<script>
    window.addEventListener('close-modal', event =>{
        $('#addArticuloModal').modal('hide');
        $('#editStudentModal').modal('hide');
    });
    window.addEventListener('show-edit-student-modal', event =>{
        $('#editStudentModal').modal('show');
    });
</script>
@section('content_top_nav_right')
<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-bell"></i>
        @if (count(auth()->user()->unreadNotifications))
        <span class="badge badge-warning">{{ count(auth()->user()->unreadNotifications) }}</span>
            
        @endif
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notifi">
    <span class="dropdown-header" >Notificaciones Sin Leer</span>
        @forelse (auth()->user()->unreadNotifications as $notification)
        <a href="{{ route('admin.pensionado.listpensionados') }}" class="dropdown-item">
        <i class="fa-solid fa-hand-pointer"></i> El Pensionado del cliente con <br><strong>{{ $notification->data['tipo'] }}</strong> se esta por terminar
        <span class="ml-3 float-right text-muted text-sm">{{ $notification->data['Fecha_Final'] }}</span>
        </a>
        @empty
            <span class="ml-3 float-right text-muted text-sm">Sin notificaciones por leer </span><br> 
        @endforelse
        <a href="{{ route('markAsRead') }}" class="dropdown-item dropdown-footer">Marcar Todos LEIDO</a>
        <div class="dropdown-divider"></div>
            <span class="dropdown-header">Notificaciones Leidas</span>
            @forelse (auth()->user()->readNotifications as $notification)
            <a href="{{ route('admin.pensionado.listpensionados') }}" class="dropdown-item">
            <i class="fa-solid fa-check-double"></i> pension {{ $notification->data['id'] }}
            <span class="ml-3 float-right text-muted text-sm">{{ $notification->data['id'], $notification->created_at->diffForHumans() }}</span>
            </a>
            @empty
            <span class="ml-3 float-right text-muted text-sm">Sin notificaciones leidas</span>
        @endforelse
    </div>
</li>
@endsection



