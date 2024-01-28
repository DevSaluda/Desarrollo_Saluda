<?php
//DB details
$dbHost = 'localhost';
$dbUsername = 'somosgr1_SHWEB';
$dbPassword = 'yH.0a-v?T*1R';
$dbName = 'somosgr1_Sistema_Hospitalario';

//Create connection and select DB
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if($db->connect_error){
    die("Unable to connect database: " . $db->connect_error);
}