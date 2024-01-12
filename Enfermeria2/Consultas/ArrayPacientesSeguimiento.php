
<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";
include "Sesion.php";


$sql = "SELECT ID_Data_Paciente,Nombre_Paciente,Edad,Sexo,FK_ID_H_O_D,Alergias
FROM Data_Pacientes WHERE FK_ID_H_O_D ='".$row['ID_H_O_D']."' ORDER BY ID_Data_Paciente DESC";
 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["Folio"] = $fila["ID_Data_Paciente"];
    $data[$c]["Nombre"] = $fila["Nombre_Paciente"];
    $data[$c]["Edad"] = $fila["Edad"];
    $data[$c]["Sexo"] = $fila["Sexo"];
    $data[$c]["Alergias"] = $fila["Alergias"];
    $data[$c]["Cita"] = '<td>
    <button data-id="' . $fila["ID_Data_Paciente"] . '" type="button" class="btn-edit btn btn-success"><i class="fas fa-file-medical-alt"></i> Cita</button>
</td>';

    
    
    $c++; 
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
