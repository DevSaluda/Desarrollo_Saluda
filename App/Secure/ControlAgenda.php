<?

session_start();
include ("Scripts/PersonalAgenda.php");
if($_SESSION["AdminAgenda"])	//Condicion admin
{

	header("location:https://controlfarmacia.com/ControldecitasV2");	

}
if($_SESSION["AgendaCallCenter"])	//Condicion personal
{

	header("location: https://controlfarmacia.com/POS"); 
}


?>