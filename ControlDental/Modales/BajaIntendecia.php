<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT Personal_Intendecia.Intendencia_ID,Personal_Intendecia.Nombre_Apellidos,Personal_Intendecia.file_name,Personal_Intendecia.file_name,Personal_Intendecia.Fk_Usuario,Personal_Intendecia.Biometrico,
Personal_Intendecia.Telefono,Personal_Intendecia.Fk_Sucursal,Personal_Intendecia.Estatus ,Personal_Intendecia.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal, Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol from Personal_Intendecia,SucursalesCorre,Roles_Puestos where 
Personal_Intendecia.Fk_Usuario = Roles_Puestos.ID_rol AND Personal_Intendecia.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND Personal_Intendecia.Intendencia_ID = ".$_POST["id"];
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

<form action="javascript:void(0)" method="post" id="BajaEmpleados" >
 
    <p>¿Esta seguro que desea marcar como baja al usuario <br>
    <?php echo $Especialistas->Nombre_Apellidos; ?> ?</p>

    <input type="text"  hidden class="form-control " value="Baja"  readonly name="Vigencia" id="vigenciaest">
    <input type="text"  hidden class="form-control " value="background-color: #FE0000 !important;"  readonly name="ColorVigencia" id="colorvigencia">
<input type="hidden" name="idbaja" id="idbaja" value="<?php echo $Especialistas->Intendencia_ID; ?>">
<button type="submit"  id="submit"  class="btn btn-danger">Confirmar baja <i class="fas fa-check"></i></button>
                          
</form>
<script src="js/BajaIntendencias.js"></script>
 
<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>
