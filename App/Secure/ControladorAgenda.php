<?

session_start();
include ("Scripts/PersonalAgenda.php");
if($_SESSION["AdminAgenda"])	//Condicion admin
{
	

	header("location:https://controlfarmacia.com/AgendaDeCitas");	

}
if($_SESSION["AgendaDePavel"])	//Condicion personal
{

	header("location: https://controlfarmacia.com/AgendaPavel"); 
}


?>