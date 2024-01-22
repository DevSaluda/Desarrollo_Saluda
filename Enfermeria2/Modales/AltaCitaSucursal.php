
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fluid">
    <div class="modal-content">
    

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva cita</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <span id="error_alta" class="alert alert-danger" style="display: none"></span>
        <p id="show_error"  class="alert alert-danger" style="display: none">Algo salio mal </p>
      <div class="modal-body">
 
 <form action="javascript:void(0)" method="post" id="ajax-form">
 <div class="form-row">
    <div class="col">
    <label for="Nombre Paciente">Nombre Paciente</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-user-circle"></i></span>
  </div>
  <input type="text" class="form-control" name="Nombre" id="nombre" aria-label="Default" aria-describedby="inputGroup-sizing-default">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Tipo de visita</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-hand-pointer"></i></span>
  </div>
  <select name="Visita" id="visita" class="form-control">
                                               <option value="">Seleccione:</option>
                                               <option value="Primera vez">Primera vez</option>
                                               <option value="Recurrente">Recurrente</option>
                    
                                               <option value="Revaloracion">Revaloracion</option>
       

                                               </select>
                                               <script>
                                                 $( function() {
    $("#visita").change( function() {
        if ($(this).val() === "Primera vez") {
            $("#entero").prop("disabled", false);
        } else {
            $("#entero").prop("disabled", true);
        }
    });
});
                                               </script>
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Sexo</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-venus-mars"></i></span>
  </div>
  <select name="Sexo" id="sexo" class="form-control">
                                               <option value="0">Seleccione:</option>
                                               <option value="Masculino">Masculino</option>
                                               <option value="Femenino">Femenino</option>
                                          
       

                                               </select>
                                             
</div>
    </div>
  </div>
  <?php include "Consultas/Select_Edades.php"?>
    <div class="col">
    <label for="exampleFormControlInput1">Talla</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-hand-pointer"></i></span>
  </div>
  <input type="number" step="any" class="form-control" id="talla" name="Talla" aria-label="Default" aria-describedby="inputGroup-sizing-default"  >
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Peso</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input name="Peso" id="peso" step="any"type="number" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
</div>
    </div>
  </div>

  <div class="form-row">
    <div class="col">
    <label for="Nombre Paciente">Temperatura</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-temperature-high"></i></span>
  </div>
  <input type="number" step="any" class="form-control" id="temp" name="Temp"  >
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">T/A</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-pager"></i></span>
  </div>
  <input name="TA" id="TA"  step="any" type="number" class="form-control">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">FC</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-pager"></i></span>
  </div>
  <input type="number" step="any" class="form-control" id="FC" name="FC"  >
                                             
</div>
    </div>
  </div>

  <div class="form-row">
    <div class="col">
    <label for="Nombre Paciente">FR</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-pager"></i></span>
  </div>
  <input name="FR" id="FR" type="number" step="any" class="form-control">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">DxTx</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-pager"></i></span>
  </div>
  <input type="number" step="any" class="form-control" id="DxTx" name="DxTx"  >
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">SaO2</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-pager"></i></span>
  </div>
  <input type="number" step="any" class="form-control" id="SaO2" name="SaO2"  >
                                             
</div>
    </div>
  </div>
  <div class="form-row">
    <div class="col">
    <label for="Nombre Paciente">Alergia</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-allergies"></i></span>
  </div>
  <input name="Alergia" id="alergia"  type="text" class="form-control">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Motivo de consulta</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-notes-medical"></i></span>
  </div>
  <input type="text" class="form-control" id="Consulta"  name="Consulta"  >
</div>
    </div>
      
   <?Include "Consultas/Select_horas.php"?>

   <div class="form-row">
    <div class="col">
    <label for="Nombre Paciente">Doctor</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-user-md"></i></span>
  </div>
  <input name="Doc" id="Doc"  type="text" class="form-control">                     
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Telefono</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-phone"></i></span>
  </div>
  <input type="number" class="form-control" id="tel" name="Tel"   >
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Correo</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input name="Correo" id="correo" type="text" class="form-control">
                                             
</div>
    </div>
  </div>
   

   <!-- INICIA SELECT ESTADO,MUNICIPIO,LOCALIDAD -->
   <div class="form-row">
    <div class="col">
    <label for="Nombre Paciente">Selecciona estado</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-user-md"></i></span>
  </div>
  <select id = "estado" class = "form-control form-control-sm" name = "Estado" >
  <option value="0">Selecciona un estado:</option>
        <?php
          $query = $mysqli -> query ("SELECT ID_Estado,Nombre_Estado FROM Estados");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["ID_Estado"].'">'.$valores["Nombre_Estado"].'</option>';
          }
        ?>  </select>             
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Municipio</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-phone"></i></span>
  </div>
  <select  id = "municipio"  class = "form-control form-control-sm" disabled = "disabled" >
								<option value = "">Selecciona un municipio</option>
							</select>
  </div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Localidad</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <select  id ="procede" name="Procede"  class = "form-control form-control-sm" disabled = "disabled" >
								<option value = "">Selecciona localidad</option>
							</select>
                                             
</div>
    </div>
  </div>




   <div class="form-row">
    <div class="col">
    <label for="Nombre Paciente">Se entero por</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-user-md"></i></span>
  </div>
  <select name="Entero" id="entero" class="form-control">
                                               <option value="No aplica">Seleccione:</option>
                                               <option value="Recomendacion de un amigo/familiar">Recomendacion de un amigo/familiar</option>
                                               <option value="Redes sociales">Redes sociales</option>
                    
                                               <option value="Material impreso">Material impreso </option>
                                               <option value="Perifonista ">Perifonista </option>
       
       

                                               </select>
</div>
    </div>
   </div>
  
<input type="text" hidden class="form-control" readonly id="turno" name="Turno"  value="<?php echo $Turno?>"  >
  <input name="FechaConsulta" id="FechaConsulta"   hidden  type="date"   value="<?php echo date("Y-m-d") ?>" Readonly class="form-control">                                     

<input type="text" class="form-control" id="SC" name="SC" readonly hidden value="<?php echo $row['ID_Sucursal']?>" >
<input name="Propiedad" id="Propiedad" type="text" class="form-control" hidden  readonly value="<?php echo $row['ID_H_O_D']?>">
<input type="text" class="form-control" id="enfermero" name="Enfermero" hidden readonly value="<?php echo $row['Nombre_Apellidos']?>"  >
   </div>   
   <div>
   <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-primary">Guardar <i class="fas fa-save"></i></button>
                                  
</form>

      <div class="modal-footer">
      <p class="statusMsg"></p>

      </div>
    </div>
  </div>
</div>  </div>
</div></div>  </div>
</div>
