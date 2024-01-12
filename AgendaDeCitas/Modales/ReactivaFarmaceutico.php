<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT PersonalPOS.Pos_ID,PersonalPOS.Nombre_Apellidos,PersonalPOS.file_name,PersonalPOS.Fk_Usuario,PersonalPOS.Fk_Sucursal,PersonalPOS.Telefono,PersonalPOS.Correo_Electronico,
PersonalPOS.ID_H_O_D,PersonalPOS.Estatus,PersonalPOS.Password,PersonalPOS.ColorEstatus,PersonalPOS.AgregadoPor,PersonalPOS.AgregadoEl,Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal 
FROM PersonalPOS,Roles_Puestos,SucursalesCorre WHERE PersonalPOS.Fk_Usuario= Roles_Puestos.ID_rol AND 
PersonalPOS.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND PersonalPOS.Pos_ID= ".$_POST["id"];
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
<input type="hidden" name="idbajaa" id="idbajaa" value="<?php echo $Especialistas->Pos_ID; ?>">
<button type="submit"  id="submit"  class="btn btn-primary">Confirmar reactivación <i class="fas fa-check"></i></button>
                          
</form>
<script src="js/ReactivaFarmaceuticos.js"></script>
 
<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>
