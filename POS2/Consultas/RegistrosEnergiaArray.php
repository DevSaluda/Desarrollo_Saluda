
<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

$fcha = date("Y-m-d");


// Obtiene la fecha actual en el formato 'YYYY-MM-DD'
$fechaActual = date("Y-m-d");

// Consulta SQL adaptada con la variable de fecha
$sql = "SELECT * FROM `Registros_Energia` WHERE Fecha_registro = '$fechaActual' AND Sucursal = '" . $row['Nombre_Sucursal'] . "'";

 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["Id_Registro"] = $fila["Id_Registro"];
    $data[$c]["Registro_energia"] = $fila["Registro_energia"];
    $data[$c]["Fecha_registro"] = $fila["Fecha_registro"];
    $data[$c]["Sucursal"] = $fila["Sucursal"];
    $data[$c]["Comentario"] = $fila["Comentario"];
    $data[$c]["Foto"] = ["<img   alt='avatar' class='img-thumbnail' src='https://saludapos.com/FotosMedidores/$fila[file_name]'>"];
    
    $c++; 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
