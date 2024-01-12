<?
include("Cookies/SvEspecial.php");
include("Cookies/Mensaje.php");?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>SERVICIOS ESPECIALES</title>
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


<script src="Componentes/jquery.min.js"></script>

  
<script src="Componentes/fonts.js" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="Componentes/Preloader.css">
<!--===============================================================================================-->
<script type="text/javascript" src="Consultas/validation.min.js"></script>
<script type="text/javascript" src="Consultas/loginservicios.js"></script>

</head>
<body>
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
	<div class="limiter">
		<div class="container-login100" style="background-image: url('Componentes/images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" method="post" id="login-form">

					<span class="login100-form-title p-b-49">
						<?echo $mensaje?>
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Debes ingresar tu usuario">
						<span class="label-input100">Usuario</span>
						<input class="input100" input type="email" required placeholder="Correo Electronico" name="user_email" id="user_email">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Se requiere la contraseña">
						<span class="label-input100">Contraseña</span>
						<input class="input100" type="password" required placeholder=" Contraseña"  name="password" id="password">
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
                    </form>
                    <div id="error">
  </div>
					<div class="flex-c-m">
						<button data-toggle="modal" data-target="#Despliegueayuda" class="login100-social-item bg1">
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
  imageUrl: 'ApoyoSistema/demo.gif',
  imageWidth: 400,
  imageHeight: 350,
  imageAlt: 'inicio',
})
  });
  </script>
  <?php endif; ?>

	<div id="dropDownSelect1"></div>
  <div class="modal fade" id="Despliegueayuda" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" 
  data-backdrop="static" data-keyboard="false"
  >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Ayuda general</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <!-- Inicio primer collapse -->
      <button type="button" class="btn btn-primary btn-lg btn-block"
      data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"
      >1.-¿Que debo hacer? <i class="fas fa-question-circle"></i></button>
      <button type="button" class="btn btn-primary btn-lg btn-block"
      data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample"
      >2.-No puedo ingresar <i class="fas fa-question-circle"></i></button>
      <div class="collapse" id="collapseExample">
  <div class="card card-body">
  <div class="card" >
  <img class="card-img-top" src="ApoyoSistema/Inicio.gif"  alt="Card image cap">
  <div class="card-body">
    <p class="card-text">Debes introducir tus claves de acceso, recuerda que debe ser el correo que te proporciono tu empresa o que soporte te envió.
</p>
<button type="button" class="btn btn-primary btn-lg btn-block"
      data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"
      >1.-¿Que debo hacer? <i class="fas fa-question-circle"></i></button>
  </div>
</div>
    </div>
</div>
 <!-- Fin primer collapse -->
 
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
	
<!--===============================================================================================-->
<?include("Footer.php")?>
<?include("Redireccion.php")?>
<script src="ApoyoSistema/Apoyo.js" type="text/javascript"></script>
	
</body>
</html>


