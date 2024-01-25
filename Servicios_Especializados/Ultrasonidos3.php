<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/Conexion_selects.php";
$connee = mysqli_connect("localhost","somosgr1_SHWEB","yH.0a-v?T*1R","somosgr1_Sistema_Hospitalario");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>ULTRASONIDOS |<?echo $row['ID_Sucursal']?> </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
  <script src="https://kit.fontawesome.com/b5ed0deb1b.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.5.0.js" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
<script type="text/javascript">
$(document).ready( function () {
    $('#datatable').DataTable({
      "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        }
      } );
} );
</script>
</head>
<?php
include_once ("Menu.php");

?>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Subiendo resultados de ultrasonidos</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form enctype="multipart/form-data" id="fupForm" >
                <div class="card-body">
                <div class="form-group">
          <div class="position-relative form-group"><label for="exampleEmail11" class="">Nombre del paciente</label>
         <input name="Nombre" id="nombre_apellidos"  required type="text" class="form-control"></div>
            </div>
            <div class="form-group">
                 <div class="position-relative form-group"><label for="exampleEmail11" class="">Telefono</label>
                       <input name="Tel" id="telefono" type="Number" class="form-control"></div>
                      </div>
                      <div class="form-group">
                  <label for="exampleInputPassword1">Sucursal</label>
                  <select name="Sucursal" id="sucursal" class="form-control">
                                               <option value="0">Seleccione una sucursal:</option>
        <?
          $query = $mysqli -> query ("SELECT Nombre_ID_Sucursal FROM Sucursales WHERE Dueño_Propiedad='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[Nombre_ID_Sucursal].'">'.$valores[Nombre_ID_Sucursal].'</option>';
          }
        ?>  </select>
                  </div>
                    
                                               
                      
                   
                <!-- /.card-body -->
                <div class="card-footer">
                <button type="submit" onclick="Procesando()"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-primary">Guardar <i class="fas fa-save"></i></button>
                </div>
              </form>
            </div>
         
          

            </div>
            <!-- /.card -->
            <?php

//hago un listado para mostrar datos de la tabla
//ademas me sirve para verificar que la conexión con la base haya sido exitosa
//en caso que tenga datos la tabla los mostrara aqui.

$sqlSelect = "SELECT * FROM Resultados_Ultrasonidos";
$result = mysqli_query($connee, $sqlSelect);

if (mysqli_num_rows($result) > 0)
{
?>
       <table id="datatable" class="table">
        <thead>
            <tr>
         
                <th>Nombre </th>
         <th>Continuar</th>
            </tr>
        </thead>
<?php


// puedo agregar todos las columnas que necesite
  while ($row = mysqli_fetch_array($result)) {
?>                  
      
      <tr>
       
      
            <td><?php  echo $row['Nombre_paciente']; ?></td>
            <td><a class="btn btn-primary"  href="SubeUltras?Nombre_paciente=<?echo $row["Nombre_paciente"]; ?>"><span class="fa fa-arrow-right"></span><span class="hidden-xs"></span></a></td>
         
           

 
      </tr>

<?php
  }
?>
    
  </table>
<?php 
} 
?>

            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?include "footer.php" ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script type="text/javascript" src="js/Gultrasonidos.js"></script>
<!-- jQuery -->

<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>


</body>
</html>
