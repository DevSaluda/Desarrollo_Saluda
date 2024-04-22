<?php
include('dbconect.php');
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');

if (isset($_POST["import"]))
{
    
$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'subidas/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        $Sucursal= mysqli_real_escape_string($con, $_POST["Sucursalnueva"]);
        $Tipo_ajuste= mysqli_real_escape_string($con, $_POST["TipAjuste"]);
        $Agrego= mysqli_real_escape_string($con, $_POST["Agrega"]);
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
        for($i=0;$i<$sheetCount;$i++)
        {
            
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
          
                $Cod_Barra = "";
                if(isset($Row[0])) {
                    $Cod_Barra = mysqli_real_escape_string($con,$Row[0]);
                }
                
                $Nombre_prod = "";
                if(isset($Row[1])) {
                    $Nombre_prod = mysqli_real_escape_string($con,$Row[1]);
                }
				
                $Cantidad = "";
                if(isset($Row[2])) {
                    $Cantidad = mysqli_real_escape_string($con,$Row[2]);
                }
				
                
                if (!empty($Cod_Barra) || !empty($Nombre_prod) || !empty($Cantidad) || !empty($Sucursal)) {
                    $query = "INSERT INTO Inserciones_Excel_inventarios (Cod_Barra, Nombre_prod, Cantidad, Sucursal,Tipo_ajuste, Agrego) values('".$Cod_Barra."','".$Nombre_prod."','".$Cantidad."','".$Sucursal."','".$Tipo_ajuste."','".$Agrego."')";
                    $resultados = mysqli_query($con, $query);
                
                    if (! empty($resultados)) {
                        $type = "success";
                        $message = "Excel importado correctamente";
                    } else {
                        $type = "error";
                        $message = "Hubo un problema al importar registros";
                    }
                }
             }
        
         }
  }
  else
  { 
        $type = "error";
        $message = "El archivo enviado es invalido. Por favor vuelva a intentarlo";
  }
}

include "Consultas/Consultas.php";

$fcha = date("Y-m-d");


?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Area de inventarios </title>

<?php include "Header.php"?>
 <style>
        .error {
  color: red;
  margin-left: 5px; 
  
        }
        #frmExcelImport {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }

        input[type="file"] {
            margin-bottom: 10px;
        }

        button.btn-submit {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        select {
            padding: 8px;
            margin-right: 10px;
        }


    </style>

     <script>
     
     </script>


</head>
<?php include_once ("Menu.php")?>

<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">




</div>
<script type="text/javascript">
$(document).ready( function () {
    $('#SignosVitales').DataTable({
      
      "stateSave":true,
      "language": {
        "url": "Componentes/Spanish.json"
		}
		
	  } 
	  
	  );
} );
</script>
<!-- MOBILIARIO VIGENTE -->
<div class="tab-pane fade show active" id="MobiVigente" role="tabpanel" aria-labelledby="pills-profile-tab">
  <div class="card text-center">
    <div class="card-header" style="background-color:#2b73bb !important;color: white;">
      Actualizacion de inventarios
    </div>

    <div class="card-body">
    <form action="" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
    <div>
        <label for="file">Elija Archivo Excel</label>
        <input type="file" name="file" id="file" accept=".xls, .xlsx">
       
    </div>

    <label for="Sucursalnueva">Seleccione una Sucursal:</label>
    <select id="Sucursalnueva" class="form-control" name="Sucursalnueva">
        <option value="">Seleccione una Sucursal:</option>
        <?php
          $query = $conn->query("SELECT ID_SucursalC, Nombre_Sucursal, ID_H_O_D FROM SucursalesCorre WHERE  ID_H_O_D='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["ID_SucursalC"].'">'.$valores["Nombre_Sucursal"].'</option>';
          }
        ?>
    </select> <br>
    <select id="TipAjuste" class="form-control" name="TipAjuste">
        <option value="">Especifique el tipo de ajuste que se realizara</option>
        <option value="Inventario inicial">Inventario inicial</option>
        <option value="Ajuste de inventario">Ajuste de inventario</option>
    </select>
    <input type="text" hidden name="Agrega" value="<?php echo $row['Nombre_Apellidos']?>">

    <br>
    <button type="submit" id="submit" name="import" class="btn-submit">Importar Registros</button>
</form>
    </div>
    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
    
         
<?php
    $sqlSelect = "SELECT Inserciones_Excel_inventarios.Id_Insert, Inserciones_Excel_inventarios.Cod_Barra, Inserciones_Excel_inventarios.Nombre_prod, Inserciones_Excel_inventarios.Cantidad_Ajuste, Inserciones_Excel_inventarios.Sucursal, Inserciones_Excel_inventarios.Tipo_ajuste, Inserciones_Excel_inventarios.Agrego, Inserciones_Excel_inventarios.Fecha_registro,
    SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM Inserciones_Excel_inventarios, SucursalesCorre WHERE Inserciones_Excel_inventarios.Sucursal = SucursalesCorre.ID_SucursalC";
    $result = mysqli_query($con, $sqlSelect);

if (mysqli_num_rows($result) > 0)
{
?>
        
        <table id="SignosVitales" class="table ">
        <thead>
            <tr>
                <th>Cod_Barra</th>
                <th>Nombre_prod</th>
                <th>Cantidad</th>
                <th>Sucursal</th>
                <th>Tipo de ajuste</th>
                <th>Agrego</th>
            </tr>
        </thead>
<?php
    while ($row = mysqli_fetch_array($result)) {
?>                  
        <tbody>
        <tr>
            <td><?php  echo $row['Cod_Barra']; ?></td>
            <td><?php  echo $row['Nombre_prod']; ?></td>
            <td><?php  echo $row['Cantidad']; ?></td>
            <td><?php  echo $row['Nombre_Sucursal']; ?></td>
            <td><?php  echo $row['Tipo_ajuste']; ?></td>
            <td><?php  echo $row['Agrego']; ?></td>
        </tr>
<?php
    }
?>
        </tbody>
    </table>
<?php 
} 
?>
      <!-- Fin Contenido --> 
    </div>
  </div>
    </div>
  </div>
</div>
</div></div>
      

     
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?php
    
  include ("Modales/AltaMobiliario.php");
  include ("Modales/Error.php");
  include ("Modales/Exito.php");
  include ("Modales/ExitoActualiza.php");
  include ("Modales/AltaNuevoTipoMobi.php");
  
  include ("footer.php")?>

<!-- ./wrapper -->


<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->

</body>
</html>
<?php

function fechaCastellano ($fecha) {
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