<?php include "Consultas/ContadorParaNotificacion.php";
include "Consultas/ConsultaCaja.php";



?>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-primary navbar-light" style="background-color: #c80096 !important;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: white;"></i></a>
      </li>
      <!-- <li class="nav-item">
    <marquee behavior="scroll" direction="left" scrollamount="8" style="color: white; font-weight: bold;">
        Hola, <?php echo $row['Nombre_Apellidos']?> te recordamos que tenemos promociones vigentes hasta el 29 de febrero, 
        🎉💊 30% descuento en Laboratorios 💊🎉
        📋⚡ 20% descuento en Ultrasonidos *Sujeto a previa agenda
 ⚡📋
        💓📈 30% descuento en Electrocardiogramas 📈💓
        recuerda aplicarlos antes de cobrarle al cliente. 
    </marquee>
</li> -->

    </ul>

    

    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments" style="color: white;" ></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell" style="color: white;"></i>
          <span class="badge badge-info navbar-badge"><?php echo $totalmontotraspasos?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Notificaciones</span>
          <div class="dropdown-divider"></div>
          <a href="ProductosConCambiosDePrecios" class="dropdown-item">
            <i class="fas fa-dollar-sign mr-2"></i> <?php echo $CambiosdepreciosNuevos['totalnotifi']?>  Cambios de precios
           
          </a>
          <div class="dropdown-divider"></div>
          <a href="https://saludapos.com/POS2/ListadoDeTraspasos" class="dropdown-item">
          <i class="fas fa-exchange-alt mr-2"></i> <?php echo $TraspasosPendientes['traspasopendiente']?>  Traspasos pendientes
          
          </a>
          <!-- <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div> -->
         
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link"><i
        class="fas fa-sign-out-alt" style="color: white;" data-toggle="modal" data-target="#Salida"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index" class="brand-link" style="background-color: #c80096 !important;">
    
      <span class="brand-text font-weight-light" style="color: white;">PUNTO DE VENTA <?php echo $row['Nombre_Sucursal']?></span>
    
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../Perfiles/<?php echo $row['file_name']?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a  id="DatosGenerales" class="d-block" ><?php echo $row['Nombre_Apellidos']?></a>
          <a  id="DatosGenerales" class="d-block"><small><?php echo $row['Nombre_rol']?></small></a>
          <a id="DatosGenerales" class="d-block">
    <small>
        <?php
        if ($ValorCaja !== null && isset($ValorCaja['Turno'])) {
            echo 'Turno actual: <strong>' . $ValorCaja['Turno'] . '</strong>';
        } else {
            echo 'Sin turno por el momento'; // o cualquier otro mensaje que desees mostrar
        }
        ?>
    </small>
</a>

        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
              
          
          <li class="nav-item has-treeview menu-open">
            <a href="index" class="nav-link ">
            <i class="fas fa-home"></i>
              <p>
                Inicio
           
              </p>
            </a>
           
           
          
            
          
          <li class="nav-header">Citas</li>
          
          <li class="nav-item has-treeview">
            
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-calendar-check "></i>
              <p>
              Agenda
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            
            <ul class="nav nav-treeview">
              
            <li class="nav-item">
            <a href="AgendamientoDeCitasV3" class="nav-link">
            <i class="fas fa-notes-medical"></i>
              <p>
                Cita con especialista
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="AgendaRevaloraciones" class="nav-link">
            <i class="fas fa-address-book"></i>
              <p>
                Cita de revaloracion
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="AgendaLabs" class="nav-link">
            <i class="fas fa-vials"></i>
              <p>
              
            Agendar laboratorios
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://saludapos.com/POS2/CancelacionesV2" class="nav-link">
            <i class="fas fa-calendar-times"></i>
              <p>
              Cancelaciones
               
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="https://saludapos.com/POS2/CancelacionesAgenda" class="nav-link">
            <i class="fas fa-calendar-times"></i>
              <p>
              Cancelaciones V2.0
               
              </p>
            </a>
          </li> -->
       
            </ul>
          </li>
          <li class="nav-header">Punto de venta <i class="fas fa-clinic-medical"></i></li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-coins"></i>
              <p>
        Ventas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
           
         
          <li class="nav-item">
            <a href="ConsultaVentas" class="nav-link">
            <i class="fas fa-table"></i>
              <p>
              Consultar
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="ConsultaVentasEnfermeria" class="nav-link">
            <i class="fas fa-user-nurse"></i>
              <p>
              Creditos enfermería
               
              </p>
            </a>
          </li>
        
            </ul>
          </li> 
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-tooth"></i>
              <p>
              Créditos dentales
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="https://saludapos.com/POS2/Creditos" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
                Apertura de créditos
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://saludapos.com/POS2/CreditosFinalizados" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
                Créditos Finalizados
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://saludapos.com/POS2/CreditosFinalizados" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
                Créditos Vencidos
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="Abonos" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Abonos
               
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a  href=""  class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
            Historial
               
              </p>
            </a>
          </li> -->
          
            </ul>
          </li>
          
          <a href="https://saludapos.com/POS2/VentaV2" class="nav-link">
            <i class="fas fa-hand-holding-usd"></i>
              <p>
              Realizar venta
              
              </p>
            </a>
          <li class="nav-header">Almacenaje y productos <i class="fas fa-dolly"></i>
          <li class="nav-item">
            <a href="https://saludapos.com/POS2/InventarioRapido" class="nav-link">
            <i class="fas fa-boxes"></i>
              <p>
              Conteo diario
              
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="https://saludapos.com/POS2/ReportesMedicamentos" class="nav-link">
            <i class="fa-solid fa-people-carry-box"></i>
              <p>
           Generar devoluciones
               
              </p>
            </a>
          </li> -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-dolly"></i>
              <p>
              Almacen
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
        
          <li class="nav-item">
            <a href="https://saludapos.com/POS2/ProductosV2" class="nav-link">
            <i class="fas fa-prescription-bottle-alt"></i>
              <p>
            Productos
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://saludapos.com/POS2/ProntosACaducar" class="nav-link">
            <i class="fas fa-prescription-bottle-alt"></i>
              <p>
            Prontos a caducar
               
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="https://saludapos.com/POS2/ProductosEnfermeria" class="nav-link">
            <i class="fas fa-user-nurse"></i>
              <p>
           Stock enfermeria
               
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="https://saludapos.com/POS2/RegistroProductos" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
            Registrar productos
               
              </p>
            </a>
          </li> -->
            </ul>
           
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-exchange-alt"> </i>
            
              <p>
               Traspasos
              <!--   <span class="badge badge-danger navbar-badge"><i class="fas fa-bell"></i></span> -->
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <!-- <li class="nav-item">
            <a href="" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Apartar producto
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Recoger producto
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a  href=""  class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
            Historial
               
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a  href="https://saludapos.com/POS2/ListadoDeTraspasos"  class="nav-link">
            <i class="fas fa-exchange-alt"></i>
            
              <p>
            Traspasos pendientes
            <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
          </li>
         
          <li class="nav-item">
            <a  href="https://saludapos.com/POS2/TraspasosRecepcionados"  class="nav-link">
            <i class="fas fa-dolly-flatbed"></i>
              <p>
          Traspasos recepcionados               
              </p>
            </a>
          </li>
            </ul>
          </li>


          
        <div style=<?php if($row['Nombre_Sucursal'] != "Oficinas"){
   
   echo "display:none;";
 
} else {
  echo "display:block;";
}
?>> <li class="nav-item">
<a  href="https://saludapos.com/POS2/TraspasosASucursales"  class="nav-link">
<i class="fas fa-dolly-flatbed"></i>
  <p>
Realizar Traspasos              
  </p>
</a>
</li>

<li class="nav-item">
<a  href="https://saludapos.com/POS2/SurtidoAEnfermeria" target="blank_" class="nav-link">
<i class="fas fa-briefcase-medical"></i>
  <p>
Surtir a enfermería             
  </p>
</a>
</li>

<li class="nav-item">
<a  href="https://saludapos.com/POS2/RealizarVentaVfinal"  class="nav-link">
<i class="fas fa-briefcase-medical"></i>
  <p>
Surtir a enfermería             
  </p>
</a>
</li>
</div>
          

          <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-cart-plus"></i>
              <p>
         Pedidos / Compras
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="https://saludapos.com/POS2/ComprasSucursales" class="nav-link">
            <i class="fas fa-clinic-medical"></i>
              <p>
              Farmacia
              
              </p>
            </a>
          </li>
         
         
         
          <li class="nav-item">
            <a href="https://saludapos.com/POS2/ComprasEnfermeria" class="nav-link">
            <i class="fas fa-user-nurse"></i>
              <p>
              Enfermería
               
              </p>
            </a>
          </li>
         
            </ul>
          </li> -->
          <li class="nav-item">
            <a href="https://saludapos.com/POS2/RegistrosEnergiaElectrica" class="nav-link">
            <i class="fas fa-lightbulb"></i>
              <p>
             Control de energia 
               
              </p>
            </a>
          </li>
          <li class="nav-header">Administración de cajas <i class="fas fa-cash-register"></i></li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-cash-register"></i>
              <p>
              Caja
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="https://saludapos.com/POS2/AdministraCaja" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Administrar Caja
              
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Corte de caja
               
              </p>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a href="" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Historial Caja
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Reportes
               
              </p>
            </a>
          </li> -->

        
          <li class="nav-item">
            <a href="Gastos" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Otros gastos
               
              </p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="https://saludapos.com/POS2/TotalesServicios" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Totales
              
              </p>
            </a>
          </li>      
          <li class="nav-item">
            <a href="https://saludapos.com/POS2/TotalesServiciosAnteriores" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Totales anteriores
              
              </p>
            </a>
          </li>     
            </ul>
          </li>
        
          </li>
          <li class="nav-header">Reimpresiones <i class="fas fa-print"></i></i></li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-receipt"></i>
              <p>
        Tickets
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
           
         
          <li class="nav-item">
            <a href="Tickets" class="nav-link">
            <i class="fas fa-table"></i>
              <p>
              Desglose Tickets
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="Desglosaticketscreditoenfermeria" class="nav-link">
            <i class="fas fa-print"></i>
              <p>
              Desglose Tickets crédito 
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="ReimpresionCortes" class="nav-link">
            <i class="fas fa-print"></i>
              <p>
              Reimpresión de cortes 
               
              </p>
            </a>
          </li>
            </ul>
          </li>
          

        
<!--          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-bullhorn"></i>
              <p>
         Incidencia / Reportes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="https://saludapos.com/POS2/ReporteRapido" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Reportar
              
              </p>
            </a>
          </li>
         
         
          <li class="nav-item">
            <a href="https://saludapos.com/POS2/ReporteMobiliario" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Reporte de mobiliario
               
              </p>
            </a>
          </li>
        
            </ul>
          </li> -->
         
         
          
          
         
       
     
       
          
          <li class="nav-header"></li>
         
         
            </ul>
          </li>
        
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
         
          <div class="col">
          <div id="clockdate">
          <div class="clockdate-wrapper">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active" id="date"></li>
              <li class="breadcrumb-item" id="clock"></li>
            </ol>
           </div><!-- /.col -->
          </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <div class="modal fade" id="Cierre" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Cerrar la sesión?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <button type="button" onclick="salir()"class="btn btn-danger btn-lg btn-block">Si, Cerrar sesión</button>
      <br>
   

      </div>
      <div class="modal-footer">
   
      <button type="button" data-dismiss="modal" class="btn btn-primary">Cerrar ventana</button>

      </div>
    </div>
  </div>
</div>
<?php include ("Modales/Ventana_Mantenimiento.php");
?>
<script src="js/clock.js"></script>
    <!-- Main content -->
    <script>
      function inicio()
{
    $('#inicio').modal('show'); // abrir
}
function cierre()
{
    $('#Cierre').modal('show'); // abrir
}

function salir()
{
    
window.location.replace('https://saludapos.com/POS/Cierre'); 

}
$( document ).ready(function() {
  startTime();
});

    </script>

    <style>
      #date{
        color:#007bff;
      }
    </style>
      <!-- <script>
    $(document).ready(function(){
        $('#maintenanceModal').modal('show');
    });
</script> -->