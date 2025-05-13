<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/Conexion_selects.php";
include "Consultas/ConeSelectDinamico.php";

?>
<label for="exampleFormControlInput1">Especialidad<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <select id = "sucursal" class = "form-control" name = "Sucursal">
                                               <option value="">Seleccione una Sucursal:</option>
        <?
          $query = $mysqli -> query ("SELECT ID_SucursalC,Nombre_Sucursal FROM Sucursales_CampañasV2 WHERE Estatus_Sucursal = 'Vigente' AND ID_H_O_D='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_SucursalC].'">'.$valores[Nombre_Sucursal].'</option>';
          }
        ?>  </select>
         
    </div><label for="nombreprod" class="error">