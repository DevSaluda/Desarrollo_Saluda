
<div class="modal fade" id="CitaExt" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="Di"class="modal-dialog modal-lg modal-notify modal-success">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="Titulo">Agendamiento de nuevas cita con especialistas</p>

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
     
<form action="javascript:void(0)" method="post" id="AgendaExterno" >

<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Nombre del paciente</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="fas fa-user"></i></span>
  </div>
  <input type="text" class="form-control"   name="NombresExt" id="nombresExt" aria-describedby="basic-addon1">
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
    </div>
    
    </div>
   
    
 
  
<!-- INICIA DATA DE AGENDA -->

<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Sucursal</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="fas fa-hospital"></i></span>
  </div>
  <select id = "sucursalExt" class = "form-control" name = "SucursalExt"  >
    <option value="">Seleccione una Sucursal:</option>
    <?php
    // 1. Obtener el nombre del usuario actual (ajusta la variable según tu sesión)
    $nombre_usuario = isset($_SESSION['Nombre_Medico']) ? $_SESSION['Nombre_Medico'] : '';
    // 2. Buscar todos los Medico_ID del usuario con estatus 'Disponible'
    $medicos = [];
    $especialidades = [];
    $sucursales = [];
    $sqlMedicos = "SELECT Medico_ID, Especialidad_Express FROM Personal_Medico_Express WHERE Nombre_Apellidos='".$conn->real_escape_string($nombre_usuario)."' AND Estatus='Disponible'";
    $resMedicos = $conn->query($sqlMedicos);
    while($rowMed = $resMedicos->fetch_assoc()) {
      $medicos[] = $rowMed['Medico_ID'];
      $especialidades[] = $rowMed['Especialidad_Express'];
    }
    // 3. Buscar los Fk_Sucursal de esas especialidades
    $especialidades_ids = array_map('intval', $especialidades);
    $especialidades_ids = implode(',', $especialidades_ids);
    $sucursales_ids = [];
    if($especialidades_ids) {
      $sqlEsp = "SELECT Fk_Sucursal FROM Especialidades_Express WHERE ID_Especialidad IN ($especialidades_ids) AND Estatus_Especialidad='Disponible'";
      $resEsp = $conn->query($sqlEsp);
      while($rowEsp = $resEsp->fetch_assoc()) {
        $sucursales_ids[] = $rowEsp['Fk_Sucursal'];
      }
    }
    // 4. Mostrar solo las sucursales válidas
    if(count($sucursales_ids)) {
      $sucursales_ids = array_map('intval', $sucursales_ids);
      $sucursales_ids = implode(',', $sucursales_ids);
      $sqlSuc = "SELECT ID_SucursalC, Nombre_Sucursal FROM SucursalesCorre WHERE ID_SucursalC IN ($sucursales_ids) AND Sucursal_Activa = ''";
      $resSuc = $conn->query($sqlSuc);
      while($rowSuc = $resSuc->fetch_assoc()) {
        echo '<option value="'.$rowSuc["ID_SucursalC"].'">'.$rowSuc["Nombre_Sucursal"].'</option>';
      }
    }
    ?>
  </select>
</div>
<label for="sucursal" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Especialidad</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="fas fa-user-tag"></i></span>
  </div>
  <select  id = "especialidadExt" name = "EspecialidadExt"  class = "form-control" disabled = "disabled" >
								<option value = "">Selecciona una especialidad</option>
							</select>
</div>
<label for="especialidad" class="error">
    </div>
    
    </div>
              
    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Medico</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="fas fa-user-md"></i></span>
  </div>
  <select  id = "medicoExt" name = "MedicoExt"  class = "form-control " disabled = "disabled" >
								<option value = "">Selecciona un medico</option>
							</select>
</div>

    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Fecha</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="fas fa-calendar-day"></i></span>
  </div>
  
  <select  id = "fechaExt" name = "FechaExt"  class = "form-control " disabled = "disabled" >
								<option value = "">Selecciona un medico</option>
							</select>
</div>

<label for="fecha" class="error">
    </div>
   
    </div>
    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Hora </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="fas fa-clock"></i></span>
  </div>
                                  
          

  <select  id = "horasExt" name = "HorasExt"  class = "form-control"  >
								<option value = ""></option>
	
</option>
 
							</select>
</div>
<label for="hora" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Costo</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select  id = "costoExt" name = "CostoExt"  class = "form-control" disabled = "disabled" >
								<option value = "">Selecciona un costo</option>
							</select>
</div>
<label for="costo" class="error">
    </div>
    </div>
    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Tipo de consulta </label>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
        </div>
        <select name="TipoConsultaExt" class="form-control form-control-sm" id="tipoconsultaExt">
            <option value="">Elige un tipo de consulta</option>
            <?php
            
            $sql = "SELECT Tipo_ID, Nom_Tipo FROM Tipos_Consultas WHERE Estado = 'Vigente'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Generar las opciones del select
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["Tipo_ID"] . "'>" . $row["Nom_Tipo"] . "</option>";
                }
            } else {
                echo "<option value=''>No hay tipos de consulta disponibles</option>";
            }
            ?>
        </select>
    </div>
</div>
<label for="tipoconsulta" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Observaciones</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <textarea id="observacionesExt" class="form-control form-control-sm"  name="ObservacionesExt" rows="2" cols="50">
  </textarea>
</div>
    </div>
    </div>  
    <input type="hidden" class="form-control" name="UsuarioExt" id="usuarioExt" value="<?php echo isset($_SESSION['Nombre_Medico']) ? $_SESSION['Nombre_Medico'] : ''; ?>">
<input type="hidden" class="form-control" name="SistemaExt" id="sistemaExt" value="Agenda de citas">
<input type="hidden" class="form-control" name="EmpresaExt" id="empresaExt" value="Saluda">
    
<button type="submit"  name="submit_AgeExt" id="submit_AgeExt"  class="btn btn-success">Confirmar datos <i class="fas fa-user-check"></i></button>
    </div>    </div>
<!-- FINALIZA DATA DE AGENDA -->
                  
</form>


</div></div>




        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->