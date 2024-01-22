
<div class="modal fade" id="CitaExt" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="Di"class="modal-dialog modal-lg modal-notify modal-success">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="Titulo">Agendamiento de cita de revaloracion </p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="Mensaje "class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold">Estimado usuario, 
                            Verifique los campos antes de realizar alguna accion</span>
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
     
<form action="javascript:void(0)" method="post" id="AgendaExternoRevaloraciones" >

<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Nombre del paciente</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="fas fa-user"></i></span>
  </div>
  <input type="text" class="form-control"   name="NombresExt" id="nombresExt" aria-describedby="basic-addon1">
</div>
<div>
  <!-- AQUI SE ANEXA EL MARGEN DE ERROR -->
<label for="nombresExt" class="error">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Telefono</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="fas fa-mobile-alt"></i></span>
  </div>
  <input type="text" class="form-control"   name="TelExt" id="telExt" aria-describedby="basic-addon1">
</div>
<div>
  <!-- AQUI SE ANEXA EL MARGEN DE ERROR -->
<label for="telExt" class="error">
</div>
    </div>
    
    </div>
   
    
 
  
<!-- INICIA DATA DE AGENDA -->


   
    
    </div>
              
    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Enfermero</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="fas fa-user-md"></i></span>
  </div>
  <select  id = "medico" name = "Medico"  class = "form-control ">
								<option value = "">Selecciona un Enfermero</option>
                <?
          $query = $conn -> query ("SELECT Nombre_Apellidos,Fk_Sucursal,Estatus FROM  Personal_Enfermeria WHERE Estatus='Vigente' AND Fk_Sucursal='".$row['Fk_Sucursal']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[Nombre_Apellidos].'">'.$valores[Nombre_Apellidos].'</option>';
          }
        ?> 
							</select>
</div>

    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Fecha</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="fas fa-calendar-day"></i></span>
  </div>
  
  <input type="date" class="form-control"   name="Fecha" id="fecha" aria-describedby="basic-addon1">
</div>

<label for="fecha" class="error">
    </div>
   

    <div class="col">
    <label for="exampleFormControlInput1">Turno</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="fas fa-calendar-day"></i></span>
  </div>
  
  <select class="form-control" name="Turno" id="turno">
    <option value="Matutino">Matutino</option>
    <option value="Vespertino">Vespertino</option>
    
  </select>
</div>

<label for="fecha" class="error">
    </div>
    </div>
   

   
    
    <div class="form-group">
    <label for="exampleFormControlInput1">Motivo de consulta</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <textarea id="MotConsulta" class="form-control form-control-sm"  name="MotConsulta" rows="2" cols="50">
  </textarea>
</div>
    </div>
     
    <input type="text" class="form-control" name="Agendo" id="Agendo"  value="<?echo $row['Nombre_Apellidos']?>"  hidden readonly >
  
    <input type="text" class="form-control" name="Sucursal" id="sucursal"  value="<?echo $row['Fk_Sucursal']?>" hidden  readonly >

    <div class="text-center">
<button type="submit"  name="submit_AgeExt" id="submit_AgeExt"  class="btn btn-success">Confirmar datos <i class="fas fa-user-check"></i></button>
    </div>    </div></div>
<!-- FINALIZA DATA DE AGENDA -->
                  
</form>


</div></div>




        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->