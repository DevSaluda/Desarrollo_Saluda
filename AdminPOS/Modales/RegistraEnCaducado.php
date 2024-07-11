<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
 $sql = "SELECT * FROM Traspasos_generados ORDER BY ID_Traspaso_Generado DESC LIMIT 1";
 $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
 $Ticketss = mysqli_fetch_assoc($resultset);
 
 $monto1 = $Ticketss['Num_Orden'];
 $monto2 = 1;
 $totalmonto = $monto1 + $monto2;
 
 // Obtener la longitud original de $Ticketss['Num_Orden']
 $longitud_original = strlen($Ticketss['Num_Orden']);
 
 // Mostrar $totalmonto con los caracteres '0000000000' (ajustando la longitud)
 $totalmonto_con_ceros = str_pad($totalmonto, $longitud_original, '0', STR_PAD_LEFT);


$fcha = date("Y-m-d");
$user_id=null;
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
    SucursalesCorre.Nombre_Sucursal,
    Stock_POS.Cod_Barra AS Stock_Cod_Barra,
    Stock_POS.Fk_sucursal AS Stock_Fk_sucursal,
    Stock_POS.Precio_Venta,
    Stock_POS.Precio_C,
    Stock_POS.ID_Prod_POS,
    Stock_POS.Tipo_Servicio
FROM 
    Devolucion_POS
LEFT JOIN 
    SucursalesCorre ON Devolucion_POS.Fk_Suc_Salida = SucursalesCorre.ID_SucursalC
LEFT JOIN 
    Stock_POS ON Devolucion_POS.Cod_Barra = Stock_POS.Cod_Barra 
    
WHERE 
    Devolucion_POS.ID_Registro = '".$_POST["id"]."' ";

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
    <form action="javascript:void(0)" method="post" id="RegistraCaducados" >
    <div class="row">
        <div class="col">
            <label for="exampleFormControlInput1">Número de Factura</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="Factura"> <i class="fas fa-info-circle"></i></span>
                </div>
                <input type="text" class="form-control" readonly value="<?php echo $Devoluciones->Num_Factura; ?>">
                <input type="text" class="form-control" hidden name="IdBasedatos" hidden readonly value="<?php echo $Devoluciones->ID_Prod_POS; ?>">
                <input type="text" class="form-control" hidden value="<?php echo $row['Nombre_Apellidos']?>" readonly name="GeneradoPor">
                <input type="text" class="form-control" hidden name="TipodeServicio"  readonly value="<?php echo $Devoluciones->Tipo_Servicio; ?>">
                <input type="text" class="form-control" hidden name="ID_H_O_D"  readonly value="Saluda">
            </div>
        </div>
        <div class="col">
            <label for="exampleFormControlInput1">Sucursal</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="Sucursal"> <i class="fas fa-info-circle"></i></span>
                </div>
                <input type="text" class="form-control" name="Fk_sucursal" hidden readonly value="<?php echo $Devoluciones->Fk_Suc_Salida; ?>">
                <input type="text" class="form-control"  readonly value="<?php echo $Devoluciones->Nombre_Sucursal; ?>">
            </div>
        </div>
        

      

        <div class="col">
            <label for="exampleFormControlInput1">Motivo de baja</label>
            <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-barcode"></i></span>
            <select class="form-control" style="font-size: 0.75rem !important;">
                            <option value="">Seleccione el motivo de baja </option>
                  <option value="Caducado">Caducado</option>
              <option value="Proximo a caducar">Proximo a caducar</option>
              
</select>

    </div> 
    </div>

    <div class="text-center">
        <div class="table-responsive">
            <table id="HistorialDevoluciones" class="table table-hover">
                <thead>
                  
                    <th>Código de Barra</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Motivo Devolución</th>
                    <th>Fecha</th>
                 
                </thead>
                <tbody>
                    <?php 
                    $query = $conn->query($sql1);
                    while ($Devolucion = $query->fetch_array()): ?>
                        <tr>
                            
                            <td> <input type="text" value="<?php echo $Devolucion["Cod_Barra"]; ?>"class="form-control"  id="CodBarra" name="CodBarra" readonly></td>
                            <td><input type="text" value="<?php echo $Devolucion["Nombre_Produc"]; ?>"class="form-control"  id="NombreProd" name="NombreProd" readonly></td>
                            <td><input type="text" value="<?php echo $Devolucion["Cantidad"]; ?>"class="form-control"  id="Cantidad" name="Cantidad" readonly></td>
                            <td><input type="date" class="form-control"  id="fechacaducidad" name="FechaCaducidad" ><input hidden value="<?php echo $Devolucion["Precio_Venta"]; ?>"class="form-control"  id="Precioventa" name="PrecioVenta" readonly></td>
                            <td> <input type="text" class="form-control"  id="lote" name="Lote"><input hidden value="<?php echo $Devolucion["Precio_C"]; ?> class="form-control"  id="Preciocompra" name="PrecioCompra" readonly></td>
                            
                      
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <button type="submit"  id="submit"  class="btn btn-success">Registrar caducado <i class="fas fa-check"></i></button>
        </div>
    </div>
    </form>

    <script src="js/RegistraComoCaducado.js"></script>
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
