<?php 
include "Header.php";
?>

<div class="loader">
<div class="absCenter ">
    <div class="loaderPill">
        <div class="loaderPill-anim">
            <div class="loaderPill-anim-bounce">
                <div class="loaderPill-anim-flop">
                    <div class="loaderPill-pill"></div>
                </div>
            </div>
        </div>
        <div class="loaderPill-floor">
            <div class="loaderPill-floor-shadow"></div>
        </div>
        <div class="loaderPill-text">Cargando... </div>
    </div>
</div></div>
</div>
<nav class="mb-1 navbar navbar-expand-lg navbar-dark bg-primary" style="background-color: #C80096 !important;">
  <a class="navbar-brand" href="#">CONTROL FARMACIA <i  class="fas fa-prescription-bottle-alt  fa-2x fa-lgfa-2x fa-lg"></i></a>
 
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
    aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
    <ul class="navbar-nav mr-auto">
   
    </ul>
    <ul class="navbar-nav ml-auto nav-flex-icons">
     
      <li class="nav-item">
        <a class="nav-link waves-effect waves-light">
       
        <i  data-toggle="modal" data-target="#centralModalInfo" class="fas fa-tools fa-2x fa-lgfa-2x fa-lg"></i>
      
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link waves-effect waves-light">
        <i data-toggle="modal" data-target="#AcercaDe" class="fas fa-info-circle fa-2x fa-lgfa-2x fa-lg"></i>
      
        </a>
      </li>
    </ul>
  </div>
</nav>

<div class="container for-content">
    
<div class="prog-container degree">
  <span class="icon">
  <i onclick="POSV()" class="fas fa-cash-register"></i>
  </span>
  <div class="details">
    <h1>PUNTO DE VENTA</h1>
   </div>
</div>

<div class="prog-container degree">
  <span class="icon">
  <i onclick="Citas()" class="fas fa-calendar-day"></i>
  </span>
  <div class="details">
  <h1>CONTROL DE CITAS</h1>
   
  </div>

</div>
<div class="prog-container degree">
  <span class="icon">
  <i onclick="Servicios()" class="fas fa-hand-holding-medical"></i>
  </span>
  <div class="details">
  <h1>SERVICIOS ESPECIALIZADOS</h1>
   
  </div>
</div>
<div class="prog-container degree">
  <span class="icon">
  <i  onclick="Administracion()" class="fas fa-laptop-medical"></i>
  </span>
  <div class="details">
  <h1>ADMINISTRACIÓN</h1>
    </div>
 
</div>





  </div>
</div>
<?include "Footer.php"?>
<script src="Componentes/jquery.min.js"></script>
<script src="Scripts/RedireccionesV3.js" type="text/javascript"></script>
<script src="AyudaSistema/Ayuda_bienvenida.js" type="text/javascript"></script>
<script type="text/javascript">
$(window).load(function() {
    $(".loader").fadeOut(3000);
});
</script>
</html>