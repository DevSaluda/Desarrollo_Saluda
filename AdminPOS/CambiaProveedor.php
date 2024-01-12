<?php
 $IdBusqueda=base64_decode($_GET['idProd']);
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/AnalisisIndex.php";
$fcha = date("Y-m-d");
$user_id=null;
$sql1= "SELECT Productos_POS.ID_Prod_POS,Productos_POS.Cod_Barra,Productos_POS.Clave_adicional,Productos_POS.Nombre_Prod,Productos_POS.Stock,Productos_POS.Lote_Med,Productos_POS.Precio_Venta,Productos_POS.Precio_C,
Productos_POS.Min_Existencia,Productos_POS.Max_Existencia,Productos_POS.Fecha_Caducidad,Productos_POS.AgregadoPor,Productos_POS.Sistema,
Productos_POS.Tipo_Servicio,Productos_POS.Proveedor1,Productos_POS.Proveedor2,Servicios_POS.Servicio_ID,Servicios_POS.Nom_Serv FROM Productos_POS,Servicios_POS where
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
    <label for="exampleFormControlInput1">Nombre / Descripcion<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <textarea class="form-control"  rows="3" ><? echo $Especialistas->Nombre_Prod; ?></textarea>
         
    </div><label for="nombreprod" class="error">
    </div>
</div>

   
    <!-- DATA IMPORTANTE -->
    
    





    <!-- DATA DE SERVICIOS CAPTURAR DATA IMPORTANTE -->
    <div class="row">
    <div class="col">
      
    <label for="exampleFormControlInput1">Servicio <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-mobile"></i></span>
  </div>

  <select id = "tiposervicio" class = "form-control" name = "TipoServicio" onchange="actualizaservicio()">
                                               <option value="<? echo $Especialistas->Tipo_Servicio; ?>"><? echo $Especialistas->Nom_Serv; ?></option>
        <?
          $query = $conn -> query ("SELECT Servicio_ID,Nom_Serv,Estado,ID_H_O_D FROM Servicios_POS WHERE  ID_H_O_D='".$row['ID_H_O_D']."' AND Estado='Vigente'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[Servicio_ID].'">'.$valores[Nom_Serv].'</option>';
          }
        ?>  </select>       
</div><label for="pv" class="error"></div>


    <div class="col">
    <label for="exampleFormControlInput1"> Proveedor 1 <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <select id = "proveedor1" class = "form-control" name = "Provee1" onchange="actualizaproveedor1()" >
                                               <option value="<? echo $Especialistas->Proveedor1; ?>"><? echo $Especialistas->Proveedor1; ?></option>
        <?
          $query = $conn -> query ("SELECT 	ID_Proveedor,Nombre_Proveedor,ID_H_O_D,Estatus FROM Proveedores_POS WHERE  ID_H_O_D='".$row['ID_H_O_D']."' AND Estatus='Alta'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[Nombre_Proveedor].'">'.$valores[Nombre_Proveedor].'</option>';
          }
        ?>  </select>
    </div><label for="pc" class="error">
    </div>
   
    <div class="col">
    <label for="exampleFormControlInput1"> Proveedor 2 <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <select id = "proveedor2" class = "form-control" name = "Provee2" onchange="actualizaproveedor2()">
                                               <option value="<? echo $Especialistas->Proveedor2; ?>"><? echo $Especialistas->Proveedor2; ?></option>
        <?
          $query = $conn -> query ("SELECT 	ID_Proveedor,Nombre_Proveedor,ID_H_O_D,Estatus FROM Proveedores_POS WHERE  ID_H_O_D='".$row['ID_H_O_D']."' AND Estatus='Alta'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[Nombre_Proveedor].'">'.$valores[Nombre_Proveedor].'</option>';
          }
        ?>  </select>
    </div><label for="pc" class="error">
    </div>
   
    </div>
    <!-- DATA DE SERVICIOS CAPTURAR DATA IMPORTANTE -->
   <!-- DATA CAPTURA -->
   
    
    
  
   

    <input type="text" class="form-control " hidden name="ACT_ID_Prod" value="<? echo $Especialistas->ID_Prod_POS; ?>" >

       
  
  

       </div>
       <!--Footer-->
    
       <button type="submit"   id="EnviarDatos" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>

       <br>
                                        </form>
       <form enctype="multipart/form-data" id="EnviaActualizacionPrecios">

       <input type="text" class="form-control " hidden name="Act_Stock_ID" value="<? echo $Especialistas->ID_Prod_POS; ?>" >
       <div class="row">
   
   <div class="col">
      
    <label for="exampleFormControlInput1">Proveedor 1 <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-mobile"></i></span>
  </div>
  <input type="text" class="form-control " id="servicionuevo" name="ServicioNuevo" value="<? echo $Especialistas->Tipo_Servicio; ?>" >
  <input type="text" class="form-control " id="proveedor1stock" name="Proveedor1Stock" value="<? echo $Especialistas->Proveedor1; ?>" >
</div><label for="pv" class="error"></div>
<div class="col">
    <label for="exampleFormControlInput1">Proveedor 2 <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control "  id="proveedor2stock" name="Proveedor2Stock"value="<? echo $Especialistas->Proveedor2; ?>" >
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
  function actualizaproveedor1() {
    let municipio = document.getElementById("proveedor1").value;
    //Se actualiza en municipio inm
    document.getElementById("proveedor1stock").value = municipio;
}
function actualizaproveedor2() {
    let fecch = document.getElementById("proveedor2").value;
    //Se actualiza en municipio inm
    document.getElementById("proveedor2stock").value = fecch;
}

function actualizaservicio() {
    let serviceeee = document.getElementById("tiposervicio").value;
    //Se actualiza en municipio inm
    document.getElementById("servicionuevo").value = serviceeee;
}
</script>
<script src="js/ActualizaProveedoresPrincipales.js"></script> 
<script src="js/ActualizaProveedoresStock.js"></script> 
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