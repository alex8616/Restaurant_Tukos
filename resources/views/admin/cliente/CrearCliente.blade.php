<div class="modal fade bd-example-modal-lg" id="modelId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRAR CLIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                    <div class="col-md-12">
                        <form action="{{ url('/cliente') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputNombre" class="is-required">Nombre</label>
                                    <input type="text" class="form-control" id="Nombre_cliente" 
                                    name="Nombre_cliente" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Nombre_cliente') }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputApellidop" class="is-required">Apellido Paterno</label>
                                    <input type="text" class="form-control" id="Apellidop_cliente" 
                                    name="Apellidop_cliente" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Apellidop_cliente') }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputApellidom">Apellido Materno</label>
                                    <input type="text" class="form-control" id="Apellidom_cliente" 
                                    name="Apellidom_cliente" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Apellidom_cliente') }}">  
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Correo Electronico</label>
                                    <input type="email" class="form-control" id="Correo_cliente" 
                                    name="Correo_cliente" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Correo_cliente') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputAddress" class="is-required">Direccion</label>
                                    <input type="text" class="form-control" id="Direccion_cliente" 
                                    name="Direccion_cliente" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Direccion_cliente') }}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4" class="is-required">Numero De Celular</label>
                                    <input type="number" class="form-control" id="Celular_cliente" 
                                    name="Celular_cliente" value="{{ old('Celular_cliente') }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Fecha De Nacimiento</label>
                                    <input type="date" class="form-control" id="FechaNacimiento_cliente" 
                                    name="FechaNacimiento_cliente" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('FechaNacimiento_cliente') }}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Latitud</label>
                                    <input type="number" name="latidud" id="latidud" class="form-control" value="-19,588591400088237" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Longitud</label>
                                    <input type="number" name="longitud" id="longitud" class="form-control" value="-65,75048982678497" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                            <label for="">SELECCIONE LA UBICACION EXACTA</label><br>
                            <div class="flex-center position-ref full-height">
                                <div class="content">
                                    <div id="mapa" style="width: 100%; height:200px"></div>
                                </div>
                            </div>
                            <script>
                                function iniciarMapa(){
                                    var latitud = -19.58341986454926;
                                    var longitud = -65.75655027805412;
                                    
                                    coordenadas = {
                                        lng: longitud,
                                        lat: latitud
                                    }

                                    generarMapa(coordenadas);
                                } 

                                function generarMapa(coordenadas){
                                    var mapa = new google.maps.Map(document.getElementById('mapa'),{
                                        zoom: 18,
                                        center: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
                                    });

                                    marcador = new google.maps.Marker({
                                        map: mapa,
                                        draggable: true,
                                        position: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
                                    });

                                        marcador.addListener('dragend',function(event){
                                        document.getElementById("latidud").value = this.getPosition().lat();
                                        document.getElementById("longitud").value = this.getPosition().lng();
                                    })
                                }
                            </script>
                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZfZFrJxVmMfX7uxTrFDkEF6WncPIAvUY&callback=iniciarMapa" ></script>
                        </div>
                        <center>
                                <button type="submit" class="btn btn-danger">Cancelar</button>
                                <button type="submit" class="btn btn-success">Registrar</button>
                            </center>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>