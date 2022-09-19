<div><br>
<div class="card" style="width: 80%; margin: auto;"> 
    <div class="card-body">
        <div>
            <button class="btn btn-sm btn-primary" style="float: ringth;"  data-toggle="modal" data-target="#addArticuloModal">Add Articulo</button>
            <a href="{{ route('articulos.articuloxportPDF') }}">
                <button class="btn btn-sm btn-secondary"><span><i class="fa-solid fa-file-pdf"></i></span> Exportar Articulos PDF</button>
            </a>
            <a href="{{ route('articulos.articuloxportEXCEL') }}">
                <button class="btn btn-sm btn-success"><span><i class="fa-solid fa-file-excel"></i></span> Exportar Articulos EXCEL</button>
            </a>
            <nav class="navbar navbar-light bg-light justify-content-between">
                <input class="form-control mr-sm-2" type="search" placeholder="Buscar Por Nombre .." aria-label="Search" wire:model="search">
            </nav>    
        </div>
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
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
                        <td>{!! $articulo->Descripcion_articulo !!}</td>
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

        <div class="px-6 py-3">
            {{$articulos->links()}}
        </div>
</div>
</div>
<!-- Modal Add Articulo -->
@include('livewire.articulos.crear')  

<!-- Modal Edit Articulo -->
@include('livewire.articulos.edit') 

<!-- Modal Delete Articulo -->
@include('livewire.articulos.delete')

<!-- Modal Ver Articulo -->
@include('livewire.articulos.show')


<script src="https://cdn.tailwindcss.com"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>
<script>
    window.addEventListener('close-modal', event =>{
        $('#addArticuloModal').modal('hide');
        $('#showArticuloModal').modal('hide');
        $('#editArticulotModal').modal('hide');
        $('#deleteArticuloModal').modal('hide');
        $('#viewArticuloModal').modal('hide');
    });
    window.addEventListener('show-edit-articulo-modal', event =>{
        $('#editArticulotModal').modal('show');
    });
    window.addEventListener('show-delete-confirmation-modal', event =>{
            $('#deleteArticuloModal').modal('show');
        });
    window.addEventListener('show-view-articulo-modal', event =>{
        $('#viewArticuloModal').modal('show');
    });
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ))
        .then(function(editor){
            editor.model.document.on('change:data', ()=> {
                @this.set('Descripcion_articulo',editor.getData());
            })
        })
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    function previewImage(event, querySelector){

    //Recuperamos el input que desencadeno la acción
    const input = event.target;

    //Recuperamos la etiqueta img donde cargaremos la imagen
    $imgPreview = document.querySelector(querySelector);

    // Verificamos si existe una imagen seleccionada
    if(!input.files.length) return

    //Recuperamos el archivo subido
    file = input.files[0];

    //Creamos la url
    objectURL = URL.createObjectURL(file);

    //Modificamos el atributo src de la etiqueta img
    $imgPreview.src = objectURL;
                
    }
</script>





