
<div class="modal fade bd-example-modal-lg" id="modelId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRAR MENU DEL DIA {{now()}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
                <div class="modal-body">
                    <form action="{{ url('/menu') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="orders-chart-legend" class="orders-chart-legend">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-9">
                                                        <label for="id_plato">Plato</label>
                                                        <select class="form-control selectpicker articuloB" data-live-search="true" name="id_plato"
                                                            id="id_plato" lang="es">
                                                            <option value="" data-icon="fa-solid fa-bowl-rice" disabled selected>Buscar Plato</option>
                                                            @foreach ($platos as $plato)
                                                                <option value="{{ $plato->id }}_{{ $plato->stock }}_{{ $plato->Precio_plato }}">
                                                                    {{ $plato->Nombre_plato }} {{ $plato->Precio_plato }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-2"><br>
                                                        <button type="button" class="btn btn-success" id="agregar">
                                                            <i class="zmdi zmdi-plus-square zmdi-hc-2x"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="detalles" class="table table-striped col-md-12 table-bordered shadow-lg">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th style="width: 100px;" class="text-center">Quitar</th>
                                                <th class="text-center">Plato</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <center>
                                        <button type="submit" id="guardar" class="btn btn-success">Registrar</button>
                                        <a href="{{ route('admin.menu.index') }}" class="btn btn-danger">Cancelar</a>
                                    </center>
                                </div>
                            </div>                                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>

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
    }

    function agregar() {
        datosProducto = document.getElementById('id_plato').value.split('_');
        id_plato = datosProducto[0];

        articulo = $("#id_plato option:selected").text();
        if (id_plato != "") {
                var fila = '<tr class="selected" id="fila' + cont +
                    '"><td class="text-center"><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont +
                    ');"><i class="zmdi zmdi-close"></i></button></td> <td><input type="hidden" name="id_plato[]" value="' +
                    id_plato + '">' + articulo + '</td></tr>';
                cont++;
                limpiar();
                evaluar();
                $('#detalles').append(fila);
            }else {
            Swal.fire({
                icon: 'error',
                title: 'Lo siento',
                text: 'NO seleccionaste Nada ...',
            })
        }
    }

    function limpiar() {
        $("#cantidad").val("");
        $("#descuento").val("0");
    }

    function evaluar() {
        $("#guardar").show();   
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
