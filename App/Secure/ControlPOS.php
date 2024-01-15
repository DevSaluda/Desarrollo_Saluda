<?php

session_start();
include ("Scripts/POS.php");
if($_SESSION["SuperAdmin"])	//Condicion admin
{
	

	header("location:https://saludapos.com/AdminPOS");	

}
if($_SESSION["VentasPos"])	//Condicion personal
{

	header("location: https://saludapos.com/POS2"); 
}

if($_SESSION["AdminPOS"])	//Condicion personal
{

	header("location: https://saludapos.com/AdministracionPOS"); 
}


if($_SESSION["LogisticaPOS"])	//Condicion personal
{

	header("location: https://saludapos.com/POSLogistica"); 
}

if($_SESSION["ResponsableCedis"])	//Condicion personal
{

	header("location: https://saludapos.com/CEDIS"); 
}

if($_SESSION["ResponsableInventarios"])	//Condicion personal
{

	header("location: https://saludapos.com/Inventarios"); 
}

if($_SESSION["ResponsableDeFarmacias"])	//Condicion personal
	{	header("location: https://saludapos.com/ResponsableDeFarmacias");
	}
	if($_SESSION["CoordinadorDental"])	//Condicion personal
	{	header("location: https://saludapos.com/JefeDental");
	}
	if($_SESSION["Supervisor"])	//Condicion personal
	{	header("location: https://saludapos.com/CEDISMOVIL");
	}
	if($_SESSION["JefeEnfermeros"])	//Condicion personal
	{	header("location: https://saludapos.com/JefaturaEnfermeria");
	}