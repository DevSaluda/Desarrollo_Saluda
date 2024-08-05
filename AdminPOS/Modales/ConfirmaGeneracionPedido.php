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
    sc.Nombre_Sucursal,  -- Asumiendo que 'Nombre_Sucursal' es una columna en 'SucursalesCorre'
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
INNER JOIN 
    SucursalesCorre sc ON sp.Fk_sucursal = sc.ID_SucursalC
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
