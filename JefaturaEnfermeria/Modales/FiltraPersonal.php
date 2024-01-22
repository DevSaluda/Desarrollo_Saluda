
  
      <div class="modal fade bd-example-modal-xl" id="FiltroEspecificopersonal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Filtrado de ventas por empleado<i class="fas fa-credit-card"></i></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
     
      <div class="modal-body">
     
 <form action="FiltradoPorVendedorVentas" method="post" >
    
 
 <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Sucursal Actual </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly  value="<?echo $row['Nombre_Sucursal']?>">
    </div>
    </div>
    
    <div class="col">
    <label for="exampleFormControlInput1">Empleado </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
  </div>
  <select id = "Empleado" class = "form-control" name = "Empleado" >
                                               <option value="">Seleccione un empleado:</option>
        <?
          $query = $conn -> query ("SELECT Pos_ID,Nombre_Apellidos,Fk_Sucursal FROM PersonalPOS WHERE  Fk_sucursal='".$row['Fk_Sucursal']."' ");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[Nombre_Apellidos].'">'.$valores[Nombre_Apellidos].'</option>';
          }
        ?>  </select>
    </div>
    
    <input type="text"  name="user" hidden value="<?echo $row['Pos_ID']?>">
  <div>     </div>
  </div>  </div>
      <button type="submit"  id="submit_registroarea" value="Guardar" class="btn btn-success">Aplicar cambio de sucursal <i class="fas fa-exchange-alt"></i></button>
                                        </form>
                                        </div>
                                        </div>
     
    </div>
  </div>
  </div>
  </div>
  