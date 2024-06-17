
<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";
include "Sesion.php";
include "mcript.php";

$sql = "SELECT * FROM `Registros_Energia` WHERE Sucursal='Tekax'";
 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["Id_Registro"] = $fila["Id_Registro"];
    $data[$c]["Registro_energia"] = $fila["Registro_energia"];
    $data[$c]["Fecha_registro"] = $fila["Fecha_registro"];
    $data[$c]["Sucursal"] = $fila["Sucursal"];
    $data[$c]["Comentario"] = $fila["Comentario"];
    $data[$c]["Foto"] = ["<img   alt='avatar' class='img-thumbnail' src='https://controlfarmacia.com/FotosMedidores/$fila[file_name]'>"];
    $data[$c]["Registrado"] = $fila["Registro"];
    $data[$c]["Horaregistro"] = $fila["Agregadoel"];
    $c++; 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
