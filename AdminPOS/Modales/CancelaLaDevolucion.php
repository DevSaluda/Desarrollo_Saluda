<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";

$sql = "SELECT * FROM Traspasos_generados ORDER BY ID_Traspaso_Generado DESC LIMIT 1";
$resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
$Ticketss = mysqli_fetch_assoc($resultset);

$monto1 = $Ticketss['Num_Orden'];
$monto2 = 1;
$totalmonto = $monto1 + $monto2;

$longitud_original = strlen($Ticketss['Num_Orden']);
$totalmonto_con_ceros = str_pad($totalmonto, $longitud_original, '0', STR_PAD_LEFT);

$fcha = date("Y-m-d");
$user_id = null;
$sql1 = "SELECT 
    Devolucion_POS.ID_Registro,
    Devolucion_POS.Num_Factura,
    Devolucion_POS.Cod_Barra,
    Devolucion_POS.Nombre_Produc,
    Devolucion_POS.Cantidad,
    Devolucion_POS.Fk_Suc_Salida,
    Devolucion_POS.Motivo_Devolucion,
    Devolucion_POS.Fecha,
    Devolucion_POS.Agrego,
    Devolucion_POS.HoraAgregado,
    Devolucion_POS.NumOrde,
    Devolucion_POS.Movimiento,
    Devolucion_POS.Proveedor,
    SucursalesCorre.Nombre_Sucursal,
    SucursalesCorre.ID_SucursalC,
    MAX(Stock_POS.Cod_Barra) AS Stock_Cod_Barra,
    MAX(Stock_POS.Precio_Venta) AS Precio_Venta,
    MAX(Stock_POS.Precio_C) AS Precio_C,
    MAX(Stock_POS.ID_Prod_POS) AS ID_Prod_POS,
    MAX(Stock_POS.Tipo_Servicio) AS Tipo_Servicio
FROM 
    Devolucion_POS
LEFT JOIN 
    SucursalesCorre ON Devolucion_POS.Fk_Suc_Salida = SucursalesCorre.ID_SucursalC
LEFT JOIN 
    Stock_POS ON Devolucion_POS.Cod_Barra = Stock_POS.Cod_Barra
WHERE 
  Devolucion_POS.ID_Registro = '" . $_POST["id"] . "'
GROUP BY 
    Devolucion_POS.ID_Registro,
    Devolucion_POS.Num_Factura,
    Devolucion_POS.Cod_Barra,
    Devolucion_POS.Nombre_Produc,
    Devolucion_POS.Cantidad,
    Devolucion_POS.Fk_Suc_Salida,
    Devolucion_POS.Motivo_Devolucion,
    Devolucion_POS.Fecha,
    Devolucion_POS.Agrego,
    Devolucion_POS.HoraAgregado,
    Devolucion_POS.NumOrde,
    Devolucion_POS.Movimiento,
    SucursalesCorre.Nombre_Sucursal,
    SucursalesCorre.ID_SucursalC";

$query = $conn->query($sql1);
$Devoluciones = null;
if ($query->num_rows > 0) {
    while ($r = $query->fetch_object()) {
        $Devoluciones = $r;
        break;
    }
}
?>

<?php if ($Devoluciones != null): ?>
    <!-- Mensaje de Advertencia -->
    <div id="alertaBorrado" class="alert alert-warning">
        <p>Advertencia: Los datos del producto <strong><?php echo $Devoluciones->Nombre_Produc; ?></strong> (Código de Barras: <strong><?php echo $Devoluciones->Cod_Barra; ?></strong>) serán eliminados permanentemente.</p>
    </div>

    <!-- Formulario de actualización (Visible desde el inicio) -->
    <div id="formularioDevolucion">
        <form action="javascript:void(0)" method="post" id="ActualizaEstadoDevolucion">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <label for="nombreProducto">Nombre del producto</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                            </div>
                            <input type="text" id="nombreProducto" class="form-control" readonly value="<?php echo $Devoluciones->Nombre_Produc; ?>">
                        </div>
                    </div>
                    <!-- Más campos del formulario aquí... -->
                </div>
                <!-- Botón de eliminación -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="button" id="submit" class="btn btn-danger" onclick="confirmarEliminacion()">Eliminar datos <i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php else: ?>
    <p class="alert alert-warning">No hay resultados</p>
<?php endif; ?>

<script>
function confirmarEliminacion() {
    // Confirma la eliminación de datos
    if (confirm("¿Estás seguro de que deseas eliminar estos datos?")) {
        // Aquí puedes agregar la lógica de eliminación
        alert("Los datos se han eliminado correctamente.");
    }
}
</script>
