<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";



$fcha = date("Y-m-d");
$user_id=null;
$sql1 = "SELECT
sb.Id_Baja,
sb.ID_Prod_POS,
sb.Cod_Barra,
sb.Nombre_Prod,
sb.Fk_sucursal,
sb.Cantidad,
sb.Lote,
sb.Fecha_Caducidad,
sb.MotivoBaja,
sb.AgregadoPor,
sb.AgregadoEl,
sb.Estado,
(sb.Precio_C * sb.Cantidad) AS Total_Compra,
(sb.Precio_Venta * sb.Cantidad) AS Total_Venta
FROM
Stock_Bajas sb
WHERE 
   sb.Id_Baja = '".$_POST["id"]."' ";

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
    
               
                <input type="text" class="form-control" hidden name="IdBasedatos"  readonly value="<?php echo $Devoluciones->Id_Baja; ?>">
                <input type="text" class="form-control" hidden value="<?php echo $row['Nombre_Apellidos']?>" readonly name="AgregoElVendedor">
             
                <input type="text" class="form-control" hidden name="ID_H_O_D"  readonly value="Saluda">
         
      
        

      

        

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
                    <?php 
                    $query = $conn->query($sql1);
                    while ($Devolucion = $query->fetch_array()): ?>
                        <tr>
                            
                            <td> <input type="text" value="<?php echo $Devolucion["Cod_Barra"]; ?>"class="form-control"  id="CodBarra" name="CodBarra" readonly></td>
                            <td><input type="text" value="<?php echo $Devolucion["Nombre_Prod"]; ?>"class="form-control"  id="NombreProd" name="NombreProd" readonly></td>
                           
                            <td><input type="text" value="<?php echo $Devolucion["Cantidad"]; ?>"class="form-control"  id="Cantidad" name="Cantidad" readonly></td>
                            <td><input type="number" class="form-control"  id="Cantidadaregistrar" name="CantidadAregistrar"></td>
                            
                      
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table> 
            <button type="submit"  id="submit"  class="btn btn-success">Registrar caducado <i class="fas fa-check"></i></button>
        </div>
    </div>
    </form>

    <script src="js/ActualizaLosDatosComoCaducados.js"></script>
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
