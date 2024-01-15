<?php 
date_default_timezone_set("America/Monterrey");

if(!isset($_SESSION['SuperAdmin'])){
	header("Location: Expiro");
}?>