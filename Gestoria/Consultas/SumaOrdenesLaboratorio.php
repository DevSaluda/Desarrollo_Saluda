<?php
    include_once("../db_connect.php");
    include "../Consultas.php";
include "../Sesion.php";
    $sql ="SELECT * FROM Agenda_Labs  where Fk_sucursal='".$row['Fk_Sucursal']."'  order by Id_genda desc limit 1";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$Ticketss = mysqli_fetch_assoc($resultset);
 

$monto1 = $Ticketss['Num_Orden'];; 
$monto2 = 1; 
$totalmonto = $monto1 + $monto2; 
 
    
  
?>