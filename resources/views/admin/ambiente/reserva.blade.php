@extends('adminlte::page')

@section('title', 'Restaurant')

@section('content_header')

@stop

@section('content')
<br>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#evento">Añadir Reserva</button>

    <div style="float: left">
    </div>
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
    <hr>
<section class="wrapper">
    <div class="container-fostrap">
        <div class="content">
            <div class="container">
                <div class="row">
                @foreach ($reservas as $reserva)
                    <div class="col-xs-12 col-sm-4">
                            <p class="calendar2">
                                <strong style="font-size: 35px">{{$reserva->fecha}}</strong><br>
                                ({{ \Carbon\Carbon::parse($reserva->fecha)->formatLocalized('%d %B %Y %p') }})<br><br>
                                <strong>HORA INICIO:</strong> {{$reserva->hora_inicio}} - <strong>HORA FINAL:</strong> {{$reserva->hora_fin}}<br>
                                <strong>RESERVADO PARA:</strong> {{$reserva->motivo}}<br>
                                <br><em>
                                    <a href="{{route('admin.reserva.edit', $reserva)}}" class="btn" style="width:48%">EDITAR</a>
                                    <a href="#" class="btn" style="width:48%">ELIMINAR</a>
                                </em>
                            </p>
                    </div><br><br>
                    @endforeach
                </div>
                <div>
                </div>
            </div>
        </div>
    </div>
</section>  

<!-- Modal -->
<div class="modal fade" id="evento" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">REGISTRAR RESERVA - {{$ambiente->Nombre_Ambiente}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form onsubmit="validar();" action="{{ route('admin.ambiente.reservastore') }}" method="POST">
                    @csrf
                        <div class="form-group">
                            <input type="text" name="ambiente_id" id="ambiente_id" value="{{ old('id', $ambiente->id) }}" class="form-control"
                                tabindex="1" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" hidden>
                        </div>
                        <div class="form-group">
                            <label for="fecha">Fecha: </label>
                            <input type="date" name="fecha" id="fecha" value="{{ old('fecha') }}" class="form-control"
                                tabindex="1" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();">
                            @if ($errors->has('fecha'))
                                <div class="alert alert-danger">
                                    <span class="error text-danger">{{ $errors->first('fecha') }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-6 grid-margin stretch-card">
                                <label for="hora_inicio">Hora Inicio: </label>
                                <input type="time" name="hora_inicio" id="hora_inicio" value="{{ old('hora_inicio') }}" class="form-control"
                                    tabindex="1" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();">
                                @if ($errors->has('hora_inicio'))
                                    <div class="alert alert-danger">
                                        <span class="error text-danger">{{ $errors->first('hora_inicio') }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6 grid-margin stretch-card">
                                <label for="hora_fin">Hora Fin: </label>
                                <input type="time" name="hora_fin" id="hora_fin" value="{{ old('hora_fin') }}" class="form-control"
                                    tabindex="1" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();">
                                @if ($errors->has('hora_fin'))
                                    <div class="alert alert-danger">
                                        <span class="error text-danger">{{ $errors->first('hora_fin') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label for="motivo">Motivo: </label>
                            <input type="text" name="motivo" id="motivo" value="{{ old('motivo') }}" class="form-control"
                                tabindex="1" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();">
                            @if ($errors->has('motivo'))
                                <div class="alert alert-danger">
                                    <span class="error text-danger">{{ $errors->first('motivo') }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-4 grid-margin stretch-card">
                                <label for="precio">Precio: </label>
                                <input type="text" name="precio" id="precio" value="{{ old('hora_inicio') }}" class="form-control">
                                @if ($errors->has('hora_inicio'))
                                    <div class="alert alert-danger">
                                        <span class="error text-danger">{{ $errors->first('hora_inicio') }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-4 grid-margin stretch-card">
                                <label for="adelanto">Adelanto: </label>
                                <input type="text" name="adelanto" id="adelanto" value="{{ old('hora_fin') }}" class="form-control">
                            </div>
                            <div class="col-md-4 grid-margin stretch-card">
                                <label for="total">Total: </label>
                                <input type="text" name="total" id="total" value="0" readonly class="form-control"/>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 grid-margin stretch-card">
                                <button type="submit" class="btn btn-success" tabindex="4" style="width:100%;">Guardar </button>
                            </div>
                            <div class="col-md-6 grid-margin stretch-card">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="width:100%;">Cancelar</button>
                            </div>
                        </div>
                </form> 
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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" />
    <link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style> 
        .right{
            float: left;
            text-align: right;
            width: -50%;
            height: -50%;
        }

        .boton{
            border: 1px solid;
            padding: 5px;
            background-color: #0271CD;
            color: #ffffff;
            text-decoration: none;
            font-family: 'Helvetica', sans-serif;
            border-radius: 1px;
        
        }
        .calendar2{
            margin:.25em 10px 10px 0;
            padding-top:5px;
            float:left;
            width:100%;
            background:#ededef;
            background: -webkit-gradient(linear, left top, left bottom, from(#ededef), to(#ccc)); 
            background: -moz-linear-gradient(top,  #ededef,  #ccc); 
            text-align:center;
            color:#000;
            text-shadow:#fff 0 1px 0;     
            -moz-border-radius:3px;
            -webkit-border-radius:3px;
            border-radius:3px;      
            position:relative;
            -moz-box-shadow:0 2px 2px #888;
            -webkit-box-shadow:0 2px 2px #888;
            box-shadow:0 2px 2px #888;
        }
        .calendar2 em{
            display:block;
            font:normal bold 11px/30px Arial, Helvetica, sans-serif;
            color:#fff;
            text-shadow:#00365a 0 -1px 0; 
            background:#04599a;
            background:-webkit-gradient(linear, left top, left bottom, from(#04599a), to(#00365a)); 
            background:-moz-linear-gradient(top,  #04599a,  #00365a); 
            -moz-border-radius-bottomright:3px;
            -webkit-border-bottom-right-radius:3px;   
            border-bottom-right-radius:3px;
            -moz-border-radius-bottomleft:3px;
            -webkit-border-bottom-left-radius:3px;    
            border-bottom-left-radius:3px;      
            border-top:1px solid #00365a;
        }
        .calendar2:before, .calendar2:after{
            content:'';
            float:left;
            position:absolute;
            top:5px;    
            width:15px;
            height:15px;
            background:#111;
            z-index:1;
            -moz-border-radius:10px;
            -webkit-border-radius:10px;
            border-radius:10px;
            -moz-box-shadow:0 1px 1px #fff;
            -webkit-box-shadow:0 1px 1px #fff;
            box-shadow:0 1px 1px #fff;
        }
        .calendar2:before{left:11px;}  
        .calendar2:after{right:11px;}
        .calendar2 em:before, .calendar2 em:after{
            content:'';
            float:left;
            position:absolute;
            top:-5px;   
            width:10px;
            height:19px;
            background:#dadada;
            background:-webkit-gradient(linear, left top, left bottom, from(#f1f1f1), to(#aaa)); 
            background:-moz-linear-gradient(top,  #f1f1f1,  #aaa); 
            z-index:2;
            -moz-border-radius:10px;
            -webkit-border-radius:10px;
            border-radius:20px;
            }
        .calendar2 em:before{left:13px;}     
        .calendar2 em:after{right:13px;}  
    </style>
@stop

@section('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    <script>

        let precio1 = document.getElementById("precio")
        let precio2 = document.getElementById("adelanto")
        let precio3 = document.getElementById("total")
        
        precio2.addEventListener("change", () => {
            precio3.value = parseFloat(precio1.value) - parseFloat(precio2.value)
        })
        

        function sumar()
        {
        const $total = document.getElementById('total');
        let subtotal = 0;
        [ ...document.getElementsByClassName( "form-control1" ) ].forEach( function ( element ) {
            if(element.value !== '') {
            subtotal += parseFloat(element.value);
            }
        });
        $total.value = subtotal;
        }
            
        var fecha = new Date();
        var anio = fecha.getFullYear();
        var dia = fecha.getDate();
        var _mes = fecha.getMonth(); //viene con valores de 0 al 11
        _mes = _mes + 1; //ahora lo tienes de 1 al 12
        if (_mes < 10) //ahora le agregas un 0 para el formato date
        {
        var mes = "0" + _mes;
        } else {
        var mes = _mes.toString;
        }

        let fecha_minimo = anio + '-' + mes + '-' + dia; // Nueva variable

        document.getElementById("fecha").setAttribute('min',fecha_minimo);
 
    </script>

@stop


