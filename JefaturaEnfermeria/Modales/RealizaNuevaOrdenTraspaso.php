
  <?php
   $sql ="SELECT * FROM Traspasos_generados   order by ID_Traspaso_Generado desc limit 1";
   $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$Ticketss = mysqli_fetch_assoc($resultset);


$monto1 = $Ticketss['Num_Orden'];; 
$monto2 = 1; 
$totalmonto = $monto1 + $monto2; 

   
  
  ?>
      <div class="modal fade bd-example-modal-xl" id="FiltroLabs" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Seleccion de sucursal para traspaso <i class="fas fa-credit-card"></i></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
     
     
      <div class="modal-body">
     
 <form  method="POST" action="https://controlfarmacia.com/JefaturaEnfermeria/GeneradorTraspasosV2">
    <div class="form-group">
  <label for="exampleInputEmail1">Elija proveedor</label>
    <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-dolly"></i></span>
    <select id = "nombreproveedor" name="NombreProveedor" class = "form-control" required  >
    <option value="">Seleccione un proveedor:</option>
              <option value="">Seleccione un proveedor:</option>
<option value="CEDIS">CEDIS</option>
<option value="LEVIC">LEVIC</option>
<option value="COLGATE">COLGATE</option>
<option value="MEDICINE DEPOT">MEDICINE DEPOT</option>
<option value="NADRO">NADRO</option>
<option value="PISA FARMACEUTICA">PISA FARMACEUTICA</option>
<option value="ABASTECEDOR HOSPITALARIO">ABASTECEDOR HOSPITALARIO</option>
<option value="LEVIC">LEVIC</option>
<option value="LABORATORIO GALENOS">LABORATORIO GALENOS</option>
<option value="PRODUCTO NATURAL">PRODUCTO NATURAL</option>
<option value="DISTRIBUIDORA FARMACEUTICA CALDERON">DISTRIBUIDORA FARMACEUTICA CALDERON</option>
<option value="CLINICAS SALUDA">CLINICAS SALUDA</option>
<option value="LAPSUR (INSUMOS DE LABORATORIO)">LAPSUR (INSUMOS DE LABORATORIO)</option>
<option value="LOS TRES REYES (INSUMOS DE PAPELERIA)">LOS TRES REYES (INSUMOS DE PAPELERIA)</option>
<option value="DIAGNOX LABORATORIO CLINICO">DIAGNOX LABORATORIO CLINICO</option>
<option value="DISTRIBUIDORA DEKAFARMA S.A. DE C.V.">DISTRIBUIDORA DEKAFARMA S.A. DE C.V.</option>
          </select>   
    </div>  </div> 
 
    <div class="form-group">
    <label for="exampleInputEmail1">Elija sucursal</label>
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-clinic-medical"></i></span>
  <select id = "sucursalconorden" name="SucursalConOrdenDestino" class = "form-control" required  >
  <option value="">Seleccione una Sucursal:</option>
                                               
           <option value="18">Akil</option>
           <option value="24">Capacitación</option>
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
  </div>  </div>  
   



    <div class="form-group">
  <label for="exampleInputEmail1"># de orden de traspaso</label>
    <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-list-ol"></i></span>
   <input type="number" value="<?php echo $totalmonto?>"  class="form-control"  name="NumOrden" readonly>
    </div>  </div>  

    <div class="form-group" id="numFacturaContainer">
    <label for="exampleInputEmail1"># de factura</label>
    <div class="input-group-prepend">
        <span class="input-group-text" id="Tarjeta2"><i class="fas fa-file-invoice"></i></span>
        <input type="Text" class="form-control" name="NumFactura" id="NumFactura" onchange="comprobarUsuario()">
    </div>
    <span id="estadousuario"></span>

    <p><img src="https://controlfarmacia.com/JefaturaEnfermeria/loadergif.gif" id="loaderIcon" style="display:none;width: 50%;height: 32%;" /></p>
</div>
</div>

  <div class="form-group" style="display:none;">
    
    <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-barcode"></i></span>
    <input type="text" name="sucursalLetras" id="sucursalLetras" class="form-control">
    </div>  </div>
    <button type="submit"  id="registrotraspaso" value="Guardar" class="btn btn-success">Generar orden de traspaso <i class="fas fa-exchange-alt"></i></button>
</div>
    
                                        </form>
                                        </div>
                                        </div> </div>
     <script>
$(document).on('change', '#sucursalconorden', function(event) {
     $('#sucursalLetras').val($("#sucursalconorden option:selected").text());
});

     </script>

<script>
    // Función para manejar cambios en el proveedor seleccionado
    $('#nombreproveedor').on('change', function() {
        var selectedProveedor = $(this).val();

        if (selectedProveedor === 'CEDIS') {
            $('#numFacturaContainer').hide(); // Ocultar el input NumFactura

            // Combinar las primeras 4 letras del input sucursalLetras con totalmonto y establecerlo como valor del input NumOrden
            var inputSucursal = $('#sucursalLetras').val().slice(0, 4);
            var totalmonto = '<?php echo $totalmonto; ?>'; // Convertimos $totalmonto a cadena con comillas
            $('#NumOrden').val(inputSucursal + totalmonto);
        } else {
            $('#numFacturaContainer').show(); // Mostrar el input NumFactura
        }
    });

    // Llamar al evento change del select al cargar la página para establecer el valor inicial de NumOrden solo si se seleccionó CEDIS
    $(document).ready(function() {
        if ($('#nombreproveedor').val() === 'CEDIS') {
            $('#nombreproveedor').trigger('change');
        }
    });
</script>
<script>

function comprobarUsuario() {
	$("#loaderIcon").show();
	jQuery.ajax({
	url: "https://controlfarmacia.com/JefaturaEnfermeria/Consultas/ComprobarFactura.php",
	data:'NumFactura='+$("#NumFactura").val(),
	type: "POST",
	success:function(data){
		$("#estadousuario").html(data);
		$("#loaderIcon").hide();
	},
	error:function (){}
	});
}

</script>
<script>
  
  function desactivar()
{
  $('#registrotraspaso').attr('disabled', true);
  
}

function reactivar(){
  $('#registrotraspaso').attr('disabled', false);
}
</script>
    </div>
  </div>
  </div>
  </div>
  