<script>
function desactivado(){
    $("#submit_registro").attr('disabled','disabled');
}
function activado(){
    $("#submit_registro").removeAttr('disabled');
}
</script>

<?php 
require('../Consultas/db_connection.php');

sleep(1);
if (isset($_POST)) {
    $Sucursal = (string)$_POST['sucursal'];
    
    $result = $conn->query(
        'SELECT * FROM Sucursales_CampañasV2 WHERE ID_SucursalC = "'.htmlentities(strip_tags(Trim(($Sucursal)))).'"'
    );
    
    if ($result->num_rows > 0) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class="fas fa-exclamation-triangle"></i></strong> La sucursal ya existe, no se puede ingresar de nuevo
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
        echo "<script> desactivado(); </script>"; 
    } else {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><i class="fas fa-check-circle"></i></i></strong> La sucursal puede ser ingresada al sistema, sin problemas         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
        echo "<script> activado(); </script>"; 
    }
}


