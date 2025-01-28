<?php
include("db_connection.php");
include "Consultas/Consultas.php";

// Obtener el ID del procedimiento de la URL
$idprocedimiento = isset($_GET['idprocedimiento']) ? intval($_GET['idprocedimiento']) : 0;

// Verificar si se ha proporcionado un ID de procedimiento válido
if ($idprocedimiento <= 0) {
    die("ID de procedimiento no válido.");
}

// Obtener los detalles del procedimiento (opcional para el título)
$sql_procedimiento = "
    SELECT IDProcedimiento, Nombre_Procedimiento
    FROM Procedimientos_POS
    WHERE IDProcedimiento = $idprocedimiento
";
$result_procedimiento = $conn->query($sql_procedimiento);
if ($result_procedimiento && $result_procedimiento->num_rows > 0) {
    $procedimiento = $result_procedimiento->fetch_assoc();
} else {
    die("No se encontró el procedimiento.");
}

// Obtener los productos asociados al procedimiento
$sql_productos = "
    SELECT 
        ProdProc.IDProductoProc,
        ProdPos.Nombre_Prod,
        ProdProc.Cantidad
    FROM 
        Productos_En_Procedimientos AS ProdProc
    INNER JOIN 
        Productos_POS AS ProdPos
    ON 
        ProdProc.Fk_Prod_Stock = ProdPos.ID_Prod_POS
    WHERE 
        ProdProc.IDProcedimiento = $idprocedimiento
";
$result_productos = $conn->query($sql_productos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?php echo $procedimiento['Nombre_Procedimiento']; ?> | Procedimientos Médicos</title>

<?php include "Header.php"; ?>
<style>
    .error {
        color: red;
        margin-left: 5px;
    }
</style>
</head>
<?php include_once("Menu.php"); ?>
<body>
<div class="container mt-4">
    <h2>Detalles del procedimiento: <?php echo $procedimiento['Nombre_Procedimiento']; ?></h2>
    <a href="ProcedimientosEnfermeria.php" class="btn btn-secondary mb-3">Regresar</a>
    <h3>Productos asociados al procedimiento</h3>
    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto" data-procedimiento-id="<?php echo $procedimiento['IDProcedimiento']; ?>">
        Agregar Producto
    </button>

    <?php if ($result_productos && $result_productos->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Producto</th>
                    <th>Nombre del Producto</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr> 
            </thead>
            <tbody>
                <?php while ($producto = $result_productos->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $producto['IDProductoProc']; ?></td>
                        <td><?php echo $producto['Nombre_Prod']; ?></td>
                        <td>
                            <input 
                                type="number" 
                                class="form-control input-cantidad" 
                                data-id-producto="<?php echo $producto['IDProductoProc']; ?>" 
                                data-id-procedimiento="<?php echo $idprocedimiento; ?>" 
                                value="<?php echo $producto['Cantidad']; ?>" 
                                min="1"
                            >
                        </td>
                        <td>
                            <button 
                                class="btn btn-danger btn-eliminar-producto" 
                                data-id-producto="<?php echo $producto['IDProductoProc']; ?>" 
                                data-id-procedimiento="<?php echo $idprocedimiento; ?>">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="alert alert-warning">No hay productos asociados a este procedimiento.</p>
    <?php endif; ?>
</div>
</body>
</html>

<?php
include('Modales/ModalAgregarProductoProcedimiento.php');
include("footer.php");
?>
<script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script> 
<script src='js/ControlDetallesProcedimiento.js'></script> 
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

</body>
</html>
