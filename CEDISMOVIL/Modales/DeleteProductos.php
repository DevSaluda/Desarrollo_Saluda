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
  <form enctype="multipart/form-data" id="DeleteProd">
 
    <div class="alert alert-danger">
  <strong><i class="fas fa-exclamation-triangle"></i></strong> Al hacer clic en el botón eliminar, el producto seleccionado será eliminado de forma permanente
 
</div>
<p>¿Esta seguro que desea eliminar el producto  <br>
    <?php echo $Especialistas->Nombre_Prod; ?> ?</p> 
    <input type="text" class="form-control " hidden name="DestroyProd" value="<? echo $Especialistas->ID_Prod_POS; ?>" >

       
   

  

       </div>
       <!--Footer-->
       <div class="modal-footer justify-content-center">
       <button type="submit"   id="EnviarDatos" value="Guardar" class="btn btn-danger">Eliminar <i class="fas fa-minus-circle"></i></button>

                                        </form>
                                        <? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>

<script src="js/DeleteProductos.js"></script>
