<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/Conexion_selects.php";
include "Consultas/ConeSelectDinamico.php";
$materia = $_POST['NombreLaboratorio'];
$materia2 = $_POST['CodLaboratorio'];


?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Agendamiento de citas de revaloracion </title>

  <? include "Header.php"?>
  <link href='js/fullcalendar/fullcalendar.css' rel='stylesheet' />
</head>
<?include_once ("Menu.php")?>



    
<form enctype="multipart/form-data" id="ReasignaProductos">

<div class="card text-center">

  <div class="card-body">
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre del paciente</label>
    <input type="text" class="form-control " id="asignacodbarra" name="AsignaCodBarra" value="<? echo $_POST["NombresExt"]?>" >
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Telefono</label>
    <input type="text" class="form-control " id="asignacodbarra" name="AsignaCodBarra" value="<? echo $_POST["Telefono"]?>" >
  </div>
  
  <div class="form-group">
    <label for="exampleInputPassword1">Fecha de cita</label>
    <input type="text" class="form-control " id="asignacodbarra" name="AsignaCodBarra" value="<? echo $_POST["FechaCita"]?>" >
  </div>
         
   
  </div>
    
  </div>
  <div class="text-center">
          
          <div class="table-responsive">
          <table  id="StockSucursalesDistribucion" class="table table-hover">
        <thead>
        <th>Cod</th>
        <th>Nombre</th>
      
        
          
        <?foreach ($materia as $key => $value) {?>
        
        </thead>
      
        <tr>
        
       
   


        <td > <input type="text" class="form-control" value="<?php  echo $materia[$key]?>" name="" id=""></td>
        <td > <input type="text" class="form-control" value="<? echo $materia2[$key]?>" name="" id=""></td>
        
        
    <?}?>
            
        </tr>
        
        </table>
        </div>
        </div>
        
        </div>
        </div>
     
    
    

   
    <!-- DATA IMPORTANTE -->

        
 
  
    <div class="justify-content-center">
       <button type="submit"   id="EnviarDatos" value="Guardar" class="btn btn-primary">Asignar <i class="fas fa-tasks"></i></button>
                                        </form>



                                        </div>


</div>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <?php 
   include ("Modales/Error.php");
  
   include ("Modales/Exito.php");

   include ("Modales/Precarga.php");
   include ("Modales/ExitoActualiza.php");
   include ("Modales/EstatusAgendaGuardado.php");
  include ("Modales/AgendarCitaLab.php");
 include ("Modales/AltaEspecialista.php");
  include ("footer.php")?>

<script src="js/RevaloracionesControlLab.js"></script>


<script src="js/AgendarevaloracionesLab.js"></script>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->

<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

   

</body>
</html>
<?

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