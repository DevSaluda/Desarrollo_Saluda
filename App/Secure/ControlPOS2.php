<?

session_start();
include ("Scripts/POS2.php");
if($_SESSION["AdminPOS"])	//Condicion admin
{
	$cookie_name = "Admin";
    $cookie_value = "true";
    setcookie($cookie_name, $cookie_value, time() + (200000), "/"); 

	header("location:https://controlfarmacia.com/AdminPOS");	

}
if($_SESSION["VentasPos"])	//Condicion personal
{

	header("location: https://controlfarmacia.com/POS2/index"); 
}


include ("Modales.php")
?>