<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT Personal_Enfermeria.Enfermero_ID,Personal_Enfermeria.Nombre_Apellidos,Personal_Enfermeria.Fk_Usuario,Personal_Enfermeria.file_name,Personal_Enfermeria.Fk_Sucursal,
Personal_Enfermeria.ID_H_O_D,Personal_Enfermeria.Estatus,Personal_Enfermeria.ColorEstatus,Personal_Enfermeria.Telefono,Personal_Enfermeria.AgregadoEl,Personal_Enfermeria.Password,
Personal_Enfermeria.Correo_Electronico,Personal_Enfermeria.Estatus,Personal_Enfermeria.Biometrico,
Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal 
FROM Personal_Enfermeria,Roles_Puestos,SucursalesCorre where Personal_Enfermeria.Fk_Sucursal = SucursalesCorre.ID_SucursalC 
and Personal_Enfermeria.Fk_Usuario = Roles_Puestos.ID_rol AND Personal_Enfermeria.Enfermero_ID = ".$_POST["id"];
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

<form action="javascript:void(0)" method="post" id="CambioSucursalEmpleados" >
<div class="form-group">
    <label for="exampleFormControlInput1">Sucursal actual  </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly value="<? echo $Especialistas->Nombre_Sucursal; ?>">
  <input type="text" class="form-control " hidden name="idempleadooo" readonly value="<? echo $Especialistas->Enfermero_ID; ?>">
    </div>
    </div>
    
    <div class="form-group">
      
    <label for="exampleFormControlInput1">Nueva sucursal <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <select id = "Sucursalnueva" class = "form-control" name = "Sucursalnueva">
                                               <option value="">Seleccione una Sucursal:</option>
        <?
          $query = $conn -> query ("SELECT 	ID_SucursalC,Nombre_Sucursal FROM SucursalesCorre WHERE  ID_H_O_D='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_SucursalC].'">'.$valores[Nombre_Sucursal].'</option>';
          }
        ?>  </select>
        </div></div>
                            <button type="submit"   id="EnviarDatos" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
</form>
<script src="js/CambiaSucursalDeEmpleadosEnfermeria.js"></script>
 
<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>
