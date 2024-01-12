<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
$Nombre= $_GET["Nombre_paciente"]
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
              <form method="POST" action="SubeFotos.php" enctype="multipart/form-data">
                <div class="card-body">
                <div class="form-group">
          <div class="position-relative form-group"><label for="exampleEmail11" class="">Nombre paciente</label>
         <input name="Nombre" id="nombre_apellidos"  type="text" readonly value="<?echo $Nombre?>" class="form-control"></div>
            </div>
           
                      <div class="form-group">
                 <div class="position-relative form-group"><label for="exampleEmail11" class="">Seleccione archivos</label>
                 <input type="file" class="form-control" name="upload[]" multiple>
                      </div>
                    
                                               
                      
                   
                <!-- /.card-body -->
                <div class="card-footer">
                <input type="submit" value="Subir">  
              </form>
            </div>
         
            </div>
            <!-- /.card -->
          

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
  <!-- /.content-wrapper -->
  <?include "footer.php" ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script type="text/javascript" src="js/SubeFotosUltra.js"></script>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
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
