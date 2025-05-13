<div class="modal fade" id="AltaHorario" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
<div class="modal-dialog  modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Alta de sucursal para campañas medicas</p>

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
     
 <form action="VerificaHoras" method="post" >
 <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Sucursal</label>
    <select id = "sucursal" class = "form-control" name = "Sucursal">
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
    <select  id = "especialidad" name = "Especialidad"  class = "form-control" disabled = "disabled" >
								<option value = "">Selecciona una especialidad</option>
							</select>
    </div>
  </div>
  <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Medico</label>
    <select  id = "medico" name = "Medico"  class = "form-control"  disabled = "disabled" >
								<option value = "">Selecciona un medico</option>
							</select>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Fecha </label>
    <select  id = "fecha" name = "Fecha"  class = "form-control " disabled = "disabled" >
								<option value = "">Selecciona una fecha</option>
							</select>
    </div>
  </div>
 


<label for="exampleFormControlInput1">Hora inicial </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="time" class="form-control" name="HoraInicio" id="horai"  aria-describedby="basic-addon1">
</div>

<label for="exampleFormControlInput1">Hora final </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="time" class="form-control" name="HoraFinal" id="horaf"  aria-describedby="basic-addon1">
</div>

<label for="exampleFormControlInput1">Intervalo de tiempo entre citas </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="number" class="form-control" name="Intervalo" id="intervalo"  aria-describedby="basic-addon1">
</div>

      <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-primary">Guardar <i class="fas fa-save"></i></button>
                                        </form>
                                       
     

      </div>
    </div>
  </div>
</div></div></div></div>
