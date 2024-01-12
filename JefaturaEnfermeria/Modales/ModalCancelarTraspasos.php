
      <div class="modal fade bd-example-modal-xl" id="CancelarTraspasoModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-warning">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Seleccion de sucursal para traspaso <i class="fas fa-credit-card"></i></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
     
      <div class="modal-body">
     
 <form  method="POST" action="https://controlfarmacia.com/JefaturaEnfermeria/EditorTraspasos">
    
 
    <div class="form-group">
    <label for="exampleInputEmail1">Elija sucursal</label>
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-clinic-medical"></i></span>
  <select id = "sucursalconorden" name="SucursalConOrdenDestino" class = "form-control" required  >
  <option value="">Seleccione una Sucursal:</option>
                                               <?
          $query = $conn -> query ("SELECT ID_SucursalC,Nombre_Sucursal,ID_H_O_D FROM SucursalesCorre WHERE ID_H_O_D='".$row['ID_H_O_D']."'");
        
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_SucursalC].'">'.$valores[Nombre_Sucursal].'</option>';
          }
                        ?>
        </select>   
  </div>  </div>  
  <div class="form-group">
  <label for="exampleInputEmail1">Elija proveedor</label>
    <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-dolly"></i></span>
    <select id = "nombreproveedor" name="NombreProveedor" class = "form-control" required  >
    <option value="">Seleccione un proveedor:</option>
                                                 <?
            $query = $conn -> query ("SELECT ID_Proveedor,Nombre_Proveedor,ID_H_O_D,Estatus FROM Proveedores_POS WHERE Estatus='Alta' AND  ID_H_O_D='".$row['ID_H_O_D']."'");
          
            while ($valores = mysqli_fetch_array($query)) {
              echo '<option value="'.$valores[Nombre_Proveedor].'">'.$valores[Nombre_Proveedor].'</option>';
            }
                          ?>
          </select>   
    </div>  </div>  



    <div class="form-group">
  <label for="exampleInputEmail1"># de orden de traspaso</label>
    <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-list-ol"></i></span>
   <input type="number" value="<?php echo $totalmonto?>"  class="form-control"  name="NumOrden" readonly>
    </div>  </div>  

    <div class="form-group">
  <label for="exampleInputEmail1"># de factura</label>
    <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-file-invoice"></i></span>
   <input type="Text"   class="form-control"  name="NumFactura" id="NumFactura" onchange="comprobarUsuario()" >
    </div> 
    <span id="estadousuario"></span> 
     
    <p><img src="https://controlfarmacia.com/JefaturaEnfermeria/loadergif.gif" id="loaderIcon" style="display:none;width: 50%;height: 32%;"/></p>
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
  