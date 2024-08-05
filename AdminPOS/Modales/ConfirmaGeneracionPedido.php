<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";

// Obtener el ID de la sugerencia y la sucursal enviados por POST
$id_sugerencia = $_POST["id"];
$sucursal = $_POST["sucursal"];

// Consulta para obtener detalles de Sugerencias_POS con la condición de sucursal
$sql = "SELECT 
    sp.Id_Sugerencia,
    sp.Cod_Barra,
    sp.Nombre_Prod,
    sp.Fk_sucursal,
    sp.Precio_Venta,
    sp.Precio_C,
    sp.Cantidad,
    sp.Fecha_Ingreso,
    sp.FkPresentacion,
    sp.Proveedor1,
    sp.Proveedor2,
    sp.AgregadoPor,
    sp.AgregadoEl,
    sp.ID_H_O_D,
    sp.NumOrdPedido
FROM 
    Sugerencias_POS sp
WHERE
    sp.NumOrdPedido = '$id_sugerencia' AND
    sp.Fk_sucursal = '$sucursal'";

// Ejecutar la consulta
$query = $conn->query($sql);
$Sugerencias = null;
if ($query->num_rows > 0) {
    while ($r = $query->fetch_object()) {
        $Sugerencias = $r;
        break;
    }
}

// Verificar si se obtuvieron resultados
if ($Sugerencias != null) {
    ?>
    <!-- Modal que se abre al cargar la página -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Registrar Caducados</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Mensaje de Confirmación -->
                    <div class="alert alert-info">
                        ¿Desea realizar el pedido para la sucursal "<?php echo $Sugerencias->Fk_sucursal; ?>" con número de orden de BD "<?php echo $Sugerencias->NumOrdPedido; ?>"?
                    </div>
                    
                    <!-- Formulario para registrar caducados -->
                    <form action="javascript:void(0)" method="post" id="RegistraCaducados">
                        <input type="text" class="form-control" hidden name="IdBasedatos" readonly value="<?php echo $Sugerencias->Id_Sugerencia; ?>">
                        <input type="text" class="form-control" hidden name="AgregadoPor" value="<?php echo $Sugerencias->AgregadoPor; ?>">
                        <input type="text" class="form-control" hidden name="ID_H_O_D" value="<?php echo $Sugerencias->ID_H_O_D; ?>">
                        <input type="text" class="form-control" hidden name="Precio_Venta" value="<?php echo $Sugerencias->Precio_Venta; ?>">
                        <input type="text" class="form-control" hidden name="Precio_C" value="<?php echo $Sugerencias->Precio_C; ?>">
                        <input type="text" class="form-control" hidden name="Fecha_Ingreso" value="<?php echo $Sugerencias->Fecha_Ingreso; ?>">
                        <input type="text" class="form-control" hidden name="Fk_sucursal" value="<?php echo $Sugerencias->Fk_sucursal; ?>">

                        <div class="text-center">
                            <div class="table-responsive">
                                <table id="HistorialDevoluciones" class="table table-hover">
                                    <thead>
                                        <th>Código de Barra</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Cantidad a registrar</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" value="<?php echo $Sugerencias->Cod_Barra; ?>" class="form-control" name="CodBarra" readonly></td>
                                            <td><input type="text" value="<?php echo $Sugerencias->Nombre_Prod; ?>" class="form-control" name="NombreProd" readonly></td>
                                            <td><input type="text" value="<?php echo $Sugerencias->Cantidad; ?>" class="form-control" readonly></td>
                                            <td><input type="number" class="form-control" name="CantidadAregistrar"></td>
                                        </tr>
                                    </tbody>
                                </table> 
                                <button type="submit" id="submit" class="btn btn-success">Registrar caducado <i class="fas fa-check"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/RegistraMedicamentosCaducadosdef.js"></script>

    <script>
        $(document).ready(function() {
            $('#editModal').modal('show'); // Mostrar el modal al cargar el contenido
        });
    </script>

    <?php
} else {
    // Si no hay datos, mostrar un mensaje
    echo '<p class="alert alert-warning">No hay resultados</p>';
}
?>
