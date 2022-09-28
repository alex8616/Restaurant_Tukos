@extends('adminlte::page')

@section('title', 'Pedidos')

@section('content_header')
<div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S</span><br>LISTADO DE VENTA DE PLATOS - COMANDAS</h1>
</div>
@stop

@section('content')
<a class="btn btn-primary mb-2" href="{{ route('admin.comanda.create') }}">Nueva venta +</a>
<a class="btn btn-primary mb-2" href="{{ route('admin.comanda.listapedidos') }}">Verificacion De Pedidos Cantidad</a>

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

    <div class="card">
        <div class="card-body">
            <table id="order-listing"
                class="table venta table-striped mt-0.5 table-bordered shadow-lg dt-responsive nowrap">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Id</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th style="width:260px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comandas as $comanda)
                        <tr>
                            <td>
                            {{ $comanda->id }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($comanda->fecha_venta)->format('d-m-Y H:i a') }}
                            </td>
                            @if ($comanda->cliente_id != 0)
                                <td>{{ $comanda->cliente->Nombre_cliente }} 
                                    {{ $comanda->cliente->Apellidop_cliente }} 
                                    {{ $comanda->cliente->Apellidom_cliente }}</td>
                            @else
                                <td>
                                
                                @foreach ($tipoclientes as $tipocliente)
                                    @if($comanda->tipo_cliente_id == $tipocliente->id)        
                                    {{ $tipocliente->Nombre_tipoclientes }} <br>
                                @endif
                            @endforeach 
                                </td>
                            @endif
                            <td>Bs. {{ number_format($comanda->total, 2) }}</td>

                            @if ($comanda->estado == 'VALIDO')
                                <td>
                                    <a class="btn btn-danger" href="{{ route('cambio.estado.comanda', $comanda) }}"
                                        title="Editar">
                                        Pendiente <i class="fa-solid fa-hourglass-end"></i>
                                    </a>
                                </td>
                            @else
                                <td>
                                    <a class="btn btn-success" href="{{ route('cambio.estado.comanda', $comanda) }}"
                                        title="Editar">
                                        Confirmado <i class="fas fa-check"></i>
                                    </a>
                                    </a>
                                </td>
                            @endif
                            <td style="width: 50px;">
                                    <a href="{{ route('admin.comanda.pdf', $comanda) }}" class="btn btn-info text-bold" target="_blank">Imprimir<i class="fas fa-file-pdf ml-2"></i></a>
                                    <a href="{{ route('admin.comanda.show', $comanda) }}" class="btn btn-info">Detalles <i class="fas fa-eye"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('content_top_nav_right')
    @include('notificaciones')
@endsection

@section('css')
    <link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <script>

        $(document).ready(function() {
            $('.venta').DataTable({
                responsive: true,
                autoWidth: false,
                "bSort" : false,
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
@stop
