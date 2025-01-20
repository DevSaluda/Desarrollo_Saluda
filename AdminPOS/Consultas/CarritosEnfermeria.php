<?php
include("db_connection.php");
include "Consultas.php";

$user_id = null;

$sql1 = "
    SELECT 
        c.ID_CARRITO,
        c.ID_SUCURSAL,
        s.Nombre_Sucursal
    FROM 
        CarritosEnfermeria AS c
    INNER JOIN 
        SucursalesCorre AS s
    ON 
        c.ID_SUCURSAL = s.ID_SucursalC
";

$query = $conn->query($sql1);
if (!$query) {
    die("Error en la consulta SQL: " . $conn->error);
}
?>

<?php if ($query->num_rows > 0) : ?>
    <div class="text-center">
        <div class="table-responsive">
            <table id="TiposConsultasDoc" class="table table-hover">
                <thead>
                    <th style="background-color:#0057b8 !important;">N° Carrito</th>
                    <th style="background-color:#0057b8 !important;">Sucursal</th>
                    <th style="background-color:#0057b8 !important;">Acciones</th>
                </thead>
                <tbody>
                    <?php while ($row = $query->fetch_array()) : ?>
                        <tr>
                            <td><?php echo $row["ID_CARRITO"]; ?></td>
                            <td><?php echo $row["Nombre_Sucursal"]; ?></td>
                            <td>
                                <a href="detalle_carrito.php?id_carrito=<?php echo $row['ID_CARRITO']; ?>" class="btn btn-primary">
                                    Ver detalles
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php else : ?>
    <p class="alert alert-warning">No hay resultados</p>
<?php endif; ?>
