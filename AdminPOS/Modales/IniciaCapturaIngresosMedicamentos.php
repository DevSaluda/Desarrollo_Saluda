
  
      <div class="modal fade bd-example-modal-xl" id="IngresoMedicamentos" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Seleccion de sucursal para ingreso <i class="fas fa-credit-card"></i></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
     
      <div class="modal-body">
     
 <form  method="POST" action="https://saludapos.com/AdminPOS/GeneradorDeIngresoDeMedicamentos">
    
 
    <div class="form-group">
    
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-barcode"></i></span>
  <select id = "sucursalconorden" name="SucursalConOrdenDestino" class = "form-control" required  >
  <option value="">Seleccione la sucursal a la que se ingresaran medicamentos:</option>
                                               <?
          $query = $conn -> query ("SELECT ID_SucursalC,Nombre_Sucursal,ID_H_O_D FROM SucursalesCorre WHERE ID_H_O_D='".$row['ID_H_O_D']."'");
        
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_SucursalC].'">'.$valores[Nombre_Sucursal].'</option>';
          }
                        ?>
        </select>   
  </div>  </div>  

  <div class="form-group" style="display:none;">
    
    <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-barcode"></i></span>
    <input type="text" name="sucursalLetras" id="sucursalLetras" class="form-control">
    </div>  </div>
</div>
    <button type="submit"  id="submit_registroarea" value="Guardar" class="btn btn-success">Generar Orden de ingreso de medicamentos <i class="fas fa-clipboard-list"></i></button>
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
  