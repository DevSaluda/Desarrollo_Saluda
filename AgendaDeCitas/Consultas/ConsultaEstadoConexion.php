<?
include_once("../db_connect.php");
$sql ="SELECT * FROM Personal_Agenda_Logs WHERE  PersonalAgenda_ID='".$row['PersonalAgenda_ID']."'"; 
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$EstadoIngreso = mysqli_fetch_assoc($resultset);

?>