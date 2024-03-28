<div class="modal fade bd-example-modal-xl" id="FiltraPorSucursalesYEspecialistas" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-success">
        <div class="modal-content">
            <div class="text-center">
                <div class="modal-header">
                    <h5 class="modal-title">Busqueda por especialistas <i class="fas fa-credit-card"></i></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="FiltraCitasPorSucursalesFechas" method="POST">
                        <div class="form-row">
                            <div class="col">
                                <label for="mesesSelect">Seleccione una fecha inicial</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="calendario"><i class="far fa-calendar"></i></span>
                                    </div>
                                    <input type="date" class="form-control" id="fechainicial" name="fechainicial">
                                </div>
                            </div>
                            <div class="col">
    <label for="fecha">Seleccione una fecha final </label>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="calendario"><i class="far fa-calendar"></i></span>
        </div>
        <input type="date" class="form-control" id="fechafin" name="fechafinal">

    </div>
</div>
<div class="col">
    <label for="fecha">Seleccione una sucursal </label>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="calendario"><i class="far fa-calendar"></i></span>
        </div>
        <select id = "sucursal" class = "form-control" name = "sucursal" >
                                               <option value="">Seleccione una Sucursal:</option>
        <?php 
          $query = $conn -> query ("SELECT ID_SucursalC,Nombre_Sucursal FROM SucursalesCorre ");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["ID_SucursalC"].'">'.$valores["Nombre_Sucursal"].'</option>';
          }
        ?>  </select>

    </div>

    <div class="col">
    <label for="exampleFormControlInput1">Especialidad</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select  id = "especialidad" name = "Especialidad"  class = "form-control" disabled = "disabled" >
								<option value = "">Selecciona una especialidad</option>
							</select>
</div>
<label for="especialidad" class="error">
    </div>
    
</div>
                        </div>
                        <button type="submit" class="btn btn-success">Realizar Busqueda <i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


