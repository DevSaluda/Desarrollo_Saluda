<?php
include 'Consultas.php';

if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    $query = "SELECT Nombre_Paciente, Telefono FROM Data_Pacientes WHERE Nombre_Paciente LIKE '%$nombre%' LIMIT 10";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<a href='#' class='list-group-item list-group-item-action paciente-sugerido' data-nombre='".$row['Nombre_Paciente']."' data-telefono='".$row['Telefono']."'>".$row['Nombre_Paciente']." - ".$row['Telefono']."</a>";
        }
    } else {
        echo "<p class='list-group-item'>No se encontraron pacientes</p>";
    }
}
?>
