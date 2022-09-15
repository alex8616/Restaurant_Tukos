<div><br>
<div class="card" style="width: 80%; margin: auto;"> 
    <div class="card-body">
        <div>
            <button class="btn btn-sm btn-primary" style="float: ringth;"  data-toggle="modal" data-target="#addArticuloModal">Add Articulo</button>
            <button class="btn btn-sm btn-primary" style="float: ringth;" data-toggle="modal" data-target="#addArticuloModal">Exportar Articulos</button>
            <nav class="navbar navbar-light bg-light justify-content-between">
                <input class="form-control mr-sm-2" type="search" placeholder="Buscar Por Nombre .." aria-label="Search" wire:model="search">
            </nav>    
        </div>
        @if (session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        @if($articulos->count())
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
        @else
            <div class="px-6 py-4">
                Ningun Dato Coincidente
            </div>
        @endif
</div>
</div>
<!-- Modal Add Articulo -->
<div wire:ignore.self class="modal fade relative md:absolute fixed w-full h-100 inset-0 justify-center items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);" id="addArticuloModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-between items-center pb-3">
					<p class="text-2xl font-bold">REGISTRAR ARTICULO</p>
					<div class="modal-close cursor-pointer z-50">
						<svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
							viewBox="0 0 18 18">
							<path
								d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
							</path>
						</svg>
					</div>
				</div>
                <hr>
            <div class="modal-body">
                <form wire:submit.prevent="storeStudentData">
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="Nombre_articulo" >Nombre Articulo</label>
                            <input type="text" id="Nombre_articulo" required class="form-control" wire:model="Nombre_articulo">
                            @error('Nombre_articulo')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12">
                        <label for="Descripcion_articulo" >Descripcion Articulo</label>
                            <textarea type="text" id="Descripcion_articulo" class="form-control" wire:model="Descripcion_articulo" cols="30" rows="10"></textarea>
                            @error('Descripcion_articulo')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    

                    <div class="form-group row">
                        <div class="col-12">
                        <label for="Cantidad_articulo">Cantidad Articulo</label>
                            <input type="number" id="Cantidad_articulo" required class="form-control" wire:model="Cantidad_articulo">
                            @error('Cantidad_articulo')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <center>
                    <div >
                            <button wire:click.prevent="guardar()" type="button" class="focus:outline-none px-4 bg-teal-500 p-2 ml-3 rounded-lg text-white hover:bg-teal-400">Registrar</button>

                            <button data-dismiss="modal" type="button" class="focus:outline-none modal-close px-4 bg-gray-400 p-2 rounded-lg text-black hover:bg-gray-300">Cancelar</button>
                    </div>
                    </center>
                </form>
            </div>
        </div>
    </div> 
</div>

<!-- Modal Edit Articulo -->
<div wire:ignore.self class="modal fade relative md:absolute fixed w-full h-100 inset-0 justify-center items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content py-4 text-left px-6">
            <div class="flex justify-between items-center pb-3">
					<p class="text-2xl font-bold">EDITAR ARTICULO</p>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
				</div>
                <hr>
            <div class="modal-body">
                <form wire:submit.prevent="editArticuloData">
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
                        <textarea type="text" id="Descripcion_articulo" class="form-control" wire:model="Descripcion_articulo" cols="30" rows="10"></textarea>
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
                    <div >
                            <button type="submit" class="focus:outline-none px-4 bg-teal-500 p-2 ml-3 rounded-lg text-white hover:bg-teal-400">Registrar</button>
                            <button wire:click="limpiarCampos()" data-dismiss="modal" type="button" class="focus:outline-none modal-close px-4 bg-gray-400 p-2 rounded-lg text-black hover:bg-gray-300" class="close">Cancelar</button>
                    </div>
                    </center>
                </form>
            </div>
        </div>
    </div> 
</div>

<!-- Modal Delete Articulo -->
<div wire:ignore.self class="modal fade" id="deleteStudentModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Comfirma Si Quieres Borrar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-4 pb-4">
                <h6>Estas Seguro Que Quieres Borrar?</h6>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary" wire:click="cerrarModal()" data-dismiss="modal" aria-label="Close">Cancelar</button>
                <button class="btn btn-sm btn-danger" wire:click="deleteStudentData()">Si! Borrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ver Articulo -->
<div wire:ignore.self class="modal fade" id="viewStudentModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content py-4 text-left px-6">
        <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">DETALLES DEL ARTICULO</p>
                <div class="modal-close cursor-pointer z-50">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID: </th>
                            <td>{{ $view_id_articulo }}</td>
                        </tr>

                        <tr>
                            <th>Name: </th>
                            <td>{{ $view_Nombre_articulo }}</td>
                        </tr>

                        <tr>
                            <th>Email: </th>
                            <td>{{ $view_Descripcion_articulo }}</td>
                        </tr>

                        <tr>
                            <th>Phone: </th>
                            <td>{{ $view_Cantidad_articulo }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('close-modal', event =>{
        $('#addArticuloModal').modal('hide');
        $('#showArticuloModal').modal('hide');
        $('#editStudentModal').modal('hide');
        $('#deleteStudentModal').modal('hide');
        $('#viewStudentModal').modal('hide');
    });
    window.addEventListener('show-edit-student-modal', event =>{
        $('#editStudentModal').modal('show');
    });
    window.addEventListener('show-delete-confirmation-modal', event =>{
            $('#deleteStudentModal').modal('show');
        });
    window.addEventListener('show-view-student-modal', event =>{
        $('#viewStudentModal').modal('show');
    });
</script>

<script src="https://cdn.tailwindcss.com"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>




