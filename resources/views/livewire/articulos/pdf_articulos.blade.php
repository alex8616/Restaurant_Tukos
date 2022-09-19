<body>
 <div id="wrapper">
 <div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S -  ARTICULOS REGISTRADOS</span></h1>
    <h5>(Fecha De Descarga:{{now()}})</h5>
    <h5> </h5>
</div><br>
  <table id="keywords" cellspacing="0" cellpadding="0">
    <thead>
      <tr>
        <th><span></span></th>
        <th><span>N°</span></th>
        <th><span>NOMBRE</span></th>
        <th><span>DESCRIPCION</span></th>
        <th><span>CANTIDAD</span></th>
        <th><span>FECHA/REGISTRO </span></th>
        <th><span>FECHA/ACTUALIZACION </span></th>
      </tr>
    </thead>
    <tbody>
    @php
        $i=1;
    @endphp
    @foreach ($articulos as $articulo)
      <tr>
        @if($articulo->estado == 'ACTIVO')
          @if($i%2 == 0)
              <td style="background: #e2e2e2;"></td>
              <td style="background: #e2e2e2;">{{$i++}}</td>
              <td style="background: #e2e2e2; text-justify: inter-word; width: 95px">{{$articulo->Nombre_articulo}}</td>
              <td style="text-align: justify; background: #e2e2e2; text-justify: inter-word; width: 300px">{{$articulo->Descripcion_articulo}}</td>
              <td style="text-align: center; background: #e2e2e2;">{{$articulo->Cantidad_articulo}}</td>
              <td style="text-align: center; background: #e2e2e2;">{{$articulo->created_at}}</td>
              <td style="text-align: center; background: #e2e2e2;">{{$articulo->updated_at}}</td>
          @else
              <td></td>
              <td>{{$i++}}</td>
              <td style="text-justify: inter-word; width: 95px">{{$articulo->Nombre_articulo}}</td>
              <td style="text-align: justify; text-justify: inter-word; width: 300px">{{$articulo->Descripcion_articulo}}</td>
              <td style="text-align: center;">{{$articulo->Cantidad_articulo}}</td>
              <td style="text-align: center;">{{$articulo->created_at}}</td>
              <td style="text-align: center;">{{$articulo->updated_at}}</td>
          @endif
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
 </div> 
</body>
<style>
#htitle{
    font-size: 50px;
    line-height: 1.3;
    font-size: 30px;
    line-height: 1.8;
    text-transform: uppercase;
    font-family: "Montserrat", sans-serif;
}

.hero {
  position: relative;
  background: #333 url(http://srdjanpajdic.com/slike/2.jpg) no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  text-align: center;
  color: #e8f380;
  padding-top: -60px;
  letter-spacing: 2px;
  font-family: "Montserrat", sans-serif;
}
#title{
    font-size: 25px;
    color: #e8f380;
    border-bottom: 2px solid #e8f380;
    padding-bottom: 12px;
    line-height: 3;
}
#notifi{
  width:100%; 
  height:600px; 
  overflow: scroll;
  overflow-x: hidden;
}
#notifi::-webkit-scrollbar {
  -webkit-appearance: none;
}

#notifi::-webkit-scrollbar:vertical {
  width:10px;
  background-color: floralwhite;
}

#notifi::-webkit-scrollbar-button:increment,.contenedor::-webkit-scrollbar-button {
  display: none;
} 

#notifi::-webkit-scrollbar:horizontal {
  height: 10px;
}

#notifi::-webkit-scrollbar-thumb {
  background-color: #797979;
  border-radius: 20px;
  border: 2px solid #f1f2f3;
}

#notifi::-webkit-scrollbar-track {
  border-radius: 10px;  
}
/** page structure **/
#keywords thead {
  background: #c9dff0;
}
#keywords thead tr th { 
  font-weight: bold;
  padding: 5px;
}
#keywords thead tr th span { 
  padding-right: 20px;
}

#keywords tbody tr { 
  color: #555;
}
#keywords tbody tr td {
  padding: 15px 10px;
}

</style>