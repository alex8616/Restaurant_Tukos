@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')
<div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S </h1><br>
</div>
@stop

@section('content')
<form action="{{ url('/mesa') }}" method="post" enctype="multipart/form-data" class="registrar-form">
    @csrf
    <div class="col-sm-12">
        <div class="card">
        <div class="card-body">
        <div>
                <div>
                    <label for="cliente_id">Numero De Mesa</label>
                    <select class="form-control selectpicker clienteB" data-live-search="false" name="mesa_id" id="mesa_id" lang="es">
                        <option value="" data-icon="fa-solid fa-square" disabled selected>Seleccionar Mesa</option>
                        @foreach ($mesas as $mesa)
                            <option value="{{ $mesa->id }}">
                                {{ $mesa->Nombre_mesa }} 
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_plato">Plato</label>
                    <select class="form-control selectpicker articuloB" data-live-search="true" name="id_plato"
                        id="id_plato" lang="es" autofocus>
                        <option value="" data-icon="fa-solid fa-bowl-rice" disabled selected>Buscar Plato</option>
                        @foreach ($menus as $plato)
                            <option value="{{ $plato->id }}_{{ $plato->stock }}_{{ $plato->Precio_plato }}">
                                <h1>{{ $plato->Nombre_plato }}</h1>
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label for="comentario">Comentario</label>
                    <textarea class="form-control" name="comentario" id="comentario" cols="45" rows="3"></textarea>
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <h3>
                    <input type="number" class="form-control" name="cantidad" id="cantidad" min="0"
                        max="100" value="1" disabled>
                    </h3>
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label for="Precio_plato">Precio de venta</label>
                    <input type="number" class="form-control" name="Precio_plato" id="Precio_plato" aria-describedby="helpId" disabled style="border: 0;">
                </div>
            </div>
            <div>
                <div class="form-group mt-2">
                    <button type="button" id="agregar" class="btn btn-info float-right"> <i class="fas fa-check"></i> Agregar Artículo</button>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
        <div class="card-body">
            <div class="table-responsive col-md-12  table-bordered shadow-lg">
                        <table id="detalles" class="table table-striped col-md-12 table-bordered shadow-lg">
                            <thead class="bg-primary text-white">
                                <tr style="width:50%">
                                    <th>
                                    TOTAL PAGAR:
                                    </th>
                                    <th>
                                        <span align="right" id="total_pagar_html">Bs 0.00</span>
                                            <input type="hidden" name="total" id="total_pagar">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
            </div>
        </div>
        </div>
        <div class="card-footer text-muted">
                <button type="submit" id="guardar" class="btn btn-success float-right" onclick="recargar()">Registrar</button>
                <a href="{{ route('admin.comanda.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
    </div>
</form>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"></link>
    <style>
        #cantidad{
            text-align:center; 
            border: 0; 
        }
        .quantity-buttons {
            border: 0;
            display: flex;
            justify-content: space-between;
            background: #eee;
            height: 32px;
            width:100%;
        }
        .quantity-buttons input {
            border: 0;
            background: transparent;
            width: 100%;
        }
        .quantity-buttons button {
            background-color: #FF5F5F;
            min-width: 52px;
            min-height: 38px;
            border: 0;
        }

        ul {
        list-style-type: none;
        }

        li {
        display: inline-block;
        }

        input[type="checkbox"][id^="cb"] {
        display: none;
        }

       
    </style>
@stop


@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>

    <script>
        /**
     * Minus and Plus buttons to NUMBER type INPUTS
     */
        
    // Select all INPUTS with type NUMBER
    const inputNumber = document.querySelectorAll("#cantidad");
    inputNumber.forEach(function(item){
    // create wrapper container
    let wrapper = document.createElement('div');
    // add class to wrapper div
    wrapper.classList.add("quantity-buttons")
    // insert wrapper before item in the DOM tree
    item.parentNode.insertBefore(wrapper, item);
    // move item into wrapper
    wrapper.appendChild(item);
    
    // Inser plus and minus buttons
    item.insertAdjacentHTML('beforebegin', '<button type="button" class="minus-button"><i class="fa-solid fa-minus"></i></button>');
    item.insertAdjacentHTML('afterend', '<button type="button" class="plus-button"><i class="fa-solid fa-plus"></i></button>');
    });

    // Minus Button
    const plusButton = document.querySelectorAll(".plus-button");
    plusButton.forEach(function(btn) {
    btn.addEventListener('click', function(element){
        let inputNumber = this.previousElementSibling;
        inputNumber.stepUp();
        // trigger change event
        let change = new Event("change");
        inputNumber.dispatchEvent(change);
    })
    })

    // Minus Button
    const minusButton = document.querySelectorAll(".minus-button");
    minusButton.forEach(function(btn) {
    btn.addEventListener('click', function(element){
        let inputNumber = this.nextElementSibling;
        inputNumber.stepDown();
        // trigger change event
        let change = new Event("change");
        inputNumber.dispatchEvent(change);
    })
    })
   

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
            Precio_plato = $("#Precio_plato").val();
            if (id_plato != "" && cantidad != "" && cantidad > 0  && Precio_plato != "") {
                if (parseInt(cantidad) > 0) {
                    subtotal[cont] = (cantidad * Precio_plato);
                    total = total + subtotal[cont];
                    var fila = '<tr class="selected" id="fila' + cont +'"style="width:50%"><th style="width:50%">ELIMINAR:<br><hr>PLATO:<br><hr>P. VENTA (Bs)<br><hr>Cantidad<hr>SUB TOTAL (Bs)<hr>COMENTARIO</th><th><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont +
                        ');">Eliminar</button><br><br><input type="hidden" name="id_plato[]" value="' +
                        id_plato + '">' + articulo + '<br><br><input type="hidden" name="Precio_plato[]" value="' +
                        parseFloat(Precio_plato).toFixed(2) + '"><input class="form-control" type="number" value="' +
                        parseFloat(Precio_plato).toFixed(2) +
                        '" disabled><br><input type="hidden" name="cantidad[]" value="' +
                        cantidad + '"><input type="number" value="' + cantidad +
                        '" class="form-control" disabled><br>Bs ' + parseFloat(subtotal[cont]).toFixed(
                            2) + '<br><br><input type="hidden" name="comentario[]" value="' +comentario + '">' + comentario + '<br></th></tr>';
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
            $("#cantidad").val("0");
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

