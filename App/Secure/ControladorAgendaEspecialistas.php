<?php

session_start();

include ("Scripts/AgendaEspecialistas.php");

if($_SESSION["AgendaEspecialista"])	//Condicion personal
{

	header("location: https://saludapos.com/AgendaEspecialistas/"); 
}

?>