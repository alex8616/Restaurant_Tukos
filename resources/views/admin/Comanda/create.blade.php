@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
<div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S</span><br>REGISTRO DE VENTA - PLATOS</h1>
</div>
@stop

@section('content')
<br>
<form action="{{ url('/comanda') }}" method="post" enctype="multipart/form-data" class="registrar-form">
@csrf
    <div class="row">
    <div class="card">
        <div class="card-body">
            <div>
                @foreach($categorias as $categoria)
                    <a class="btn btn-primary mb-2" href="{{ route('admin.comanda.create')}}"> {{ $categoria->id }} </a>
                @endforeach
            </div>
            <div id="orders-chart-legend" class="orders-chart-legend">
                <div class="container">
                    <div class="card-body">
                        <div>
                            <div class="form-group">
                            <label for="id_plato">Plato</label>
                            <select class="form-control selectpicker articuloB" data-live-search="true" name="id_plato"
                                id="id_plato" lang="es" autofocus>
                                <option value="" data-icon="fa-solid fa-bowl-rice" disabled selected>Buscar Plato</option>
                                @foreach ($platos as $plato)
                                    <option value="{{ $plato->id }}_{{ $plato->stock }}_{{ $plato->Precio_plato }}">
                                        <h1>{{ $plato->Nombre_plato }}</h1>
                                    </option>
                                @endforeach
                            </select>  
                            </div>
                        </div>
                        <div>
                            <label for="cliente_id">Cliente</label>
                            <select class="form-control selectpicker clienteB" data-live-search="true" name="cliente_id" id="cliente_id" lang="es">
                                <option value="" data-icon="fas fa-user-tie" disabled selected>Buscar cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->Nombre_cliente }} 
                                                {{ $cliente->Apellidop_cliente }} 
                                                {{ $cliente->Apellidom_cliente }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="cliente_id">Pensionados</label>
                            <select class="form-control selectpicker clienteB" data-live-search="true" name="tipo_cliente_id" id="tipo_cliente_id" lang="es">
                                <option value="" data-icon="fas fa-user-tie" disabled selected>Buscar cliente</option>
                                @foreach ($tipoclientes as $tipocliente)
                                    @if($tipocliente->tipo != 'Normal')
                                    <option value="{{ $tipocliente->id }}">
                                                {{ $tipocliente->Nombre_tipoclientes }} 
                                    </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input type="number" class="form-control" name="cantidad" id="cantidad" aria-describedby="helpId" min="0"
                                    max="100" oninput="validity.valid||(value='')">
                            </div>
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="comentario">Comentario</label>
                                <textarea class="form-control" name="comentario" id="comentario" cols="45" rows="3"></textarea>
                            </div>
                        </div>
                        <div>
                            <div class="form-group col-md-15">
                            <label for="descuento">Descuento</label>
                            <div class="input-group">
                                <select name="descuento" id="descuento" class="form-control"  aria-describedby="basic-addon2" oninput="validity.valid||(value='')">
                                    <option value="0">0</option>
                                    <option value="5">5</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="13">13</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                </select>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="Precio_plato">Precio de venta</label>
                                <input type="number" class="form-control" name="Precio_plato" id="Precio_plato" aria-describedby="helpId">
                            </div>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" id="agregar" class="btn btn-info float-right"> <i class="fas fa-check"></i> Agregar Artículo</button>
    </div>
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div id="orders-chart-legend" class="orders-chart-legend">
                        <div class="table-responsive col-md-12  table-bordered shadow-lg">
                            <table id="detalles" class="table table-striped col-md-12 table-bordered shadow-lg">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Eliminar</th>
                                        <th>Artículo</th>
                                        <th>Comentario</th>
                                        <th>Precio Venta (Bs)</th>
                                        <th>Descuento</th>
                                        <th>Cantidad</th>
                                        <th style="width:150px;">SubTotal (Bs)</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th colspan="6">
                                            <p align="right">TOTAL PAGAR:</p>
                                        </th>
                                        <th>
                                            <p align="right"><span align="right" id="total_pagar_html">Bs 0.00</span>
                                                <input type="hidden" name="total" id="total_pagar">
                                            </p>
                                        </th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <button type="submit" id="guardar" class="btn btn-success float-right" onclick="recargar()">Registrar</button>
                <a href="{{ route('admin.comanda.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </div>
</form>

@stop

@section('content_top_nav_right')
    @include('notificaciones')
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"></link>
    <link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        *{
            margin: 0;
            padding: 0;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        body{
            background: #D4D4D4;
            font-family: 'Open sans';
        }

        .wrap{
            width: 800px;
            max-width: 90%;
            margin: 30px auto;
        }

        ul.tabs{
            width: 100%;
            background: #363636;
            list-style: none;
            display: flex;
        }

        ul.tabs li{
            width: 50%;
        }

        ul.tabs li a{
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            text-align: center;

            display: block;
            padding: 20px 0px;
        }

        .active{
            background: #0984CC;
        }

        ul.tabs li a .tab-text{
            margin-left: 8px;
        }

        .secciones{
            width: 100%;
            background: #fff;
        }

        .secciones article{
            padding: 30px;
        }

        .secciones article p{
            text-align: justify;
        }


        @media screen and (max-width: 700px){
            ul.tabs li{
                width: none;
                flex-basis: 0;
                flex-grow: 1;
            }
        }

        @media screen and (max-width: 450px){
            ul.tabs li a{
                padding: 15px 0px;
            }

            ul.tabs li a .tab-text{
                display: none;
            }

            .secciones article{
                padding: 20px;
            }
        }
    </style>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    
    <script>
        $("#cliente_id").change(function() {
            if($("#cliente_id").val() !== "0"){
                $('#tipo_cliente_id').prop('disabled', true);
            }
        });
        $("#tipo_cliente_id").change(function() {
            if($("#tipo_cliente_id").val() !== "0"){
                $('#cliente_id').prop('disabled', true);
            }
        });
    </script>

    <script>
       $('ul.tabs li a:first').addClass('active');
        $('.secciones article').hide();
        $('.secciones article:first').show();

        $('ul.tabs li a').click(function(){
            $('ul.tabs li a').removeClass('active');
            $(this).addClass('active');
            $('.secciones article').hide();

            var activeTab = $(this).attr('href');
            $(activeTab).show();
            return false;
        });
    </script>

    <script>
     $(document).ready(function() {
         $("#agregar").click(function() {
             agregar();
          });
       });

        var cont = 1;
        total = 0;
        subtotal = [];
        $("#guardar").hide();
        $("#id_plato").change(mostrarValores);

        function mostrarValores() {
            datosProducto = document.getElementById('id_plato').value.split('_');
            $("#Precio_plato").val(datosProducto[2]);
        }

        function agregar() {
            datosProducto = document.getElementById('id_plato').value.split('_');
            id_plato = datosProducto[0];

            articulo = $("#id_plato option:selected").text();
            cantidad = $("#cantidad").val();
            comentario = $("#comentario").val();
            descuento = $("#descuento").val();
            Precio_plato = $("#Precio_plato").val();
            if (id_plato != "" && cantidad != "" && cantidad > 0 && descuento != "" && Precio_plato != "") {
                if (parseInt(cantidad) > 0) {
                    subtotal[cont] = (cantidad * Precio_plato) - (cantidad * Precio_plato * descuento / 100);
                    total = total + subtotal[cont];
                    var fila = '<tr class="selected" id="fila' + cont +
                        '"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont +
                        ');"><i class="fa fa-trash-alt"></i></button></td> <td><input type="hidden" name="id_plato[]" value="' +
                        id_plato + '">' + articulo + '</td> <td> <input type="hidden" name="comentario[]" value="' +
                        comentario + '">' + comentario + '</td> <td> <input type="hidden" name="Precio_plato[]" value="' +
                        parseFloat(Precio_plato).toFixed(2) + '"> <input class="form-control" type="number" value="' +
                        parseFloat(Precio_plato).toFixed(2) +
                        '" disabled> </td> <td> <input type="hidden" name="descuento[]" value="' +
                        parseFloat(descuento) + '"> <input class="form-control" type="number" value="' +
                        parseFloat(descuento) + '" disabled> </td> <td> <input type="hidden" name="cantidad[]" value="' +
                        cantidad + '"> <input type="number" value="' + cantidad +
                        '" class="form-control" disabled> </td> <td align="right">Bs ' + parseFloat(subtotal[cont]).toFixed(
                            2) + '</td></tr>';
                    cont++;
                    limpiar();
                    totales();
                    evaluar();
                    $('#detalles').append(fila);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lo siento',
                        text: 'La cantidad a vender supera el stock.',
                    })
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Lo siento',
                    text: 'Rellene todos los campos del detalle de la venta.',
                })
            }
        }
    
        function limpiar() {
            $("#cantidad").val("");
            $("#descuento").val("0");
            $("#comentario").val("");
        }

        function totales() {
            $("#total").html("Bs " + total.toFixed(2));
            total_pagar = total;
            $("#total_pagar_html").html("Bs " + total_pagar.toFixed(2));
            $("#total_pagar").val(total_pagar.toFixed(2));
        }

        function evaluar() {
            if (total > 0) {
                $("#guardar").show();
            } else {
                $("#guardar").hide();
            }
        }

        function eliminar(index) {
            total = total - subtotal[index];
            total_pagar_html = total;
            $("#total").html("Bs" + total);
            $("#total_pagar_html").html("Bs" + total_pagar_html.toFixed(2));
            $("#total_pagar").val(total_pagar_html.toFixed(2));
            $("#fila" + index).remove();
            evaluar();
        }
    </script>
    
    <script>
        $(document).ready(function() {
            $("form").keypress(function(e) {
                if (e.which == 13) {
                    return true;
                }
            });
        });
    </script>

    <script>
        $('.registrar-form').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Estas Seguro Que Quieres Registrar La VENTA?',
                text: "Verificaste Todos Los Registros Correctamente",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Registrar!',
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
                'warning'
            )
        </script>
    @endif
@stop
