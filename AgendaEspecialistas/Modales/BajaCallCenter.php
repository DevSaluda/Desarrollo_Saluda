<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT Personal_Agenda.PersonalAgenda_ID,Personal_Agenda.Nombre_Apellidos,Personal_Agenda.file_name,Personal_Agenda.Fk_Usuario,Personal_Agenda.Correo_Electronico,Personal_Agenda.Telefono,Personal_Agenda.Password,
Personal_Agenda.Telefono,Personal_Agenda.ID_H_O_D,Personal_Agenda.Estatus,Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol FROM Personal_Agenda,Roles_Puestos
 where Roles_Puestos.ID_rol = Personal_Agenda.Fk_Usuario AND Personal_Agenda.PersonalAgenda_ID = ".$_POST["id"];
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
<input type="hidden" name="idbaja" id="idbaja" value="<?php echo $Especialistas->PersonalAgenda_ID; ?>">
<button type="submit"  id="submit"  class="btn btn-danger">Confirmar baja <i class="fas fa-check"></i></button>
                          
</form>
<script src="js/BajaCallCenter.js"></script>
 
<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>
