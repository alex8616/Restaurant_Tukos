<!--ventana para Update--->
<div class="modal fade" id="EditCliente{{ $cliente->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header" style="background-color: #563d7c !important;">
            <h6 class="modal-title" style="color: #fff; text-align: center;">
                Actualizar Información
            </h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
    </div>


    <form method="POST" action="{{ route('updatecliente', $cliente->id) }}">
    @method('PUT')
    @csrf
        <div class="modal-body" id="cont_modal">
        <div class="col-md-12">
            <form action="{{ url('/cliente') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputNombre" class="is-required">Nombre</label>
                        <input type="text" class="form-control" id="Nombre_cliente" name="Nombre_cliente" value="{{ $cliente->Nombre_cliente }}" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Nombre_cliente') }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputApellidop" class="is-required">Apellido Paterno</label>
                        <input type="text" class="form-control" id="Apellidop_cliente" name="Apellidop_cliente" value="{{ $cliente->Apellidop_cliente }}" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Apellidop_cliente') }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputApellidom">Apellido Materno</label>
                        <input type="text" class="form-control" id="Apellidom_cliente" name="Apellidom_cliente" value="{{ $cliente->Apellidom_cliente }}" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Apellidom_cliente') }}">  
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Correo Electronico</label>
                        <input type="email" class="form-control" id="Correo_cliente" name="Correo_cliente" value="{{ $cliente->Correo_cliente }}" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Correo_cliente') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputAddress" class="is-required">Direccion</label>
                        <input type="text" class="form-control" id="Direccion_cliente" name="Direccion_cliente" value="{{ $cliente->Direccion_cliente }}" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Direccion_cliente') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4" class="is-required">Numero De Celular</label>
                        <input type="text" class="form-control" id="Celular_cliente" name="Celular_cliente" value="{{ $cliente->Celular_cliente }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Fecha De Nacimiento</label>
                        <input type="date" class="form-control" id="FechaNacimiento_cliente" name="FechaNacimiento_cliente" value="{{ $cliente->FechaNacimiento_cliente }}" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('FechaNacimiento_cliente') }}">
                    </div>
                </div>
                <div>
                <center>
                    <button type="submit" class="btn btn-danger">Cancelar</button>
                    <button type="submit" class="btn btn-success">Registrar</button>
                </center>
                </div>
            </form>
            </div>    
        </div>
    </form>

    </div>
</div>
</div>
<!---fin ventana Update --->