
<?php
require_once("DBController.php");
$db_handle = new DBController();


if(!empty($_POST["NumFactura"])) {
  $query = "SELECT * FROM Traspasos_generados WHERE Num_Factura='" . $_POST["NumFactura"] .  "'";
  $user_count = $db_handle->numRows($query);
  if($user_count>0) {
      echo "<span class='estado-no-disponible-usuario'>Factura ya registrada en traspasos.</span>";
      echo '<script>', 'desactivar();', '</script>';
     
     
      
  }else{
      echo "<span class='estado-disponible-usuario'>Factura sin registrar</span>";
      echo '<script>', 'reactivar();', '</script>';
  }
}


?>