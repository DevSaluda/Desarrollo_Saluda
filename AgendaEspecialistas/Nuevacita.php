<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/Conexion_selects.php";
include "Consultas/ConeSelectDinamico.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>GESTIONANDO NUEVA CITA PARA ESTUDIOS MEDICOS |SUCURSAL <?echo $row['ID_H_O_D']?> </title>

  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/b5ed0deb1b.js" crossorigin="anonymous"></script>
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
</head>
<?include_once ("Menu.php")?>

  <!-- Content Wrapper. Contains page content -->
 

         
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Reservar cita para análisis médicos</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
           
              <form action="javascript:void(0)" method="post" id="ajax-form">
                <div class="card-body">
                <div class="form-group">
                   
                    <input type="text" name="Empresa" class="form-control" id="empresa" hidden readonly value="<?echo $row['ID_H_O_D']?>">
                  </div>
                  <div class="form-group">
                   
                   <input type="text" name="Empleado" class="form-control" id="empleado" hidden readonly value="<?echo $row['Nombre_Apellidos']?>">
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
                  <div class="form-group">
                    <label for="exampleInputPassword1">Fecha de cita</label>
                    <input type="date" name="Fecha" class="form-control" id="fecha" placeholder="Seleccione Fecha">
                  </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Hora de cita</label>
                  <select name="Hora" id="hora" class="form-control">
                                               <option value="0">Seleccione una hora:</option>
        <?
          $query = $mysqli -> query ("SELECT Horario_Disponibilidad FROM Horarios_Analisis WHERE ID_H_O_D='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[Horario_Disponibilidad].'">'.$valores[Horario_Disponibilidad].'</option>';
          }
        ?> </select>
                  </div>
              
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tipo de análisis a realizar</label>
                    <select id = "id_deparatamento" class = "form-control" name = "id_deparatamento" required = "required">
								<option value = "">Selecciona un tipo de análisis </option>
								<?php
									$sql = $conn->prepare("SELECT ID_Analisis,Nombre_analisis FROM Tipo_analisis WHERE ID_H_O_D='".$row['ID_H_O_D']."'");
									if($sql->execute()){
										$g_result = $sql->get_result();
									}
									while($row = $g_result->fetch_array()){
								?>
									<option value = "<?php echo $row['ID_Analisis']?>"><?php echo($row['Nombre_analisis'])?></option>
								<?php
										}
									$conn->close();	
								?>
							</select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tipo de estudio a realizar</label>
                  <select  id = "municipio" name = "municipio"  class = "form-control" disabled = "disabled" required = "required">
								<option value = "">Selecciona un tipo de estudio</option>
							</select>
              </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Nombre del solicitante</label>
                    <input type="text" name="Nombre" class="form-control" id="Nombre" placeholder="Ingrese nombre del paciente">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Edad</label>
                    <input type="number" name="Edad" class="form-control" id="Edad" placeholder="Ingrese la edad">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Telefono</label>
                    <input type="number" name="Telefono" class="form-control" id="Telefono" placeholder="Ingrese el numero de telefono">
                  </div>
              
                  <div class="form-group">
                  <label for="exampleInputPassword1">Estatus</label>
                  <select name="color" class="form-control" id="color">
									  <option value="">Seleccionar</option>
				
						  <option  value="#008000">Confirmado</option>						  
						  <option  value="#FFD700"> En espera</option>
						 
						  <option  value="#FF0000"> Cancelada</option>
						 
						  
						</select>
					</div>
         
                <!-- /.card-body -->
                <div class="card-footer">
                <button type="submit" onclick="Procesando()"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-primary">Guardar <i class="fas fa-save"></i></button>
                </div>
              </form>
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
          
         

  <?include ("footer.php")?>
<!-- ./wrapper -->
<script type = "text/javascript">
	$(document).ready(function(){
		$('#id_deparatamento').on('change', function(){
				if($('#id_deparatamento').val() == ""){
					$('#municipio').empty();
					$('<option value = "">Selecciona un estudio</option>').appendTo('#municipio');
					$('#municipio').attr('disabled', 'disabled');
				}else{
					$('#municipio').removeAttr('disabled', 'disabled');
					$('#municipio').load('Consultas/ObtieneEstudios.php?id_deparatamento=' + $('#id_deparatamento').val());
				}
		});
	});
</script>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="dist/js/pages/dashboard2.js"></script>
<script type="text/javascript" src="js/guardacita_analisis.js"></script>
</body>
</html>
