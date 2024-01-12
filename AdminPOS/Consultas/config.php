<?php
$server = "localhost";
$username = "somosgr1_SHWEB";
$password = "yH.0a-v?T*1R";
$dbname = "somosgr1_Sistema_Hospitalario";

// creamos la conexion con MySQL
try{
$db = new PDO("mysql:host=$server;dbname=$dbname","$username","$password");
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
die('No se pudo conectar con la base de datos');
}


?>