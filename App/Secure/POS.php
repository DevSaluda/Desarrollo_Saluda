<?php 
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

  
<script src="Componentes/fonts.js" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="Componentes/Preloader.css">
<!--===============================================================================================-->
<script type="text/javascript" src="Consultas/validation.min.js"></script>
<script type="text/javascript" src="Consultas/POS3.js"></script>
<script type="text/javascript" src="Scripts/Soporte.js"></script>

</head>
<body style="background-color: #C80096;">
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
<nav class="mb-1 navbar navbar-expand-lg navbar-dark default-color" style="background-color:#C80096 !important;">
  <a class="navbar-brand" href="#">PUNTO DE VENTA  <i  class="fas fa-receipt fa-2x fa-lgfa-2x fa-lg"></i></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
    aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
    <ul class="navbar-nav mr-auto">
   
    </ul>
    
  </div>
</nav>
<!--/.Navbar -->


        
		<div class="container-login100" >
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
    
				<form class="login100-form validate-form" method="post" id="login-form" autocomplete="off">

					<span class="login100-form-title p-b-49" style="font-size: 18px;">
						<?php echo $mensaje?> <br>
            <?php
            date_default_timezone_set('America/Merida');
            $hora = date('g:i A'); // Formato horas:minutos AM/PM
            echo "Son las <span id='real-time-clock'>$hora</span>";
            ?>
					</span>
          
					<div class="wrap-input100 " >
						<span class="label-input100">Correo electronico</span>
						<input class="input100" input type="email" autocomplete="off" required placeholder="puntoventa@consulta.com" name="user_email" id="user_email" maxlength="50">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 ">
						<span class="label-input100">Contraseña</span>
						<input class="input100" type="password" required placeholder="************" autocomplete="new-password" name="password" id="password"  maxlength="10">
                       
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
							<button class="login100-form-btn" type="submit"  name="login_button" id="login_button"  style="background-color: #C80096;">
								Ingresar
							</button>
						</div>
					</div>
                 
                    </form>  <div id="error">
  </div>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-+9zTb6uXjiJH4gkdIqKG6clg1xMZDe/xCJ6tR8xL0WR9/7UfGvj+SZQGDXHjZJIt33A8F9HfTYdY1HFvB2Xdbw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
  /* Tus estilos existentes permanecen sin cambios */

  .container-login100 {
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
  }

  .wrap-login100 {
    background: #fff;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    border-radius: 10px; /* Se agregó un border-radius para un aspecto más suave */
  }

  /* Resto de tus estilos existentes... */

  .login100-form-title {
    font-size: 18px;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .wrap-input100 {
    position: relative;
    margin-bottom: 20px;
  }

  .label-input100 {
    position: absolute;
    top: 10px;
    left: 7px;
    font-size: 14px;
    color: #888;
    transition: top 0.3s, font-size 0.3s;
  }

  .input100 {
    font-size: 16px;
    color: #555;
    width: 100%;
    padding: 10px;
    border: none;
    border-bottom: 2px solid #2196F3; /* Azul Material */
    background-color: transparent;
    transition: border-bottom-color 0.4s;
  }

  .input100:focus {
    border-bottom-color: #1565C0; /* Azul ligeramente más oscuro al enfocar */
  }

  .focus-input100::before {
    font-family: 'Font Awesome 5 Free';
    content: attr(data-symbol);
    position: absolute;
    color: #2196F3; /* Azul Material */
    font-size: 18px;
    top: 50%;
    left: 5px;
    transform: translateY(-50%);
  }

  .checkbox {
    margin-bottom: 20px;
    color: #555;
  }

  .checkbox label {
    display: flex;
    align-items: center;
  }

  #show_password {
    margin-right: 5px;
  }

  .login100-form-btn {
    background-color: #C80096;
    font-size: 16px;
    font-weight: bold;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.4s;
  }

  .login100-form-btn:hover {
    background-color: #C80078; /* Rosa ligeramente más oscuro al pasar el mouse */
  }
</style>

<!-- Tu enlace existente de Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-+9zTb6uXjiJH4gkdIqKG6clg1xMZDe/xCJ6tR8xL0WR9/7UfGvj+SZQGDXHjZJIt33A8F9HfTYdY1HFvB2Xdbw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

					
					<!--Start of Tawk.to Script-->

<!--End of Tawk.to Script-->
			
			</div>
		</div>
	</div>
	
<!-- Modal hacia soporte -->

    
    <footer class="page-footer font-small default-color">

  <!-- Copyright -->

  <b>PUNTO DE VENTA</b> | Version 3.0
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

<script>
function actualizarReloj() {
    var reloj = document.getElementById('real-time-clock');
    var horaActual = new Date();
    var horas = horaActual.getHours();
    var minutos = horaActual.getMinutes();
    var ampm = (horas >= 12) ? 'PM' : 'AM';

    // Convertir a formato de 12 horas
    horas = (horas % 12) || 12;

    // Formatear la hora para asegurarse de que siempre tenga dos dígitos
    horas = (horas < 10) ? '0' + horas : horas;
    minutos = (minutos < 10) ? '0' + minutos : minutos;

    // Actualizar el contenido del reloj en tiempo real
    reloj.textContent = horas + ':' + minutos + ' ' + ampm;
}

// Actualizar el reloj cada segundo
setInterval(actualizarReloj, 1000);
</script>
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

$('#login-form').attr('autocomplete', 'off');
</script>
<script src="../Scripts/Redirecciones.js" type="text/javascript"></script>

	