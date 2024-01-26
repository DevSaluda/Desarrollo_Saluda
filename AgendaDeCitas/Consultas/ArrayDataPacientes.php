
<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

;

$sql = "SELECT ID_Data_Paciente,Nombre_Paciente,Edad,Sexo,FK_ID_H_O_D,Alergias,Telefono
FROM Data_Pacientes WHERE FK_ID_H_O_D ='".$row['ID_H_O_D']."' AND Telefono!= '' ORDER BY ID_Data_Paciente DESC";
 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["Folio"] = $fila["ID_Data_Paciente"];
    $data[$c]["Nombre"] = $fila["Nombre_Paciente"];
    $data[$c]["Edad"] = $fila["Edad"];
    $data[$c]["Sexo"] = $fila["Sexo"];
    $data[$c]["Telefono"] = $fila["Telefono"];

    $data[$c]["Llamar"] = ["<a href=tel:".$fila["Telefono"]." type='button' class='btn btn-primary '><i class='fas fa-phone-volume'></i></a> "];
    $data[$c]["Whats"] = ["<a href=https://api.whatsapp.com/send?phone=+52".$fila["Telefono"]." target='_blank' type='button' class='btn btn-success '><i class='fab fa-whatsapp-square'></i></a> "];
    $data[$c]["Contactado"] = ["<a href=tel:+".$fila["ID_Data_Paciente"]." type='button' class='btn btn-info '><i class='fas fa-check'></i> </a>"];
    $c++; 
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
  