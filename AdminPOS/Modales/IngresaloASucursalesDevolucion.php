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
  Devolucion_POS.ID_Registro = '".$_POST["id"]."'
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
if($query->num_rows>0){
    while ($r=$query->fetch_object()){
        $Devoluciones = $r;
        break;
    }
}

?>

<?php if($Devoluciones != null): ?>
    <form action="javascript:void(0)" method="post" id="ActualizaEstadoDevolucion">
    <div class="container">
        <div class="row">
            <!-- Columna 1 -->
            <div class="col-md-4">
                <label for="exampleFormControlInput1">Nombre del producto</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Factura"><i class="fas fa-info-circle"></i></span>
                    </div>
                    <input type="text" class="form-control" readonly value="<?php echo $Devoluciones->Nombre_Produc; ?>">
                </div>
            </div>

            <div class="col-md-4">
                <label for="exampleFormControlInput1">Factura</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Factura"><i class="fas fa-info-circle"></i></span>
                    </div>
                    <input type="text" class="form-control" name="FacturaNumber" readonly value="<?php echo $Devoluciones->Num_Factura; ?>">
                </div>
            </div>

            <div class="col-md-4">
                <label for="exampleFormControlInput1">Proveedor</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Factura"><i class="fas fa-info-circle"></i></span>
                    </div>
                    <input type="text" class="form-control" readonly value="<?php echo $Devoluciones->Proveedor; ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Columna 2 -->
            <div class="col-md-4">
                <label for="exampleFormControlInput1">Cantidad</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Factura"><i class="fas fa-info-circle"></i></span>
                    </div>
                    <input type="text" class="form-control" readonly value="<?php echo $Devoluciones->Cantidad; ?>">
                </div>
            </div>
            <div class="col-md-4">
                <label for="exampleFormControlInput1">Cantidad a ingresar </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Factura"><i class="fas fa-info-circle"></i></span>
                    </div>
                    <input type="number"  name="Contabilizado" class="form-control" >
                </div>
            </div>
            <div class="col-md-4">
            <label for="exampleFormControlInput1">Sucursal destino</label>
            <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-barcode"></i></span>
            <select id = "sucursalconordenDestinos" name="Fk_sucursal" class = "form-control" required  >
  <option value="">Seleccione una Sucursal:</option>
                                               <?php
          $query = $conn -> query ("SELECT ID_SucursalC,Nombre_Sucursal,ID_H_O_D FROM SucursalesCorre WHERE ID_H_O_D='".$row['ID_H_O_D']."'");
        
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["ID_SucursalC"].'">'.$valores["Nombre_Sucursal"].'</option>';
          }
                        ?>
        </select>   
            </div> </div> </div>
            <!-- Campos ocultos (ocupando todo el ancho) -->
            <input type="hidden" class="form-control" name="IdBasedatos" readonly value="<?php echo $Devoluciones->ID_Prod_POS; ?>">
            <input type="hidden" class="form-control" name="CodBarras" readonly value="<?php echo $Devoluciones->Cod_Barra; ?>">
            <input type="hidden" class="form-control" name="AgregoElVendedor" readonly value="<?php echo $row['Nombre_Apellidos']?>">
            <input type="hidden" class="form-control" name="TipodeServicio" readonly value="<?php echo $Devoluciones->Tipo_Servicio; ?>">
            <input type="hidden" class="form-control" name="ID_H_O_D" readonly value="Saluda">
            <input type="hidden" class="form-control" name="Movimiento" readonly value="Ingresado desde devoluciones">
            <input type="hidden" class="form-control" name="IdDevuelve" readonly value="<?php echo $Devoluciones->ID_Registro; ?>">

            
        </div>

        <!-- Botón de envío -->
        <div class="row">
            <div class="col-md-12 text-center">
                <button type="submit" id="submit" class="btn btn-success">Realizar ingreso <i class="fas fa-check"></i></button>
            </div>
        </div>
    </div>
</form>


    <script src="js/RealizaIngresoDevolucion.js"></script>
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
