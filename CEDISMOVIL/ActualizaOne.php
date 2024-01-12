<?php
 $IdBusqueda=base64_decode($_GET['idProd']);
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/AnalisisIndex.php";
$fcha = date("Y-m-d");
$user_id=null;
$sql1= "SELECT * FROM Stock_POS WHERE Folio_Prod_Stock = $IdBusqueda";
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

  <title>Actualizando existencias </title>

<?include "Header.php"?>
 <style>
        .error {
  color: red;
  margin-left: 5px; 

}
#Tarjeta
{
  background-color: #4285f4 !important;
    color: white;
}
    </style>
</head>
<?include_once ("Menu.php")?>
<? if($Especialistas!=null):?>

  <div class="text-center">
    
  </div>
<div class="card text-center">
<div class="card-header" style="background-color:#4285f4!important;color: white;">
 Actualizando existencias del producto <? echo $Especialistas->Nombre_Prod; ?>
  </div>
   
  <div class="col-md-12">
  <div class="card-body">
  <div class="row">
    <div class="col">
    <form enctype="multipart/form-data" id="EditProductosGeneral">
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

  </div>
 



  

  
      
   
    <!-- DATA IMPORTANTE -->
    <div class="row">
    <div class="col">
      
    <label for="exampleFormControlInput1">Lote <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-mobile"></i></span>
  </div>
  <input type="text" class="form-control " name="Loteee" id="lote" oninput="actualizarlote()" value="<? echo $Especialistas->Lote; ?>" >
</div><label for="pv" class="error"></div>


    <div class="col">
    <label for="exampleFormControlInput1">Fecha caducidad <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="date" class="form-control "   name="fechacad" id="fechacd" value="<? echo $Especialistas->Fecha_Caducidad; ?>" >
    </div><label for="pc" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Existencias <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="number" class="form-control " oninput="actualizarExistencia()"  name="NuevaExistencia" id="nuevaexistencia" value="<? echo $Especialistas->Existencias_R; ?>" >
    </div><label for="pc" class="error">
    </div>
    
    </div>
    

    
  
   

    <input type="text" class="form-control " hidden name="ACT_ID_Prod" value="<? echo $Especialistas->ID_Prod_POS; ?>" >

       
     
    <input type="text" class="form-control"  hidden name="AgregaProductosBy" id="agrega" readonly value=" <?echo $row['Nombre_Apellidos']?>">
    <input type="text" class="form-control"  hidden name="SistemaProductos" id="sistema" readonly value=" POS <?echo $row['Nombre_rol']?>">
    
   
   
       <button type="submit"   id="EnviarDatos" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
    
                                        </form>
  

       
       <!--Footer-->
     

                                        <form action="javascript:void(0)" method="post"  id="EditStock">
         
    <div class="row">
    <div class="col">
      
    <label for="exampleFormControlInput1">Lote <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-mobile"></i></span>
  </div>
  <input type="text" class="form-control " name="Loteees" id="lotes"value="<? echo $Especialistas->Lote; ?>" >
</div><label for="pv" class="error"></div>


    <div class="col">
    <label for="exampleFormControlInput1">Fecha caducidad <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="date" class="form-control "   name="fechacads" id="fechacc"value="<? echo $Especialistas->Fecha_Caducidad; ?>" >
    </div><label for="pc" class="error">
    </div>
   
    
    </div>
    
    <input type="number" class="form-control " oninput="actualizarExistencia()"  name="NuevaExistenciaR" id="nuevaexistenciar" >
    
  
   

    <input type="text" class="form-control " hidden name="ACT_ID_ProdS" value="<? echo $Especialistas->ID_Prod_POS; ?>" >

       
    <input type="text" class="form-control"  hidden name="StockActualiza" id="stockactualiza" readonly value="<? echo $Especialistas->Fk_sucursal; ?>">
    <input type="text" class="form-control"  hidden name="AgregaProductosByS" id="agregas" readonly value=" <?echo $row['Nombre_Apellidos']?>">
    <input type="text" class="form-control"  hidden name="SistemaProductosS" id="sistemas" readonly value=" POS <?echo $row['Nombre_rol']?>">
    
   

  

      

       <button type="submit"  hidden  id="EnviarDatosStock" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form>
         
      </div></div>
 <? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>
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
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?php
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



</body>
</html>
<?php

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