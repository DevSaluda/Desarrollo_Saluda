<div class="modal fade bd-example-modal-xl" id="AltaAgenda" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-notify modal-primary">
    <div class="modal-content">
    

    <div class="modal-header">
         <p class="heading lead">Agendar cita con especialista</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span class="text-semibold">Estimado usuario, </span>
                            los campos con un  <span class="text-danger"> * </span> son campos necesarios para el correcto ingreso de datos. <br>
                            De igual forma algunos campos, pueden añadirse sin que contenga datos, estos pueden editarse más tarde en la opción "editar"
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
        <div class="modal-body">
         <div class="text-center">
 
 <form action="javascript:void(0)" method="post" id="ajax-form">
 <div class="form-row">
    <div class="col">
    <label for="exampleFormControlInput1">Sucursal <span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-hospital-alt"></i></span>
  </div>
 <select id = "sucursal" class = "form-control " name = "Sucursal" >
                                               <option value="">Seleccione una Sucursal:</option>
        <?
          $query = $mysqli -> query ("SELECT 	ID_SucursalC,Nombre_Sucursal,ID_H_O_D FROM Sucursales_Campañas WHERE Estatus_Sucursal='Activo' AND ID_H_O_D='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_SucursalC].'">'.$valores[Nombre_Sucursal].'</option>';
          }
        ?>  </select>
      
      </div>
      <label for="sucursal" class="error">
    </div>
    <div class="col">
      
    <label for="exampleFormControlInput1">Especialidad <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-hospital-user"></i></span>
  </div>
  <select  id = "especialidad" name = "Especialidad"  class = "form-control" disabled = "disabled" >
								<option value = "">Selecciona una especialidad</option>
              </select>
              
</div>
<label for="especialidad" class="error">
    </div>
   
    <div class="col">
    <label for="exampleFormControlInput1">Medico <span class="text-danger">*</span> </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-user-md"></i></span>
  </div>
  <select  id = "medico" name = "Medico"  class = "form-control " disabled = "disabled" >
								<option value = "">Selecciona un medico</option>
							</select>
</div>
<label for="medico" class="error">
    </div>
  </div>
  <div class="form-row">
    <div class="col">
    <label for="exampleFormControlInput1">Fecha <span class="text-danger">*</span> </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-calendar-alt"></i></span>
  </div>
  <select  id = "fecha" name = "Fecha"  class = "form-control " disabled = "disabled" >
								<option value = "">Selecciona una fecha</option>
							</select>
</div>
<label for="fecha" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Hora de cita <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-clock"></i></span>
  </div>
  <select  id = "hora" name = "Hora"  class = "form-control " disabled = "disabled" >
								<option value = "">Selecciona una hora</option>
							</select>
</div>
<label for="hora" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Costo <span class="text-danger">*</span> </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-dollar-sign"></i></span>
  </div>
  <select  id = "costo" name = "Costo"  class = "form-control " disabled = "disabled" >
								<option value = "">Selecciona un costo</option>
							</select>
</div>
<label for="costo" class="error">
    </div>
  </div>
  <div class="form-row">
    <div class="col">
    <label for="exampleFormControlInput1">Nombre paciente <span class="text-danger">*</span> </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " name="NombreP" id="nombrep" placeholder="Por ejemplo : Luis Manuel" aria-describedby="basic-addon1" maxlength="60">
</div>
<label for="nombrep" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Telefono <span class="text-danger">*</span> </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-phone"></i></span>
  </div>
  <input type="number" class="form-control " name="Telefono" id="telefono" placeholder="Por ejemplo: 9992012309" aria-describedby="basic-addon1">
</div>
<label for="telefono" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Tipo de consulta <span class="text-danger">*</span> </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-hand-pointer"></i></span>
  </div>
  <select name="TipoConsulta" class="form-control " id="tipoconsulta" >
									  <option value="">Elige un tipo de consulta</option>
				
              <option  value="Primera vez">Primera vez</option>		
              <option  value="Revaloracion">Revaloracion</option>						  
						 </select>
</div>
<label for="tipoconsulta" class="error">
    </div>
  </div>
  <div class="form-row">
    <div class="col">
    <label for="exampleFormControlInput1">Estatus pago <span class="text-danger">*</span> </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-money-check-alt"></i></span>
  </div>
  <select name="Colorpago" class="form-control " id="colorpago" onchange="ShowSelected();">
									  <option value="">Elige un estatus</option>
				
              <option  value="btn btn-success btn-sm">Pagado</option>		
              <option  value="btn btn-warning btn-sm">Pendiente</option>						  
						 </select>  
</div>
<label for="colorpago" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Estado Consulta <span class="text-danger">*</span> </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-headset"></i></span>
  </div>
  <select name="Colorcita" class="form-control " id="colorcita" onchange="ShowSelected2();">
									  <option value="">Elige un estatus</option>
				
              <option  value="btn btn-success btn-sm">Confirmada</option>		
              <option  value="btn btn-secondary btn-sm">Sin Confirmar</option>						  
						 </select>
</div>
<label for="colorcita" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Observaciones</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-comment-dots"></i></span>
  </div>
  <textarea id="observaciones" class="form-control "  name="Observaciones" rows="2" cols="50">
  </textarea>
</div>
    </div>
  </div>
 
 
  
  <input type="hidden" readonly name="EstatusPago" id="estatuspago"  >
  <input type="hidden" readonly name="EstatusCita" id="estatuscita"  >
  <input type="hidden" readonly name="EstatusSeguimiento" id="estatussegui" value="Sin seguimiento" >
  <input type="hidden" readonly name="ColorSigue" id="colorsegui" value="btn btn-dark btn-sm" >
  <input type="text" class="form-control" id="empresa" name="Empresa" hidden  readonly value="<? echo $row['ID_H_O_D']?>" >
  <input type="text" class="form-control" id="agenda" name="AgendaPor" hidden readonly   value="<?echo $row['Nombre_Apellidos']?>" >
  <input type="text" class="form-control" id="sistema" name="Sistema"  hidden  readonly value="<?echo $row['Nombre_rol']?>" >
  <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-primary">Guardar <i class="fas fa-save"></i></button>
                                        </form>
     
</form>


    
      <p class="statusMsg"></p>

    
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