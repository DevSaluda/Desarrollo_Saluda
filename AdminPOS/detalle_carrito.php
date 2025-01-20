<?php
include("db_connection.php");

// Obtener el ID del carrito de la URL
$id_carrito = isset($_GET['ID_CARRITO']) ? intval($_GET['ID_CARRITO']) : 0;


// Verificar si se ha proporcionado un ID de carrito válido
if ($id_carrito <= 0) {
    die("ID de carrito no válido.");
}

// Obtener los detalles del carrito (opcional para el título)
$sql_carrito = "
    SELECT ID_CARRITO 
    FROM CARRITOS
    WHERE ID_CARRITO = $id_carrito
";
$result_carrito = $conn->query($sql_carrito);
if ($result_carrito && $result_carrito->num_rows > 0) {
    $carrito = $result_carrito->fetch_assoc();
} else {
    die("No se encontró el carrito.");
}

// Obtener productos en el carrito
$sql_productos = "
    SELECT 
        pc.ID_PRODUCTO,
        p.Nombre_Prod,
        pc.CANTIDAD
    FROM 
        PRODUCTOS_EN_CARRITO AS pc
    INNER JOIN 
        Productos_POS AS p
    ON 
        pc.FK_Producto = p.ID_Prod_POS
    WHERE 
        pc.ID_CARRITO = $id_carrito
";
$result_productos = $conn->query($sql_productos);
?>
<?php
include "Consultas/Consultas.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?php echo $row['ID_H_O_D']?> | Carritos Enfermeria </title>

<?php include "Header.php"?>
 <style>
        .error {
  color: red;
  margin-left: 5px; 
  
}

    </style>
</head>
<?php include_once ("Menu.php")?>
<body>
    <div class="container mt-4">
        <h2>Detalle del Carrito N° <?php echo $carrito['ID_CARRITO']; ?></h2>

        <h3>Productos en el carrito</h3>
        <?php if ($result_productos->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Producto</th>
                        <th>Nombre del Producto</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($producto = $result_productos->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $producto['ID_PRODUCTO']; ?></td>
                            <td><?php echo $producto['Nombre_Prod']; ?></td>
                            <td><?php echo $producto['CANTIDAD']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="alert alert-warning">No hay productos en este carrito.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
    
¿
  include ("footer.php")?>

<script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
    <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->

</body>
</html>
<?php

function fechaCastellano ($fecha) {
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}
?>
