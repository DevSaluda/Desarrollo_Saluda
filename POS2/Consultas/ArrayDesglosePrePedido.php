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
        vp.Fk_sucursal
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
        vp.Fk_sucursal
    ORDER BY 
        vp.Cod_Barra";

        $result = mysqli_query($conn, $sql);

        $data = []; // Inicializa $data como un array vacío
        $c = 0;

        while($fila = $result->fetch_assoc()) {
            $data[$c]["Cod_Barra"] = '<input type="text" class="form-control" name="CodBarra[]" value="' . $fila["Cod_Barra"] . '" readonly>';
            $data[$c]["Nombre_Prod"] = '<input type="text" class="form-control" name="NombreProd[]" value="' . $fila["Nombre_Prod"] . '" readonly>';
            $data[$c]["Fk_sucursal"] = '<input type="text" class="form-control" name="Sucursal[]" value="' . $fila["Fk_sucursal"] . '"  readonly>';
            $data[$c]["Turno"] = '<input type="text" class="form-control"name="Cantidadd[]" value="' . $fila["Total_Cantidad_Vendida"] . '" readonly>';
            $data[$c]["Importe"] = '<input type="text" class="form-control" name="Prov1[]" value="' . $fila["Proveedor1"] . '" readonly>';
            $data[$c]["Total_Venta"] = '<input type="text" class="form-control" name="Prov2[] "value="' . $fila["Proveedor2"] . '" readonly>';
            $data[$c]["Descuento"] = '<input type="text" class="form-control" name="Presentacion[] value="' . $fila["FkPresentacion"] . '" readonly>
            <input type="text" class="form-control" name="Presentacion[] value="' . $fila["FkPresentacion"] . '" readonly>';
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
