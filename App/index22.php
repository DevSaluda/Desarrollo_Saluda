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
<nav class="mb-1 navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#"><strong>CONTROL FARMACIA</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7"
      aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Ayuda <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Ajustes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Acerca de</a>
        </li>
       
      </ul>
      
    </div>
  </div>
</nav>

<div class="container for-content">
    
<div class="prog-container degree">
  <span class="icon">
  <i onclick="POS()" class="fas fa-cash-register"></i>
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


<div class="prog-container degree">
  <span class="icon">
  <i onclick="controlconsulta()" class="fas fa-hospital-alt"></i>
  </span>
  <div class="details">
  <h1>CONTROL CONSULTA</h1>
   
  </div>
</div>
<!-- // finaliza menu de opciones  -->

<?php if($MuestraBienvenida === true) : // Si nuestra variable de control "$exibirModal" es igual a TRUE activa nuestro modal y será visible a nuestro usuario. ?>
  <script>
  $(document).ready(function()
  {
    // id de nuestro modal
    
    Swal.mixin({
      
      confirmButtonText: 'OK ',
 
    
    }).queue([
      
      {
        title: 'CONTROL FARMACIA V 1.2 ',
        text: 'DERECHOS RESERVADOS GRUPO E 2020',
        imageUrl: 'AyudaSistema/ControlFarmacia.gif',
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: 'Menu de inicio',
      },
     
    ]).then((result) => {
      if (result.value) {
        const answers = JSON.stringify(result.value)
        Swal.fire({
          title: 'AVISO.',
          text: 'Si requieres informacion adicional, haz click en el boton señalado en la imagen.',
          imageUrl: 'AyudaSistema/Ayuda.gif',
          imageWidth: 400,
          imageHeight: 200,
          imageAlt: 'Cerrar',
          confirmButtonText: 'Entendido!'
        })
      }
    })
    
  });
  </script>
  <?php endif; ?>

  </div>
</div>
<?include "Footer.php"?>
<script src="Componentes/jquery.min.js"></script>
<script src="Scripts/Redirecciones.js" type="text/javascript"></script>
<script src="AyudaSistema/Ayuda_bienvenida.js" type="text/javascript"></script>
<script type="text/javascript">
$(window).load(function() {
    $(".loader").fadeOut(3000);
});
</script>
</html>