<?
header ("Location:https://controlfarmacia.com/App/Secure/POSV3");
include("db_connect.php");
include("Cookies/Mensaje.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>PUNTO DE VENTA</title>
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
<script type="text/javascript" src="Consultas/POS2.js"></script>
<script type="text/javascript" src="Scripts/Soporte.js"></script>
<script src='https://www.google.com/recaptcha/api.js?render=6LePQs8ZAAAAABjWTh2PsZqo49ooPa314_LCfFKM'> 
    </script>
    <script>
    grecaptcha.ready(function() {
    grecaptcha.execute('6LePQs8ZAAAAABjWTh2PsZqo49ooPa314_LCfFKM', {action: 'login-form'})
    .then(function(token) {
    var recaptchaResponse = document.getElementById('recaptchaResponse');
    recaptchaResponse.value = token;
    });});
    </script>
</head>
<body style="background-color: #2FDDEE;">
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
<nav class="mb-1 navbar navbar-expand-lg navbar-dark default-color">
  <a class="navbar-brand" href="#">PUNTO DE VENTA  <i  class="fas fa-receipt fa-2x fa-lgfa-2x fa-lg"></i></a>
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
    </ul>
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
  <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
  <br>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit"  name="login_button" id="login_button">
								Ingresar
							</button>
						</div>
					</div>
                 
                    </form>  <div id="error">
  </div>
  <?include "Modal.php";
  include "Modales.php";?>

					
					
			
			</div>
		</div>
	</div>
	
<!-- Modal hacia soporte -->

    
    <footer class="page-footer font-small default-color">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">Copyright &copy; 2020 <a href="https://somosgrupoe.com/">Somos Grupo E</a> <br>
  <b>PUNTO DE VENTA</b> | Version 1.1.0
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

	<??>
