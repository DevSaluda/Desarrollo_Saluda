
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
  <input type="text" class="form-control"   name="TelExt" id="telExt" oninput="formatPhoneNumber(this)" aria-describedby="basic-addon1">
</div>
    </div>
    
    </div>
   
    
    <script>
function formatPhoneNumber(input) {
    // Eliminar todos los caracteres que no sean dígitos
    var phoneNumber = input.value.replace(/\D/g, '');

    // Aplicar formato solo si hay dígitos suficientes
    if (phoneNumber.length >= 3) {
        phoneNumber = phoneNumber.substring(0, 3) + '-' + phoneNumber.substring(3);
    }
    if (phoneNumber.length >= 7) {
        phoneNumber = phoneNumber.substring(0, 7) + '-' + phoneNumber.substring(7, 11);
    }

    // Establecer el valor formateado en el campo de entrada
    input.value = phoneNumber;
}
</script>
  
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
          $query = $conn -> query ("SELECT ID_SucursalC,Nombre_Sucursal,ID_H_O_D FROM SucursalesCorre WHERE  ID_H_O_D='".$row['ID_H_O_D']."' AND Nombre_Sucursal !='Matriz' AND Sucursal_Activa <> 'No'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["ID_SucursalC"].'">'.$valores["Nombre_Sucursal"].'</option>';
          }
        ?>  </select>
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
        <select name="TipoConsultaExt" class="form-control form-control-sm" id="tipoconsultaExt" disabled="disabled">
    <option value="">Elige un tipo de consulta</option>
</select>


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
    <input type="text" class="form-control" name="UsuarioExt" id="usuarioExt"  value="<?php echo $row['Nombre_Apellidos']?>"  hidden  readonly >
    <input type="text" class="form-control" name="SistemaExt" id="sistemaExt"  value="Control Dental" hidden  readonly >
    <input type="text" class="form-control" name="EmpresaExt" id="empresaExt"  value="<?php echo $row['ID_H_O_D']?>"   hidden readonly >
    </div>
    
<button type="submit"  name="submit_AgeExt" id="submit_AgeExt"  class="btn btn-success">Confirmar datos <i class="fas fa-user-check"></i></button>
    </div>    </div>
<!-- FINALIZA DATA DE AGENDA -->
                  
</form>


</div></div>




        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->