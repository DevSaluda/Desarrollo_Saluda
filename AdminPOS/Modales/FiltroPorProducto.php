
<div class="modal fade bd-example-modal-xl" id="FiltroPorProducto" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Filtra por Nombre de Porducto o Codigo de Barra<i class="fas fa-credit-card"></i></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       
       <?php
    // Verifica si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['searchTerm'])) {
    // Conexión a la base de datos 
    include "../Consultas/db_connection.php";

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    // consulta SQL 
    $sql = "SELECT * FROM Productos_POS WHERE Nombre_Prod LIKE ? OR Cod_Barra LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $output = array();

    // Verifica si hay resultados y los guarda en el array
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $output[] = $row;
        }
    }

    // Cierra la conexión
    $stmt->close();
    $conn->close();

    // Devuelve los resultados en formato JSON
    echo json_encode($output);
} else {
    // Si no se ha enviado el formulario, devuelve un mensaje de error
    echo json_encode(array("error" => "No se ha enviado el formulario correctamente."));
}
?>
