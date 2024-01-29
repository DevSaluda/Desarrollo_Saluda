<script type="text/javascript">
    var keep_alive = false;

    $(document).bind("click keydown keyup mousemove", function() {
        keep_alive = true;
    });

    setInterval(function() {
        if ( keep_alive ) {
            pingServer();
            keep_alive = false;
        }
    }, 1200000 );

    function pingServer() {
        $.ajax('https://saludapos.com/CEDISMOVIL/keepAlive');
    }
</script>

<footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="https://somosgrupoe.com/">Somos Grupo E</a>.</strong>
    Derechos reservados.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0
    </div>
  </footer>
</div><?php include ("Modales/Salidas.php");
?>
<script src="js/LogSalida.js"></script>
<script src="https://saludapos.com/CEDIS/js/Refresca.js"></script>