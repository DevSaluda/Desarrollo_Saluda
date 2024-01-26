<?php
include "Consultas/Consultas.php";
include "Consultas/ConsultaCaja.php";
include "Consultas/SumadeFolioTickets.php";
include ("Consultas/db_connection.php");
?>
<meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="expires" content="0" />
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>VENTAS | SALUDA </title>

<?php include "Header.php"?>
 <style>
        .error {
  color: red;
  margin-left: 5px; 
  
}
#Tarjeta2{
  background-color: #2bbbad !important;
  color: white;
}
    </style>
 
  
</head>
<?php include_once ("Menu.php")?>


  

<?php if ($ValorCaja): ?>'<div class="text-center">
<button data-toggle="modal" data-target="#ConsultaProductos" class="btn btn-primary btn-sm"  >Consulta productos <i class="fas fa-search"></i></button>
<button data-id="<?php echo $ValorCaja["ID_Caja"];?>" class="btn-arqui btn btn-warning btn-sm " type="submit"  >Arqueo de caja <i class="fa-solid fa-money-bill-transfer"></i> </button> 
<button data-id="<?php echo $ValorCaja["ID_Caja"];?>" class="btn-edit btn btn-warning btn-sm " type="submit"  >Corte de caja <i class="fas fa-cut"></i> <i class="fas fa-money-bill"></i></button> 

     <button  data-toggle="modal" data-target="#ReimprimeVentas"   class="btn-reimpresion btn btn-info btn-sm  " type="submit"  >Reimpresión de tickets de venta <i class="fas fa-print"></i></button>
     <button data-toggle="modal" data-target="#CapturaFacturacion" class="btn btn-success btn-sm" style="
    background: #6610f2 !important;"type="submit" name="guardar" >Datos para facturación <i class="far fa-bell"></i></button>
      <div class="input-group mb-3">
        
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"> Buscar<i class="fas fa-search"></i>  </span>
  </div>
  <input id="FiltrarContenido" type="text" class="form-control"  autofocus placeholder="Ingrese codigo de barra" style="position: relative;"aria-label="Alumno" aria-describedby="basic-addon1">
  <!-- <input id="FiltrarContenido2" type="text" class="form-control"  autofocus placeholder="Ingrese codigo de barra" style="position: relative;"aria-label="Alumno" aria-describedby="basic-addon1">
  <input id="FiltrarContenido3" type="text" class="form-control"  autofocus placeholder="Ingrese codigo de barra" style="position: relative;"aria-label="Alumno" aria-describedby="basic-addon1">
  <input id="FiltrarContenido4" type="text" class="form-control"  autofocus placeholder="Ingrese codigo de barra" style="position: relative;"aria-label="Alumno" aria-describedby="basic-addon1">
  <input id="FiltrarContenido5" type="text" class="form-control"  autofocus placeholder="Ingrese codigo de barra" style="position: relative;"aria-label="Alumno" aria-describedby="basic-addon1">

  
  <input id="FiltrarContenido6" type="text" class="form-control"  autofocus placeholder="Ingrese codigo de barra" style="position: relative;"aria-label="Alumno" aria-describedby="basic-addon1">
  <input id="FiltrarContenido7" type="text" class="form-control"  autofocus placeholder="Ingrese codigo de barra" style="position: relative;"aria-label="Alumno" aria-describedby="basic-addon1">
  <input id="FiltrarContenido8" type="text" class="form-control"  autofocus placeholder="Ingrese codigo de barra" style="position: relative;"aria-label="Alumno" aria-describedby="basic-addon1">
  <input id="FiltrarContenido9" type="text" class="form-control"  autofocus placeholder="Ingrese codigo de barra" style="position: relative;"aria-label="Alumno" aria-describedby="basic-addon1">
  <input id="FiltrarContenido10" type="text" class="form-control"  autofocus placeholder="Ingrese codigo de barra" style="position: relative;"aria-label="Alumno" aria-describedby="basic-addon1"> -->
</div></div>
<div class="text-center">
  
  </div>
    <div class="card-body">
     
<div id="Tabladeventas"></div>
    </div>
    </div>
    </div>

 
 <!-- <a class="btn btn-warning btn-sm" id="multi1" hidden onclick="multiplicar2()"><i class="fas fa-minus-circle"></i></a>
 <a class="btn btn-warning btn-sm" id="multi2" hidden onclick="multiplicar3()"><i class="fas fa-minus-circle"></i></a>
 <a class="btn btn-warning btn-sm" id="multi3" hidden onclick="multiplicar4()"><i class="fas fa-minus-circle"></i></a>
 <a class="btn btn-warning btn-sm" id="multi4" hidden onclick="multiplicar5()"><i class="fas fa-minus-circle"></i></a>
 <a class="btn btn-warning btn-sm" id="multi5" hidden onclick="multiplicar6()"><i class="fas fa-minus-circle"></i></a>
 <a class="btn btn-warning btn-sm" id="multi6" hidden onclick="multiplicar7()"><i class="fas fa-minus-circle"></i></a>
 <a class="btn btn-warning btn-sm" id="multi7" hidden onclick="multiplicar8()"><i class="fas fa-minus-circle"></i></a>
 <a class="btn btn-warning btn-sm" id="multi8" hidden onclick="multiplicar9()"><i class="fas fa-minus-circle"></i></a>
 <a class="btn btn-warning btn-sm" id="multi9" hidden onclick="multiplicar10()"><i class="fas fa-minus-circle"></i></a> -->
 <!-- <button hidden type="button" class="btn btn-primary btn-sm "id="add_fieldinicial" >Agregar mas productos</button>
  <button hidden type="button" class="btn btn-primary btn-sm "id="add_field" >Agregar mas productos</button>
  <button hidden type="button" class="btn btn-primary btn-sm "id="add_field2" >Agregar mas productos</button>
  <button hidden type="button" class="btn btn-primary btn-sm "id="add_field3" >Agregar mas productos</button>
  <button hidden type="button" class="btn btn-primary btn-sm "id="add_field4" >Agregar mas productos</button>
  <button hidden type="button" class="btn btn-primary btn-sm "id="add_field5" >Agregar mas productos</button>
  <button hidden type="button" class="btn btn-primary btn-sm "id="add_field6" >Agregar mas productos</button>
  <button hidden type="button" class="btn btn-primary btn-sm "id="add_field7" >Agregar mas productos</button>
  <button hidden type="button" class="btn btn-primary btn-sm "id="add_field8" >Agregar mas productos</button>
  <button hidden type="button" class="btn btn-primary btn-sm "id="add_field9" >Agregar mas productos</button>
  <button hidden type="button" class="btn btn-primary btn-sm "id="add_field10" >Agregar mas productos</button> -->
  
     
  
</div>
  </div>
    </div>
<!-- FINALIZA DATA DE AGENDA -->
      </div>
      </div>
      </div>
      </div>';
      <?php
else:
    // Mensaje en caso de que no haya caja abierta o asignada
    echo '<div class="text-center alert alert-warning" style="margin-top: 20px; padding: 15px; background-color: #ffe8a1; border-color: #ffd966; color: #856404; border-radius: 8px;">';
    echo '<strong>¡Ups!</strong> Por el momento no hay una caja abierta o asignada.</div>';
endif;
?>
</div>
      </div>
      </div>
      </div>
   
     <!-- /.content-wrapper -->
   
     <!-- Control Sidebar -->
    
     <!-- Main Footer -->
   <?php
    include ("Modales/ModalConsultaProductos.php");
     include ("Modales/Error.php");
     include ("Modales/Exito.php");
     include ("Modales/Cambio.php");
     include ("Modales/Descuentos.php");
     include ("Modales/AdvierteDeCaja.php");
     include ("Modales/DataFacturacion.php");
     include ("Modales/ReimpresionTicketsVistaVentas.php");
     include ("Modales/ExitoActualiza.php");
    
     include ("footer.php")?>
   <div class="modal fade" id="editModal" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
<div id="Di"class="modal-dialog modal-lg  modal-notify modal-warning">
    <div class="modal-content">
    <div class="modal-header">
       <p class="heading lead" id="Titulo"></p>

       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true" class="white-text">&times;</span>
       </button>
     </div>
      
        <div class="modal-body">
        <div class="text-center">
      <div id="form-edit"></div>
      
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


  <script>

$(".btn-edit").click(function() {
    id = $(this).data("id");
    $.post("https://saludapos.com/POS2/Modales/CortesDeCajaNuevo.php", "id=" + id, function(data) {
        $("#form-edit").html(data);
        $("#Titulo").html("Corte de caja");
        $("#Di").addClass("modal-dialog modal-lg modal-notify modal-warning");
    });
    $('#editModal').modal('show');
});

$(".btn-arqui").click(function() {
    id = $(this).data("id");
    $.post("https://saludapos.com/POS2/Modales/ArqueoDeCaja.php", "id=" + id, function(data) {
        $("#form-edit").html(data);
        $("#Titulo").html("Arqueo De Caja");
        $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-warning");
        $("#Di").addClass("modal-dialog modal-lg modal-notify modal-info");
    });
    $('#editModal').modal('show');
});

$(".btn-aperturacaja").click(function() {
    id = $(this).data("id");
    $.post("https://saludapos.com/POS2/Modales/AbreCajaEnVentas.php", "id=" + id, function(data) {
        $("#form-edit").html(data);
        $("#Titulo").text("Apertura De caja");
        $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-warning");
        $("#Di").addClass("modal-dialog modal-lg modal-notify modal-success");
    });
    $('#editModal').modal('show');
});
  </script>

   <!-- ./wrapper -->
   
   <script src="js/ControladorFormVentas.js"></script>
   <script src="js/VentasControlador.js"></script>
     <!-- <script src="js/BusquedaVentasV.js"></script> -->
     <!-- <script src="js/BusquedaVentasV2.js"></script>
     <script src="js/BusquedaVentasV23.js"></script>
     <script src="js/BusquedaVentasV24.js"></script>
     <script src="js/BusquedaVentasV25.js"></script>
     <script src="js/BusquedaVentasV26.js"></script>
     <script src="js/BusquedaVentasV27.js"></script>
     <script src="js/BusquedaVentasV28.js"></script>
     <script src="js/BusquedaVentasV29.js"></script>
     <script src="js/BusquedaVentasV210.js"></script> -->

  
      
   
     <script src="js/RealizaVentas.js"></script>
     <script src="js/CapturaDataFacturacion.js"></script>
     <script src="js/BuscaDataPacientes.js"></script>

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
<script>




</script>

  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="Di"class="modal-dialog  modal-notify modal-warning">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="Titulo"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="Mensaje "class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold"><?php echo $row['Nombre_Apellidos']?>
                            Verifique los campos antes de realizar alguna accion</span>
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-edit"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

 