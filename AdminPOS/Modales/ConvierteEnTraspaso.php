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
     SucursalesCorre.ID_SucursalC,
      Stock_POS.Cod_Barra ,
    Stock_POS.Fk_sucursal ,
      Stock_POS.Precio_Venta,
    Stock_POS.Precio_C,
    Stock_POS.ID_Prod_POS,
    Stock_POS.Tipo_Servicio
  FROM Devolucion_POS, SucursalesCorre, Stock_POS
WHERE 
Devolucion_POS.Fk_Suc_Salida= SucursalesCorre.ID_SucursalC AND 
Devolucion_POS.Cod_Barra = Stock_POS.Cod_Barra
AND
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
    <form action="javascript:void(0)" method="post" id="BajaEmpleados" >
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
        <label for="exampleFormControlInput1">Sucursal destino</label>
        <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-barcode"></i></span>
  <select id = "sucursalconordenDestino" name="SucursalConOrdenDestino" class = "form-control" required  >
  <option value="">Seleccione una Sucursal:</option>
                                               <?php
          $query = $conn -> query ("SELECT ID_SucursalC,Nombre_Sucursal,ID_H_O_D FROM SucursalesCorre WHERE ID_H_O_D='".$row['ID_H_O_D']."'");
        
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["ID_SucursalC"].'">'.$valores["Nombre_Sucursal"].'</option>';
          }
                        ?>
        </select>   
  </div> 
        </div>

        <div class="col">
            <label for="exampleFormControlInput1">Numero de orden</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="Agrego"> <i class="fas fa-info-circle"></i></span>
                </div>
               
                <input type="number" value="<?php echo  $totalmonto_con_ceros?>"  class="form-control"  id="NumOrden" name="NumeroDeFacturaTraspaso" readonly>
                <input type="text" id="selectedSucursal" name="selectedSucursal" class="form-control" readonly>

<script>
  document.getElementById('sucursalconordenDestino').addEventListener('change', function() {
    // Obtiene el texto de la opción seleccionada
    var selectedText = this.options[this.selectedIndex].text;
    // Actualiza el valor del input con el texto seleccionado
    document.getElementById('selectedSucursal').value = selectedText;
  });
</script>
            </div>
        </div>

        <div class="col">
            <label for="exampleFormControlInput1">Motivo de traspaso</label>
            <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-barcode"></i></span>
    <select id = "nombreproveedor" name="NombreProveedor" class = "form-control" required  >
    <option value="">Seleccione un opcion:</option>
    <option value="Devolucion a cedis">Devolucion a cedis</option>
    <!-- <option value="Traspaso entre sucursales">Traspaso entre sucursales</option>    -->
    <option value="Retiro por sobre stock">Retiro por sobre stock</option>  
    <option value="Prontos a caducar">Prontos a caducar</option>    
    <option value="Producto dañado">Producto dañado</option>    

         
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
                            <td><?php echo $Devolucion["Motivo_Devolucion"]; ?><input type="text" value="<?php echo $Devolucion["Precio_Venta"]; ?>"class="form-control"  id="Precioventa" name="PrecioVenta" readonly></td>
                            <td><?php echo fechaCastellano($Devolucion["Fecha"]); ?><input type="text" value="<?php echo $Devolucion["Precio_C"]; ?>"class="form-control"  id="Preciocompra" name="PrecioCompra" readonly></td>
                            
                      
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <button type="submit"  id="submit"  class="btn btn-success">Realizar traspaso <i class="fas fa-check"></i></button>
        </div>
    </div>
    </form>

    <script src="js/RealizaTraspasoDesdeDevolucion.js"></script>
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
