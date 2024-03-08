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
  <form enctype="multipart/form-data" id="EditProductosGeneral">
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
      
    <label for="exampleFormControlInput1">Clave adicional <span class="text-info">Opcional</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-barcode"></i></span>
  </div>
  <input type="text" class="form-control "  readonly  value="<? echo $Especialistas->Clave_adicional; ?>">            
</div><label for="clav" class="error"></div>
<div class="col">
    <label for="exampleFormControlInput1">Nombre / Descripcion<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <textarea class="form-control" id="namedescrip" name="NameDescrip" rows="3" ><? echo $Especialistas->Nombre_Prod; ?></textarea>
         
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
  <input type="text" class="form-control " name="Loteee"value="<? echo $Especialistas->Lote_Med; ?>" >
</div><label for="pv" class="error"></div>


    <div class="col">
    <label for="exampleFormControlInput1">Fecha caducidad <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="date" class="form-control "   name="fechacad" value="<? echo $Especialistas->Fecha_Caducidad; ?>" >
    </div><label for="pc" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Existencia cedis <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control "   name="lestock"aria-describedby="basic-addon1" value="<? echo $Especialistas->Stock; ?>" >           
    </div><label for="mine" class="error">
    </div>
    
    </div>
    
   <!-- DATA CAPTURA -->
   <div class="row">
   
   <div class="col">
      
    <label for="exampleFormControlInput1">Precio venta <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-mobile"></i></span>
  </div>
  <input type="number" class="form-control " oninput="actualizarPrecioVenta()" id="acaspv" name="ACASPV" value="<? echo $Especialistas->Precio_Venta; ?>" >
</div><label for="pv" class="error"></div>
<div class="col">
    <label for="exampleFormControlInput1">Precio compra <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="number" class="form-control "   oninput="actualizarPrecioCompra() "  id="pcc" name="pcc"value="<? echo $Especialistas->Precio_C; ?>" >
    </div><label for="pc" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Minimo existencia <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="number" class="form-control "  name="ACAsMinimo" id="acasmini" aria-describedby="basic-addon1" value="<? echo $Especialistas->Min_Existencia; ?>" >           
    </div><label for="mine" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Maximo existencia<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="number" class="form-control " name="ACAsMaximo" id="acasmaxe"  aria-describedby="basic-addon1" value="<? echo $Especialistas->Max_Existencia; ?>" >           
    </div><label for="maxe" class="error">
    </div>
    </div>
    
    
  
   

    <input type="text" class="form-control " hidden name="ACT_ID_Prod" value="<? echo $Especialistas->ID_Prod_POS; ?>" >

       
     
    <input type="text" class="form-control"  hidden name="AgregaProductosBy" id="agrega" readonly value=" <?echo $row['Nombre_Apellidos']?>">
    <input type="text" class="form-control"  hidden name="SistemaProductos" id="sistema" readonly value=" POS <?echo $row['Nombre_rol']?>">
    
   

  

       </div>
       <!--Footer-->
       <div class="modal-footer justify-content-center">
       <button type="submit"   id="EnviarDatos" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>

       <br>
                                        </form>
       <form enctype="multipart/form-data" id="EnviaActualizacionPrecios">

       <input type="text" class="form-control " hidden name="Act_Stock_ID" value="<? echo $Especialistas->ID_Prod_POS; ?>" >
       <div class="row">
   
   <div class="col">
      
    <label for="exampleFormControlInput1">Precio venta <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-mobile"></i></span>
  </div>
  <input type="number" class="form-control " id="preciostockventa" name="preciostockventa" value="<? echo $Especialistas->Precio_Venta; ?>" >
</div><label for="pv" class="error"></div>
<div class="col">
    <label for="exampleFormControlInput1">Precio compra <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="number" class="form-control "  id="preciostockcompra" name="preciostockcompra"value="<? echo $Especialistas->Precio_C; ?>" >
    </div><label for="pc" class="error">
    </div>
    </div>
       <button type="submit"   id="ActualizaPrecios" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
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

<script>
  function actualizarPrecioVenta() {
    let municipio = document.getElementById("acaspv").value;
    //Se actualiza en municipio inm
    document.getElementById("preciostockventa").value = municipio;
}
function actualizarPrecioCompra() {
    let fecch = document.getElementById("pcc").value;
    //Se actualiza en municipio inm
    document.getElementById("preciostockcompra").value = fecch;
}
</script>
<script src="js/ActualizaProductosGenerales.js"></script>
<script src="js/ActualizaPreciosDeTodo.js"></script>