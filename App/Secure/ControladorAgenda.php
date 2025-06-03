<?php

session_start();
include ("Scripts/PersonalAgenda.php");
if($_SESSION["AdminAgenda"])	//Condicion admin
{
	

	header("location:https://saludapos.com/AgendaDeCitas");	

}
if($_SESSION["AgendaPediatria"])	//Condicion personal
{

	header("location: https://saludapos.com/AgendaDeEspecialistas"); 
}

if($_SESSION["AgendaEspecialista"])//Condicion especialista
{
	header("location: https://saludapos.com/AgendaEspecialistas"); 
}

?>