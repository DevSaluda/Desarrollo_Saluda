<div class="modal fade" id="AltaPaciente" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo paciente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <span id="error" class="alert alert-danger" style="display: none"></span>
        <p id="show_message" style="display: none">Form data sent. Thanks for your comments.We will update you within 24 hours. </p>
        <p id="show_error"  class="alert alert-danger" style="display: none">Algo salio mal </p>
      <div class="modal-body">
 
 <form action="javascript:void(0)" method="post" id="ajax-form">
     <label for="exampleFormControlInput1">Nombre paciente</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input name="Nombre" id="nombre_apellidos"  required type="text" class="form-control">
</div>
<label for="exampleFormControlInput1">Telefono</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input name="Tel" id="telefono" type="Number" required class="form-control">
</div>
<label for="exampleFormControlInput1">Sucursal</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select name="Sucursal" id="sucursal" required class="form-control">
                                               <option value="0">Seleccione una sucursal:</option>
        <?php
          $query = $conn -> query ("SELECT Nombre_Sucursal FROM SucursalesCorre");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["Nombre_Sucursal"].'">'.$valores["Nombre_Sucursal"].'</option>';
          }
        ?>  </select>
</div>

<input type="text" class="form-control" id="estatus" name="Estatus"    hidden value="Pendiente" >
<input type="text" class="form-control" id="color" name="Color"   hidden value="btn btn-danger" >

<input type="text" class="form-control" id="empresa" name="Empresa" hidden   value="<? echo $row['ID_H_O_D']?>" >
                 
      <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-primary">Guardar <i class="fas fa-save"></i></button>
                                        </form>
                                        <br>
      <div class="modal-footer">
      <p class="statusMsg"></p>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

      </div>
    </div>
  </div>
</div></div>
