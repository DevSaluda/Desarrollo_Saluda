<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed" >
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-primary navbar-light" style="background-color: #c80096 !important;">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: white;"></i></a>
        </li>

      </ul>

      <!-- SEARCH FORM -->
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments" style="color: white;"></i>
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

          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
       
        <li class="nav-item">
          <a class="nav-link"><i class="fas fa-sign-out-alt" style="color: white;" data-toggle="modal" data-target="#Salida"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index" class="brand-link" style="background-color: #c80096 !important;">
        <i class="fas fa-book-open fa-2x fa-lgfa-2x fa-lg" style="color: white;"></i>

        <span class="brand-text font-weight-light" style="color: white;">AGENDA DE CITAS</span>

      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../Perfiles/<?php echo $row['file_name']?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a id="DatosGenerales" class="d-block">
              <?php echo $row['Nombre_Apellidos']?>
            </a>
            <a id="DatosGenerales" class="d-block"><small>
                <?php echo $row['Nombre_rol']?>
              </small></a>
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



            
            <li class="nav-header" style="color: white;">Agendamiento de citas</li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link" style="color: white;">
                <i class="nav-icon fas fa-clipboard"></i>
            

                <p>
                Control de citas
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="https://saludapos.com/AgendaDeCitas/AgendamientoDeCitasV3" class="nav-link" style="color: white;" >
                  <i class="fas fa-calendar-check"></i>
                    <p>
                     Agendar citas

                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="https://saludapos.com/AgendaDeCitas/AgendamientoDeCitasRevaloracion" class="nav-link" style="color: white;">
                  <i class="fas fa-calendar-check"></i>
                    <p>
                   Revaloraciones

                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="https://saludapos.com/AgendaDeCitas/CancelacionesV2" class="nav-link" style="color: white;">
                  <i class="fas fa-calendar-times"></i>
                    <p>
                      Cancelaciones

                    </p>
                  </a>
                </li>
             
              </ul>
            </li>
<!-- CITAS -->


            
            <!-- <li class="nav-header" style="color: white;">Calendarios de campañas</li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-calendar-alt" style="color: white;"></i>


                <p>
                Calendarios
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="https://saludapos.com/AgendaDeCitas/Calendarios" class="nav-link" style="color: white;">
                    <i class="fas fa-calendar-check"></i>
                    <p>
                      Pacientes agendados

                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="https://saludapos.com/AgendaDeCitas/DataCampañas" class="nav-link" style="color: white;">
                    <i class="fas fa-calendar-check"></i>
                    <p>
                   Datos campañas

                    </p>
                  </a>
                </li> -->
                <!-- <li class="nav-item">
            <a href="https://controlfarmacia.com/AgendaDeCitas/Calendario" class="nav-link">
            <i class="fas fa-calendar-check"></i>
              <p>
                Pacientes agendados V 2.0
              
              </p>
            </a>
          </li> -->
                <!-- <li class="nav-item">
                  <a href="https://controlfarmacia.com/AgendaDeCitas/CalendarioActivosCampanas" class="nav-link">
                    <i class="fas fa-calendar-week"></i>
                    <p>
                      Campañas activas

                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="https://controlfarmacia.com/AgendaDeCitas/CalendarioFinalizadosCampanas" class="nav-link">
                    <i class="far fa-calendar"></i>
                    <p>
                      Campañas finalizadas

                    </p>
                  </a>
                </li> -->
              </ul>
            </li>
            <!-- CALENDARIO XD -->


            <!-- <li class="nav-header">Pacientes</li> -->
            <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fas fa-users"></i>
            
          
              <p>
              Control de clientes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="https://controlfarmacia.com/AgendaDeCitas/CitaEspecialistas" class="nav-link">
            <i class="fas fa-notes-medical"></i>
              <p>
                Nueva cita
              
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="AltaPaciente" class="nav-link">
            <i class="fas fa-user-plus"></i>
              <p>
                Alta de paciente
              
              </p>
            </a>
          </li>
         
            </ul>
          </li> -->
            <li class="nav-header" style="color: white;">Campañas</li>
            <li class="nav-item has-treeview">
              <a href="" class="nav-link" style="color: white;">
                <i class="nav-icon fas fa-laptop-medical "></i>
    

                <p>
                  Campaña express
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
             
                <li class="nav-item">
                  <a href="https://saludapos.com/AgendaDeCitas/MedicosExpress" class="nav-link" style="color: white;">
                  <i class="fas fa-user-md"></i>
                    <p>
                     Agregar medico

                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="https://saludapos.com/AgendaDeCitas/CitasEspecialistasExt" class="nav-link" style="color: white;">
                    <i class="fas fa-calendar-check"></i>
                    <p>
                     Programar campaña

                    </p>
                  </a>
                </li>
               
              
          
            
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="" class="nav-link" style="color: white;">
                <i class="nav-icon fas fa-clinic-medical "></i>
              <p>
                Sucursales
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="https://saludapos.com/AgendaDeCitas/MedicosEnGeneral" class="nav-link" style="color: white;">
                  <i class="fas fa-user-md"></i>
                    <p>
                     Médicos

                    </p>
                  </a>
                </li>
              <li class="nav-item">
                  <a href="https://saludapos.com/AgendaDeCitas/ProgramacionSucursales" class="nav-link" style="color: white;">
                    <i class="fas fa-calendar-check"></i>
                    <p>
                     Programar campaña

                    </p>
                  </a>
                </li>
               
              
               
            
              </ul>
            </li>
            <li class="nav-header">Reportes y data de pacientes </li>
            <li class="nav-item">
                  <a href="https://saludapos.com/AgendaDeCitas/ProductosV2" class="nav-link" style="color: white;">
                  <i class="fas fa-money-bill-alt"></i>
                    <p>
                     Listado de costos
                    </p>
                  </a>
                </li>   
            <li class="nav-item">
                  <a href="https://saludapos.com/AgendaDeCitas/DatosPacientes" class="nav-link">
                  <i class="fas fa-database"></i>
                    <p>
                     Data Px

                    </p>
                  </a>
                </li>   
                
                <li class="nav-item">
                  <a href="https://saludapos.com/AgendaDeCitas/Reportes" class="nav-link" style="color: white;">
                  <i class="fas fa-file-excel"></i>
                    <p>
                     Reportes laboratorios

                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="https://saludapos.com/AgendaDeCitas/ReportesRx" class="nav-link" style="color: white;">
                  <i class="fas fa-file-excel"></i>
                    <p>
                     Reportes Rayos X

                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="https://saludapos.com/AgendaDeCitas/ReportesUSG" class="nav-link" style="color: white;">
                  <i class="fas fa-file-excel"></i>
                    <p>
                     Reportes USG

                    </p>
                  </a>
                </li>


                <li class="nav-item">
                  <a href="https://saludapos.com/AgendaDeCitas/ReportesEkg" class="nav-link" style="color: white;">
                  <i class="fas fa-file-excel"></i>
                    <p>
                     Reportes EKG

                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="https://saludapos.com/AgendaDeCitas/ReportesSG" class="nav-link" style="color: white;">
                  <i class="fas fa-file-excel"></i>
                    <p>
                     Reportes Signos vitales

                    </p>
                  </a>
                </li>

                

           
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-clipboard-list"></i>
              <p>
             Registro de pacientes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="https://saludapos.com/AgendaDeCitas/RegistroDiariosSignosVitales" class="nav-link" style="color: white;">
            
            <i class="fas fa-calendar-day"></i>
              <p>
              Registro por día
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://saludapos.com/AgendaDeCitas/RegistroSignosVitalesGeneral" class="nav-link" style="color: white;">
            <i class="far fa-calendar-check"></i>
              <p>
              Registro general
              
              </p>
            </a>
          </li> 
          <li class="nav-item">
        
            </ul>
          </li>

          <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-chart-bar"></i>
              <p>
             Estadisticas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="https://controlfarmacia.com/AgendaDeCitas/Pacientespordia" class="nav-link">
            
            <i class="fas fa-calendar-day"></i>
              <p>
              Registro por día
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://controlfarmacia.com/AgendaDeCitas/RegistroSignosVitalesGeneral" class="nav-link">
            <i class="far fa-calendar-check"></i>
              <p>
              Registro general
              
              </p>
            </a>
          </li>  -->



          <!-- Estadisticas del personal -->






          </div>

           

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
            </div><!-- /.col -->

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
              <button type="button" onclick="salir()" class="btn btn-danger btn-lg btn-block">Si, Cerrar sesión</button>
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
        function inicio() {
          $('#inicio').modal('show'); // abrir
        }

        function cierre() {
          $('#Cierre').modal('show'); // abrir
        }

        function salir() {

          window.location.replace('https://saludapos.com/AgendaDeCitas/Cierre');

        }
        $(document).ready(function() {
          startTime();
        });
      </script>

      <style>
        #date {
          color: #007bff;
        }
      </style>
       <!-- <script>
    $(document).ready(function(){
        $('#maintenanceModal').modal('show');
    });
</script> -->