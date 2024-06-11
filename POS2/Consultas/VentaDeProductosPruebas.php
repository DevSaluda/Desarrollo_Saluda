<?php
if (isset($_GET['term']) && isset($_GET['sucursal'])) {
    // Conectarse a la base de datos
    include ("db_connection.php");
    include "Consultas.php";
  
    $return_arr = array();
    $term = mysqli_real_escape_string($conn, $_GET['term']);
    $sucursal = $row['Fk_Sucursal'];
echo  $row['Fk_Sucursal'];
    // Consulta SQL para buscar por Cod_Barra o Nombre_Prod y filtrar por sucursal
    $sql = "SELECT * FROM Stock_POS 
            WHERE (Cod_Barra LIKE '%$term%' OR Nombre_Prod LIKE '%$term%') 
            AND Fk_sucursal = '$sucursal' 
            LIMIT 5";
    
    if ($conn) {
        $fetch = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($fetch)) {
            $ID_Prod_POS = $row['ID_Prod_POS'];
            $Cod_Barra = $row['Cod_Barra'];
            $Nombre_Prod = $row['Nombre_Prod'];
            $Precio_Venta = $row['Precio_Venta'];
            $Lote = $row['Lote'];
            $Clave_adicional = $row['Clave_adicional'];
            $Tipo_Servicio = $row['Tipo_Servicio'];
            
            // AQUI VAN LOS ID DE LOS INPUTS
            $row_array['value'] = $row['Cod_Barra']." | ".$row['Nombre_Prod']." | $".$row['Precio_Venta'];
            $row_array['pro_FKID'] = $row['ID_Prod_POS'];
            $row_array['pro_clavad'] = $row['Clave_adicional'];
            $row_array['pro_nombre'] = $row['Cod_Barra'];
            $row_array['NombreProd'] = $row['Nombre_Prod'];
            $row_array['pro_cantidad'] = $row['Precio_Venta'];
            $row_array['montoreal'] = $row['Precio_Venta'];
            $row_array['pro_lote'] = $row['Lote'];
            $row_array['IdentificadorTip'] = $row['Tipo_Servicio'];

            array_push($return_arr, $row_array);
        }
    }

    // Cierra la conexión.
    mysqli_close($conn);

    // Codifica el resultado del array en JSON.
    echo json_encode($return_arr);
}
?>
