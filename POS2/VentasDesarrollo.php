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

     <button  data-toggle="modal" data-target="#ReimprimeVentasEnVentas"   class=" btn btn-info btn-sm  " type="submit"  >Reimpresión de tickets de venta <i class="fas fa-print"></i></button>
     <button  id="aperturarcajon"  class=" btn btn-dark btn-sm  "  >Aperturar cajon de dinero <i class="fa-regular fa-lock-keyhole-open"></i></button>
   
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
<script>
        $(document).ready(function(){
    $('#aperturarcajon').click(function(){
        const datosBD = {
            accion: "aperturar_cajon",
            timestamp: new Date().toISOString() // Marca de tiempo para registrar cada clic
        };
        
        // Primera solicitud POST a tu backend para registrar el clic en la base de datos
        $.ajax({
            url: 'Consultas/registrar_aperturacajon.php',
            type: 'POST',
            data: JSON.stringify(datosBD),
            contentType: 'application/json',
            success: function(respuestaBD) {
                console.log("Registro en la BD completado:", respuestaBD);
                
                const datosLocalhost = {
                    mensaje: "Solicitud completada al localhost:8080",
                    idRegistro: respuestaBD.idRegistro // Usa el id del registro si está disponible
                };

                // Segunda solicitud POST al localhost:8080
                $.ajax({
                    url: 'http://localhost:8080/ticket/AbreElCajon.php',
                    type: 'POST',
                    data: JSON.stringify(datosLocalhost),
                    contentType: 'application/json',
                    success: function(respuestaLocalhost) {
                        console.log("Solicitud al localhost:8080 completada:", respuestaLocalhost);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error en la solicitud a localhost:8080:", status, error);
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Error en el registro en la BD:", status, error);
            }
        });
    });
});

    </script>

   <!-- ./wrapper -->
   
   <script src="js/ControladorFormVentasDesarrollo.js"></script>

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

 