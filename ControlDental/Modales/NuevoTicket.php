

<div class="text-right"> <!-- Modal --> 
    <button type="button" class="btn btn-danger"  data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="fas fa-plus-circle"></i> Agregar Ticket</button>
</div>
    
  <div  class="modal fade bs-example-modal-lg-add" id="NuevoTicket" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="Di"class="modal-dialog modal-lg modal-notify modal-primary">
      <div class="modal-content">
     <div class="modal-header">
         <p class="heading lead" id="Titulo">Nuevo Ticket</p>

           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true" class="white-text">&times;</span>
           </button>
     </div>
        
        <div id="Mensaje "class="alert alert-info alert-styled-left text-blue-800 content-group">
           <span id="Aviso" class="text-semibold"> 
                            Verifique los campos antes de realizar cambios</span>
             <button type="button" class="close" data-dismiss="alert">×</button>
        </div>
         
  <div class="modal-body">
  <div class="text-center">
     
    <form action="javascript:void(0)" method="post" id="AgregarTicket" >

    <div class="row">
          <div class="col">
            <label for="exampleFormControlInput1">Folio del Ticket <span class="text-danger">AUTOGENERADO</span> </label>
              <div class="input-group mb-3">
             <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
              </div>
              <input type="text" id="FolioTicket" class="form-control " disabled >
            </div>
          </div>

           <div class="col">
            <label for="exampleFormControlInput1">Fecha Reporte <span class="text-danger"></span></label>
              <div class="input-group mb-3">
            <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-calendar-alt"></i></span>
            </div>
            <input type="datetime"  id="FechaReporte" name="fechareporte" value="<?php echo date("Y-m-d");?>" class="form-control" disabled>
              </div><label for="fecha" class="error">
          </div>
        
    </div>
   

    <div class="row">
            <div class="col">
                <label for="exampleFormControlInput1">Reporta</label>
                 <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="Tarjeta"><i class="fas fa-hospital"></i></span>
                    </div>
                     <select id = "SucursalRep" class = "form-control" name = "sucursalRep"  >
                    <option value="">Seleccione una Sucursal:</option>
                  
                      <?
                  $resultado = $conn -> query ("SELECT ID_SucursalC,Nombre_Sucursal,ID_H_O_D FROM SucursalesCorre WHERE  ID_H_O_D='".$row['ID_H_O_D']."' AND Nombre_Sucursal !='Matriz' ");
                  while ($valores = mysqli_fetch_array($resultado)) {
                    echo '<option value="'.$valores[ID_SucursalC].'">'.$valores[Nombre_Sucursal].'</option>';
                      }
                    ?>
                   </select>
                 </div>
                 <div>
                  <label for="sucursalRep" class="error">
                </div>
            </div>
           
           <div class="col">
                <label for="exampleFormControlInput1">Descripcion</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="Tarjeta"><i class="fas fa-question-circle"></i></span>
                    </div>
                    <textarea id="Descripcion" class="form-control form-control-sm"  name="descripcion" rows="2" cols="50">
                    </textarea>
                 </div>
           </div>
                
        </div>
              
    <div class="row">
        <div class="col">
          <label for="exampleFormControlInput1">Fecha de Asignación</label>
             <div class="input-group mb-3">
                <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-calendar-alt"></i></span>
                </div>
                <input type="date" class="form-control " id="FechaAsigna" name="fechaasigna">
           </div>
    <div>
      
        <label for="medicoExt" class="error">
        </div>
        </div>

       <div class="col">
          <label for="exampleFormControlInput1">Asignar a</label>
           <div class="input-group mb-3">
            <div class="input-group-prepend">
             <span class="input-group-text" id="Tarjeta"><i class="far fa-user"></i></span>
                </div>
                <select  id = "AsignadoA" name = "asignadoa"  class = "form-control"  >
                        <option value = ""> Selecciona un Departamento </option>
                        <?
                       $resultado2 = $conn -> query ("SELECT ID_Departamento,Nombre_Departamento,ID_H_O_D FROM Departamentos" );
                      while ($valores = mysqli_fetch_array($resultado2)) {
                         echo '<option value="'.$valores[ID_Departamento].'">'.$valores[Nombre_Departamento].'</option>';
                      }
                ?> 
                </select>
            </div>
            <label for="costo" class="error">
        </div>
          </div>
        <div class="row">

              <div class="col">
          <label for="exampleFormControlInput1">Fecha de Cierre</label>
             <div class="input-group mb-3">
                <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-calendar-alt"></i></span>
                </div>
                <input type="date" class="form-control " id="FechaCierre" name="fechacierre">
           </div>  </div>

            <div class="col">
              <label for="exampleFormControlInput1">Solución</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="Tarjeta"><i class="fas fa-info-circle"></i></span>
                </div>
                 <textarea id="Solucion" class="form-control form-control-sm"  name="solucion" rows="2" cols="50">
                </textarea>
             </div>
             </div>
            </div>


    </div>  



    <div class="text-right">
      <button type="submit"  name="submit_TicketNuevo" id="submit_TicketNuevo"  class="btn btn-primary">Guardar</button>
      <button type="button" class="btn btn-Secondary" data-dismiss="modal">Cerrar</button>
    </div>
    </div>      
    </div>
<!-- FINALIZA -->
                  
</form>

</div>
             
</div>
       
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


<?php

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$sql = "INSERT INTO 'Incidencias_Express'('ID_incidencia','Descripcion','Reporto','Fecha','FK_Sucursal','Sistema','ID_H_O_') VALUES ('$FolioTicket','$Descripcion', '$Reporta', '$FechaReporte','$SucursalRep', ,'$FechaAsigna', '$AsignadoA', '$FechaCierre','$Solucion')";
    ?>