
  
      <div class="modal fade bd-example-modal-xl" id="FiltroPedidosEnfermeria" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Seleccione a quien le realizara el surtido de productos e insumos<i class="fas fa-credit-card"></i></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
     
      <div class="modal-body">
      <div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
  <label class="form-check-label" for="inlineCheckbox1">Enfermero</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
  <label class="form-check-label" for="inlineCheckbox2">Medico</label>
</div>

 <form  method="POST" action="https://saludapos.com/POS2/CreditosEnfermeriaInicia">
    
 
    <div class="form-group">
      <div id="Enfermero" style="display:none;">
    <label for="exampleFormControlInput1">Enfermero al que se le surte </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
  </div>
  <select name="NombreEnfemero" id="nombreenfermero" class = "form-control">
                                               <option value="">Seleccione un enfermero:</option>
        <?php
          $query = $conn -> query ("SELECT Enfermero_ID,Nombre_Apellidos,ID_H_O_D,Fk_Sucursal,Estatus FROM Personal_Enfermeria WHERE Estatus='Vigente' AND ID_H_O_D='".$row['ID_H_O_D']."' AND Fk_Sucursal='".$row['Fk_Sucursal']."' ");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["Nombre_Apellidos"].'">'.$valores["Nombre_Apellidos"].'</option>';
          }
        ?>  </select>  
  </div>
  </div>
   </div>

   <div class="form-group">
   <div id="Medic" style="display:none;">
    <label for="exampleFormControlInput1">Enfermero al que se le surte </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
  </div>
  <select name="NombreEnfemero" id="nombreenfermero" class = "form-control">
                                               <option value="">Seleccione un enfermero:</option>
        <?php
          $query = $conn -> query ("SELECT Enfermero_ID,Nombre_Apellidos,ID_H_O_D,Fk_Sucursal,Estatus FROM Personal_Enfermeria WHERE Estatus='Vigente' AND ID_H_O_D='".$row['ID_H_O_D']."' AND Fk_Sucursal='".$row['Fk_Sucursal']."' ");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["Nombre_Apellidos"].'">'.$valores["Nombre_Apellidos"].'</option>';
          }
        ?>  </select>  
  </div>
  </div>
   </div>
   <div id="botonxd" style="display:none;">
   <input type="text" hidden name="SucursalNombre" value="<?echo $row['Nombre_Sucursal']?>">
   <input type="text" hidden   name="SucursalClave" value="<?echo $row['Fk_Sucursal']?>">
      <button type="submit"  id="submit_registroarea" value="Guardar" class="btn btn-success">Realizar busqueda <i class="fas fa-exchange-alt"></i></button>
                                        </form>
                                        </div> </div>
                                        </div>
     
    </div>
  </div>
  </div>
  </div>
  