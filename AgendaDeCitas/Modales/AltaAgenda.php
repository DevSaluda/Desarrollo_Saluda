<div class="modal fade bd-example-modal-xl" id="AltaAgenda" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
    

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agendar nueva cita</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <span id="error_agenda" class="alert alert-danger" style="display: none"></span>
        <p id="show_error"  class="alert alert-danger" style="display: none">Algo salio mal </p>
      <div class="modal-body">
 
 <form action="javascript:void(0)" method="post" id="ajax-form">
 <div class="form-row">
    <div class="col">
    <label for="exampleFormControlInput1">Sucursal </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-hospital-alt"></i></span>
  </div>
 <select id = "sucursal" class = "form-control form-control-sm" name = "Sucursal" >
                                               <option value="0">Seleccione una Sucursal:</option>
        <?
          $query = $mysqli -> query ("SELECT 	ID_SucursalC,Nombre_Sucursal,ID_H_O_D FROM Sucursales_Campañas WHERE Estatus_Sucursal='Activo' AND ID_H_O_D='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_SucursalC].'">'.$valores[Nombre_Sucursal].'</option>';
          }
        ?>  </select>
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Especialidad</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-hospital-user"></i></span>
  </div>
  <select  id = "especialidad" name = "Especialidad"  class = "form-control form-control-sm" disabled = "disabled" >
								<option value = "">Selecciona una especialidad</option>
							</select>
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Medico</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-user-md"></i></span>
  </div>
  <select  id = "medico" name = "Medico"  class = "form-control form-control-sm" disabled = "disabled" >
								<option value = "">Selecciona un medico</option>
							</select>
</div>
    </div>
  </div>
  <div class="form-row">
    <div class="col">
    <label for="exampleFormControlInput1">Fecha </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-calendar-alt"></i></span>
  </div>
  <select  id = "fecha" name = "Fecha"  class = "form-control form-control-sm" disabled = "disabled" >
								<option value = "">Selecciona una fecha</option>
							</select>
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Hora de cita</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-clock"></i></span>
  </div>
  <select  id = "hora" name = "Hora"  class = "form-control form-control-sm" disabled = "disabled" >
								<option value = "">Selecciona una hora</option>
							</select>
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Costo</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-dollar-sign"></i></span>
  </div>
  <select  id = "costo" name = "Costo"  class = "form-control form-control-sm" disabled = "disabled" >
								<option value = "">Selecciona un costo</option>
							</select>
</div>
    </div>
  </div>
  <div class="form-row">
    <div class="col">
    <label for="exampleFormControlInput1">Nombre paciente </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control form-control-sm" name="NombreP" id="nombrep" placeholder="Por ejemplo : Luis Manuel" aria-describedby="basic-addon1">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Telefono</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-phone"></i></span>
  </div>
  <input type="number" class="form-control form-control-sm" name="Telefono" id="telefono" placeholder="Por ejemplo: 9992012309" aria-describedby="basic-addon1">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Tipo de consulta</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-hand-pointer"></i></span>
  </div>
  <select name="TipoConsulta" class="form-control form-control-sm" id="tipoconsulta" >
									  <option value="0">Elige un tipo de consulta</option>
				
              <option  value="Primera vez">Primera vez</option>		
              <option  value="Revaloracion">Revaloracion</option>						  
						 </select>
</div>
    </div>
  </div>
  <div class="form-row">
    <div class="col">
    <label for="exampleFormControlInput1">Estatus pago </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-money-check-alt"></i></span>
  </div>
  <select name="Colorpago" class="form-control form-control-sm" id="colorpago" onchange="ShowSelected();">
									  <option value="0">Elige un estatus</option>
				
              <option  value="btn btn-success btn-sm">Pagado</option>		
              <option  value="btn btn-warning btn-sm">Pendiente</option>						  
						 </select>  
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Estado Consulta</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-headset"></i></span>
  </div>
  <select name="Colorcita" class="form-control form-control-sm" id="colorcita" onchange="ShowSelected2();">
									  <option value="0">Elige un estatus</option>
				
              <option  value="btn btn-success btn-sm">Confirmada</option>		
              <option  value="btn btn-secondary btn-sm">Sin Confirmar</option>						  
						 </select>
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Observaciones</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-comment-dots"></i></span>
  </div>
  <textarea id="observaciones" class="form-control form-control-sm"  name="Observaciones" rows="2" cols="50">
  </textarea>
</div>
    </div>
  </div>
 
 
  
  <input type="hidden" readonly name="EstatusPago" id="estatuspago"  >
  <input type="hidden" readonly name="EstatusCita" id="estatuscita"  >
  <input type="hidden" readonly name="EstatusSeguimiento" id="estatussegui" value="Sin seguimiento" >
  <input type="hidden" readonly name="ColorSigue" id="colorsegui" value="btn btn-dark btn-sm" >
  <input type="text" class="form-control" id="empresa" name="Empresa" hidden  readonly value="<? echo $row['ID_H_O_D']?>" >
  <input type="text" class="form-control" id="agenda" name="AgendaPor" hidden readonly   value="Call Center" >
  <input type="text" class="form-control" id="sistema" name="Sistema" hidden  readonly value="Control de citas" >
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