<?php


include_once("db_connection.php");
$user_id=null;
$sql1="SELECT * FROM Area_De_Notificaciones Where Estado=1 AND Sucursal='".$row['Fk_Sucursal']."' LIMIT 2";
$query = $conn->query($sql1);
  

$sql ="SELECT COUNT(*) as totalnotifi FROM  Area_De_Notificaciones WHERE Estado=1 AND Sucursal='".$row['Fk_Sucursal']."'"; 
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$Totalnotificaciones = mysqli_fetch_assoc($resultset);

   ?>