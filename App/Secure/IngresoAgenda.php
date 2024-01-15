<?php include("db_connect.php");
include("Cookies/Mensaje.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>🔐 INICIO DE SESIÓN</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="Componentes/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Componentes/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="Componentes/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Componentes/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Componentes/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="Componentes/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Componentes/css/util.css">
    <link rel="stylesheet" type="text/css" href="Componentes/css/main.css">
    <script src="Componentes/sweetalert2@9.js"></script>
<link rel="stylesheet" href="Componentes/bootstrap.min.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
<script src="Componentes/jquery.min.js"></script>
<link href="https://cdn.rawgit.com/djibe/bootstrap-select/v1.13.0-dev/dist/css/bootstrap-select-daemonite.min.css" rel="stylesheet">
<script src="https://www.google.com/recaptcha/api.js"></script>
  
<script src="Componentes/fonts.js" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="Componentes/Preloader.css">
<!--===============================================================================================-->
<script type="text/javascript" src="Consultas/validation.min.js"></script>
<script type="text/javascript" src="Consultas/AgendaV3.js"></script>
<script type="text/javascript" src="Scripts/Soporte.js"></script>

    
</head>
<body style="background-color:#0057B8;">
   <style>
        .error {
  color: red;
  margin-left: 5px; 
  
}

    </style>
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
<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark default-color" style="background-color: #C80096 !important;">
  <a class="navbar-brand" href="#">Panel de administración de agenda SALUDA  <i  class="fas fa-book-open fa-2x fa-lgfa-2x fa-lg"></i> </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
    aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
    <ul class="navbar-nav mr-auto">
   
    </ul>
    <!-- <ul class="navbar-nav ml-auto nav-flex-icons">
      <li class="nav-item">
        <a class="nav-link waves-effect waves-light">
        <i onclick="Home()"class="fas fa-home fa-2x fa-lgfa-2x fa-lg" ></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link waves-effect waves-light">
       
        <i  data-toggle="modal" data-target="#centralModalInfo" class="fas fa-tools fa-2x fa-lgfa-2x fa-lg"></i>
      
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link waves-effect waves-light">
        <i data-toggle="modal" data-target="" class="fas fa-info-circle fa-2x fa-lgfa-2x fa-lg"></i>
      
        </a>
      </li> 
    </ul> -->
  </div>
</nav>
<!--/.Navbar -->


        
		<div class="container-login100" >
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
    
				<form class="login100-form validate-form" method="post" id="login-form">

					<span class="login100-form-title p-b-49">
            <?echo $mensaje?>
             
					</span>

					<div class="wrap-input100 " >
						<span class="label-input100">Correo electronico</span>
						<input class="input100" input type="email" autocomplete="off" required placeholder="puntoventa@consulta.com" name="user_email" id="user_email" maxlength="30">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 ">
						<span class="label-input100">Contraseña</span>
						<input class="input100" type="password" required placeholder="************"  name="password" id="password"  maxlength="10">
                       
						<span class="focus-input100" data-symbol="&#xf190;"></span>
                        
                    </div>
                    <br>
                    <div class="checkbox">
    <label>
    <input id="show_password" type="checkbox" /> Mostrar contraseña
    </label>
  </div>   
  
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit"  name="login_button" id="login_button" style="background-color: #C80096;">
								Ingresar
							</button>
						</div>
					</div>
                 
                    </form>  <div id="error">
  </div>
  <?include "Modales/ModalCitas.php";
  include "Modales.php";?>

						<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/608050d65eb20e09cf35417b/1f3qmkqn8';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
					
			
			</div>
		</div>
	</div>
	
<!-- Modal hacia soporte -->

    
    <footer class="page-footer font-small default-color" style="background-color: #0057B8 !important;">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">Copyright &copy; 2020 <a href="https://somosgrupoe.com/">Somos Grupo E</a> <br>
  <b>CONTROL FARMACIA</b> | Version 2.0
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->


<!--===============================================================================================-->
	
	<script src="Componentes/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="Componentes/vendor/bootstrap/js/popper.js"></script>
	<script src="Componentes/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="Componentes/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="Componentes/vendor/daterangepicker/moment.min.js"></script>
	<script src="Componentes/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="Componentes/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="Componentes/js/main.js"></script>

</body>
</html>

    <script type="text/javascript">
$(window).load(function() {
    $(".loader").fadeOut(1000);
});
</script>

<script>

   // Cuando el checkbox cambie de estado.
$('#show_password').on('change',function(event){
   // Si el checkbox esta "checkeado"
   if($('#show_password').is(':checked')){
      // Convertimos el input de contraseña a texto.
      $('#password').get(0).type='text';
   // En caso contrario..
   } else {
      // Lo convertimos a contraseña.
      $('#password').get(0).type='password';
   }
});
</script>
<script src="../Scripts/Redirecciones.js" type="text/javascript"></script>

	
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