<?
session_start();
include("db_connect.php");
include("Cookies/Mensaje.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>ADMINISTRATIVO</title>
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
<script type="text/javascript" src="Consultas/administrativo.js"></script>

</head>
<body style="background-color: #1856ff;">
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
<nav class="mb-1 navbar navbar-expand-lg navbar-dark blue accent-4">
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

        
		<div class="container-login100" style="background-image: url('Componentes/images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
    
				<form class="login100-form validate-form" method="post" id="login-form">

					<span class="login100-form-title p-b-49">
						<?echo $mensaje?>
					</span>

					<div class="wrap-input100 " >
						<span class="label-input100">Usuario</span>
						<input class="input100" input type="email" required placeholder="Correo Electronico" name="user_email" id="user_email">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 ">
						<span class="label-input100">Contraseña</span>
						<input class="input100" type="password" required placeholder="************"  name="password" id="password">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
                    </div>
                   
					
					<div class="text-right p-t-8 p-b-31">
						
					</div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit"  name="login_button" id="login_button">
								Ingresar
							</button>
						</div>
					</div>
                    <div class="txt1 text-center p-t-54 p-b-20">
						<span>
						
						</span>
					</div>
                    </form>  <div id="error">
  </div>
					<div class="flex-c-m">
						<button onclick="ayudalogin()" class="login100-social-item bg1">
                        <i class="fas fa-info-circle"></i>
						</button>

						<button onclick="Home()" class="login100-social-item bg2">
                        <i class="fas fa-house-user"></i>
							</button>


						<button data-toggle="modal" data-target="#exampleModal"  class="login100-social-item bg3">
						<i class="fas fa-users-cog"></i>
						</button>
					</div>

					
					
			
			</div>
		</div>
	</div>
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Opciones de configuración</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <button type="button" class="btn btn-primary btn-lg btn-block">Mensajes de ayuda <i class="fas fa-comment-alt"></i></button>
<button type="button" data-toggle="modal" data-target="#ModalSoporte" data-dismiss="modal" class="btn btn-secondary btn-lg btn-block">Contacto a soporte <i class="fas fa-laptop-code"></i></button>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
       
      </div>
    </div>
  </div>
</div>

<!-- Modal hacia soporte -->
<div class="modal fade" id="ModalSoporte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Contacto a soporte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form>
  <div class="form-group">
    
    <input type="email" class="form-control" id="exampleInputEmail1" hidden aria-describedby="emailHelp" value="Control Farmacia">
  </div>
  <div class="form-group">
  
    <input type="Text" class="form-control" id="exampleInputPassword1"hidden value="Doctor Consulta">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre Y Apellidos</label>
    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Por ejemplo Luis Quintal">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Telefono</label>
    <input type="Text" class="form-control" id="exampleInputPassword1" placeholder="9991426600">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Descripcion</label>
	<textarea id="w3review" name="w3review" rows="4" cols="50">
Describe el problema presentado
</textarea>
  </div>
  
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" data-dismiss="modal">Cancelar</button>
        
      </div>
    </div>
  </div>
</div>
<!-- Modal hacia soporte -->
	<?php if($MostrarMensaje === true) : // Si nuestra variable de control "$exibirModal" es igual a TRUE activa nuestro modal y será visible a nuestro usuario. ?>
  <script>
  $(document).ready(function()
  {
    // id de nuestro modal
    
    Swal.fire({
  title: 'Notificación del sistema',
  text: 'Si tienes dudas o requieres ayuda adicional, haz clic en el botón ayuda para desplegar los mensajes de ayuda',
  imageUrl: 'AyudaLogin/Explica.gif',
  imageWidth: 300,
  imageHeight: 300,
  imageAlt: 'Custom image',
})
  });
  </script>
  <?php endif; ?>

	<div id="dropDownSelect1"></div>
    <?include "Modal.php"?>
    <footer class="page-footer font-small primary-color">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">Copyright &copy; 2020 <a href="https://somosgrupoe.com/">Somos Grupo E</a> <br>
  <b>Control Farmacia</b> V 1.3.1
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
<script src="../Scripts/Redirecciones.js" type="text/javascript"></script>
<script src="../Scripts/Ayuda_login.js" type="text/javascript"></script>
	
