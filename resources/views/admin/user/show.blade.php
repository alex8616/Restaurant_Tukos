@extends('adminlte::page')

@section('title', 'Información sobre el usuario')

@section('content_header')
<div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S</span><br>DETALLES DEL USUARIO</h1>
</div>
    <h1>Usuario: {{ $user->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="border-bottom text-center pb-4">
                        <h3>{{ ucwords($user->name) }}</h3>
                    </div>
                    <div class="border-bottom py-4">
                        <div class="list-group">
                            <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list"
                                href="#list-home" user="tab" aria-controls="home">
                                Sobre el usuario
                            </a>

                            <a type="button" class="list-group-item list-group-item-action" id="list-messages-list"
                                data-toggle="list" href="#list-messages" user="tab" aria-controls="messages">Historial de
                                ventas</a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-8 pl-lg-5">

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-home" user="tabpanel"
                            aria-labelledby="list-home-list">

                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>Información del usuario</h4>
                                </div>
                            </div>
                            <div class="profile-feed">
                                <div class="d-flex align-items-start profile-feed-item">

                                    <div class="form-group col-md-6">
                                        <strong><i class="fab fa-product-hunt mr-1"></i> Nombre</strong>
                                        <p class="text-muted">
                                            {{ ucwords($user->name) }}
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-user-tag mr-1"></i> Roles</strong>
                                        <p class="text-muted">
                                            @forelse ($user->roles as $role)
                                                @can('roles.show')
                                                    <a href="{{ route('admin.roles.show', $role) }}"
                                                        class="bg-primary text-white p-1 mt-2 rounded mt-3 ">{{ $role->name }}</a>
                                                @endcan
                                            @empty <span>
                                                    <h4 class="text-danger">El usuario no tiene rol</h4>
                                                </span>
                                            @endforelse
                                        </p>
                                        <hr>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <strong>
                                            <i class="fas fa-envelope mr-1"></i>
                                            Correo electrónico</strong>
                                        <p class="text-muted">
                                            {{ $user->email }}
                                        </p>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="list-messages" user="tabpanel" aria-labelledby="list-messages-list">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>Historial de ventas</h4>
                                </div>
                            </div>
                            <div class="profile-feed">
                                <div class="d-flex align-items-start profile-feed-item">

                                    <div class="table-responsive">
                                        <table id="order-listing1"
                                            class="table venta table-striped mt-0.5 table-bordered shadow-lg dt-responsive nowrap">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Fecha</th>
                                                    <th>Total</th>
                                                    <th>Estado</th>
                                                    <th style="width:180px;">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user->comandas as $venta)
                                                    <tr>
                                                        <th scope="row">
                                                            {{ $venta->id }}
                                                        </th>
                                                        <td>{{ $venta->fecha_venta }}</td>
                                                        <td>Bs. {{ number_format($venta->total, 2) }}</td>

                                                        @if ($venta->estado == 'VALIDO')
                                                            <td>
                                                                <a class="btn btn-danger btn-sm"
                                                                    href="{{ route('cambio.estado.comanda', $venta) }}"
                                                                    title="Editar">
                                                                    Pendiente <i class="fas fa-check"></i>
                                                                </a>
                                                            </td>
                                                        @else
                                                            <td>
                                                                <a class="btn btn-success btn-sm"
                                                                    href="{{ route('cambio.estado.comanda', $venta) }}"
                                                                    title="Editar">
                                                                    Confirmado 
                                                                </a>
                                                            </td>
                                                        @endif

                                                        <td sstyle="width: 180px;">
                                                                <a href="{{ route('admin.comanda.pdf', $venta) }}"
                                                                    class="btn btn-danger btn-sm">Imprimir <i
                                                                        class="far fa-file-pdf"></i></a>
                                                           
                                                                <a href="{{ route('admin.comanda.show', $venta) }}"
                                                                    class="btn btn-info btn-sm">Ver <i
                                                                        class="far fa-eye"></i></a>
                                                           
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2"><strong>Monto total vendido: </strong></td>
                                                    <td colspan="3" align="left"><strong>Bs.
                                                            {{ number_format($total_compras, 2) }}</strong>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary float-right">Regresar</a>
        </div>
    </div>
    <br><br>
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

@stop
