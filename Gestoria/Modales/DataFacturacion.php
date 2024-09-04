<!-- Central Modal Medium Info -->
<div class="modal fade" id="CapturaFacturacion" tabindex="-100" role="dialog" aria-labelledby="myModalLabel"
   aria-="true" style="overflow-y: scroll;">
   <div class="modal-dialog modal-lg modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Alta de nuevo producto</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-="true" class="white-text">&times;</span>
         </button>
       </div>
       <div class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span class="text-semibold">Estimado usuario, </span>
                            los campos con un  <span class="text-danger"> * </span> son campos necesarios para el correcto ingreso de datos.
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
         <form action="javascript:void(0)" method="post" id="DatosParaFacturacion" >

         <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Nombre del paciente</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control"   name="Nombres" id="nombres" aria-describedby="basic-addon1">
</div>
    </div>
    <div class="col">
   
    <label for="exampleFormControlInput1">Telefono</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control"   name="Tel" id="tel" aria-describedby="basic-addon1">
</div>
    </div></div>
    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Correo</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control"   name="Correo" id="correo" aria-describedby="basic-addon1">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">RFC</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control"   name="RFC" id="rfc" aria-describedby="basic-addon1">
</div></div>
    </div>   <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Direccion</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control"   name="Direccion" id="direccion" aria-describedby="basic-addon1">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Uso CFDI</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control"   name="CFDI" id="cdfdi" aria-describedby="basic-addon1">
</div>
    </div> </div>
    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Ticket</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select id = "fkticket" class = "form-control" name = "FKTicket" >
                                               <option value="">Seleccione un ticket:</option>
        <?
          $query = $conn -> query ("SELECT DISTINCT Ventas_POS.Venta_POS_ID,Ventas_POS.Fk_Caja,Ventas_POS.Venta_POS_ID,Ventas_POS.Identificador_tipo,Ventas_POS.Folio_Ticket,Ventas_POS.Cod_Barra,Ventas_POS.Clave_adicional,
          Ventas_POS.Nombre_Prod,Ventas_POS.Cantidad_Venta,Ventas_POS.Fk_sucursal,Ventas_POS.AgregadoPor,Ventas_POS.AgregadoEl,
          Ventas_POS.Total_Venta,Ventas_POS.Lote,Ventas_POS.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM 
          Ventas_POS,SucursalesCorre WHERE Ventas_POS.Fk_sucursal= SucursalesCorre.ID_SucursalC AND Ventas_POS.Fk_sucursal  ='".$row['Fk_Sucursal']."' AND Ventas_POS.ID_H_O_D ='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[Venta_POS_ID].'">'.$valores[Folio_Ticket].'</option>';
          }
        ?>  </select>
</div>
    </div>
  
    <div class="col">
    <label for="exampleFormControlInput1">Fecha</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control"   aria-describedby="basic-addon1">
</div>
    </div>
    </div>
    <input type="text" class="form-control" name="SucursalFac" id="sucursalfac"  value="<?echo $row['Fk_Sucursal']?>"  hidden readonly >
    <input type="text" class="form-control" name="Usuario" id="usuario"  value="<?echo $row['Nombre_Apellidos']?>"  hidden readonly >
    <input type="text" class="form-control" name="Sistema" id="sistema"  value="Farmacia" hidden  readonly >
    <input type="text" class="form-control" name="Empresa" id="empresa"  value="<?echo $row['ID_H_O_D']?>" hidden  readonly >
    
    <div>
<button type="submit"  name="submit_Age" id="submit_Age"  class="btn btn-success">Confirmar datos <i class="fas fa-user-check"></i></button>
</div>                 
</form>
</div>







        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->