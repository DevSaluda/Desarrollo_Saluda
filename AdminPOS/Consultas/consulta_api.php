<?php
include("db_connection_Huellas.php");

// Definir las columnas que se pueden ordenar
$sortable_columns = array(
    'Id_asis',
    'Nombre_Completo',
    'Cargo_rol',
    'Domicilio',
    'FechaAsis',
    'HoIngreso',
    'HoSalida',
    'EstadoAsis',
    'totalhora_tr'
);

// Configurar la consulta base
$sql = "SELECT
            p.Id_pernl AS Id_Pernl,
            p.Cedula AS Cedula,
            p.Nombre_Completo AS Nombre_Completo,
            p.Sexo AS Sexo,
            p.Cargo_rol AS Cargo_rol,
            p.Domicilio AS Domicilio,
            a.Id_asis AS Id_asis,
            a.FechaAsis AS FechaAsis,
            a.Nombre_dia AS Nombre_dia,
            a.HoIngreso AS HoIngreso,
            a.HoSalida AS HoSalida,
            a.Tardanzas AS Tardanzas,
            a.Justifacion AS Justifacion,
            a.tipoturno AS tipoturno,
            a.EstadoAsis AS EstadoAsis,
            a.totalhora_tr AS totalhora_tr
        FROM
            u155356178_SaludaHuellas.personal p
        JOIN u155356178_SaludaHuellas.asistenciaper a
            ON a.Id_Pernl = p.Id_pernl";

// Filtrar por fecha
$sql .= " WHERE DATE(a.FechaAsis) = CURDATE()";

// Obtener el número total de registros (sin paginación)
$total_records = $conn->query($sql)->num_rows;

// Obtener los parámetros de DataTables
$draw = $_POST['draw'];
$start = $_POST['start'];
$length = $_POST['length'];
$search = $_POST['search']['value'];
$order_column = $_POST['order'][0]['column'];
$order_dir = $_POST['order'][0]['dir'];

// Construir la consulta para ordenar y paginar los datos
$order_by = isset($sortable_columns[$order_column]) ? $sortable_columns[$order_column] : null;
$order_dir = ($order_dir == 'desc') ? 'DESC' : 'ASC';
$sql .= " ORDER BY $order_by $order_dir";
$sql .= " LIMIT $start, $length";

// Ejecutar la consulta
$result = $conn->query($sql);

// Construir el array de datos para DataTables
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Preparar la respuesta JSON
$response = array(
    "draw" => intval($draw),
    "recordsTotal" => $total_records,
    "recordsFiltered" => $total_records,
    "data" => $data
);

// Devolver la respuesta JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
