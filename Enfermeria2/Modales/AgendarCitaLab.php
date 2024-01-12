<?php include "Consultas/SumaOrdenesLaboratorio.php";?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="modal fade" id="CitaExt" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="Di" class="modal-dialog modal-lg modal-notify modal-success">
    <div class="modal-content">
      <div class="modal-header">
        <p class="heading lead" id="Titulo">Agendamiento de laboratorios</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>
      <div id="Mensaje" class="alert alert-info alert-styled-left text-blue-800 content-group">
        <span id="Aviso" class="text-semibold">
          Estimado usuario, Verifique los campos antes de realizar alguna accion
        </span>
        <button type="button" class="close" data-dismiss="alert">×</button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <form action="javascript:void(0)" method="post" id="AgendaLaboratorios">
            <div class="form-group row">
              <div class="col">
                <label for="nombres">Nombre del paciente</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                  </div>
                  <input type="text" class="form-control" name="Nombres" id="nombres" aria-describedby="basic-addon1" />
                </div>
              </div>
              <div class="col">
                <label for="tel">Telefono</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-address-card"></i></span>
                  </div>
                  <input type="tel" class="form-control" name="Tel" id="tel" aria-describedby="basic-addon1" />
                </div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col">
                <label for="sucursal">Sucursal</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-address-card"></i></span>
                  </div>
                  <?php
                      $query = $conn->query(
                        "SELECT Nombre_Sucursal FROM Sucursales_CampañasV2 WHERE Estatus_Sucursal='Vigente' AND ID_H_O_D='" .
                        $row['ID_H_O_D'] . "' AND ID_SucursalC =" . $row['Fk_Sucursal']
                      );

                      if ($query->num_rows > 0) {
                        $sucursalData = $query->fetch_assoc();
                        $nombreSucursal = $sucursalData['Nombre_Sucursal'];
                      } else {
                        $nombreSucursal = "Nombre no encontrado";
                      }
                  ?>
                  <input id="sucursal" class="form-control" name="Sucursal" value="<?php echo $nombreSucursal;?>" readonly></input>
                </div>
              </div>
              <div class="col">
                <label for="fecha">Fecha</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                  </div>
                  <input type="date" class="form-control" name="Fecha" id="fecha" aria-describedby="basic-addon1"/>
                </div>
              </div>
              <div class="col">
                <label for="turno">Turno</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                  </div>
                  <select class="form-control" name="Turno" id="turno">
                    <option value="Matutino">Matutino</option>
                    <option value="Vespertino">Vespertino</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col">
                <label for="codbarra">Laboratorio</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-address-card"></i></span>
                  </div>
                  <select type="text" class="form-control" name="Codbarra" id="codbarra" aria-describedby="basic-addon1"/>
                  <option value="" name="Codbarra" id="codbarra" >Selecciona un producto</option>
                  <?php
                      $query = $conn->query(
                        "SELECT
                        Productos_POS.Cod_Barra,
                        Productos_POS.Tipo_Servicio,
                        Productos_POS.Nombre_Prod,
                        Productos_POS.Precio_Venta,
                        Servicios_POS.Servicio_ID,
                        Servicios_POS.Nom_Serv
                    FROM
                        Productos_POS,
                        Servicios_POS
                    WHERE
                        Servicios_POS.Nom_Serv = 'Laboratorio'
                        AND Productos_POS.Cod_Barra LIKE 'LAB-%'
                        AND (
                            (Productos_POS.Cod_Barra LIKE '%" . mysqli_real_escape_string($conn, ($_GET['term'])) . "%')
                            OR (Productos_POS.Nombre_Prod LIKE '%" . mysqli_real_escape_string($conn, ($_GET['term'])) . "%')
                        )"
                      );
                      while ($valores = mysqli_fetch_array($query)) {
                        echo '<option name="Codbarra" id="codbarra" value="' . $valores['Cod_Barra'] . '">' . $valores['Cod_Barra'] . ' - ' . $valores['Nombre_Prod'] . '</option>';
                      }
                    ?>
                    </select>
                </div>
              </div>
              <div class="col">
                <label for="nombresLab">Descripcion</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                  </div>
                  <textarea id="nombresLab" name="NombresLab" class="form-control form-control-sm" rows="10" cols="200" readonly></textarea>
                  <!-- <input type="text" class="form-control" name="NombresLab" id="nombresLab" aria-describedby="basic-addon1" disabled = "disabled" /> -->
                  <textarea id="codigoOculto" name="CodigoOculto" class="form-control form-control-sm" rows="10" cols="200"></textarea>
                </div>
              </div>
            </div>
            <div class="col text-center align-self-center">
              <!-- Botón para quitar el último elemento -->
              <input type="button" id="removeLastItem" class="btn btn-danger" value="Eliminar">
              </div>
            <div class="form-group row">
              <div class="col">
                <label for="enfermero">Enfermero</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="Tarjeta"><i class="fas fa-user-md"></i></span>
                  </div>
                  <select id="enfermero" name="Enfermero" class="form-control">
                    <option value="">Selecciona un Enfermero</option>
                    <?php
                      $query = $conn->query(
                        "SELECT Nombre_Apellidos,Fk_Sucursal,Estatus FROM  Personal_Enfermeria WHERE Estatus='Vigente' AND Fk_Sucursal='" .
                          $row['Fk_Sucursal'] . "'"
                      );
                      while ($valores = mysqli_fetch_array($query)) {
                        echo '<option value="' . $valores['Nombre_Apellidos'] . '">' . $valores['Nombre_Apellidos'] . '</option>';
                      }
                    ?> 
                  </select>
                </div>
              </div>
              <div class="col">
                <label for="motConsulta">Indicaciones</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
                  </div>
                  <textarea id="indicaciones" class="form-control form-control-sm" name="Indicaciones" rows="2" cols="50"></textarea>
                </div>
              </div>
            </div>
            <!-- Rest of the form content... -->
            <!-- INICIA DATA DE AGENDA -->
            <div class="text-center">
              <div class="form-group fieldGroupCopy" style="display: none;">
                <div class="lista-producto float-clear" style="clear:both;">
                  <!-- List group content... -->
                </div>
              </div>
              <div class="text-center">
                <button type="submit" name="submit_Lab" id="submit_Lab" class="btn btn-success">
                  Confirmar datos <i class="fas fa-user-check"></i>
                </button>
                <input type="text" class="form-control" name="Empresa" id="empresa"  value="<?echo $row['ID_H_O_D']?>" hidden  readonly >
                <input type="text" class="form-control" name="sistema" id="sistema"  value="Enfermería" hidden  readonly >
              </div>
            </div>
            <!-- FINALIZA DATA DE AGENDA -->
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .ui-front {
    position: absolute !important;
    z-index: 2006 !important;
    overflow: auto !important;
  }
</style>
