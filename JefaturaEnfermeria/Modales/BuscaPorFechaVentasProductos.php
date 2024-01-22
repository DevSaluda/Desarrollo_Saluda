
  
      <div class="modal fade bd-example-modal-xl" id="FiltroEspecificoPorCod" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Filtrado de ventas por sucursal<i class="fas fa-credit-card"></i></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
     
      <div class="modal-body">
     
 <form  method="POST" action="SugerenciaFechasProducto">
    
 
 <div class="form-group">
    <label for="exampleFormControlInput1">Sucursal a elegir </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
  </div>
  <select id = "sucursal" class = "form-control" name = "SucursalProducto" >
  <option value="">Seleccione una Sucursal:</option>
  <option value="21">CEDIS</option>
           <option value="23">CEDIS(Partner)</option>
           <option value="25">Itzincab</option>
          <option value="3">Izamal</option>
          <option value="19">Kanasín</option>
           <option value="4">Mama</option>
          <option value="5">Mani</option>
            <option value="20">Motul</option>
            <option value="15">Oficinas</option>
          <option value="6">Oxkutzcab</option>
           <option value="7">Peto</option>
             <option value="8">Teabo</option>
              <option value="22">Teabo Clínica</option>
               <option value="9">Tekax</option>
              <option value="10">Tekit</option>
              <option value="11">Ticul</option>
            <option value="12">Tixkokob</option>
          <option value="13">Uman</option>
          </select>
        <input hidden type="text" name="nombresucursal" id="namesucursal">
    </div>
    <script>
      $("#sucursal").change(function() {
 
  var texto = $(this).find('option:selected').text(); // Capturamos el texto del option seleccionado

  
  $("#namesucursal").val(texto);
});
    </script>

  </div>   
  <div class="form-group">
  <label for="exampleFormControlInput1">Producto o servicio </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
  </div>
  <select class = "form-control" Name="ProductoBuscado" id='buscador'>
<option value='0'>- Buscar producto -</option>
</select>
  </div>
  
</div>

  <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Fecha inicio </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
  </div>
  <input type="date" class="form-control " name="Fecha1Prod">
    </div>
    </div>
    
    <div class="col">
    <label for="exampleFormControlInput1">Fecha fin </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
  </div>
  <input type="date" class="form-control " name="Fecha2Prod">
    </div>
    

 
  </div>  </div>
      <button type="submit"  id="submit_registroarea" value="Guardar" class="btn btn-success">Aplicar cambio de sucursal <i class="fas fa-exchange-alt"></i></button>
                                        </form>
                                        </div>
                                        </div>
     
    </div>
  </div>
  </div>
  </div>
 <script>
$(document).ready(function(){
$("#buscador").select2({
    theme: 'bootstrap4',
ajax: {
url: "https://controlfarmacia.com/JefaturaEnfermeria/Consultas/BusquedaProductoParaFiltrar.php",
type: "post",
dataType: 'json',
delay: 150,
data: function (params) {
return {
palabraClave: params.term // search term
};
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
});
});

</script>