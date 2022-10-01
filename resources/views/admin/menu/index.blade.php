@extends('adminlte::page')

@section('title', 'Restaurant')

@section('content')
<div class="floating-container">
    <button type="button" data-toggle="modal" data-target="#modelId">
        <div class="floating-button">+</div>
    </button>
</div>
<br>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">LISTADO DE MENUS</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
            <table class="table table-striped mt-0.5 table-bordered shadow-lg mt-4 dt-responsive nowrap" id="categoria">
                <thead class=" text-primary">
                  <th class="text-center" style="width: 100px;">
                    <strong>ID</strong>
                  </th>
                  <th class="text-center">
                    <strong>FECHA DEL MENU</strong>
                  </th>
                  <th class="text-center">
                    <strong>Acciones</strong>
                  </th>
                </thead>
                <tbody>
                    @php
                        $i=1;
                    @endphp
                    @foreach ($menus as $menu)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td>
                                Menu del Dia <strong>{{ \Carbon\Carbon::parse($menu->fecha_registro)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y') }}</strong>
                                - ({{ \Carbon\Carbon::parse($menu->fecha_registro)->format('d-m-Y H:i a') }})
                            </td>
                            <td style="width: 250px;" class="text-center">
                                <form action="{{ route('admin.menu.destroy', $menu) }}" method="POST"
                                    class="eliminar-form">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ route('admin.menu.pdf', $menu) }}">
                                        <button type="button" class="btn btn-info" style="padding:6%" title="Mostrar Registro">
                                            <i class="zmdi zmdi-print zmdi-hc-2x""></i>
                                        </button>
                                    </a>
                                    <button type="submit" class="btn btn-danger" style="padding:6%" title="Eliminar Registro">
                                        <i class="zmdi zmdi-delete zmdi-hc-2x"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning" style="padding:6%" data-toggle="modal" data-target="#MostrarMenu{{ $menu->id }}" title="Mostrar Registro">
                                        <i class="zmdi zmdi-eye zmdi-hc-2x"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @include('admin.menu.MostrarMenu')
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
<!-- Modal crear categoria -->
    @include('admin.menu.CrearMenu')
@endsection

@section('content_top_nav_right')
    <x:notify-messages />
    @include('Notificaciones')
@endsection
@section('css')
    
    <link href="{{ asset('css/material-dashboardForms.css?v=2.1.1') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{asset('css/bottonfooder.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        .is-required:after {
        content: '*';
        margin-left: 3px;
        color: red;
        font-weight: bold;
        }
    </style>
    @notifyCss
@stop

@section('js')
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
    <script>
        $(document).ready(function() {
            $('#categoria').DataTable({
                responsive: true,
                autoWidth: false,
                "language": {
                    "lengthMenu": "Mostrar registro por página",
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
                    [7, 10, 50, -1],
                    [5, 10, 50, "All"]
                ]

            });
        });
    </script>
    @notifyJs
@stop


