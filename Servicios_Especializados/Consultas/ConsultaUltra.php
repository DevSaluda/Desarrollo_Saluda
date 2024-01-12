<?
include_once("../db_connect.php");
$sql = "SELECT * FROM Resultados_Ultrasonidos";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$ultra = mysqli_fetch_assoc($resultset);
?>