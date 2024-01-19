<?php
include "../Consultas/db_connection.php";

$user_id=null;
$sql1= "SELECT Personal_Enfermeria.Enfermero_ID,Personal_Enfermeria.Nombre_Apellidos,Personal_Enfermeria.Fk_Usuario,Personal_Enfermeria.file_name,Personal_Enfermeria.Fk_Sucursal,
Personal_Enfermeria.ID_H_O_D,Personal_Enfermeria.Estatus,Personal_Enfermeria.ColorEstatus,Personal_Enfermeria.Telefono,Personal_Enfermeria.AgregadoEl,Personal_Enfermeria.Password,
Personal_Enfermeria.Correo_Electronico,Personal_Enfermeria.Estatus,Personal_Enfermeria.Fecha_Nacimiento,
Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal 
FROM Personal_Enfermeria,Roles_Puestos,SucursalesCorre where Personal_Enfermeria.Fk_Sucursal = SucursalesCorre.ID_SucursalC 
and Personal_Enfermeria.Fk_Usuario = Roles_Puestos.ID_rol  AND Personal_Enfermeria.Enfermero_ID = ".$_POST["id"];
$query = $conn->query($sql1);
$Especialistas = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Especialistas=$r;
  break;
}

  }
?>

<?php if($Especialistas!=null):?>

<form action="javascript:void(0)" method="post" id="ActualizaEmpleados" >
  <label for=""> <h3> Datos generales del empleado</h3></label>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Folio de empleado </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly value="<?php echo $Especialistas->Pos_ID; ?>">
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Nombre y apellidos <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " name="ActNombres" id="actnombres" value="<?php echo $Especialistas->Nombre_Apellidos; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div></div>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Fecha de nacimiento </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="date" class="form-control " id="actfecha" name="ActFecha" value="<?php echo $Especialistas->Fecha_Nacimiento; ?>">
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Telefono <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="number" class="form-control " name="AcTtelefono" id="acttelefono" value="<?php echo $Especialistas->Telefono; ?>" aria-describedby="basic-addon1" >            
</div></div></div>
<label for=""> <h3> Datos del empleado para el uso del sistema</h3></label>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Correo </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control "  id="actcorreo" name="ActCorreo" value="<?php echo $Especialistas->Correo_Electronico;?>">
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Contraseña <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " name="ActPass" id="actpass" value="<?php echo $Especialistas->Password; ?>" aria-describedby="basic-addon1" >            
</div></div></div>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Sucursal </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control "  disabled readonly value="<?php echo $Especialistas->Nombre_Sucursal;?>">
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Empresa <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly value="<?php echo $Especialistas->ID_H_O_D; ?>" aria-describedby="basic-addon1" >            
</div></div></div>

    <input type="text"  hidden class="form-control "  readonly name="VigenciaEst" id="vigenciaest">
<input type="hidden" name="id" id="id" value="<?php echo $Especialistas->Enfermero_ID; ?>">
<button type="submit"  id="submit"  class="btn btn-info">Aplicar cambios <i class="fas fa-check"></i></button>
                          
</form>
<script src="js/ActualizaEnfermeros.js"></script>

<?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>
