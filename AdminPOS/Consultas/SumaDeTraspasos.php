<?php
    include_once("db_connect.php");
    include "Consultas.php";
    $sql ="SELECT * FROM Traspasos_generadosV2 order by ID_Traspaso_Generado desc limit 1";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$Ticketss = mysqli_fetch_assoc($resultset);
 

$monto1 = $Ticketss['Folio_Traspaso'];
$monto2 = 000000000001; 
$totalmonto =  $monto1 + $monto2; 
 
    
  
?>