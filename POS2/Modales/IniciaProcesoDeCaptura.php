
  
      <div class="modal fade bd-example-modal-xl" id="IniciaCapturaDeFacturaProceso" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Seleccion de proveedor <i class="fas fa-credit-card"></i></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
     
      <div class="modal-body">
     
 <form  method="POST" action="https://controlfarmacia.com/POS2/CapturadorDeFacturas">
    
 
    <div class="form-group">
    
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-barcode"></i></span>
  <select id = "sucursalconorden" name="SucursalConOrdenDestino" class = "form-control" required  >
  <option value="">Seleccione una Proveedor:</option>
                                               <?
          $query = $conn -> query ("SELECT ID_Proveedor,Nombre_Proveedor,ID_H_O_D,Estatus FROM Proveedores_POS WHERE Estatus='Alta' AND  ID_H_O_D='".$row['ID_H_O_D']."'");
        
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[Nombre_Proveedor].'">'.$valores[Nombre_Proveedor].'</option>';
          }
                        ?>
        </select>   
  </div>  </div>  
  <input type="text" name="SucursalCaptura" id="sucursal"  value="<?echo $row['Nombre_Sucursal']?>" class="form-control">
  <input type="text" name="SucursalCapturaValue" id="sucursalvalue"  value="<?echo $row['Fk_Sucursal']?>" class="form-control">
  <div class="form-group" style="display:none;">
    
    <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-barcode"></i></span>
    <input type="text" name="sucursalLetras" id="sucursalLetras" class="form-control">
   
    </div>  </div>
</div>
    <button type="submit"  id="submit_registroarea" value="Guardar" class="btn btn-success">Generar orden de traspaso <i class="fas fa-exchange-alt"></i></button>
                                        </form>
                                        </div>
                                        </div>
     <script>
$(document).on('change', '#sucursalconorden', function(event) {
     $('#sucursalLetras').val($("#sucursalconorden option:selected").text());
});

     </script>
    </div>
  </div>
  </div>
  </div>
  