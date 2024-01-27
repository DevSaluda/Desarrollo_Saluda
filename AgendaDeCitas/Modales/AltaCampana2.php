<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva cita</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <span id="error_agenda" class="alert alert-danger" style="display: none"></span>
        <p id="show_error"  class="alert alert-danger" style="display: none">Algo salio mal </p>
      <div class="modal-body">
 
 <form action="javascript:void(0)" method="post" id="ajax-form">
    
 <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Especialidad </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
 <select id = "especialidad" class = "form-control form-control-sm" name = "Especialidad">
                                               <option value="0">Seleccione una Especialidad:</option>
        <?php
          $query = $mysqli -> query ("SELECT ID_Especialidad,Nombre_Especialidad,ID_H_O_D FROM Especialidades WHERE Estatus_Especialidad='Activo' AND ID_H_O_D='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["ID_Especialidad"].'">'.$valores["Nombre_Especialidad"].'</option>';
          }
        ?>  </select>
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Especialista</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select  id = "medico" name = "Medico"  class = "form-control form-control-sm" disabled = "disabled" >
								<option value = "">Selecciona un medico</option>
							</select>
</div>
    </div>
  </div>
  <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Sucursal</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select  id = "sucursal" name = "Sucursal"  class = "form-control form-control-sm" disabled = "disabled" >
								<option value = "">Selecciona una sucursal</option>
							</select>
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Fecha</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select  id = "fecha" name = "Fecha"  class = "form-control form-control-sm" disabled = "disabled" >
								<option value = "">Selecciona una fecha</option>
							</select>
</div>
    </div>
  </div>
  <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Hora</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select  id = "hora" name = "Hora"  class = "form-control form-control-sm" disabled = "disabled" >
								<option value = "">Selecciona una hora</option>
							</select>
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Nombre paciente</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control form-control-sm" name="NombreP" id="nombrep"  aria-describedby="basic-addon1">
</div>
    </div>
  </div>
  <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Telefono</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="number" class="form-control form-control-sm" name="Telefono" id="telefono"  aria-describedby="basic-addon1">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Tipo consulta</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select name="TipoConsulta" class="form-control form-control-sm" id="tipoconsulta" >
									  <option value="0">Elige un tipo de consulta</option>
				
              <option  value="Primera vez">Primera vez</option>		
              <option  value="Revaloracion">Revaloracion</option>						  
						 </select>
</div>
    </div>
  </div>
  <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Estado pago</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select name="Colorpago" class="form-control form-control-sm" id="colorpago" onchange="ShowSelected();">
									  <option value="0">Elige un estatus</option>
				
              <option  value="btn btn-success btn-sm">Pagado</option>		
              <option  value="btn btn-warning btn-sm">Pendiente</option>						  
						 </select>
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Estado consulta</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select name="Colorcita" class="form-control form-control-sm" id="colorcita" onchange="ShowSelected2();">
									  <option value="0">Elige un estatus</option>
				
              <option  value="btn btn-success btn-sm">Confirmada</option>		
              <option  value="btn btn-secondary btn-sm">Sin Confirmar</option>						  
						 </select>
</div>
    </div>
  </div>
  <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Costo</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select  id = "costo" name = "Costo"  class = "form-control form-control-sm" disabled = "disabled" >
								<option value = "">Selecciona un costo</option>
							</select>
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Observaciones</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <textarea id="observaciones" class="form-control form-control-sm"  name="Observaciones" rows="2" cols="50">
</textarea>
</div>
    </div>
  </div>
  
  <input type="hidden" name="EstatusPago" id="estatuspago"  >
  <input type="hidden" name="EstatusCita" id="estatuscita"  >
  <input type="hidden" name="EstatusSeguimiento" id="estatussegui" value="Sin seguimiento" >
  <input type="hidden" name="ColorSigue" id="colorsegui" value="btn btn-dark btn-sm" >
  <input type="text" class="form-control" id="empresa" name="Empresa" hidden   value="<?php echo $row['ID_H_O_D']?>" >
  <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-primary">Guardar <i class="fas fa-save"></i></button>
                                        </form>
     
</form>

      <div class="modal-footer">
      <p class="statusMsg"></p>

      </div>
    </div>
  </div>
</div>  </div>
</div></div>  </div>
</div>
<script type="text/javascript">
function ShowSelected()
{

 
/* Para obtener el texto */
var combo = document.getElementById("colorpago");
var selected = combo.options[combo.selectedIndex].text;
$("#estatuspago").val(selected);
}
function ShowSelected2()
{

 
/* Para obtener el texto */
var combo = document.getElementById("colorcita");
var selected = combo.options[combo.selectedIndex].text;
$("#estatuscita").val(selected);
}
</script>