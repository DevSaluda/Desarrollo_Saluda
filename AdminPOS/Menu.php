
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
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
          <i class="far fa-comments" style="color: white;" ></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <!-- <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle"> -->
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
              <!-- <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3"> -->
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
              <!-- <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3"> -->
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
    
      <span class="brand-text font-weight-light" style="color: white;"><i class="fas fa-cash-register"></i> PUNTO DE VENTA</span>
    
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style ="background-color: #0057b8 !important;">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../Perfiles/<?php echo $row['file_name']?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a  id="DatosGenerales" class="d-block"><?php echo $row['Nombre_Apellidos']?></a>
          <a  id="DatosGenerales" class="d-block"><small><?php echo $row['Nombre_rol']?></small></a>
          <a  id="DatosGenerales" class="d-block"><small>Sucursal actual: <strong><?php echo $row['Nombre_Sucursal']?></strong></small></a>
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
      
         
            <li class="nav-header" style="font-size: medium; font-weight: bold; color: white;">Punto de venta <i class="fas fa-cash-register"></i></li>

            <div  style=<?php switch($row){
	case $row['Permisos']==10 ;				
  echo "display:none;";

	break;
	case $row['Permisos']==0 ;		
  echo "display:block;";
		
		} 	
        
      
?>>
            <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/RegistrosEnergiaElectrica" class="nav-link">
            <i class="fas fa-lightbulb"></i>
              <p>
             Control de energia 
               
              </p>
            </a>
          </li>
          </div>

          <div  style=<?php switch($row){
	case $row['Permisos']==10 ;				
  echo "display:none;";

	break;
	case $row['Permisos']==0 ;		
  echo "display:block;";
		
		} 	
        
      
?>>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/RegistrosDeCombustibles" class="nav-link">
            <i class="fas fa-gas-pump"></i>
              <p>
             Control de combustible 
               
              </p>
            </a>
          </li>
          </div>

          <div  style=<?php switch($row){
	case $row['Permisos']==10 ;				
  echo "display:none;";

	break;
	case $row['Permisos']==0 ;		
  echo "display:block;";
		
		} 	
        
      
?>>
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
            <a href="AdministraCaja" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Administrar Caja
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="CajasActivas" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Cajas Activas
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="HistorialCaja" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Historial Caja
               
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="ReimpresionCortes" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
            Cortes de caja
              
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="Totalesdeventas" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
             Totales
               
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="ControlGastos" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Otros gastos
               
              </p>
            </a>
          </li>
          
            </ul>
          </li>

          </div>


          <div  style=<?php switch($row){
	case $row['Permisos']==10 ;				
  echo "display:none;";

	break;
	case $row['Permisos']==0 ;		
  echo "display:block;";
		
		} 	
        
      
?>>   
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
            <i class="fas fa-file-invoice"></i>
              <p>
              Desglose Tickets
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="Desglosaticketscreditoenfermeria" class="nav-link">
            <i class="fas fa-credit-card"></i>
              <p>
              Desglose Tickets crédito 
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="ReimpresionCortes" class="nav-link">
            <i class="fas fa-cash-register"></i>
              <p>
              Reimpresión de cortes 
               
              </p>
            </a>
          </li>
            </ul>
          </li>
         <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-address-book"></i>
              <p>
        Clientes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
           
         
          <li class="nav-item">
            <a href="ListaDeClientes" class="nav-link">
            <i class="fas fa-receipt"></i>
              <p>
              Lista de Clientes
               
              </p>
            </a>
          </li>
                      </ul>
          </li>

          </div>

          <div  style=<?php switch($row){
	case $row['Permisos']==10 ;				
  echo "display:none;";

	break;
	case $row['Permisos']==0 ;		
  echo "display:block;";
		
		} 	
        
      
?>>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-barcode"></i>
              <p>
              Ventas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="Ventas" class="nav-link">
            <i class="fas fa-barcode"></i>
              <p>
              Registro de ventas
              
              </p>
            </a>
          </li>
        
          <!-- <li class="nav-item">
            <a href="VentasEnGeneral" class="nav-link">
            <i class="fas fa-barcode"></i>
              <p>
              Ventas en general
              </p>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a href="TotalesServicios" class="nav-link">
            <i class="fas fa-laptop-medical"></i>
              <p>
            Totales de servicios
               
              </p>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a href="ReportesVentas" class="nav-link">
            <i class="fas fa-folder"></i>
              <p>
              Reporte de ventas
              
              </p>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a href="DataFacturacion" class="nav-link">
            <i class="fas fa-file-invoice-dollar"></i>
              <p>
              Datos facturacion
              
              </p>
            </a>
          </li> -->

          <!-- <li class="nav-item">
            <a href="ListadoDeCancelaciones" class="nav-link">
            <i class="fas fa-ban"></i>
              <p>
              Cancelaciones
              
              </p>
            </a>
          </li> -->
            </ul>
          </li>
          </div>
          <div  style=<?php switch($row){
	case $row['Permisos']==10 ;				
  echo "display:none;";

	break;
	case $row['Permisos']==0 ;		
  echo "display:block;";
		
		} 	
        
      
?>>
          <!-- <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/EstadisticasFarmacias" class="nav-link">
            <i class="fas fa-chart-area"></i>
              <p>
              Estadisticas Farmacia
              </p>
            </a>
          </li> -->
</div>
<div  style=<?php switch($row){
	case $row['Permisos']==10 ;				
  echo "display:none;";

	break;
	case $row['Permisos']==0 ;		
  echo "display:block;";
		
		} 	
        
      
?>>
          <!-- <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/SugerenciaFechas" class="nav-link">
            <i class="fa-solid fa-filter"></i>
              <p>
              Filtrar Ventas
              </p>
            </a>
          </li> -->
        </div>
        <div  style=<?php switch($row){
	case $row['Permisos']==10 ;				
  echo "display:none;";

	break;
	case $row['Permisos']==0 ;		
  echo "display:block;";
		
		} 	
        
      
?>>
          <li class="nav-header" style="font-size: medium; font-weight: bold; color: white;">Créditos <i class="fas fa-credit-card"></i></li>
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
            <a href="https://saludapos.com/AdminPOS/TratamientoCredito" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Tratamiento Creditos
              
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/MedicoCredito" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Medicos Creditos
              
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/AreaCredito" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Areas Credito
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/Promociones" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Promociones
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="AbreCredi" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Apertura de crédito
               
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/CreditoFinalizado" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Credito Finalizado
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="CreditoActivo" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Historial abonos
               
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
          </div>

          <div  style=<?php switch($row){
	case $row['Permisos']==10 ;				
  echo "display:none;";
 
	break;
	case $row['Permisos']==0 ;		
  echo "display:block;";
		
		} 	
        
      
?>>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/CreditoEnfermeriaGeneral" class="nav-link">
            <i class="fas fa-user-nurse"></i>
              <p>
            Créditos enfermería
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/CreditoFarmaceuticoGeneral" class="nav-link">
            <i class="fas fa-prescription-bottle-alt"></i>
              <p>
            Créditos Farmaceutico
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/CreditoMedicoGeneral" class="nav-link">
            <i class="fas fa-user-md"></i>
              <p>
            Créditos Medico
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/CreditoLimpiezaGeneral" class="nav-link">
            <i class="fas fa-broom"></i>
              <p>
            Créditos Limpieza
              </p>
            </a>
          </li>
         </div>


         <div  style=<?php switch($row){
	case $row['Permisos']==10 ;				
  echo "display:none;";

	break;
	case $row['Permisos']==0 ;		
  echo "display:block;";
		
		} 	
        
      
?>>
            <li class="nav-header" style="font-size:medium; font-weight: bold; color: white;" >Almacenaje y productos <i class="fas fa-dolly"></i>

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
            <a href="Categorias" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Control
              
              </p>
            </a>
          </li>
        
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/ComponentesActivos" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Componente activo
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/TipoDeProducto" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Tipo de Productos
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/Presentaciones" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Presentaciones
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/Marcas" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Marcas
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/Servicios" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Servicios
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/ProductosV2" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
            Productos general
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="StockSucursalesV2" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
            Stock en sucursales               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="StockSucursalesEnfermeria" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
            Stock enfermeria/clinica               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="StockEliminado" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
            Productos Eliminados               
              </p>
            </a>
          </li>
         
          <li class="nav-item">
            <a href="UltimaInsercionEnStock" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
            Consultar distribuciones               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="BajaDeProductos" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
            Baja de productos               
              </p>
            </a>
          </li>
            </ul>
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-shopping-cart"></i>
              <p>
              Compras
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="Proveedores" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
             Proveedores
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="Compras" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
             Sugerencias Compras
               
              </p>
            </a>
          </li>
        
            </ul>
          </li>
</div>

<div  style=<?php switch($row){
	case $row['Permisos']==10 ;				
  echo "display:none;";

	break;
	case $row['Permisos']==0 ;		
  echo "display:block;";
		
		} 	
        
      
?>>
          <li class="nav-item">
            <a href="Ingresosrealizados" class="nav-link">
            <i class="fas fa-prescription-bottle"></i>
              <p>
            Ingreso de medicamentos               
              </p>
            </a>
          </li>
</div>

<div  style=<?php switch($row){
	case $row['Permisos']==10 ;				
  echo "display:none;";

	break;
	case $row['Permisos']==0 ;		
  echo "display:block;";
		
		} 	
        
      
?>>
          <li class="nav-header" style="font-size: medium; font-weight: bold; color: white;">Traspasos <i class="fas fa-truck-loading"></i></i>
          <li class="nav-item">
            <a  href="ListadoDeTraspasos"  class="nav-link">
            <i class="fas fa-random"></i>
              <p>
           Listado de traspasos             
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a  href="https://saludapos.com/AdminPOS/ControlTraspasos"  class="nav-link">
            <i class="fas fa-random"></i>
              <p>
            Control de traspasos           
              </p>
            </a>
          </li> -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-exchange-alt"></i>
              <p>
             Traspasos
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
         
          <!-- <li class="nav-item">
            <a  href="ListadoDeTraspasos"  class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
            Traspasos
               
              </p>
            </a>
          </li> -->

        
       <!--    <li class="nav-item">
            <a  href="Traspasos"  class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
            Solicitud Traspasos
               
              </p>
            </a>-->
          </li> 
           <li class="nav-item">
            <a  href="RegistroTraspasos"  class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
            Registro Traspasos
               
              </p>
            </a>
          </li> 
           <li class="nav-item">
            <a  href="TraspasosExcel"  class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
            Descargar registro
               
              </p>
            </a>
          </li> 
           
            </ul>
          </li>
          </div>

          <div  style=<?php switch($row){
	case $row['Permisos']==10 ;				
  echo "display:none;";

	break;
	case $row['Permisos']==0 ;		
  echo "display:block;";
		
		} 	
        
      
?>>
          <li class="nav-header" style="font-size: medium; font-weight: bold; color: white;">Inventarios <i class="fas fa-store"></i></li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-id-card"></i>
              <p>
              Inventarios
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="InventariosDescarga" class="nav-link">
            <i class="fas fa-download"></i>
              <p>
         Descargar inventarios             
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="AjusteDeInventarios" class="nav-link">
            <i class="fas fa-sliders-h"></i>
              <p>
            Ajustar inventarios               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="AjustesRealizados" class="nav-link">
            <i class="fas fa-tasks"></i>
              <p>
            Ver ajustes realizados               
              </p>
            </a>
          </li>
        
          
          
            </ul>
          </li>
          </div>

          <div  style=<?php switch($row){
	case $row['Permisos']==10 ;				
  echo "display:none;";

	break;
	case $row['Permisos']==0 ;		
  echo "display:block;";
		
		} 	
        
      
?>>
<li class="nav-item has-treeview">
            <a href="ProductosSinAsignar" class="nav-link">
            <i class="fas fa-times-circle"></i>
              <p>
        Productos sin asignar
               
              </p>
            </a>
          
          </li>
<li class="nav-item has-treeview">
            <a href="ModuloDeInventarios" class="nav-link">
            <i class="fas fa-boxes"></i>
              <p>
        Carga de inventarios
               
              </p>
            </a>
          
          </li>
          <li class="nav-item has-treeview">
            <a href="CuentaInventarios" class="nav-link">
            <i class="fa-solid fa-box-open"></i>
              <p>
        Conteo de productos
               
              </p>
            </a>
          
          </li>
          <li class="nav-item has-treeview">
            <a href="GeneracionReportesInventarios" class="nav-link">
            <i class="fas fa-boxes"></i>
              <p>
        Generacion de reportes
               
              </p>
            </a>
          
          </li>
          <li class="nav-item has-treeview">
            <a href="Mobiliarios" class="nav-link">
            <i class="fas fa-barcode"></i>
              <p>
        Mobiliario
               
              </p>
            </a>
          
          </li>
          
          <li class="nav-item has-treeview">
            <a href="CodigosBarras" class="nav-link">
            <i class="fas fa-barcode"></i>
              <p>
        Codigos de barras
               
              </p>
            </a>
          
          </li>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/InventarioRapidoResultado" class="nav-link">
            <i class="fas fa-boxes"></i>
              <p>
              Conteo diario
              
              </p>
            </a>
          </li>

          <li class="nav-header" style="font-size: medium; font-weight: bold; color: white;">Reportes <i class="fas fa-dolly"></i>
          <li class="nav-item">
                  <a href="https://saludapos.com/AdminPOS/ReportesLab" class="nav-link">
                  <i class="fas fa-file-excel"></i>
                    <p>
                     Reportes laboratorios

                    </p>
                  </a>
                </li>
                <!-- <li class="nav-item">
                  <a href="https://saludapos.com/AdminPOS/ReportesRx" class="nav-link">
                  <i class="fas fa-file-excel"></i>
                    <p>
                     Reportes Rayos X

                    </p>
                  </a>
                </li> -->

                <li class="nav-item">
                  <a href="https://saludapos.com/AdminPOS/ReportesUSG" class="nav-link">
                  <i class="fas fa-file-excel"></i>
                    <p>
                     Reportes USG

                    </p>
                  </a>
                </li>


                <li class="nav-item">
                  <a href="https://saludapos.com/AdminPOS/ReportesEkg" class="nav-link">
                  <i class="fas fa-file-excel"></i>
                    <p>
                     Reportes EKG

                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="https://saludapos.com/AdminPOS/RegistroDiariosSignosVitales" class="nav-link">
                  <i class="fas fa-file-excel"></i>
                    <p>
                     Reportes Signos vitales

                    </p>
                  </a>
                </li>
</div>
                
<div  style=<?php switch($row){
	case $row['Permisos']==9 ;				
  echo "display:none;";

	break;
	case $row['Permisos']==0 ;		
  echo "display:block;";
		
		} 	
        
      
?>>
          <li class="nav-header" style="font-size: medium; font-weight: bold; color: white;">Control de personal</li>
            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-users"></i>
              <p>
            Personal
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/Enfermeros" class="nav-link">
            <i class="fas fa-user-nurse"></i>
              <p>
              Enfermeros
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/Farmaceuticos" class="nav-link">
            <i class="fas fa-pills"></i>
              <p>
              Farmacéuticos
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/Medicos" class="nav-link">
            <i class="fas fa-user-md"></i>
              <p>
              Medicos
              
              </p>
            </a>
          </li>
          <div  style=<?php switch($row){
	case $row['Permisos']==10 ;				
  echo "display:none;";

	break;
	case $row['Permisos']==0 ;		
  echo "display:block;";
		
		} 	
        
      
?>>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/PersonalLimpieza" class="nav-link">
            <i class="fas fa-air-freshener"></i>
              <p>
              Intendencia / Limpieza
              
              </p>
            </a>
          </li>
          </div>
          <div  style=<?php switch($row){
	case $row['Permisos']==10 ;				
  echo "display:none;";

	break;
	case $row['Permisos']==0 ;		
  echo "display:block;";
		
		} 	
        
      
?>>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/PersonalCallCenter" class="nav-link">
            <i class="fas fa-headset"></i>
              <p>
              Call Center
              
              </p>
            </a>
          </li>
          </div>
          <div  style=<?php switch($row){
	case $row['Permisos']==10 ;				
  echo "display:none;";

	break;
	case $row['Permisos']==0 ;		
  echo "display:block;";
		
		} 	
        
      
?>>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/Administrativos" class="nav-link">
            <i class="fas fa-users-cog"></i>
              <p>
              Administradores
              
              </p>
            </a>
          </li>
          </div>
            </ul>
          </li>
          </div>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-clock"></i>
              <p>
            Reloj Checador
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/RegistroPersonalDia" class="nav-link">
            
            <i class="fas fa-calendar-day"></i>
              <p>
              Registro por día
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/RegistroPersonalLibre" class="nav-link">
            <i class="far fa-calendar-check"></i>
              <p>
              Registro general
              
              </p>
            </a>
          </li> 
          <li class="nav-item">
        
            </ul>
          </li>
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
            <a href="https://saludapos.com/AdminPOS/ReportesDeIncidencias" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Reportes
              
              </p>
            </a>
          </li>
         
         
          <li class="nav-item">
            <a href="" class="nav-link">
            <i class="fas fa-dot-circle"></i>
              <p>
              Reporte de mobiliario
               
              </p>
            </a>
          </li>
        
            </ul>
          </li>
          <div  style=<?php switch($row){
	case $row['Permisos']==10 ;				
  echo "display:none;";

	break;
	case $row['Permisos']==0 ;		
  echo "display:block;";
		
		} 	
        
      
?>>
          <li class="nav-header" style="font-size: medium; font-weight: bold; color: white;">Configuraciones</li>
          <li class="nav-item has-treeview">
           
           
            <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/Roles" class="nav-link">
            <i class="fas fa-user-tag"></i>
              <p>
              Roles / Puestos
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/Sucursales" class="nav-link">
            <i class="fas fa-clinic-medical"></i>
              <p>
            Sucursales
              
              </p>
            </a>
          </li>
       
          </li>
          
          <li class="nav-header" style="font-size: medium; font-weight: bold; color: white;">Control de enfermería <i class="fas fa-user-nurse"></i></li>
            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-file-medical-alt"></i>
              <p>
            Toma de signos vitales
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/RegistroDiariosSignosVitales" class="nav-link">
            <i class="fas fa-user-nurse"></i>
              <p>
              Registro por dia
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/RegistroSignosVitalesGeneral" class="nav-link">
            <i class="fas fa-pills"></i>
              <p>
              Registro en general
              
              </p>
            </a>
          </li>
          
            </ul>
          </li>
          </div>
          <div  style=<?php switch($row){
	case $row['Permisos']==10 ;				
  echo "display:none;";

	break;
	case $row['Permisos']==0 ;		
  echo "display:block;";
		
		} 	
        
      
?>>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-file-medical-alt"></i>
              <p>
            Procedimientos
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/RegistroDiariosSignosVitales" class="nav-link">
            <i class="fas fa-user-nurse"></i>
              <p>
              Registro por dia
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/RegistroSignosVitalesGeneral" class="nav-link">
            <i class="fas fa-pills"></i>
              <p>
              Registro en general
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/RegistroSignosVitalesGeneral" class="nav-link">
            <i class="fas fa-user-nurse"></i>
              <p>
              Registro por enfermero
              
              </p>
            </a>
          </li>
          </div>
          <div  style=<?php switch($row){
	case $row['Permisos']==10 ;				
  echo "display:none;";

	break;
	case $row['Permisos']==0 ;		
  echo "display:block;";
		
		} 	
        
      
?>>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/RegistroSignosVitalesGeneral" class="nav-link">
            <i class="fab fa-searchengin"></i>
              <p>
              Registro personalizado
              
              </p>
            </a>
          </li>
          
            </ul>
          </li>
          </div>

       
            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-file-medical-alt"></i>
              <p>
            Motivos de consulta
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/RegistroDiarioMotivoConsulta" class="nav-link">
          <i class="fas fa-calendar-day"></i>
              <p>
              Registro por dia
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/RegistrosMotivosConsultaGeneral" class="nav-link">
            <i class="fas fa-calendar-alt"></i>
              <p>
              Registro en general
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://saludapos.com/AdminPOS/RegistrosMotivosConsultaGeneral" class="nav-link">
            <i class="fab fa-searchengin"></i>
              <p>
              Registro personalizado
              
              </p>
            </a>
          </li>
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
    
window.location.replace('https://saludapos.com/AdminPOS/Cierre'); 

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