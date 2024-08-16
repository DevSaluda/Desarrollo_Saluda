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
    sc.Nombre_Sucursal,  -- Asegúrate de que esta columna existe en 'SucursalesCorre'
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
                        ¿Desea realizar el pedido para la sucursal "<?php echo $Sugerencias->Nombre_Sucursal; ?>" con número de orden de "<?php echo $Sugerencias->NumOrdPedido; ?>"?
                    </div>
                    
                    <!-- Formulario para registrar caducados -->
                    <form action="GeneradorDeEncargos" method="post" >
                       <input type="text" name="Mes" hidden value="<?php echo $Sugerencias->NumOrdPedido; ?>">
                       <input type="text" name="Sucursal"  hidden value="<?php echo $Sugerencias->Fk_sucursal; ?>">
                        
                                <button type="submit" id="submit" class="btn btn-success">Generar pedido <i class="fas fa-file-invoice-dollar"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

  

 

    <?php
} else {
    // Si no hay datos, mostrar un mensaje
    echo '<p class="alert alert-warning">No hay resultados</p>';
}
?>
