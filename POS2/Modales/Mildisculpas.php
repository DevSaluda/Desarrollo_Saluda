<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ventana Modal</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background-color: #f0f0f0;
    }

    .modal {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      text-align: left;
    }

    .modal img {
      width: 100%;
      max-width: 300px;
      border-radius: 8px;
    }

    .overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1;
    }
  </style>
</head>
<body>

<div class="overlay" id="overlay"></div>

<div class="modal" id="modal">
  <p>Lamentamos las molestias ocasionadas por el mantenimiento que sufrió el sistema. Agradecemos su paciencia y apoyo. </p>
  
  <ul>
    <li>La agenda de citas ya funciona y pueden agendar sin problemas.</li>
    <li>La recepción de traspasos opera con normalidad.</li>
    <li>La apertura y cobro de abonos dentales para las sucursales que lo manejan estarán listas en el transcurso del día.</li>
    <li>Estamos trabajando en el tema del cierre de sesión por inactividad.</li>
  </ul>

  <p>Gracias nuevamente por su paciencia y apoyo.</p>

  <!-- Gif de Cheems -->
  <img src="https://c.tenor.com/YEqsyuOsPVwAAAAd/tenor.gif" alt="Cheems">

  <!-- Botón de WhatsApp -->
  <a href="https://api.whatsapp.com/send?phone=9993630961" target="_blank" style="display: inline-block; background-color: #25D366; color: #fff; padding: 10px 15px; text-decoration: none; border-radius: 5px; margin-top: 10px;">Reportar Incidencias por WhatsApp</a>
</div>

<script>
  // Función para abrir la modal automáticamente al cargar la página
  window.onload = function() {
    openModal();
  };

  function openModal() {
    document.getElementById('modal').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
  }

  function closeModal() {
    document.getElementById('modal').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
  }

  // Cerrar modal al hacer clic fuera de él
  window.onclick = function (event) {
    var modal = document.getElementById('modal');
    if (event.target === modal) {
      closeModal();
    }
  };
</script>

</body>
</html>
