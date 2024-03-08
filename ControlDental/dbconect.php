<?php
// simple conexion a la base de datos
function connect(){
	return new mysqli("localhost","u155356178_SaludDevCenter","uE;bAISz;*6c|I4PvEnfSys324\Zavp2zJ:9TLx{]L&QMcmhAdmSCDBSN3iH4UV3D24WMF@2024myV>","u155356178_saludapos");
}
$con = connect();
if (!$con->set_charset("utf8")) {//asignamos la codificación comprobando que no falle
       die("Error cargando el conjunto de caracteres utf8");
}
?>