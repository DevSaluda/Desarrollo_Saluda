<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$fcha = date("Y-m-d");
$user_id=null;
$sql1= "SELECT * FROM Productos_POS WHERE ID_Prod_POS = ".$_POST["id"];
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

         <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Codigo de barra <span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " readonly  value="<? echo $Especialistas->Cod_Barra; ?>" >
    </div>
    </div>
    
  
<div class="col">
    <label for="exampleFormControlInput1">Nombre / Descripcion<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <textarea class="form-control" readonly rows="3" ><? echo $Especialistas->Nombre_Prod; ?></textarea>
         
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
  <input type="text" class="form-control " readonly value="<? echo $Especialistas->Lote_Med; ?>" >
</div><label for="pv" class="error"></div>


    <div class="col">
    <label for="exampleFormControlInput1">Fecha caducidad <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="date" class="form-control "   readonly value="<? echo $Especialistas->Fecha_Caducidad; ?>" >
    </div><label for="pc" class="error">
    </div>
   
    
    </div>
    

    
  
   

    <input type="text" class="form-control " hidden name="ACT_ID_Prod" value="<? echo $Especialistas->ID_Prod_POS; ?>" >

       
     
    <input type="text" class="form-control"  hidden name="AgregaProductosBy" id="agrega" readonly value=" <?echo $row['Nombre_Apellidos']?>">
    <input type="text" class="form-control"  hidden name="SistemaProductos" id="sistema" readonly value=" POS <?echo $row['Nombre_rol']?>">
    
   

  

       </div>
       <!--Footer-->
       <div class="modal-footer justify-content-center">
     
                            
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>
 <? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>
