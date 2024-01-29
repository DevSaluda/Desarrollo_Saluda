<?php

session_start();

include ("Scripts/Enfermeria2.php");

if($_SESSION["Enfermeria"])	//Condicion personal
{

	header("location: https://saludapos.com/Enfermeria2/"); 
}
if($_SESSION["AdminEnfermeria"])	//Condicion personal
{
 

 //header("location: https://controlconsulta.com/CEnfermeria/"); 
}


?>