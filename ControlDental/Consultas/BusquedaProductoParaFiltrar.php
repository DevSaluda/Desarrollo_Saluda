<?php
include 'config.php';

// Numero de registros
$numero_de_registros = 10;

if(!isset($_POST['palabraClave'])){

// Obtener registros
$stmt = $db->prepare("SELECT * FROM Productos_POS ORDER BY Nombre_Prod LIMIT :limit");
$stmt->bindValue(':limit', (int)$numero_de_registros, PDO::PARAM_INT);
$stmt->execute();
$usersList = $stmt->fetchAll();

}else{

$search = $_POST['palabraClave'];// Palabra a buscar

// Obtener registros
$stmt = $db->prepare("SELECT * FROM Productos_POS WHERE Nombre_Prod like :Nombre_Prod ORDER BY Nombre_Prod LIMIT :limit");
$stmt->bindValue(':Nombre_Prod', '%'.$search.'%', PDO::PARAM_STR);
$stmt->bindValue(':limit', (int)$numero_de_registros, PDO::PARAM_INT);
$stmt->execute();
$usersList = $stmt->fetchAll();

}

$response = array();

// Leer la informacion
foreach($usersList as $user){
$response[] = array(
"id" => $user['Cod_Barra'],
"text" => $user['Nombre_Prod']

);
}

echo json_encode($response);
exit();

?>