@extends('adminlte::page')

@section('title', 'Gestion de Empresa')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title text-bold">Gestión de empresa</h4>
        </div>
        @if (session('update'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong> Editado!</strong> {{ session('update') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="form-row">
            <div class="form-group col-md-6">
                <strong><i class="fas fa-file-signature mr-1"></i> Nombre </strong>

                <p class="text-muted">
                    {{ $empresa->Empresa_Nombre }}
                </p>
                <hr>
                <strong><i class="fas fa-align-left mr-1"></i> Descripción</strong>

                <p class="text-muted">
                    {{ $empresa->Empresa_Descripcion }}
                </p>
                <hr>
                <strong><i class="fas fa-map-marked-alt mr-1"></i> Dirección</strong>

                <p class="text-muted">
                    {{ $empresa->Empresa_Direccion }}
                </p>

                <hr>
                <strong><i class="fas fa-map-marked-alt mr-1"></i> Telefono</strong>
                <p class="text-muted">
                    {{ $empresa->Empresa_Telefono }}
                </p>

                <hr>
                <strong><i class="fas fa-map-marked-alt mr-1"></i> Propietario</strong>
                <p class="text-muted">
                    {{ $empresa->Empresa_Propietario }}
                </p>
                <hr>
            </div>
            <div class="form-group col-md-6">
                <strong><i class="far fa-address-card mr-1"></i> NIT</strong>

                <p class="text-muted">{{ $empresa->Empresa_Nit }}</p>
                <hr>
                <strong><i class="far fa-envelope mr-1"></i> Correo electrónico</strong>

                <p class="text-muted">{{ $empresa->Empresa_Email }}</p>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <strong><i class="fas fa-exclamation-circle mr-1"></i> Logo</strong><br>
                    </div>
                    <div class="col-md-6">
                        @if (isset($empresa->Empresa_Logo))
                            <img src="{{ 'imagen' . '/' . $empresa->Empresa_Logo }}" width="250" alt="logo.png"
                                class="mx-auto d-block">
                        @else
                            <img src="storage/uploads/logoempresa.png" alt="logo-defecto.png"
                                width="250">
                        @endif
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
    <div class="card-footer text-muted">
            <button type="button" class="btn btn-success btn-sm float-right" data-toggle="modal"
                data-target="#exampleModal-2">Actualizar información de la empresa</button>
    </div>
    <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel-2">Actualizar datos de empresa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                {!! Form::model($empresa, ['route' => ['admin.empresa.update', $empresa], 'method' => 'PUT', 'files' => true]) !!}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Empresa_Nombre" class="text-primary">Nombre</label>
                        <input type="text" class="form-control" name="Empresa_Nombre" id="Empresa_Nombre"
                            value="{{ $empresa->Empresa_Nombre }}" aria-describedby="helpId">
                        @if ($errors->has('Empresa_Nombre'))
                            <div class="alert alert-danger">
                                <span class="error text-danger">{{ $errors->first('Empresa_Nombre') }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="Empresa_Descripcion" class="text-primary">Descripción</label>
                        <textarea class="form-control" name="Empresa_Descripcion" id="Empresa_Descripcion"
                            rows="3">{{ $empresa->Empresa_Descripcion }}</textarea>
                        @if ($errors->has('Empresa_Descripcion'))
                            <div class="alert alert-danger">
                                <span class="error text-danger">{{ $errors->first('Empresa_Descripcion') }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="Empresa_Email" class="text-primary">Correo electrónico</label>
                        <input type="Empresa_Email" class="form-control" name="Empresa_Email" id="Empresa_Email" value="{{ $empresa->Empresa_Email }}"
                            aria-describedby="helpId">
                        @if ($errors->has('Empresa_Email'))
                            <div class="alert alert-danger">
                                <span class="error text-danger">{{ $errors->first('Empresa_Email') }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="Empresa_Direccion" class="text-primary">Dirección</label>
                        <input type="text" class="form-control" name="Empresa_Direccion" id="Empresa_Direccion"
                            value="{{ $empresa->Empresa_Direccion }}" aria-describedby="helpId">
                        @if ($errors->has('Empresa_Direccion'))
                            <div class="alert alert-danger">
                                <span class="error text-danger">{{ $errors->first('Empresa_Direccion') }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="Empresa_Telefono" class="text-primary">Dirección</label>
                        <input type="text" class="form-control" name="Empresa_Telefono" id="Empresa_Telefono"
                            value="{{ $empresa->Empresa_Telefono }}" aria-describedby="helpId">
                        @if ($errors->has('Empresa_Telefono'))
                            <div class="alert alert-danger">
                                <span class="error text-danger">{{ $errors->first('Empresa_Telefono') }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="Empresa_Propietario" class="text-primary">Dirección</label>
                        <input type="text" class="form-control" name="Empresa_Propietario" id="Empresa_Propietario"
                            value="{{ $empresa->Empresa_Propietario }}" aria-describedby="helpId">
                        @if ($errors->has('Empresa_Propietario'))
                            <div class="alert alert-danger">
                                <span class="error text-danger">{{ $errors->first('Empresa_Propietario') }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="Empresa_Nit" class="text-primary">Numero de NIT</label>
                        <input type="text" class="form-control" name="Empresa_Nit" id="Empresa_Nit" value="{{ $empresa->Empresa_Nit }}"
                            aria-describedby="helpId">
                        @if ($errors->has('Empresa_Nit'))
                            <div class="alert alert-danger">
                                <span class="error text-danger">{{ $errors->first('Empresa_Nit') }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="logo" class="text-primary">Logo</label><br>
                        <img src="{{ 'imagen' . '/' . $empresa->Empresa_Logo }}" width="150" alt="logo.png"
                            class="mb-5 mx-auto d-block">
                        <input type="file" name="Empresa_Logo" id="Empresa_Logo" class="form-control">
                        @if ($errors->has('Empresa_Logo'))
                            <span class="error text-danger">{{ $errors->first('Empresa_Logo') }}</span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
@stop

@section('js')

@stop
