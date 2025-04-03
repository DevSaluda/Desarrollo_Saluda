<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";

$fcha = date("Y-m-d");
$user_id = null;

// Primera consulta para obtener información del ticket
$sql1 = "SELECT 
    Ventas_POS.Folio_Ticket,
    Ventas_POS.Fk_Caja,
    Ventas_POS.Venta_POS_ID,
    Ventas_POS.Identificador_tipo,
    Ventas_POS.Cod_Barra,
    Ventas_POS.FormaDePago,
    Ventas_POS.Fecha_venta,
    Ventas_POS.Clave_adicional,
    Ventas_POS.Total_Venta,
    Ventas_POS.Importe,
    Ventas_POS.Total_VentaG,
    Ventas_POS.CantidadPago,
    Ventas_POS.Cambio,
    Servicios_POS.Servicio_ID,
    Servicios_POS.Nom_Serv,
    Ventas_POS.Nombre_Prod,
    Ventas_POS.Cantidad_Venta,
    Ventas_POS.Fk_sucursal,
    Ventas_POS.AgregadoPor,
    Ventas_POS.AgregadoEl,
    Ventas_POS.Lote,
    Ventas_POS.ID_H_O_D,
    SucursalesCorre.ID_SucursalC,
    SucursalesCorre.Nombre_Sucursal
FROM Ventas_POS
JOIN SucursalesCorre ON Ventas_POS.Fk_sucursal = SucursalesCorre.ID_SucursalC
JOIN Servicios_POS ON Ventas_POS.Identificador_tipo = Servicios_POS.Servicio_ID
WHERE Ventas_POS.Folio_Ticket = ? 
AND Ventas_POS.Fk_sucursal = ?";

$stmt = $conn->prepare($sql1);
$stmt->bind_param("ss", $_POST["id"], $_SESSION['Fk_Sucursal']);
$stmt->execute();
$result = $stmt->get_result();
$Especialistas = null;

if($result->num_rows > 0) {
    $Especialistas = $result->fetch_object();
}

// Segunda consulta para obtener detalles del ticket
$sql2 = "SELECT 
    Ventas_POS.Folio_Ticket,
    Ventas_POS.Fk_Caja,
    Ventas_POS.Venta_POS_ID,
    Ventas_POS.Identificador_tipo,
    Ventas_POS.Cod_Barra,
    Ventas_POS.Turno,
    Ventas_POS.DescuentoAplicado,
    Ventas_POS.Fecha_venta,
    Ventas_POS.FormaDePago,
    Ventas_POS.Clave_adicional,
    Ventas_POS.Total_Venta,
    Ventas_POS.Importe,
    Ventas_POS.Total_VentaG,
    Ventas_POS.CantidadPago,
    Ventas_POS.Cambio,
    Servicios_POS.Servicio_ID,
    Servicios_POS.Nom_Serv,
    Ventas_POS.Nombre_Prod,
    Ventas_POS.Cantidad_Venta,
    Ventas_POS.Fk_sucursal,
    Ventas_POS.AgregadoPor,
    Ventas_POS.AgregadoEl,
    Ventas_POS.Lote,
    Ventas_POS.ID_H_O_D,
    SucursalesCorre.ID_SucursalC,
    SucursalesCorre.Nombre_Sucursal
FROM Ventas_POS
JOIN SucursalesCorre ON Ventas_POS.Fk_sucursal = SucursalesCorre.ID_SucursalC
JOIN Servicios_POS ON Ventas_POS.Identificador_tipo = Servicios_POS.Servicio_ID
WHERE Ventas_POS.Folio_Ticket = ? 
AND Ventas_POS.Fk_sucursal = ?";

$stmt = $conn->prepare($sql2);
$stmt->bind_param("ss", $_POST["id"], $_SESSION['Fk_Sucursal']);
$stmt->execute();
$query = $stmt->get_result();
?>

<?php if($Especialistas != null): ?>
    <div class="row">
        <div class="col">
            <label for="exampleFormControlInput1">N° Ticket</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="Tarjeta">
                        <i class="fas fa-info-circle"></i>
                    </span>
                </div>
                <input type="text" class="form-control" readonly value="<?php echo $Especialistas->Folio_Ticket; ?>">
            </div>
        </div>
        <div class="col">
            <label for="exampleFormControlInput1">Sucursal</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="Tarjeta">
                        <i class="fas fa-info-circle"></i>
                    </span>
                </div>
                <input type="text" class="form-control" readonly value="<?php echo $Especialistas->Nombre_Sucursal; ?>">
            </div>
        </div>
        <div class="col">
            <label for="exampleFormControlInput1">Vendedor</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="Tarjeta">
                        <i class="fas fa-info-circle"></i>
                    </span>
                </div>
                <input type="text" class="form-control" readonly value="<?php echo $Especialistas->AgregadoPor; ?>">
            </div>
        </div>
    </div>

    <?php if($query->num_rows > 0): ?>
        <div class="text-center">
            <div class="table-responsive">
                <table id="HistorialCajas" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Servicio</th>
                            <th>Cod barra</th>
                            <th>Prod</th>
                            <th>Lote</th>
                            <th>Cantidad</th>
                            <th>P.U</th>
                            <th>Descuento</th>
                            <th>Importe</th>
                            <th>Fecha | Hora</th>
                            <th>Vendedor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($Tickets = $query->fetch_array()): ?>
                            <tr>
                                <td><?php echo $Tickets["Nom_Serv"]; ?></td>
                                <td><?php echo $Tickets["Cod_Barra"]; ?></td>
                                <td><?php echo $Tickets["Nombre_Prod"]; ?></td>
                                <td><?php echo $Tickets["Lote"]; ?></td>
                                <td><?php echo $Tickets["Cantidad_Venta"]; ?></td>
                                <td><?php echo number_format($Tickets["Total_Venta"], 2); ?></td>
                                <td><?php echo $Tickets["DescuentoAplicado"]; ?> %</td>
                                <td><?php echo number_format($Tickets["Importe"], 2); ?></td>
                                <td>
                                    <?php echo fechaCastellano($Tickets["AgregadoEl"]); ?> <br>
                                    <?php echo date("g:i a", strtotime($Tickets["AgregadoEl"])); ?>
                                </td>
                                <td><?php echo $Tickets["AgregadoPor"]; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="exampleFormControlInput1">Total de venta</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Tarjeta">
                            <i class="fas fa-info-circle"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" readonly value="<?php echo number_format($Especialistas->Total_VentaG, 2); ?>">
                </div>
            </div>
            <div class="col">
                <label for="exampleFormControlInput1">El cliente pago</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Tarjeta">
                            <i class="fas fa-info-circle"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" readonly value="<?php echo number_format($Especialistas->CantidadPago, 2); ?>">
                </div>
            </div>
            <div class="col">
                <label for="exampleFormControlInput1">Cambio</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Tarjeta">
                            <i class="fas fa-info-circle"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" readonly value="<?php echo number_format($Especialistas->Cambio, 2); ?>">
                </div>
            </div>
            <div class="col">
                <label for="exampleFormControlInput1">Forma de pago</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Tarjeta">
                            <i class="fas fa-info-circle"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" readonly value="<?php echo $Especialistas->FormaDePago; ?>">
                </div>
            </div>
        </div>
    <?php else: ?>
        <p class="alert alert-warning">No hay resultados</p>
    <?php endif; ?>
<?php else: ?>
    <p class="alert alert-danger">404 No se encuentra<br>El ticket puede corresponder a un crédito, te sugerimos revisar el área de créditos</p>
<?php endif; ?>

<?php
function fechaCastellano($fecha) {
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