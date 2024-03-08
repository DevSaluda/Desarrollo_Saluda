<?php
 $IdBusqueda=base64_decode($_GET['editprod']);
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/AnalisisIndex.php";
$fcha = date("Y-m-d");
$user_id=null;
$sql1= "SELECT Productos_POS.ID_Prod_POS,Productos_POS.Cod_Barra,Productos_POS.Clave_adicional,Productos_POS.Nombre_Prod,Productos_POS.Stock,
Productos_POS.Lote_Med,Productos_POS.Precio_Venta,Productos_POS.Precio_C,Productos_POS.Clave_Levic,
Productos_POS.Min_Existencia,Productos_POS.Max_Existencia,Productos_POS.Fecha_Caducidad,Productos_POS.AgregadoPor,Productos_POS.Sistema,
Productos_POS.Tipo_Servicio,Productos_POS.Proveedor1,Servicios_POS.Servicio_ID,Servicios_POS.Nom_Serv FROM Productos_POS,Servicios_POS where
  Productos_POS.Tipo_Servicio = Servicios_POS.Servicio_ID AND Productos_POS.ID_Prod_POS = $IdBusqueda";
$query = $conn->query($sql1);
$Especialistas = null;
if($query->num_rows>0){ 
while ($r=$query->fetch_object()){
  $Especialistas=$r;
  break;
}
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Editando datos del producto</title>

<?include "Header.php"?>
 <style>
        .error {
  color: red;
  margin-left: 5px; 
  
}

    </style>
</head>
<?include_once ("Menu.php")?>
<? if($Especialistas!=null):?>
  <div class="card text-center">
  <div class="card-header" style="background-color:#2b73bb !important;color: white;">
 Editando datos de <? echo $Especialistas->Nombre_Prod; ?>
 
  </div>
  <div >
  <button type="button" class="btn btn-outline-info btn-sm" onClick="history.go(-1);" class="btn btn-default">
  <i class="fas fa-long-arrow-alt-left fa-lg"></i> Regresar a productos 
</button>

</div>
  <div class="col-md-12">
  <div class="text-center">
    <br>
  
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
  <input type="text" class="form-control "  id="clavadicional" name="ClaveAdicional"  value="<? echo $Especialistas->Clave_adicional; ?>">            
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
      
    <label for="exampleFormControlInput1">Clave Levic <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-mobile"></i></span>
  </div>
  <input type="text" class="form-control "  id="leviclave" oninput="actualizarClaveLevic()" name="ClaveLevic" value="<? echo $Especialistas->Clave_Levic; ?>"  >
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
    





  
    <!-- DATA DE SERVICIOS CAPTURAR DATA IMPORTANTE -->
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
  <input type="text" name="actualizaClavelevic" id="actualizaClavelevic">
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

function 
actualizarClaveLevic() {
    let fecch = document.getElementById("leviclave").value;
    //Se actualiza en municipio inm
    document.getElementById("actualizaClavelevic").value = fecch;
}
</script>
<script src="js/ActualizaProductosGenerales.js"></script>
<script src="js/ActualizaPreciosDeTodo.js"></script>
<?
  include ("Modales/Vacios.php");
  include ("Modales/Error.php");
  include ("Modales/Exito.php");
  include ("Modales/ExitoActualiza.php");

  include ("footer.php")?>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->




<script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
    <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>


<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<script>
$(function(){
  $('#sucursal').multiselect({
          includeSelectAllOption: true,
          enableFiltering: true,
          selectAllText: 'Todas las sucursales', 
          nonSelectedText: 'Elija sucursales',
        
          
        });
});   
</script>
</body>
</html>
<?

function fechaCastellano ($fecha) {
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}
?>