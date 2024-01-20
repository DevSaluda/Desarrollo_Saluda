
  <?php
   $sql ="SELECT * FROM Traspasos_generados   order by ID_Traspaso_Generado desc limit 1";
   $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$Ticketss = mysqli_fetch_assoc($resultset);


$monto1 = $Ticketss['Num_Orden'];; 
$monto2 = 1; 
$totalmonto = $monto1 + $monto2; 

   
  
  ?>
      <div class="modal fade bd-example-modal-xl" id="FiltroParaSucursalesVarias" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-info">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Seleccion de sucursal para traspaso entre sucursales  <i class="fas fa-credit-card"></i></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
     
      <div class="modal-body">
     
 <form  method="POST" action=" https://saludapos.com/CEDISMOVIL/GeneradorTraspasosEntreSucursalesV2">
    
 
    <div class="form-group">
    <label for="exampleInputEmail1">Elija sucursal Origen </label>
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-barcode"></i></span>
  <select id = "SucursalDeOrigen" name="SucursalDeOrigen" class = "form-control" required  >
  <option value="">Seleccione una Sucursal:</option>
                                               <?php
          $query = $conn -> query ("SELECT ID_SucursalC,Nombre_Sucursal,ID_H_O_D FROM SucursalesCorre WHERE ID_H_O_D='".$row['ID_H_O_D']."'");
        
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["ID_SucursalC"].'">'.$valores["Nombre_Sucursal"].'</option>';
          }
                        ?>
        </select>   
  </div>  </div>  

  <div class="form-group">
    <label for="exampleInputEmail1">Elija sucursal Destino </label>
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-barcode"></i></span>
  <select id = "sucursalconordenDestino" name="SucursalConOrdenDestino" class = "form-control" required  >
  <option value="">Seleccione una Sucursal:</option>
                                               <?php
          $query = $conn -> query ("SELECT ID_SucursalC,Nombre_Sucursal,ID_H_O_D FROM SucursalesCorre WHERE ID_H_O_D='".$row['ID_H_O_D']."'");
        
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["ID_SucursalC"].'">'.$valores["Nombre_Sucursal"].'</option>';
          }
                        ?>
        </select>   
  </div>  </div>  
  <div class="form-group">
  <label for="exampleInputEmail1">Elija razon de traspaso</label>
    <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-barcode"></i></span>
    <select id = "nombreproveedor" name="NombreProveedor" class = "form-control" required  >
    <option value="">Seleccione un opcion:</option>
    <option value="Devolucion a cedis">Devolucion a cedis</option>
    <option value="Traspaso entre sucursales">Traspaso entre sucursales</option>   
    <option value="Retiro por sobre stock">Retiro por sobre stock</option>  
    <option value="Prontos a caducar">Prontos a caducar</option>    
    <option value="Producto dañado">Producto dañado</option>    

         
          </select>   
    </div>  </div>  



    <div class="form-group">
  <label for="exampleInputEmail1"># de orden de traspaso</label>
    <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-barcode"></i></span>
   <input type="number" value="<?php echo $totalmonto?>"  class="form-control"  name="NumOrden" readonly>
    </div>  </div>  
  <div class="form-group" style="display:none;" >
    
    <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-barcode"></i></span>
    <input type="text" name="sucursalLetrasDestino" id="sucursalLetrasDestino" class="form-control">
    <input type="text" name="sucursalLetrasOrigen" id="sucursalLetrasOrigen" class="form-control">
    </div>  </div>
</div>
    <button type="submit"  id="submit_registroarea" value="Guardar" class="btn btn-success">Generar orden de traspaso <i class="fas fa-exchange-alt"></i></button>
                                        </form>
                                        </div>
                                        </div>
     <script>
$(document).on('change', '#sucursalconordenDestino', function(event) {
     $('#sucursalLetrasDestino').val($("#sucursalconordenDestino option:selected").text());
});

     </script>

<script>
$(document).on('change', '#SucursalDeOrigen', function(event) {
     $('#sucursalLetrasOrigen').val($("#SucursalDeOrigen option:selected").text());
});

     </script>
    </div>
  </div>
  </div>
  </div>
  