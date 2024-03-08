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
  <form enctype="multipart/form-data" id="EliminaProcedimiento">
          
   
  <div class="modal-body">

<i class="fas fa-exclamation-triangle fa-4x animated rotateIn"></i>
<br><br>

<p>¿Eliminar el procedimiento <b><? echo $Especialistas->Nombre_Procedimiento; ?></b>?</p>


</div>

  

<input type="text" class="form-control " hidden name="ProcedimientoAEliminar" value="<? echo $Especialistas->ID_Proce; ?>" >

  

       </div>
       <!--Footer-->
       <div class="modal-footer justify-content-center">
       <button type="submit"   id="EnviarDatos" value="Guardar" class="btn btn-warning">Confirmar <i class="fas fa-minus-circle"></i></button>
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
<script src="js/EliminaProcedimientos.js"></script>
