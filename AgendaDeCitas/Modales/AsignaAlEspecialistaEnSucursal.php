<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";

$fcha = date("Y-m-d");
$user_id=null;
$sql1= "SELECT Personal_Medico_Express.Medico_ID,Personal_Medico_Express.Nombre_Apellidos,Personal_Medico_Express.Correo_Electronico, 
Personal_Medico_Express.Telefono,Personal_Medico_Express.Especialidad_Express,Personal_Medico_Express.ID_H_O_D,Personal_Medico_Express.Estatus,
Especialidades_Express.ID_Especialidad,Especialidades_Express.Nombre_Especialidad FROM Personal_Medico_Express,Especialidades_Express WHERE 
Personal_Medico_Express.Especialidad_Express= Especialidades_Express.ID_Especialidad AND  Personal_Medico_Express.Medico_ID = ".$_POST["id"];
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
  <form enctype="multipart/form-data" id="EditProductosGeneral">
  <div class="form-group">
    <label for="exampleFormControlInput1">Médico<span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " readonly  value="<?php echo $Especialistas->Nombre_Apellidos; ?>" >
    </div>
    </div>
    
  
    <div class="form-group">
    <label for="exampleFormControlInput1">Especialidad<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " readonly  value="<?php echo $Especialistas->Nombre_Especialidad; ?>" >
  
         
    </div>
    </div>
    <div class="form-group">
    <label for="exampleFormControlInput1">Sucursal<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <select id = "sucursal" class = "form-control" name = "Sucursal"  >
                                               <option value="">Seleccione una Sucursal:</option>
        <?php
          $query = $conn -> query ("SELECT ID_SucursalC,Nombre_Sucursal,ID_H_O_D FROM SucursalesCorre WHERE  ID_H_O_D='".$row['ID_H_O_D']."' AND Nombre_Sucursal !='Matriz'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["ID_SucursalC"].'">'.$valores["Nombre_Sucursal"].'</option>';
          }
        ?>  </select>
  
         
    </div><label for="nombreprod" class="error">
    </div>


   
    

    
  
   

    <input type="text" class="form-control " hidden name="ACT_ID_Prod" value="<?php echo $Especialistas->ID_Prod_POS; ?>" >

       
     
    <input type="text" class="form-control"  hidden name="AgregaProductosBy" id="agrega" readonly value=" <?php echo $row['Nombre_Apellidos']?>">
    <input type="text" class="form-control"  hidden name="SistemaProductos" id="sistema" readonly value=" POS <?php echo $row['Nombre_rol']?>">
    
   

  

       </div>
       <!--Footer-->
       <div class="modal-footer justify-content-center">
       <button type="submit"   id="EnviarDatos" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form>

                                  
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>
 <?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php  endif;?>
<script src="js/ActualizaProductosGenerales.js"></script>

<script>
function actualizarlote() {
    let municipio = document.getElementById("lote").value;
    //Se actualiza en municipio inm
    document.getElementById("lotes").value = municipio;
}
function actualizarfecha() {
    let fecch = document.getElementById("fechacd").value;
    //Se actualiza en municipio inm
    document.getElementById("fechacc").value = fecch;
}
</script>
 