@extends('adminlte::page')

@section('title', 'Restaurant')

@section('content_header')

@stop

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong> Guardado!</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong> Error !</strong> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session('cancelado'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('cancelado') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<!-- Button trigger modal -->
<br>
<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#modelId">
  Añadir Ambiente
</button>
<hr>
<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('admin.ambiente.store') }}" method="POST">
                            @csrf
                            <div class="card ">
                                <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('CREAR AMBIENTE ') }}</h4>
                                <p class="card-category">{{ __('') }}</p>
                                </div>
                                <div class="card-body ">
                                @if (session('status'))
                                    <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="material-icons">close</i>
                                        </button>
                                        <span>{{ session('status') }}</span>
                                        </div>
                                    </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <label class="col-sm-12 col-form-label" for="nombre">Nombre Del Ambiente: </label>
                                    <div class="col-sm-12">
                                        <div class="form-group{{ $errors->has('text') ? ' has-danger' : '' }}">
                                            <input type="text" name="Nombre_Ambiente" id="Nombre_Ambiente" value="{{ old('Nombre_Ambiente') }}" 
                                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                tabindex="1" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                @if ($errors->has('Nombre_Ambiente'))
                                                <div class="alert alert-danger">
                                                    <span class="error">{{ $errors->first('Nombre_Ambiente') }}</span>
                                                </div>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="card-footer ml-auto mr-auto">
                                    <button type="submit" class="btn btn-success" tabindex="4" style="width:100%;">Guardar </button>
                                    <a href="{{ route('admin.ambiente.index') }}" class="btn btn-danger" tabindex="4" style="width:100%;">Cancelar</a>
                                </div>
                            </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content_top_nav_right')
    @include('Notificaciones')
@endsection
@section('css')
    <link href="{{ asset('css/material-dashboardForms.css?v=2.1.1') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
    <link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .stepper-input {
            display: flex;

            /* Border */
            border: 1px solid #d1d5db;
            border-radius: 0.25rem;

            /* Size */
            height: 2rem;
        }

        .stepper-input__button {
            /* Reset */
            background: #d1d5db;
            border: none;

            /* Center the content */
            align-items: center;
            display: flex;
            justify-content: center;

            /* Size */
            width: 2rem;
        }

        .stepper-input__content {
            flex: 1;
        }

        .stepper-input__input {
            /* Reset */
            border: none;

            /* Take full size of its container */
            height: 100%;
            width: 100%;
        }
    </style>
    @notifyCss
@stop

@section('js')
        <x:notify-messages />
        @notifyJs
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.8/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.8/js/responsive.bootstrap4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>

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
        $('.eliminar-form').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Quieres eliminar?',
                text: "El registro se eliminara definitivamente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
        </script>
        @if (session('delete') == 'ok')
            <script>
                Swal.fire(
                    'Eliminar!',
                    'Se Eliminó el registro.',
                    'success'
                )
            </script>
        @endif
@stop


