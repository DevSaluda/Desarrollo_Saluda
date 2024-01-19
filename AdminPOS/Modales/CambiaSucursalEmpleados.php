<?php
include "../Consultas/db_connection.php";

$user_id=null;
$sql1= "SELECT PersonalPOS.Pos_ID,PersonalPOS.Nombre_Apellidos,PersonalPOS.Fk_Usuario,PersonalPOS.Fk_Sucursal,PersonalPOS.Password,PersonalPOS.Fecha_Nacimiento,PersonalPOS.Correo_Electronico,
PersonalPOS.Telefono,PersonalPOS.ID_H_O_D,PersonalPOS.Estatus,PersonalPOS.ColorEstatus,PersonalPOS.AgregadoPor,PersonalPOS.AgregadoEl,Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal 
FROM PersonalPOS,Roles_Puestos,SucursalesCorre WHERE PersonalPOS.Fk_Usuario= Roles_Puestos.ID_rol AND 
PersonalPOS.Fk_Sucursal = SucursalesCorre.ID_SucursalC  AND PersonalPOS.Pos_ID = ".$_POST["id"];
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

<form action="javascript:void(0)" method="post" id="CambioSucursalEmpleados" >
<div class="form-group">
    <label for="exampleFormControlInput1">Sucursal actual  </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly value="<?php echo $Especialistas->Nombre_Sucursal; ?>">
  <input type="text" class="form-control " hidden name="idempleadooo" readonly value="<?php echo $Especialistas->Pos_ID; ?>">
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
        <?php
          $query = $conn -> query ("SELECT 	ID_SucursalC,Nombre_Sucursal FROM SucursalesCorre WHERE  ID_H_O_D='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["ID_SucursalC"].'">'.$valores["Nombre_Sucursal"].'</option>';
          }
        ?>  </select>
        </div></div>
                            <button type="submit"   id="EnviarDatos" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
</form>
<script src="js/CambiaSucursalDeEmpleados.js"></script>
 
<?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>
