<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT Personal_Medico_Express.Medico_ID,Personal_Medico_Express.Nombre_Apellidos,Personal_Medico_Express.Correo_Electronico, 
Personal_Medico_Express.Telefono,Personal_Medico_Express.Especialidad_Express,Personal_Medico_Express.ID_H_O_D,Personal_Medico_Express.Estatus,
 Especialidades_Express.ID_Especialidad,Especialidades_Express.Nombre_Especialidad, Especialidades_Express.Fk_Sucursal,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal 
 FROM Personal_Medico_Express,Especialidades_Express, SucursalesCorre WHERE Personal_Medico_Express.Especialidad_Express= Especialidades_Express.ID_Especialidad
  AND Especialidades_Express.Fk_Sucursal = SucursalesCorre.ID_SucursalC   AND Personal_Medico_Express.Medico_ID = ".$_POST["id"];
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
<input type="hidden" name="idbaja" id="idbaja" value="<?php echo $Especialistas->Medico_ID; ?>">
<button type="submit"  id="submit"  class="btn btn-danger">Confirmar baja <i class="fas fa-check"></i></button>
                          
</form>
<script src="js/BajaMedicosExpress.js"></script>
 
<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>
