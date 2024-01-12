<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
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

<? if($Especialistas!=null):?>

<form action="javascript:void(0)" method="post" id="ReactivaEmpleados" >
 
    <p>¿Esta seguro que desea reactivar al usuario <br>
    <?php echo $Especialistas->Nombre_Apellidos; ?> ?</p>

    <input type="text"  hidden class="form-control " value="Vigente"  readonly name="VigenciaA" id="vigenciaesta">
    <input type="text"  hidden class="form-control " value="background-color:#FE0000 !important;"  readonly name="ColorVigenciaA" id="colorvigenciaa">
<input type="hidden" name="idbajaa" id="idbajaa" value="<?php echo $Especialistas->Enfermero_ID; ?>">
<button type="submit"  id="submit"  class="btn btn-danger">Confirmar baja <i class="fas fa-check"></i></button>
                          
</form>
<script src="js/ReactivaEnfermeros.js"></script>
 
<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>
