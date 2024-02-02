<?php
include "../Consultas/db_connection.php";

$user_id=null;
$sql1= "SELECT Personal_Intendecia.Intendencia_ID,Personal_Intendecia.Nombre_Apellidos,Personal_Intendecia.file_name,Personal_Intendecia.Fk_Usuario,Personal_Intendecia.Fk_Sucursal,Personal_Intendecia.Telefono,
Personal_Intendecia.ID_H_O_D,Personal_Intendecia.Estatus,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol,Personal_Intendecia.Biometrico
FROM Personal_Intendecia,SucursalesCorre,Roles_Puestos where Personal_Intendecia.Fk_Usuario = Roles_Puestos.ID_rol AND 
Personal_Intendecia.Fk_Sucursal= SucursalesCorre.ID_SucursalC AND Personal_Intendecia.Intendencia_ID = ".$_POST["id"];
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
 
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Folio de empleado </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly value="<?php echo $Especialistas->Intendencia_ID; ?>">
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
    <label for="exampleFormControlInput1">Sucursal </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <select id = "sucursalact" class = "form-control" name = "sucursalact">
                                               <option value=""><?php echo $Especialistas->Nombre_Sucursal;?></option>
        <?php
          $query = $conn -> query ("SELECT 	ID_SucursalC,Nombre_Sucursal FROM SucursalesCorre ");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["ID_SucursalC"].'">'.$valores["Nombre_Sucursal"].'</option>';
          }
        ?>  </select>
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

<input type="hidden" name="id" id="id" value="<?php echo $Especialistas->Pos_ID; ?>">
<button type="submit"  id="submit"  class="btn btn-info">Aplicar cambios <i class="fas fa-check"></i></button>
                          
</form>
<script src="js/ActualizaEmpleadosIntendes.js"></script>

<?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>
