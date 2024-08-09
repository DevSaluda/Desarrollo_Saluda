<?php
include 'Consultas/Consultas.php';
include 'Consultas/ManejoEncargosPendientes.php';

$search = '';
$page = 1;
$perPage = 10; // Número de resultados por página

if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
}

// Calcular el offset para la consulta SQL
$offset = ($page - 1) * $perPage;

$result = obtenerEncargos($conn, $search, $offset, $perPage);
$totalEncargos = contarEncargos($conn, $search);
$totalPages = ceil($totalEncargos / $perPage);
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        .content-wrapper {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }
        .search-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .search-form input {
            flex: 1;
            min-width: 200px;
        }
        .table-responsive {
            flex: 1;
            margin-top: 20px;
            overflow-y: auto;
        }
        .pagination {
            justify-content: center;
            margin-top: 20px;
        }
        @media (max-width: 768px) {
            .btn {
                width: 100%;
                margin-top: 10px;
            }
            .search-form {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
<?php include_once("Menu.php")?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <h2>Encargos Pendientes</h2>

            <!-- Formulario de búsqueda -->
            <form method="GET" action="Encargos.php" class="search-form">
                <input type="text" name="search" class="form-control" placeholder="Buscar por identificador, sucursal o estado" value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>

            <!-- Tabla de resultados -->
            <div class="table-responsive">
                <table class="table table-bordered mt-3">
                    <thead class="thead-dark">
                        <tr>
                            <th>Identificador</th>
                            <th>Sucursal</th>
                            <th>Monto Abonado</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$row['IdentificadorEncargo']}</td>";
                            echo "<td>{$row['Fk_sucursal']}</td>";
                            echo "<td>{$row['MontoAbonadoTotal']}</td>";
                            echo "<td>{$row['Estado']}</td>";
                            echo "<td>
                                    <a href='DetallesEncargo.php?identificador={$row['IdentificadorEncargo']}' class='btn btn-info btn-sm'>Ver Detalles</a>
                                  </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <nav aria-label="Paginación de resultados">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"><?php echo $i; ?></a>
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
