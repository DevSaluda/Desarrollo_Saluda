<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";


    // Verifica si las variables están seteadas y no son nulas
   
        // Obtén los valores del formulario de manera segura
        $mes = $_POST['Mes'];
        $anual = $_POST['anual'];

        // Prepara la consulta SQL con sentencias preparadas
        $sql = "SELECT DISTINCT
                Ventas_POS.Venta_POS_ID,
                Ventas_POS.Folio_Ticket,
                Ventas_POS.FolioSucursal,
                Ventas_POS.Fk_Caja,
                Ventas_POS.Identificador_tipo,
                Ventas_POS.Fecha_venta, 
                Ventas_POS.Total_Venta,
                Ventas_POS.Importe,
                Ventas_POS.Total_VentaG,
                Ventas_POS.FormaDePago,
                Ventas_POS.Turno,
                Ventas_POS.FolioSignoVital,
                Ventas_POS.Cliente,
                Cajas_POS.ID_Caja,
                Cajas_POS.Sucursal,
                Cajas_POS.MedicoEnturno,
                Cajas_POS.EnfermeroEnturno,
                Ventas_POS.Cod_Barra,
                Ventas_POS.Clave_adicional,
                Ventas_POS.Nombre_Prod,
                Ventas_POS.Cantidad_Venta,
                Ventas_POS.Fk_sucursal,
                Ventas_POS.AgregadoPor,
                Ventas_POS.AgregadoEl,
                Ventas_POS.Lote,
                Ventas_POS.ID_H_O_D,
                SucursalesCorre.ID_SucursalC, 
                SucursalesCorre.Nombre_Sucursal,
                Servicios_POS.Servicio_ID,
                Servicios_POS.Nom_Serv,
                Ventas_POS.DescuentoAplicado -- Agregamos la columna DescuentoAplicado
                FROM 
                Ventas_POS
                INNER JOIN 
                SucursalesCorre ON Ventas_POS.Fk_sucursal = SucursalesCorre.ID_SucursalC 
                INNER JOIN 
                Servicios_POS ON Ventas_POS.Identificador_tipo = Servicios_POS.Servicio_ID 
                INNER JOIN 
                Cajas_POS ON Cajas_POS.ID_Caja = Ventas_POS.Fk_Caja
                INNER JOIN 
                Stock_POS ON Stock_POS.ID_Prod_POS = Ventas_POS.ID_Prod_POS
                WHERE 
                YEAR(Ventas_POS.Fecha_venta) = ? AND MONTH(Ventas_POS.Fecha_venta) = ?";

        // Prepara la sentencia
        $stmt = mysqli_prepare($conn, $sql);

        // Asocia los parámetros
        mysqli_stmt_bind_param($stmt, "ii", $anual, $mes);

        // Ejecuta la consulta
        mysqli_stmt_execute($stmt);

        // Obtiene el resultado
        $result = mysqli_stmt_get_result($stmt);

        // Procesa los resultados
        $data = [];
        while($fila = mysqli_fetch_assoc($result)){
            $data[] = [
                "Cod_Barra" => $fila["Cod_Barra"],
                "Nombre_Prod" => $fila["Nombre_Prod"],
                "FolioTicket" => $fila["FolioSucursal"] . '' . $fila["Folio_Ticket"],
                "Sucursal" => $fila["Nombre_Sucursal"],
                "Turno" => $fila["Turno"],
                "Cantidad_Venta" => $fila["Cantidad_Venta"],
                "Importe" => $fila["Importe"],
                "Total_Venta" => $fila["Total_Venta"],
                "Descuento" => $fila["DescuentoAplicado"],
                "FormaPago" => $fila["FormaDePago"],
                "Cliente" => $fila["Cliente"],
                "FolioSignoVital" => $fila["FolioSignoVital"],
                "NomServ" => $fila["Nom_Serv"],
                "AgregadoEl" => date("d/m/Y", strtotime($fila["Fecha_venta"])),
                "AgregadoEnMomento" => $fila["AgregadoEl"],
                "AgregadoPor" => $fila["AgregadoPor"],
                "Enfermero" => $fila["EnfermeroEnturno"],
                "Doctor" => $fila["MedicoEnturno"]
            ];
        }

        // Crea el arreglo de resultados
        $results = [
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data 
        ];

        // Codifica y envía los resultados como JSON
        echo json_encode($results);
    } else {
        // Si alguna de las variables no está seteada o es nula, muestra un mensaje de error
        echo json_encode(["error" => "No se recibieron todas las variables necesarias."]);
    

?>
