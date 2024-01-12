<?

session_start();
include ("Scripts/ServiciosV2.php");
if($_SESSION["Radiografias"])	//Condicion admin
{
	

	header("location:https://controlfarmacia.com/ServicioEspecial_Radiografias");	

}
if($_SESSION["Ultrasonidos"])	//Condicion personal
{

	header("location: https://controlfarmacia.com/Servicios_Especializados/"); 
}


?>