<?php
include 'Consultas/Consultas.php';
include 'Consultas/ManejoEncargos.php';

// Parámetros de paginación
$itemsPorPagina = 10;
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($paginaActual - 1) * $itemsPorPagina;

// Parámetro de búsqueda
$terminoBusqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
?>
<?php
include 'Consultas/Consultas.php';?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Solicitar Encargos | <?php echo $row['Nombre_Sucursal']?> </title>
    <?php include "Header.php"?>
    <style>
        .error {
            color: red;
            margin-left: 5px; 
        }  
        .hidden-field {
            display: none;
        }
        .highlight {
            font-size: 1.2em;
            font-weight: bold;
        }
        .alert {
            margin-top: 10px;
        }
        .table-responsive {
            margin-top: 20px;
        }
        .pagination {
            justify-content: center;
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<?php include_once("Menu.php")?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <h2>Encargos Pendientes</h2>
            
            <!-- Formulario de búsqueda -->
            <form method="get" action="Encargos.php" class="form-inline mb-3">
                <div class="form-group mr-2">
                    <input type="text" name="busqueda" class="form-control" placeholder="Buscar encargos" value="<?php echo htmlspecialchars($terminoBusqueda); ?>">
                </div>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
            
            <!-- Tabla de resultados -->
            <div class="table-responsive">
                <table class="table table-bordered" id="encargosTable">
                <thead>
    <tr>
        <th>Identificador</th>
        <th>Sucursal</th>
        <th>Monto Abonado</th>
        <th>Estado</th>
        <th>Teléfono Cliente</th> <!-- Nueva columna -->
        <th>Número Cliente</th> <!-- Nueva columna -->
        <th>Acciones</th>
    </tr>
</thead>
<tbody>
    <?php
    $result = obtenerEncargos($conn, $terminoBusqueda, $offset, $itemsPorPagina);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['IdentificadorEncargo']}</td>";
        echo "<td>{$row['Fk_sucursal']}</td>";
        echo "<td>{$row['MontoAbonadoTotal']}</td>";
        echo "<td>{$row['Estado']}</td>";
        echo "<td>{$row['TelefonoCliente']}</td>"; // Mostrar TelefonoCliente
        echo "<td>{$row['NumeroCliente']}</td>"; // Mostrar NumeroCliente
        echo "<td>
                <a href='DetallesEncargo.php?identificador={$row['IdentificadorEncargo']}' class='btn btn-info'>Ver Detalles</a>
              </td>";
        echo "</tr>";
    }
    ?>
</tbody>
                </table>
            </div>

            <!-- Paginación -->
            <?php
            $totalEncargos = contarEncargos($conn, $terminoBusqueda);
            $totalPaginas = ceil($totalEncargos / $itemsPorPagina);
            ?>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                        <li class="page-item <?php if ($paginaActual == $i) echo 'active'; ?>">
                            <a class="page-link" href="Encargos.php?pagina=<?php echo $i; ?>&busqueda=<?php echo urlencode($terminoBusqueda); ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>

        </div>
    </section>
</div>

<?php include("footer.php");?>
</body>
</html>
