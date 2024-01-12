<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$fcha = date("Y-m-d");
$user_id=null;
$sql1= "SELECT * FROM Procedimientos_Medicos WHERE ID_Proce = ".$_POST["id"];
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
  <form enctype="multipart/form-data" id="ActualizaProcedimientos">
          
    <label for="exampleFormControlInput1">Codigo procedimiento <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " name="CodigoProcedimientoACT" id="codigoprocedimientoact" value="<? echo $Especialistas->Codigo_Procedimiento; ?>" maxlength="60">            
</div>

<label for="exampleFormControlInput1">Nombre procedimiento <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " name="NombreProcedimientoACT" id="nombreprocedimientoact" value="<? echo $Especialistas->Nombre_Procedimiento; ?>" maxlength="60">            
</div>
  
<label for="exampleFormControlInput1">Costo de procedimiento <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " name="CostoProcedimientoACT" id="costoprocedimientoact" value="<? echo $Especialistas->Costo_Procedimiento; ?>" maxlength="60">            
</div>
  

    <input type="text" class="form-control " hidden name="ID_ProcedimientoAct" value="<? echo $Especialistas->ID_Proce; ?>" >

       
     
    <input type="text" class="form-control"  hidden name="AcTUser" id="agrega" readonly value=" <?echo $row['Nombre_Apellidos']?>">

    
   

  

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
 <? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>
<script src="js/ActualizaProcedimientos.js"></script>
