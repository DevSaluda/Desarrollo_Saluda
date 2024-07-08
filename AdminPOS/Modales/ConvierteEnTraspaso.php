<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";

$fcha = date("Y-m-d");
$user_id=null;
$sql1 = "SELECT `ID_Registro`, `Num_Factura`, `Cod_Barra`, `Nombre_Produc`, `Cantidad`, `Fk_Suc_Salida`, `Motivo_Devolucion`, `Fecha`, `Agrego`, `HoraAgregado`, `NumOrde`, `Movimiento` 
         FROM `Devolucion_POS` 
         WHERE `ID_Registro` = '".$_POST["id"]."' ";

$query = $conn->query($sql1);
$Devoluciones = null;
if($query->num_rows>0){
    while ($r=$query->fetch_object()){
        $Devoluciones = $r;
        break;
    }
}

?>

<?php if($Devoluciones != null): ?>
    <div class="row">
        <div class="col">
            <label for="exampleFormControlInput1">Número de Factura</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="Factura"> <i class="fas fa-info-circle"></i></span>
                </div>
                <input type="text" class="form-control" readonly value="<?php echo $Devoluciones->Num_Factura; ?>">
            </div>
        </div>
        <div class="col">
            <label for="exampleFormControlInput1">Sucursal</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="Sucursal"> <i class="fas fa-info-circle"></i></span>
                </div>
                <input type="text" class="form-control" readonly value="<?php echo $Devoluciones->Fk_Suc_Salida; ?>">
            </div>
        </div>
        <div class="col">
            <label for="exampleFormControlInput1">Agregado por</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="Agrego"> <i class="fas fa-info-circle"></i></span>
                </div>
                <input type="text" class="form-control" readonly value="<?php echo $Devoluciones->Agrego; ?>">
            </div>
        </div>
    </div>

    <div class="text-center">
        <div class="table-responsive">
            <table id="HistorialDevoluciones" class="table table-hover">
                <thead>
                    <th>ID Registro</th>
                    <th>Código de Barra</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Motivo Devolución</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Orden</th>
                    <th>Movimiento</th>
                </thead>
                <tbody>
                    <?php 
                    $query = $conn->query($sql1);
                    while ($Devolucion = $query->fetch_array()): ?>
                        <tr>
                            <td><?php echo $Devolucion["ID_Registro"]; ?></td>
                            <td><?php echo $Devolucion["Cod_Barra"]; ?></td>
                            <td><?php echo $Devolucion["Nombre_Produc"]; ?></td>
                            <td><?php echo $Devolucion["Cantidad"]; ?></td>
                            <td><?php echo $Devolucion["Motivo_Devolucion"]; ?></td>
                            <td><?php echo fechaCastellano($Devolucion["Fecha"]); ?></td>
                            <td><?php echo date("g:i a", strtotime($Devolucion["HoraAgregado"])); ?></td>
                            <td><?php echo $Devolucion["NumOrde"]; ?></td>
                            <td><?php echo $Devolucion["Movimiento"]; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php else: ?>
    <p class="alert alert-warning">No hay resultados</p>
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
