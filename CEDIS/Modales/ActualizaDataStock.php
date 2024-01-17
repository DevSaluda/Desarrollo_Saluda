<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
$fcha = date("Y-m-d");
$user_id=null;
$sql1= "SELECT * FROM Stock_POS WHERE ID_Prod_POS = ".$_POST["id"];
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
         <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Codigo de barra <span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " readonly  value="<?php echo $Especialistas->Cod_Barra; ?>" >
    </div>
    </div>
    
  
<div class="col">
    <label for="exampleFormControlInput1">Nombre / Descripcion<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <textarea class="form-control" readonly rows="3" ><?php echo $Especialistas->Nombre_Prod; ?></textarea>
         
    </div><label for="nombreprod" class="error">
    </div>
</div>

   
    <!-- DATA IMPORTANTE -->
    <div class="row">
    <div class="col">
      
    <label for="exampleFormControlInput1">Lote <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-mobile"></i></span>
  </div>
  <input type="text" class="form-control " name="Loteee" id="lote" oninput="actualizarlote()" value="<?php echo $Especialistas->Lote; ?>" >
</div><label for="pv" class="error"></div>


    <div class="col">
    <label for="exampleFormControlInput1">Fecha caducidad <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="date" class="form-control "   name="fechacad" id="fechacd" value="<?php echo $Especialistas->Fecha_Caducidad; ?>" >
    </div><label for="pc" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Existencias <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="number" class="form-control " oninput="actualizarExistencia()"  name="NuevaExistencia" id="nuevaexistencia" value="<?php echo $Especialistas->Existencias_R; ?>" >
    </div><label for="pc" class="error">
    </div>
    
    </div>
    

    
  
   

    <input type="text" class="form-control " hidden name="ACT_ID_Prod" value="<?php echo $Especialistas->ID_Prod_POS; ?>" >

       
     
    <input type="text" class="form-control"  hidden name="AgregaProductosBy" id="agrega" readonly value=" <?php echo $row['Nombre_Apellidos']?>">
    <input type="text" class="form-control"  hidden name="SistemaProductos" id="sistema" readonly value=" POS <?php echo $row['Nombre_rol']?>">
    
   

  

       </div>
       <!--Footer-->
       <div class="modal-footer justify-content-center">
       <button type="submit"   id="EnviarDatos" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form>

                                        <form  id="EditStock">
         
    <div class="row">
    <div class="col">
      
    <label for="exampleFormControlInput1">Lote <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-mobile"></i></span>
  </div>
  <input type="text" class="form-control " name="Loteees" id="lotes"value="<?php echo $Especialistas->Lote; ?>" >
</div><label for="pv" class="error"></div>


    <div class="col">
    <label for="exampleFormControlInput1">Fecha caducidad <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="date" class="form-control "   name="fechacads" id="fechacc"value="<?php echo $Especialistas->Fecha_Caducidad; ?>" >
    </div><label for="pc" class="error">
    </div>
   
    
    </div>
    
    <input type="number" class="form-control " oninput="actualizarExistencia()"  name="NuevaExistenciaR" id="nuevaexistenciar" >
    
  
   

    <input type="text" class="form-control " hidden name="ACT_ID_ProdS" value="<?php echo $Especialistas->ID_Prod_POS; ?>" >

       
    <input type="text" class="form-control"  hidden name="StockActualiza" id="stockactualiza" readonly value="<?php echo $Especialistas->Fk_sucursal; ?>">
    <input type="text" class="form-control"  hidden name="AgregaProductosByS" id="agregas" readonly value=" <?php echo $row['Nombre_Apellidos']?>">
    <input type="text" class="form-control"  hidden name="SistemaProductosS" id="sistemas" readonly value=" POS <?php echo $row['Nombre_rol']?>">
    
   

  

       </div>
       <!--Footer-->
       <div class="modal-footer justify-content-center">
       <button type="submit"  hidden  id="EnviarDatosStock" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form>
         
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>
 <?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>
<script src="js/ActualizaProductosGeneralesVersion2.js"></script>

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
function actualizarExistencia() {
    let exist = document.getElementById("nuevaexistencia").value;
    //Se actualiza en municipio inm
    document.getElementById("nuevaexistenciar").value = exist;
}
</script>
 