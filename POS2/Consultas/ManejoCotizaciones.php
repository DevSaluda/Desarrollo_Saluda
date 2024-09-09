<?php
include 'Consultas.php';
require('/Pdf/fpdf.php');

function buscarProducto($conn, $Cod_Barra) {
    $query = "SELECT ID_Prod_POS, Cod_Barra, Nombre_Prod, Precio_Venta, Precio_C, FkPresentacion, Proveedor1, Proveedor2 
              FROM Productos_POS 
              WHERE Cod_Barra='$Cod_Barra'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        return [mysqli_fetch_assoc($result)]; // Devuelve un array con un solo producto
    } else {
        $query = "SELECT ID_Prod_POS, Cod_Barra, Nombre_Prod, Precio_Venta, Precio_C, FkPresentacion, Proveedor1, Proveedor2 
                  FROM Productos_POS 
                  WHERE Nombre_Prod LIKE '%$Cod_Barra%'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return []; // Devuelve un array vacío si no se encuentran productos
        }
    }
}

function generarPDFCotizacion($cotizacion, $IdentificadorCotizacion, $nombreCliente) {
    // Crear un nuevo PDF usando FPDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Cotizacion ' . $IdentificadorCotizacion);
    $pdf->Ln(10);
    $pdf->Cell(40, 10, 'Cliente: ' . $nombreCliente);
    $pdf->Ln(20);

    // Encabezado de tabla
    $pdf->Cell(40, 10, 'Producto');
    $pdf->Cell(40, 10, 'Cantidad');
    $pdf->Cell(40, 10, 'Precio');
    $pdf->Cell(40, 10, 'Total');
    $pdf->Ln();

    // Detalle de productos
    foreach ($cotizacion as $producto) {
        $pdf->Cell(40, 10, $producto['Nombre_Prod']);
        $pdf->Cell(40, 10, $producto['Cantidad']);
        $pdf->Cell(40, 10, $producto['Precio_Venta']);
        $pdf->Cell(40, 10, $producto['Total']);
        $pdf->Ln();
    }

    // Guardar PDF en el servidor
    $nombreArchivo = 'Cotizacion_' . $IdentificadorCotizacion . '.pdf';
    $rutaArchivo = 'pdf_cotizaciones/' . $nombreArchivo; // Carpeta donde se almacenarán los PDFs
    $pdf->Output('F', $rutaArchivo);

    return $rutaArchivo;
}

function guardarCotizacion($conn, $cotizacion, $IdentificadorCotizacion, $fkSucursal, $agregadoPor, $idHOD, $estado, $tipoCotizacion, $fkCaja, $nombreCliente, $telefonoCliente, $archivoPDF) {
    $response = [];

    foreach ($cotizacion as $producto) {
        $Cod_Barra = $producto['Cod_Barra'];
        $Nombre_Prod = $producto['Nombre_Prod'];
        $Precio_Venta = $producto['Precio_Venta'];
        $Cantidad = isset($producto['Cantidad']) ? $producto['Cantidad'] : NULL;
        $Total = $producto['Total'];
        $FkPresentacion = $producto['FkPresentacion'] ?? '';
        $Proveedor1 = $producto['Proveedor1'] ?? '';
        $Proveedor2 = $producto['Proveedor2'] ?? '';

        // Verificar si el producto es un procedimiento (código de barras de 4 dígitos o formato USG-####)
        if (preg_match('/^\d{4}$/', $Cod_Barra) || preg_match('/^USG-\d{4}$/', $Cod_Barra)) {
            $Cantidad = 0; // No asignar cantidad a procedimientos
        }

        $query = "INSERT INTO Cotizaciones_POS (IdentificadorCotizacion, Cod_Barra, Nombre_Prod, Fk_sucursal, Precio_Venta, Cantidad, Total, FkPresentacion, Proveedor1, Proveedor2, AgregadoPor, ID_H_O_D, Estado, TipoCotizacion, ID_Caja, NombreCliente, TelefonoCliente, ArchivoPDF)
                  VALUES ('$IdentificadorCotizacion', '$Cod_Barra', '$Nombre_Prod', '$fkSucursal', '$Precio_Venta', '$Cantidad', '$Total', '$FkPresentacion', '$Proveedor1', '$Proveedor2', '$agregadoPor', '$idHOD', '$estado', '$tipoCotizacion', '$fkCaja', '$nombreCliente', '$telefonoCliente', '$archivoPDF')";

        if (!mysqli_query($conn, $query)) {
            $response['error'] = "Error al guardar la cotización: " . mysqli_error($conn);
            return $response;
        }
    }

    $response['success'] = "Cotización guardada exitosamente.";
    return $response;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['buscar_producto'])) {
        $Cod_Barra = $_POST['Cod_Barra'];
        $producto = buscarProducto($conn, $Cod_Barra);
        echo json_encode(['productos' => $producto]);
    }

    if (isset($_POST['guardar_cotizacion'])) {
        $cotizacionData = $_POST['productos'];

        // Verificar si 'cotizacion' es un array y convertirlo a JSON si es necesario
        if (is_array($cotizacionData)) {
            $cotizacionData = json_encode($cotizacionData);
        }

        $cotizacion = json_decode($cotizacionData, true);
        if (empty($cotizacion)) {
            echo json_encode(['error' => 'No hay productos en la cotización.']);
            exit;
        }
    
        $IdentificadorCotizacion = $_POST['IdentificadorCotizacion'];
        $fkSucursal = $_POST['FkSucursal'];
        $agregadoPor = $_POST['AgregadoPor'];
        $idHOD = $_POST['ID_H_O_D'];
        $estado = $_POST['Estado'];
        $tipoCotizacion = $_POST['TipoCotizacion'];
        $fkCaja = $_POST['ID_Caja']; // Captura ID_Caja
        $nombreCliente = $_POST['NombreCliente']; // Captura el nombre del cliente
        $telefonoCliente = $_POST['TelefonoCliente']; // Captura el teléfono del cliente
    
        // Generar el PDF de la cotización
        $archivoPDF = generarPDFCotizacion($cotizacion, $IdentificadorCotizacion, $nombreCliente);

        // Guardar la cotización en la base de datos junto con la ruta del PDF
        $response = guardarCotizacion($conn, $cotizacion, $IdentificadorCotizacion, $fkSucursal, $agregadoPor, $idHOD, $estado, $tipoCotizacion, $fkCaja, $nombreCliente, $telefonoCliente, $archivoPDF);
        echo json_encode($response);
    }
}
?>
