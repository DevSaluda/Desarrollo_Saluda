
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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['searchTerm'])) {
    // Validar y limpiar datos de entrada
    $searchTerm = trim($_POST['searchTerm']);
    $searchTerm = htmlspecialchars($searchTerm);

    // Conexión a la base de datos
    include "../Consultas/db_connection.php";

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL
    $sql = "SELECT * FROM Productos_POS WHERE `Nombre_Prod` LIKE ? OR `Cod_Barra` = ?";
    $stmt = $conn->prepare($sql);

    // Verificar si la consulta fue correcta
    if ($stmt === false) {
        die("Error en la  consulta: " . $conn->error);
    }

    // Definir las variables para la búsqueda
    $nombre_busqueda = '%' . $searchTerm . '%';
    $codigo_busqueda = $searchTerm;

    // Enlazar parámetros
    $stmt->bind_param("ss", $nombre_busqueda, $codigo_busqueda);
    $stmt->execute();
    $result = $stmt->get_result();

    $output = array();

    // Verificar si hay resultados y guardarlos en el array
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $output[] = $row;
        }
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();

    // Devolver los resultados en formato JSON
    echo json_encode($output);
} else {
    // Si no se ha enviado el formulario, devolver un mensaje de error
    echo json_encode(array("error" => "No se ha enviado el formulario correctamente."));
}
?>
