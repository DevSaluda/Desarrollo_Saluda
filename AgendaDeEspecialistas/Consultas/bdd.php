<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=somosgr1_Sistema_Hospitalario;charset=utf8', 'somosgr1_SHWEB', 'yH.0a-v?T*1R');
}
catch(Exception $e)
{
        die('Error : '.$e->getMessage());
}
