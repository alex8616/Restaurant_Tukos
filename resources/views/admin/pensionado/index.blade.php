@extends('adminlte::page')

@section('title', 'Restaurant')

@section('content_header')
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

<div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S</span><br>LISTADO DE CLIENTE PENSIONADOS</h1>
</div>
@stop

@section('content')
<div class="card">
    <div class="card-body">
    <table class="table table-striped" id="cliente">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Plan Pension</th>
            <th>Fecha Inicio</th>
            <th>Fecha Conclucion</th>
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tipoclientes as $tipocliente)
        @if($tipocliente->Fecha_Final <= now()->toDateString())
            <tr style="background-color: #FF5252">
                <td>{{$tipocliente->id}}</td>
                <td>{{$tipocliente->Nombre_tipoclientes}}</td>
                <td>{{$tipocliente->tipo}}</td>
                <td>{{$tipocliente->Fecha_Inicio}}</td>
                <td>{{$tipocliente->Fecha_Final}}</td>
                <td>
                @if ($tipocliente->tipo != 'Normal')
                        <a class="btn btn-danger" href="{{ route('cambio.estado.tipocliente', $tipocliente) }}"
                            title="Editar">
                            Dar De BAJA 
                        </a>
                @else
   
                            CLIENTE DADO DE BAJA 
                @endif
                </td>
            </tr> 
        @else
            <tr>
                <td>{{$tipocliente->id}}</td>
                <td>{{$tipocliente->Nombre_tipoclientes}}</td>
                <td>{{$tipocliente->tipo}}</td>
                <td>Inicio el {{ \Carbon\Carbon::parse($tipocliente->Fecha_Inicio)->setTimezone('America/La_Paz')->isoFormat(' dddd D \d\e MMMM \d\e\l Y')}}</td>
                <td>Concluye el {{ \Carbon\Carbon::parse($tipocliente->Fecha_Final)->setTimezone('America/La_Paz')->isoFormat(' D \d\e MMMM \d\e\l Y')}}</td>
                <span class="clock" data-countdown="{{ $tipocliente->Fecha_Final}}"></span>
                <td>
                    {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', now())->diffInDays(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tipocliente->Fecha_Final))}} Dias
                </td>
            </tr> 
        @endif
        @endforeach
    </tbody>
</table>
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
    <link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>

    <script>
        /**
         *  <div class = "card">
                        <div class="card-header">
                        Cuenta regresiva
                        <div class="float-end">
                            <input type="date" name="fecha" id="fecha" class="form-control" value="">
                        </div>
                        <div class="card-body">
                        <div class="wrapper_timer">
                            Selecciona una fecha para iniciar.
                        </div>
                        </div>
                    </div>
         */
        $('#fecha').on('change', run_timer);
        function run_timer() {
            var fecha = $('#fecha').val(),
                limite = new Date(fecha).getTime(),
                wrapper = $('.wrapper_timer'),
                ahora = new Date().getTime(),
                restante = limite - ahora,
                dias = Math.floor(restante/(1000 * 60 * 60 * 24)),
                horas = Math.floor((restante%(1000 * 60 * 60 * 24))/(1000 * 60 * 60)),
                minutos = Math.floor((restante%(1000 * 60 * 60))/(1000 * 60)),
                segundos = Math.floor((restante%(1000 * 60))/1000),
                texto = " ";
            if(restante < 0){
                wrapper.html('<div class="alert alert-danger text-center"> El Tiempo Expiro </div>');
                return;
            }

            if(dias > 0){
                texto += dias + ' dias, ';
            }
            
            if(horas > 0){
                texto += horas + ' horas, ';
            }

            if(minutos > 0){
                texto += minutos + ' minutos, ';
            }

            if(segundos > 0){
                texto += segundos + ' segundos, ';
            }

            wrapper.html(texto);

            setTimeout(run_timer, 1000);
            

            
        }
    </script>
    <script>
        $('#cliente').DataTable({
            responsive: true,
            autoWidth: false,
            "bSort": false,
            "language": {
            "lengthMenu": "Mostrar  " +
                                   `<select class="custon-select custom-select-sm form-control form-control-sm"> 
                                        <option value='10'>10</option>
                                        <option value='25'>25</option>
                                        <option value='50'>50</option>
                                        <option value='100'>100</option>
                                        <option value='-1'>All</option>
                                    </select>`
                                    + " Registros Por Pagina",
            "zeroRecords": "No Se Encontro Ningun Usuario - Lo Siento",
            "info": "Mostrando La Pagina _PAGE_ de _PAGES_",
            "infoEmpty": "Ningun Registro Coincide Con Lo Buscado",
            "infoFiltered": "(Filtrado de _MAX_ Registros Totales)",
            'search': 'Buscar:',
            'paginate':{
                'next': 'Siguiente',
                'previous': 'Anterior'
            }
        }
        });
    </script>
@stop


