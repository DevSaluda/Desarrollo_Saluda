<div class="modal fade" id="AltaCosto" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
<div class="modal-dialog  modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Alta de especialidad</p>

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
     
 <form action="javascript:void(0)" method="post" id="AltaDeCostos">
    
 <label for="exampleFormControlInput1">Sucursal</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select id = "sucursal" class = "form-control" name = "Sucursal">
                                               <option value="">Seleccione una Sucursal:</option>
        <?
          $query = $mysqli -> query ("SELECT 	ID_SucursalC,Nombre_Sucursal FROM Sucursales_CampañasV2 WHERE Estatus_Sucursal = 'Vigente' AND ID_H_O_D='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_SucursalC].'">'.$valores[Nombre_Sucursal].'</option>';
          }
        ?>  </select>
         
</div>
<label for="exampleFormControlInput1">Especialidad </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select  id = "especialidad" name = "Especialidad"  class = "form-control " disabled = "disabled" >
								<option value = "">Selecciona una especialidad</option>
							</select>
</div>
<label for="exampleFormControlInput1">Medico Especialista</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select  id = "medico" name = "Medico"  class = "form-control"  disabled = "disabled" >
								<option value = "">Selecciona un medico</option>
							</select>
</div>

<label for="exampleFormControlInput1">Costo de citas</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="Number" class="form-control" name="Costo" id="costo" placeholder="00.00" aria-describedby="basic-addon1">
</div>


<input type="text" class="form-control" id="empresa" name="Empresa" hidden   value="<? echo $row['ID_H_O_D']?>" >
<input type="text" class="form-control" id="usuario" name="Usuario" hidden   value="<? echo $row['Nombre_Apellidos']?>">


        <div>         
      <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
      </div>                            </form>
                                      
    
     

      </div>
    </div>
  </div></div></div></div>