@extends('adminlte::page')

@section('title', 'Restaurant')

@section('content_header')
<div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S</span><br>LISTADO DE PLATOS</h1>
</div>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> Guardado!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('update'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong> Editado!</strong> {{ session('update') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong> Error!</strong> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row">
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                    <div id="orders-chart-legend" class="orders-chart-legend">
                            <form action="{{ url('/plato') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="inputNombre">Nombre</label>
                                    <input type="text" class="form-control" id="Nombre_plato" name="Nombre_plato"  onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Nombre_plato') }}">
                                    @if ($errors->has('Nombre_plato'))
                                            <span class="error text-danger" style="color:#fff";>{{ $errors->first('Nombre_plato') }}</span><br>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputApellidop">Precio del plato</label>
                                    <input type="Number" class="form-control" id="Precio_plato" name="Precio_plato"  onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Precio_plato') }}">
                                    @if ($errors->has('Precio_plato'))
                                            <span class="error text-danger" style="color:#fff";>{{ $errors->first('Precio_plato') }}</span><br>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputApellidom">Caracteristicas Del Plato</label>
                                    <textarea class="form-control" placeholder="Breve Resumen Del Plato" id="Caracteristicas_plato" name="Caracteristicas_plato" rows="5" cols="51  " onkeyup="javascript:this.value=this.value.toUpperCase();" ></textarea>
                                    @if ($errors->has('Caracteristicas_plato'))
                                            <span class="error text-danger" style="color:#fff";>{{ $errors->first('Caracteristicas_plato') }}</span><br>
                                    @endif
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="inputApellidom">Categoria Del Plato</label>
                                        <select id="categoria_id" name="categoria_id" class="form-control">
                                        <option value="" >Seleccione Una De las Opciones</option>
                                            @foreach($categorias as $categoria)
                                                <option value="{{ $categoria->id}}" {{ old('Nombre_categoria') == $categoria->id ? "selected" :""}} >{{ $categoria->Nombre_categoria}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('$categoria->categoria_id'))
                                                <span class="error text-danger" style="color:#fff";>{{ $errors->first('$categoria->categoria_id') }}</span><br>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="imagen">Imagen: </label>
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" name="imagen" id="imagen" value="{{ old('imagen') }}" class="form-control" tabindex="3" accept="image/*" onchange="previewImage(event, '#imgPreview')">
                                        <label class="custom-file-label" for="imagen">Seleciona Imagen</label>
                                    </div>
                                    @if ($errors->has('imagen'))
                                        <div class="alert alert-danger">
                                            <span class="error text-danger">{{ $errors->first('imagen') }}</span>
                                        </div>
                                    @endif
                                    <img id="imgPreview" class="responsive">
                                </div>
                                <div class="row">
                                <div class="col-md-6 grid-margin stretch-card">
                                    <button type="submit" class="btn btn-success" tabindex="4" style="width:100%;">Guardar </button>
                                </div>
                                <div class="col-md-6 grid-margin stretch-card">
                                    <a href="{{ route('admin.mesa.index') }}" class="btn btn-danger" tabindex="4" style="width:100%;">Cancelar</a>
                                </div>
                            </div>
                            </form>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div id="orders-chart-legend" class="orders-chart-legend">
                    <div class="card">
                        <div class="card-body ">
                            <table class="table table-striped mt-0.5 table-bordered shadow-lg mt-4 dt-responsive nowrap" id="categoria">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="text-center">N°</th>
                                        <th scope="col" class="text-center">Nombre</th>
                                        <th class="text-center">Precio</th>
                                        <th class="text-center">Imagen</th>
                                        <th scope="col"class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach ($platos as $plato)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td style="width:400px;">{{ ($plato->Nombre_plato) }}</td>
                                            <td style="width:400px;">{{ ($plato->Precio_plato) }}</td>
                                            <td class="text-center" style="width:400px;">
                                            @if (isset($plato->imagen))
                                                <img class="img-thumbnail" src="{{ asset('storage' . '/' . $plato->imagen) }}" style="width:100%;" />
                                            @else
                                                <p>Imagen No Subida</p>
                                            @endif
                                            </td>
                                            <td class="text-right" style="width: 400px;">
                                                <form action="{{ route('admin.plato.destroy', $plato) }}" method="POST" class="formulario-eliminar">
                                                    @method('DELETE')
                                                    @csrf
                                                        <a href="{{ route('admin.plato.edit', $plato) }}"
                                                            class="btn btn-success ">Editar
                                                        </a>
                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

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

@section('css')
<link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
<style>
    .responsive {
    width: 100%;
    height: auto;
    }
</style>
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>
    <script>
       // VARIABLES
        const rangeInput = document.querySelector('input[type = "range"]');
        const imageList = document.querySelector(".image-list");
        const searchInput = document.querySelector('input[type="search"]');
        const btns = document.querySelectorAll(".view-options button");
        const photosCounter = document.querySelector(".toolbar .counter span");
        const imageListItems = document.querySelectorAll(".image-list li");
        const captions = document.querySelectorAll(".image-list figcaption p:first-child");
        const myArray = [];
        let counter = 1;
        const active = "active";
        const listView = "list-view";
        const gridView = "grid-view";
        const dNone = "d-none";

        // SET VIEW
        for (const btn of btns) {
        btn.addEventListener("click", function() {
            const parent = this.parentElement;
            document.querySelector(".view-options .active").classList.remove(active);
            parent.classList.add(active);
            this.disabled = true;
            document.querySelector('.view-options [class^="show-"]:not(.active) button').disabled = false;

            if (parent.classList.contains("show-list")) {
            parent.previousElementSibling.previousElementSibling.classList.add(dNone);
            imageList.classList.remove(gridView);
            imageList.classList.add(listView);
            } else {
            parent.previousElementSibling.classList.remove(dNone);
            imageList.classList.remove(listView);
            imageList.classList.add(gridView);
            }
        });
        }

        // SET THUMBNAIL VIEW - CHANGE CSS VARIABLE
        rangeInput.addEventListener("input", function() {
        document.documentElement.style.setProperty("--minRangeValue",`${this.value}px`);
        });

        // SEARCH FUNCTIONALITY
        for (const caption of captions) {
        myArray.push({
            id: counter++,
            text: caption.textContent
        });
        }

        searchInput.addEventListener("keyup", keyupHandler);

        function keyupHandler() {
        for (const item of imageListItems) {
            item.classList.add(dNone);
        }
        const text = this.value;
        const filteredArray = myArray.filter(el => el.text.includes(text));
        if (filteredArray.length > 0) {
            for (const el of filteredArray) {
            document.querySelector(`.image-list li:nth-child(${el.id})`).classList.remove(dNone);
            }
        }
        photosCounter.textContent = filteredArray.length;
        }
    </script>
    
    @if(session('eliminar')=='ok')
        <script>
            Swal.fire(
                    'Eliminando ...',
                    'Los Datos Fueron ELIMINADOS Correctamente',
                    'success'
                    )
        </script>
    @endif

    @if(session('actualizar')=='ok')
        <script>
            Swal.fire(
                    'Actualizando ...',
                    'Los Datos Fueron Actualizados Correctamente',
                    'success'
                    )
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#categoria').DataTable({
                responsive: true,
                autoWidth: false,
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registro por página",
                    "zeroRecords": "No se encontro registro",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "search": "Buscar",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente"
                    },
                    "infoEmpty": "No hay registros",
                    "infoFiltered": "(Filtrado de _MAX_ registros totales)"
                },
                "lengthMenu": [
                    [5, 10, 50, -1],
                    [5, 10, 50, "All"]
                ]

            });
        });
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
    @if(session('eliminar')=='ok')
        <script>
            Swal.fire(
                    'Eliminando ...',
                    'Los Datos Fueron ELIMINADOS Correctamente',
                    'success'
                    )
        </script>
    @endif

    @if(session('actualizar')=='ok')
        <script>
            Swal.fire(
                    'Actualizando ...',
                    'Los Datos Fueron Actualizados Correctamente',
                    'success'
                    )
        </script>
    @endif

    <script>
        $('.formulario-eliminar').submit(function(e){
            e.preventDefault();
                Swal.fire({
                title: '¿Estas Seguro?',
                text: "Este Plato Se Eliminara Definitivamente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡SI, Eliminar!'
                }).then((result) => {
                if (result.value) {
                    this.submit();
                }
                })
        })
    </script>
@stop


