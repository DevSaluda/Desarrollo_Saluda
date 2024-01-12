<?
include("Cookies/Mensaje.php");?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>ENFERMERÍA | LOGIN</title>
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

  
<script src="Componentes/fonts.js" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="Componentes/Preloader.css">
<!--===============================================================================================-->
<script type="text/javascript" src="Consultas/validation.min.js"></script>
<script type="text/javascript" src="Consultas/Enfermeria2.js"></script>
<script type="text/javascript" src="Scripts/Soporte.js"></script>
<script type="text/javascript" src="Consultas/Contra.js"></script>
<style>
        .error {
  color: red;
  margin-left: 5px; 
  
}
</style>
</head>
<body style="background-color:#ADD8E6;">
<div class="loader"></div>
<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark primary-color" style="
    background-color: #33b5e5 !important;">
  <a class="navbar-brand" href="#">ENFERMERÍA  <i  class="fas fa-user-nurse  fa-2x fa-lgfa-2x fa-lg"></i></a>
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
  

          
          
      
      </div>
      </div>
    </div>
     
  <footer class="font-small" style="background-color: #33b5e5 !important;">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3" style="
    color: #ffffff99;
">Copyright © 2020 <a href="https://somosgrupoe.com/" style="
    color: #fff;
">Somos Grupo E</a> <br>
  <b>CONTROL CONSULTA</b> | Version 2.0
  </div>
  <!-- Copyright -->

</footer>
<?include ("Modales/Soporte.php");
  include ("Modales/ModalEnfer.php");?>
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
window.onload = (e) => { 
    let deferredPrompt;
    window.addEventListener('beforeinstallprompt', (e) => {
      // Prevent Chrome 67 and earlier from automatically showing the prompt
      e.preventDefault();
      // Stash the event so it can be triggered later.
      deferredPrompt = e;
    });
    // Show the prompt
    deferredPrompt.prompt();
    // Wait for the user to respond to the prompt
    deferredPrompt.userChoice
      .then((choiceResult) => {
        if (choiceResult.outcome === 'accepted') {
          console.log('User accepted the A2HS prompt');
        } else {
          console.log('User dismissed the A2HS prompt');
        }
        deferredPrompt = null;
      });
  }
</script>
<script src="../Scripts/Redirecciones.js" type="text/javascript"></script>

  

  