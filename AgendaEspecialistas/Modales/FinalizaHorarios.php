<div class="modal fade" id="FinalizaHorario" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
<div class="modal-dialog  modal-notify modal-warning">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Cambio de vigencia en horarios</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div class="alert alert-success alert-styled-left text-blue-800 content-group">
						                <span class="text-semibold">Estimado usuario, </span>
                            los campos con un  <span class="text-danger"> * </span> son campos necesarios para el correcto ingreso de datos.
                          
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
      <div class="modal-body">
     
      <form action="javascript:void(0)" method="post" id="FinalizaH">
 <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Sucursal</label>
    <select id = "sucursalf" class = "form-control" name = "SucursalF">
                                               <option value="">Seleccione una Sucursal:</option>
        <?
          $query = $mysqli -> query ("SELECT 	ID_SucursalC,Nombre_Sucursal FROM Sucursales_CampañasV2 WHERE Estatus_Sucursal = 'Vigente' AND ID_H_O_D='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_SucursalC].'">'.$valores[Nombre_Sucursal].'</option>';
          }
        ?>  </select>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Especialidad </label>
    <select  id = "especialidadf" name = "EspecialidadF"  class = "form-control" disabled = "disabled" >
								<option value = "">Selecciona una especialidad</option>
							</select>
    </div>
  </div>
  <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Medico</label>
    <select  id = "medicof" name = "MedicoF"  class = "form-control"  disabled = "disabled" >
								<option value = "">Selecciona un medico</option>
							</select>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Fecha </label>
    <select  id = "fechaf" name = "FechaF"  class = "form-control " disabled = "disabled" >
								<option value = "">Selecciona una fecha</option>
							</select>
    </div>
  </div>
 




      <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-warning">Finalizar <i class="fas fa-save"></i></button>
                                        </form>
                                       
     

      </div>
    </div>
  </div>
</div></div></div></div>
