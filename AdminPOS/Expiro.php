<head>
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
