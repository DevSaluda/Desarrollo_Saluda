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
  <form enctype="multipart/form-data" id="ReasignaProductos">
         <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Codigo de barra <span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " id="asignacodbarra" name="AsignaCodBarra" value="<? echo $Especialistas->Cod_Barra; ?>" >
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Clave adicional <span class="text-info">Opcional</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-barcode"></i></span>
  </div>
  <input type="text" class="form-control " name="ASignaClav" id="asignaclav" value="<? echo $Especialistas->Clave_adicional; ?>">            
</div><label for="clav" class="error"></div>
<div class="col">
    <label for="exampleFormControlInput1">Nombre / Descripcion<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " id="asignanombreprod" name="AsignaNombreProd" value="<? echo $Especialistas->Nombre_Prod; ?>" >          
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
  <input type="text" class="form-control " id="pv" name="AsLote" value="<? echo $Especialistas->Lote_Med; ?>" >
</div><label for="pv" class="error"></div>


    <div class="col">
    <label for="exampleFormControlInput1">Fecha caducidad <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " id="aslote" name="AsFecha" value="<? echo $Especialistas->Fecha_Caducidad; ?>" >
    </div><label for="pc" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Existencia cedis <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " name="ExisteCedis" id="existecedis"  aria-describedby="basic-addon1" value="<? echo $Especialistas->Stock; ?>" >           
    </div><label for="mine" class="error">
    </div>
    
    </div>
    
   <!-- DATA CAPTURA -->
   <div class="row">
   
    <div class="col">
    <label for="exampleFormControlInput1">Sucursal <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <select id = "sucursal" class = "form-control" name = "AsignaSucursal" >
                                               <option value="">Seleccione una Sucursal:</option>
        <?
          $query = $conn -> query ("SELECT ID_SucursalC,Nombre_Sucursal,ID_H_O_D FROM SucursalesCorre WHERE  ID_H_O_D='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_SucursalC].'">'.$valores[Nombre_Sucursal].'</option>';
          }
        ?>  </select>            
    </div><label for="mine" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Cantidad asignada<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " name="CanAsigna" id="canasigna"  aria-describedby="basic-addon1"  >           
    </div><label for="maxe" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Fecha ingreso<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control "   value="<?php echo $fcha;?>"  aria-describedby="basic-addon1"  >           
    </div><label for="maxe" class="error">
    </div>
    </div>
    
    <div class="row">
    <div class="col">
      
    <label for="exampleFormControlInput1">Precio venta <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-mobile"></i></span>
  </div>
  <input type="text" class="form-control " id="aspv" name="ASPV" value="<? echo $Especialistas->Precio_Venta; ?>" >
</div><label for="pv" class="error"></div>


    <div class="col">
    <label for="exampleFormControlInput1">Precio compra <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " id="aspc" name="ASPC" value="<? echo $Especialistas->Precio_C; ?>" >
    </div><label for="pc" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Minimo existencia <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " name="ASMinimo" id="asmine"  aria-describedby="basic-addon1" value="<? echo $Especialistas->Min_Existencia; ?>" >           
    </div><label for="mine" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Maximo existencia<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " name="AsMaximo" id="asmaxe"  aria-describedby="basic-addon1" value="<? echo $Especialistas->Max_Existencia; ?>" >           
    </div><label for="maxe" class="error">
    </div>
    </div>
    
   
   
   

   

    <input type="text" hidden name="AsTipo" class="form-control " value="<?if($Especialistas->Tipo == 0000000000){
   echo "0000000000";
} else {
   echo "$Especialistas->Tipo";
}?>">

<input type="text" hidden name="AsCategoria" class="form-control " value="<?if($Especialistas->FkCategoria == 0000000000){
   echo "0000000000";
} else {
   echo "$Especialistas->FkCategoria";
}?>">
<input type="text" hidden name="AsMarca" class="form-control " value="<?if($Especialistas->FkMarca == 0000000000){
   echo "0000000000";
} else {
   echo "$Especialistas->FkMarca";
}?>">

<input type="text" hidden name="AsPresentacion" class="form-control " value="<?if($Especialistas->FkPresentacion == 0000000000){
   echo "0000000000";
} else {
   echo "$Especialistas->FkPresentacion";
}?>">


<input type="text" class="form-control "  hidden name="ID_Prod" value="<? echo $Especialistas->ID_Prod_POS; ?>" >
<input type="text" class="form-control " hidden name="TipoServicio" id="tiposervicio"  value="<?echo $Especialistas->Tipo_Servicio?>"aria-describedby="basic-addon1" >
    <input type="text" class="form-control " hidden name="EmpresaProductos" id="empresa" value="<?echo  $row['ID_H_O_D']?>"aria-describedby="basic-addon1" >       
    <input type="text" class="form-control " hidden name="RevProvee1" id="revprovee1" value="<? echo $Especialistas->Proveedor1; ?>"  >   
    <input type="text" class="form-control " hidden name="RevProvee2" id="revprovee2" value="<? echo $Especialistas->Proveedor2; ?>" >   
    <input type="text" class="form-control"  hidden name="AgregaProductosBy" id="agrega" readonly value=" <?echo $row['Nombre_Apellidos']?>">
    <input type="text" class="form-control"  hidden name="SistemaProductos" id="sistema" readonly value=" POS <?echo $row['Nombre_rol']?>">
    
   

  

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
<script src="js/ReasignaProductos2.js"></script>
 
 <!-- Central Modal Medium Info-->
 <script type="text/javascript">
  
$(function() {
  
    
$("#vigencia").on('change', function() {

  var selectValue = $(this).val();
  switch (selectValue) {

    case "background-color: #2BBB1D !important;":
        $("#SiVigente").show();
                        
                       
                        $("#Quizasproximo").hide();   
                      
     
      break;

   
      case "background-color: #ECB442 !important;":
        $("#Quizasproximo").show();    
      
        $("#SiVigente").hide();
        $("#VigenciaBD").hide();
     
      
      break;
      case "":
        $("#NoVigente").hide();
        $("#Quizasproximo").hide();    
        $("#SiVigente").hide();
        $("#VigenciaBD").hide();
        
     
      
      break;
     
    

  }
 
}).change();

});

</script>

<style>
    			.divOculto {
			display: none;
		}
</style>