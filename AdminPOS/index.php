<?php

  # Iniciando la variable de control que permitirá mostrar o no el modal
  $exibirModal = false;
  # Verificando si existe o no la cookie
  if(!isset($_COOKIE["mostrarModal"]))
  {
    # Caso no exista la cookie entra aqui
    # Creamos la cookie con la duración que queramos
     
    //$expirar = 3600; // muestra cada 1 hora
    //$expirar = 10800; // muestra cada 3 horas
    //$expirar = 21600; //muestra cada 6 horas
    $expirar = 43200; //muestra cada 12 horas
    //$expirar = 86400;  // muestra cada 24 horas
    setcookie('mostrarModal', 'SI', (time() + $expirar)); // mostrará cada 12 horas.
    # Ahora nuestra variable de control pasará a tener el valor TRUE (Verdadero)
    $exibirModal = true;
  }
  include "Consultas/Consultas.php";
  include "Consultas/ContadorIndex.php";

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?php echo $row['ID_H_O_D']?> PUNTO DE VENTA  </title>

  <!-- Font Awesome Icons -->
  <?php include "Header.php"?>
</head>
<?php include_once ("Menu.php")?>

<div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
         
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $CajasAbiertas['CajasAbiertas']?></h3>

                <p>Cajas abiertas</p>
              </div>
              <div class="icon">
              <i class="fas fa-cash-register"></i>
              </div>
              <a data-toggle="modal" data-target="#ConsultaCajas" class="small-box-footer">Consultar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $Tickets['Folio_Ticket']?></h3>

                <p>Productos vendidos</p>
              </div>
              <div class="icon">
              <i class="fas fa-barcode"></i>
              </div>
                <a  data-toggle="modal" data-target="#VentasProd" class="small-box-footer">Consultar Ventas <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
              <h3><?php echo $TraspasosPendientes['TraspasosPendientes']?></h3>
                <p>Traspasos</p>

               
              </div>
              <div class="icon">
              <i class="fas fa-boxes"></i>
              </div>
              <a data-toggle="modal" data-target="#ConsultaTraspasos" class="small-box-footer">Ver traspasos <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
              <h3><?php echo $TotalGanancia['totaldia']?></h3>
              <p>Ganancia global</p>
               
              </div>
              <div class="icon">
              <i class="fas fa-hand-holding-usd"></i>
              </div>
              <a data-toggle="modal" data-target="#TotalesporSucursalesindex" class="small-box-footer">Ver totales <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $TotalFarmaceuticos['Farmaceuticos']?></h3>

                <p>Farmacéuticos <br> vigentes</p>
              </div>
              <div class="icon">
              <i class="fas fa-pills"></i>
              </div>
              <a data-toggle="modal" data-target="#FarmasVigentes" class="small-box-footer">Consultar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $TotalEnfermeros['Enfermeros']?></h3>

                <p>Enfermeros <br> vigentes</p>
              </div>
              <div class="icon">
              <i class="fas fa-user-nurse"></i>
              </div>
                <a  data-toggle="modal" data-target="#EnferVigentes" class="small-box-footer">Consultar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>  
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?php echo $TotalMedicos['Medicos']?></h3>

                <p>Medicos <br> vigentes</p>
              </div>
              <div class="icon">
              <i class="fas fa-user-md"></i>
              </div>
                <a  data-toggle="modal" data-target="#MedVigentes" class="small-box-footer">Consultar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
       
  <!-- ./col -->
  <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
              <h3><?php echo $TotalLimpieza['Intendentes']?></h3>
              <p>Intendencia/Limpieza <br> Vigentes</p>
               
              </div>
              <div class="icon">
              <i class="fas fa-hand-sparkles"></i>
              </div>
              <a data-toggle="modal" data-target="#LimpiezaVigente" class="small-box-footer">Consultar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
      
  <!-- Content Wrapper. Contains page content -->
  
  

<div class="tab-content" id="pills-tabContent">

<!-- PRESENTACIONES -->
<div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
  <div class="card text-center">
  <div class="card-header" style="background-color:#2b73bb !important;color: white;">
Registros del reloj checador de <?php echo $row['ID_H_O_D']?> al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
 
  <div >
  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#FiltroEspecificoFecha" class="btn btn-default">
  Filtrar por fechas <i class="fas fa-calendar-week"></i>
</button>
</div>

</div>
<div id="Registros"></div>
  </div>
  
</div>

    
</div></div>

</div></div>

</div></div>

            
         

     
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php include ("Modales/Ingreso.php");
  include ("Modales/ConsultaCajasAbiertas.php");
  include ("Modales/ModalConsultaVentas.php");
  include ("Modales/ModalTraspasos.php");
  include ("Modales/ModalTotalesSincortes.php");
  include ("Modales/ModalFarmaceuticosVigentes.php");
  include ("Modales/ModalEnfermerosVigentes.php");
  include ("Modales/ModalMedicosVigentes.php");
  include ("Modales/ModalLimpiezaVigentes.php");
  include("Modales/FiltraEspecificamenteEntradas.php");
  include("Modales/FiltraEspecificamenteSalidas.php");
  include ("footer.php");?>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="js/Logs.js"></script>

<script src="js/Registrodiariodehuellas.js"></script>
<!-- <script src="js/RegistroMasVendidosDelDia.js"></script> -->

<?php
include "datatables.php"; 

?>

<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>


<!-- ChartJS -->

</body>
</html>
<?php if($exibirModal === true) : // Si nuestra variable de control "$exibirModal" es igual a TRUE activa nuestro modal y será visible a nuestro usuario. ?>
<script>
$(document).ready(function()
{
  // id de nuestro modal
  $("#Ingreso").modal("show");
});
</script>
<?php endif; ?>
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