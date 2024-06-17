<?php

session_start();

include ("Scripts/Medicos.php");

if($_SESSION["Médico"])	//Condicion personal
{

	header("location: https://saludapos.com/Medicos/"); 
}

?>