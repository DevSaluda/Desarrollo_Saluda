<head>

  <!-- Agrega estos enlaces para incluir los estilos de Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyD8iUueNW4PqGg0XlFgkeqRUmzC6dY4WI" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


  <!-- Agrega este código para incluir jQuery desde un CDN -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI/t1i8n4LgLunLBNxMZi1GjeFqeaCDd1nIGF/O8=" crossorigin="anonymous"></script>
</head>

<?php include "Modales/Expirado.php"?>
<!-- Agrega este código al final de tu archivo PHP -->
<script>
  // Utilizando jQuery para activar el modal automáticamente
  $(document).ready(function() {
    $('#Expirado').modal('show');
  });
</script>
