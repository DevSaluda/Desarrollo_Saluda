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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body style="background-color: #C80096;">
   <style>
        .error {
  color: red;
  margin-left: 5px; 
  
}


    </style>


<style>/* Estilos adicionales para un diseño juvenil y futurista */
/* Puedes ajustar estos estilos según tus preferencias */

/* Fondos y colores vibrantes */
body, html {
  background-color: #C80096; /* Fondo rosa */
}

.container-login100 {
  background-color: #C80096; /* Color de fondo para el contenedor principal */
}

/* Estilo de los inputs */
.input100 {
  background: transparent;
  border: none;
  border-bottom: 2px solid #6ab4ff; /* Azul vibrante */
  border-radius: 0;
  color: #000; /* Texto blanco */
}

.input100::placeholder {
  color: #a3a3a3; /* Color de placeholder */
}

.input100:focus {
  border-bottom-color: #42a5f5; /* Azul más claro al enfocar */
}

/* Estilo del botón */
.login100-form-btn {
  background-color: #ff4081; /* Rosa brillante */
  font-weight: bold;
}

.wrap-login100-form-btn:hover .login100-form-bgbtn {
  left: 0;
  background-color: #ff4081; /* Rosa más claro al pasar el mouse */
}

/* Efectos de transición */
.wrap-input100, .login100-form-btn {
  transition: all 0.3s ease-in-out;
}

.wrap-input100:hover, .wrap-input100:focus, .login100-form-btn:hover {
  transform: scale(1.05); /* Efecto de escala al pasar el mouse o enfocar */
}

/* Otros ajustes de estilo */
.label-input100 {
  color: #6ab4ff; /* Azul vibrante para el texto de la etiqueta */
}

.focus-input100::before {
  color: #6ab4ff; /* Azul vibrante para el icono */
}

/* Puedes agregar más estilos según tus preferencias */
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
						<input class="input100" input type="email" autocomplete="off" required placeholder="farmacia@saluda.com" name="user_email" id="user_email" maxlength="50">
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
  $('#show_password').on('change', function(event) {
    // Mostrar la confirmación de SweetAlert2
    Swal.fire({
      title: '¿Estás seguro?',
      text: '¿Quieres revelar la contraseña?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, revelar contraseña'
    }).then((result) => {
      // Si el usuario confirma
      if (result.isConfirmed) {
        // Si el checkbox está "checkeado"
        if ($('#show_password').is(':checked')) {
          // Convertimos el input de contraseña a texto.
          $('#password').get(0).type = 'text';
        } else {
          // Lo convertimos a contraseña.
          $('#password').get(0).type = 'password';
        }
      }
    });
  });

  $('#login-form').attr('autocomplete', 'off');
</script>

<script src="../Scripts/Redirecciones.js" type="text/javascript"></script>

	