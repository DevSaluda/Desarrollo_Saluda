<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

// Verifica si se han enviado datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si las variables están seteadas y no son nulas
    if (isset($_POST['Mes'])) {
        // Obtén los valores del formulario
        $mes = $_POST['Mes'];
       
        // Concatena los valores en la consulta SQL
        $sql = "SELECT 
        vp.Cod_Barra,
        vp.Nombre_Prod,
        SUM(vp.Cantidad_Venta) AS Total_Cantidad_Vendida,
        sp.Proveedor1,
        sp.Proveedor2,
        sp.Nombre_Prod AS Nombre_Prod_Stock,
        sp.FkPresentacion,
        sp.Precio_Venta,
        sp.Precio_C,
        sc.Nombre_Sucursal
    FROM 
        Ventas_POS vp
    INNER JOIN 
        Stock_POS sp ON vp.Cod_Barra = sp.Cod_Barra AND vp.Fk_sucursal = sp.Fk_sucursal
    INNER JOIN 
        Servicios_POS sv ON vp.Identificador_tipo = sv.Servicio_ID
    INNER JOIN
        SucursalesCorre sc ON vp.Fk_sucursal = sc.ID_SucursalC
    WHERE 
        vp.Fecha_venta = CURRENT_DATE
        AND vp.Fk_sucursal = $mes
        AND sv.Servicio_ID = '00000000024'
    GROUP BY 
        vp.Cod_Barra, 
        vp.Nombre_Prod, 
        sp.Proveedor1, 
        sp.Proveedor2, 
        sp.Nombre_Prod, 
        sp.FkPresentacion, 
        sp.Precio_Venta, 
        sp.Precio_C, 
        sc.Nombre_Sucursal
    ORDER BY 
        vp.Cod_Barra";

        $result = mysqli_query($conn, $sql);

        $c=0;

        while($fila=$result->fetch_assoc()){

            $data[$c]["Cod_Barra"] = $fila["Cod_Barra"];
            $data[$c]["Nombre_Prod"] = $fila["Nombre_Prod"];
            $data[$c]["Sucursal"] = $fila["Nombre_Sucursal"];
            $data[$c]["Turno"] = $fila["Total_Cantidad_Vendida"];
            $data[$c]["Cantidad_Venta"] = $fila["Cantidad_Venta"];
            $data[$c]["Importe"] = $fila["Proveedor1"];
            $data[$c]["Total_Venta"] = $fila["Proveedor2"];
            $data[$c]["Descuento"] = $fila["FkPresentacion"];
          
            $c++; 

        }

        $results = [
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data 
        ];

        echo json_encode($results);
    } else {
        // Si alguna de las variables no está seteada o es nula, muestra un mensaje de error
        echo json_encode(["error" => "No se recibieron todas las variables necesarias."]);
    }
}
?>
