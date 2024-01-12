<div class="modal fade" id="AltaCampana" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo especialista</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <span id="error" class="alert alert-danger" style="display: none"></span>
        <p id="show_message" style="display: none">Form data sent. Thanks for your comments.We will update you within 24 hours. </p>
        <p id="show_error"  class="alert alert-danger" style="display: none">Algo salio mal </p>
      <div class="modal-body">
 
 <form action="javascript:void(0)" method="post" id="ajax-form">
    
<label for="exampleFormControlInput1">Especialidad </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
 <select id = "especialidad" class = "form-control" name = "Especialidad">
                                               <option value="0">Seleccione una Especialidad:</option>
        <?
          $query = $mysqli -> query ("SELECT ID_Especialidad,Nombre_Especialidad,ID_H_O_D FROM Especialidades WHERE ID_H_O_D='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_Especialidad].'">'.$valores[Nombre_Especialidad].'</option>';
          }
        ?>  </select>
</div>
<label for="exampleFormControlInput1">Medico Especialista</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select  id = "medico" name = "Medico"  class = "form-control" disabled = "disabled" required = "required">
								<option value = "">Selecciona un medico</option>
							</select>
</div>
<label for="exampleFormControlInput1">Fecha </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="Date" class="form-control" name="Fecha" id="fecha"  aria-describedby="basic-addon1">
</div>
<label for="exampleFormControlInput1">Hora de citas </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="time" class="form-control" name="Hora" id="hora"  aria-describedby="basic-addon1">
</div>


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
