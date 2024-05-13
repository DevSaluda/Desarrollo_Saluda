
<div class="modal fade" id="CitaExt" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="Di"class="modal-dialog modal-lg modal-notify modal-success">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="Titulo">Agendamiento de cita de laboratorio </p>

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
    <label for="exampleFormControlInput1">Sucursal</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="fas fa-building"></i></span>
  </div>
  <select  id = "sucursal" name = "Sucursal"  class = "form-control "  >
								<option value = "">Selecciona una sucursal</option>
                <?php
          $query = $conn -> query ("SELECT Nombre_Sucursal,ID_SucursalC FROM  SucursalesCorre");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["ID_SucursalC"].'">'.$valores["Nombre_Sucursal"].'</option>';
          }
        ?> 
							</select>
</div>

<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Laboratorio</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="fas fa-flask"></i></span>
  </div>
  <select  id = "LabAgendado" name = "LabAgendado"  class = "form-control "  >
								<option value = "">Selecciona un laboratorio</option>
                <?php
          $query = $conn -> query ("SELECT Nombre_Prod,ID_Prod_POS,Tipo_Servicio FROM  Stock_POS WHERE Stock_POS.Tipo_Servicio = '00000000012'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["ID_Prod_POS"].'">'.$valores["Nombre_Prod"].'</option>';
          }
        ?> 
							</select>
</div>
    <div class="row">
    
    <label for="exampleFormControlInput1">Fecha</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="fas fa-calendar-day"></i></span>
  </div>
  <input type="date" class="form-control"   name="Fecha" id="fecha" aria-describedby="basic-addon1">
</div>

<label for="fecha" class="error"></label>
</div>
<div class="col">
<label for="horaMinuto">Hora y Minutos</label>
<div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="Reloj"><i class="fas fa-clock"></i></span>
    </div>
    <input type="time" class="form-control" id="horaMinuto" name="horaMinuto">
</div>


<label for="fecha" class="error">
    </div>

<button type="submit"  name="submit_AgeExt" id="submit_AgeExt"  class="btn btn-success">Confirmar datos <i class="fas fa-user-check"></i></button>
    </div>    </div></div>
<!-- FINALIZA DATA DE AGENDA -->

<input type="text" class="form-control" name="Agendo" id="Agendo"  value="<?php echo $row['Nombre_Apellidos']?>" hidden  readonly >
                  
</form>


</div></div>




        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal --> 