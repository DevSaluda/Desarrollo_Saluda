<?php
 $IdBusqueda=base64_decode($_GET['idProd']);
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/AnalisisIndex.php";
$fcha = date("Y-m-d");
$user_id=null;
$sql1= "SELECT * FROM `Traspasos_generadosV2` WHERE Folio_Traspaso=$IdBusqueda ";
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

  <title>Cancelar Traspaso </title>

<?include "Header.php"?>
 <style>
        .error {
  color: red;
  margin-left: 5px; 

}
#Tarjeta
{
  background-color: #ff3547 !important;
    color: white;
}
    </style>
</head>
<?include_once ("Menu.php")?>
<? if($Especialistas!=null):?>
  <div class="card text-center">
  <div class="card-header" style="background-color:#ff3547 !important;color: white;">
  Cancelar traspaso
  </div>
  </div>
  <div class="col-md-12">
  <div class="text-center">
    <br>
  
<form enctype="multipart/form-data" id="EliminaTraspaso">
         <div class="row">
         <div class="col">
    <label for="exampleFormControlInput1">Folio de traspaso <span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " name="CancelacionTraspasoCedis" readonly value="<? echo $Especialistas->ID_Traspaso_Generado; ?>" >
    </div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Codigo de barra <span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " readonly id="asignacodbarra" name="AsignaCodBarra" value="<? echo $Especialistas->Cod_Barra; ?>" >
    </div>
    </div>
    
    <div class="col">
    <label for="exampleFormControlInput1">Nombre / Descripcion<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " readonly id="asignanombreprod" name="AsignaNombreProd" value="<? echo $Especialistas->Nombre_Prod; ?>" >          
    </div>
   </div></div>
   <div class="row">
   <div class="col">
    <label for="exampleFormControlInput1">Sucursal Origen <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  
  <input type="text" class="form-control " readonly  value="<? echo $Especialistas->Nombre_Sucursal; ?>" >   
  <input type="text" class="form-control "  readonly hidden id="sucursalorigen" name="SucursalOrigen" value="<? echo $Especialistas->Fk_sucursal; ?>" >       
    </div><label for="mine" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Sucursal Destino <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  
  <input type="text" class="form-control " readonly  value="<? echo $Especialistas->Fk_Sucursal_Destino; ?>" >   
    </div><label for="sucursaldestino" class="error">
    </div>

   
    <!-- DATA IMPORTANTE -->

    <div class="col">
      
    <label for="exampleFormControlInput1">Fecha estimada de entrega <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-mobile"></i></span>
  </div>
  <input type="date" class="form-control " readonly value="<? echo $Especialistas->FechaEntrega; ?>" > 
</div><label for="fechaaprox" class="error"></div></div>
<div class="row">
    
    <div class="col">
    <label for="exampleFormControlInput1">Existencia en sucursal <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " readonly name="ExisteActual" id="existenciaactual"  aria-describedby="basic-addon1" value="<? echo $Especialistas->Existencias_R; ?>" >           
    </div><label for="mine" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Cantidad traspasado <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="number" class="form-control monto" readonly  value="<? echo $Especialistas->Cantidad_Enviada; ?>" aria-describedby="basic-addon1"  >           
    </div><label for="maxe" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Cantidad en sucursal despues de traspaso <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " readonly  value="<? echo $Especialistas->Existencias_D_envio; ?>" >
    </div><label for="pc" class="error">
    </div>
    </div>
   

 
    
    <div class="justify-content-center">
       <button type="submit"   id="EnviarDatos" value="Guardar" class="btn btn-danger">Eliminar orden de traspaso <i class="fas fa-folder-minus"></i></button>
                                        </form>
                                        </div>


                                        </div>


</div>

<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>

       <!--Footer-->
     

<?php
  include ("Modales/Vacios.php");
  include ("Modales/Error.php");
  include ("Modales/Exito.php");
  include ("Modales/ExitoActualiza.php");

  include ("footer.php")?>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<script src="js/CancelaTraspasos.js"></script>
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