<?php
  header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
  header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
?>
<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/ConsultaCaja.php";
include "Consultas/SumadeFolioTickets.php";
include ("db_connection.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>VENTAS | <?echo $row['ID_H_O_D']?> </title>

<?include "Header.php"?>
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
<?include_once ("Menu.php")?>


  



 

   <div class="text-center">
   <button data-toggle="modal" data-target="#ConsultaProductos" class="btn btn-primary btn-sm"  >Consulta productos <i class="fas fa-search"></i></button>
      <button data-id="<?php echo $ValorCaja["ID_Caja"];?>" class="btn-edit btn btn-warning btn-sm " type="submit"  >Corte de caja <i class="fas fa-cut"></i> <i class="fas fa-money-bill"></i></button> 
     <!-- <button data-id="<?php echo $ValorCaja["ID_Caja"];?>" class="btn-cancelacion btn btn-dark btn-sm " type="submit"  >Solicitar cancelación <i class="fas fa-ban"></i></button> -->
     <button  data-toggle="modal" data-target="#ReimprimeVentas"   class="btn-reimpresion btn btn-info btn-sm  " type="submit"  >Reimpresión de tickets <i class="fas fa-print"></i></button>
     <!-- <button data-toggle="modal" data-target="#CapturaFacturacion" class="btn btn-success btn-sm" style="
    background: #6610f2 !important;"type="submit" name="guardar" >Datos para facturación <i class="far fa-bell"></i></button> -->
      <div class="input-group mb-3">
        
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"> Buscar<i class="fas fa-search"></i>  </span>
  </div>
  <input id="FiltrarContenido" type="text" class="form-control"  autofocus placeholder="Ingrese codigo de barra" style="position: relative;"aria-label="Alumno" aria-describedby="basic-addon1">
  
</div></div>
<div class="text-center">
  
  </div>
    <div class="card-body">
     
<div id="Tabladeventas"></div>
    </div>
    </div>
    </div>

 

     
  
</div>
  </div>
    </div>
<!-- FINALIZA DATA DE AGENDA -->
      </div>
      </div>
      </div>
      </div>
   
      </div>
      </div>
      </div>
      </div>
   
     <!-- /.content-wrapper -->
   
     <!-- Control Sidebar -->
    
     <!-- Main Footer -->
   <?
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
   
   <!-- ./wrapper -->
   
   <script src="js/FormularioVentasNuevo.js"></script>

   <script src="js/VentasControlador.js"></script>
     <script src="js/BusquedaVentasV.js"></script>
     <script src="js/BusquedaVentasV2.js"></script>
     <script src="js/BusquedaVentasV23.js"></script>
     <script src="js/BusquedaVentasV24.js"></script>
     <script src="js/BusquedaVentasV25.js"></script>
     <script src="js/BusquedaVentasV26.js"></script>
     <script src="js/BusquedaVentasV27.js"></script>
     <script src="js/BusquedaVentasV28.js"></script>
     <script src="js/BusquedaVentasV29.js"></script>
     <script src="js/BusquedaVentasV210.js"></script>

  
      
     <script src="js/FuncionalidadesVentas.js"></script>
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
						                <span id="Aviso" class="text-semibold"><?echo $row['Nombre_Apellidos']?>
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

 