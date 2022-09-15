
<div><br>
<div class="card" style="width: 80%; margin: auto;"> 
    <div class="card-body">
        <div>
            <nav class="navbar navbar-light bg-light justify-content-between">
                <button class="btn btn-sm btn-primary" style="float: ringth;"  data-toggle="modal" data-target="#addArticuloModal">Add Articulo</button>
                <button class="btn btn-sm btn-primary" style="float: left;" data-toggle="modal" data-target="#addArticuloModal">Exportar Articulos</button>
                <form class="form-inline">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </nav>
        </div>
    <table class="table table-striped" id="cliente">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Especificacion</th>
                <th style="text-align:center;">cantidad</th>
                <th style="width: 200px; text-align:center;">Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articulos as $articulo)
            <tr>
                <td>{{$articulo->id}}</td>
                <td>{{$articulo->Nombre_articulo}}</td>
                <td>{{$articulo->Descripcion_articulo}}</td>
                <td style="text-align:center;">{{$articulo->Cantidad_articulo}}</td>
                <td>
                    <button wire:click="ver({{$articulo->id}})" class="btn btn-sm btn-secondary text-white">Ver</button>
                    <button wire:click="editar({{$articulo->id}})" class="btn btn-sm btn-primary" >Editar</button>
                    <button wire:click="borrar({{$articulo->id}})" class="btn btn-sm btn-danger text-white">Borrar</button>
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
                        <div class="col-12">
                            <label for="Nombre_articulo" >Nombre Articulo</label>
                            <input type="text" id="Nombre_articulo" class="form-control" wire:model="Nombre_articulo">
                            @error('Nombre_articulo')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12">
                        <label for="Descripcion_articulo" >Descripcion Articulo</label>
                            <input type="text" id="Descripcion_articulo" class="form-control" wire:model="Descripcion_articulo">
                            @error('Descripcion_articulo')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    

                    <div class="form-group row">
                        <div class="col-12">
                        <label for="Cantidad_articulo">Cantidad Articulo</label>
                            <input type="number" id="Cantidad_articulo" class="form-control" wire:model="Cantidad_articulo">
                            @error('Cantidad_articulo')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <center>
                    <div class="float-none">
                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                            <button wire:click.prevent="guardar()" type="button" class="btn btn-success text-white">Registrar</button>
                        </span>

                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                            <button data-dismiss="modal" type="button" class="btn btn-danger text-white">Cancelar</button>
                        </span>
                    </div>
                    </center>
                </form>
            </div>
        </div>
    </div> 
</div>

<!-- Modal Edit Articulo -->
<div wire:ignore.self class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Articulo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="storeStudentData">
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="Nombre_articulo" >Nombre Articulo</label>
                            <input type="text" id="Nombre_articulo" class="form-control" wire:model="Nombre_articulo">
                            @error('Nombre_articulo')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12">
                        <label for="Descripcion_articulo" >Descripcion Articulo</label>
                            <input type="text" id="Descripcion_articulo" class="form-control" wire:model="Descripcion_articulo">
                            @error('Descripcion_articulo')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    

                    <div class="form-group row">
                        <div class="col-12">
                        <label for="Cantidad_articulo">Cantidad Articulo</label>
                            <input type="number" id="Cantidad_articulo" class="form-control" wire:model="Cantidad_articulo">
                            @error('Cantidad_articulo')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <center>
                    <div class="float-none">
                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                            <button wire:click.prevent="guardar()" type="button" class="btn btn-success text-white">Registrar</button>
                        </span>

                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                            <button data-dismiss="modal" type="button" class="btn btn-danger text-white">Cancelar</button>
                        </span>
                    </div>
                    </center>
                </form>
            </div>
        </div>
    </div> 
</div>

<!-- Modal Show Articulo -->
<div wire:ignore.self class="modal fade" id="showArticuloModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Articulo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="storeStudentData">
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="Nombre_articulo" >Nombre Articulo</label>
                            <input type="text" id="Nombre_articulo" class="form-control" wire:model="Nombre_articulo">
                            @error('Nombre_articulo')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12">
                        <label for="Descripcion_articulo" >Descripcion Articulo</label>
                            <input type="text" id="Descripcion_articulo" class="form-control" wire:model="Descripcion_articulo">
                            @error('Descripcion_articulo')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    

                    <div class="form-group row">
                        <div class="col-12">
                        <label for="Cantidad_articulo">Cantidad Articulo</label>
                            <input type="number" id="Cantidad_articulo" class="form-control" wire:model="Cantidad_articulo">
                            @error('Cantidad_articulo')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <center>
                    <div class="float-none">
                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                            <button wire:click.prevent="guardar()" type="button" class="btn btn-success text-white">Registrar</button>
                        </span>

                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                            <button data-dismiss="modal" type="button" class="btn btn-danger text-white">Cancelar</button>
                        </span>
                    </div>
                    </center>
                </form>
            </div>
        </div>
    </div> 
</div>

<script>
    window.addEventListener('close-modal', event =>{
        $('#addArticuloModal').modal('hide');
        $('#showArticuloModal').modal('hide');
    });
    window.addEventListener('show-edit-student-modal', event =>{
        $('#editStudentModal').modal('show');
    });
</script>
<script>
    window.addEventListener('swal', () => {
        Swal.fire(
        'Se Registro Correctamente!!!',
        'Click en "OK" para cerrar!',
        'success'
        )
    })
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>




