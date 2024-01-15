<?php 
date_default_timezone_set("America/Monterrey");
session_start();
if(!isset($_SESSION['SuperAdmin'])){
	header("Location: Expiro");
}
?>