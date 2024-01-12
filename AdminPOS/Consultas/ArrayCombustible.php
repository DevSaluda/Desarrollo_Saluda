<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";
include "Sesion.php";
include "mcript.php";

$sql = "SELECT * FROM `Registros_Combustibles`";
 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["Id_Registro"] = $fila["Id_Registro"];
    $data[$c]["Registro_combustible"] = $fila["Registro_combustible"];
    $data[$c]["Fecha_registro"] = $fila["Fecha_registro"];
    $data[$c]["Sucursal"] = $fila["Sucursal"];
    $data[$c]["Comentario"] = $fila["Comentario"];
    $data[$c]["Foto"] = ["<img   alt='avatar' class='img-thumbnail' src='https://controlfarmacia.com/FotosMedidores/$fila[file_name]'>"];
    $data[$c]["Registro"] = $fila["Registro"];
    $data[$c]["Agregadoel"] = $fila["Agregadoel"];
      $data[$c]["Tipo_Veiculo"] = $fila["Tipo_Veiculo"];

    $c++; 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
