<div class="modal fade" id="Espere" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true"  style="overflow-y: scroll;">
<div class="modal-dialog modal-notify modal-primary" role="document">
          <!--Content-->
          <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
              <p class="heading">Estatus de acciones</p>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="white-text">×</span>
              </button>
            </div>

            <!--Body-->
            <div class="modal-body">

              <div class="row">
                <div class="col-3 text-center">
                  <img  src="../Perfiles/<?echo $row['file_name']?>" alt="Perfil de usuario" class="img-fluid z-depth-1-half rounded-circle">
                  <div style="height: 10px"></div>
                  <p class="title mb-0"><?echo $row['Nombre_Apellidos']?></p>
                  <p class="text-muted " style="font-size: 13px"><?echo $row['Nombre_rol']?></p>
                </div>
            
                <div class="col-9">
                <div class="text-center">
                  <p>Se ha realizado el agendamiento del paciente correctamente. <br>

                  El estatus de la cita actualmente es:<br>
<button class="btn btn-default btn-sm" style="background-color:#04B45F !important">Confirmado</button>
                  </p>
                  <p class="card-text">
                    <strong>Para verificar la información haz clic en el botón continuar <i class="fas fa-arrow-down"></i></strong>
                  </p>
                </div>
              </div>
              </div>

            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
              <a type="button" href="https://controlfarmacia.com/POS2/ListadoDataPacientesAgenda" class="btn btn-success waves-effect waves-light">Continuar
              <i class="fas fa-arrow-alt-circle-right"></i>
              </a>
             
            </div>
          </div>
          <!--/.Content-->
        </div> </div>
         
        <div class="modal fade" id="ActualizandoData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true"  style="overflow-y: scroll;">
<div class="modal-dialog modal-notify modal-success" role="document">
          <!--Content-->
          <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
              <p class="heading">Estatus de actualizacion</p>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="white-text">×</span>
              </button>
            </div>

            <!--Body-->
            <div class="modal-body">

              <div class="row">
                <div class="col-3 text-center">
                  <img  src="../Perfiles/<?echo $row['file_name']?>" alt="Perfil de usuario" class="img-fluid z-depth-1-half rounded-circle">
                  <div style="height: 10px"></div>
                  <p class="title mb-0"><?echo $row['Nombre_Apellidos']?></p>
                  <p class="text-muted " style="font-size: 13px"><?echo $row['Nombre_rol']?></p>
                </div>
            
                <div class="col-9">
                <div class="text-center">
                  <p>Se han actualizado correctamente los datos <br>

                  Recuerda que puedes observar los cambios en el boton de la columna "Estatus" <br>
                  <div class="table-responsive">
  <table class="table table-bordered">
  <thead>
    <tr>
     
      <th scope="col">Estatus</th>
    
    </tr>
  </thead>
  <tbody>
    <tr>
      
    </tr>
    
  
  </tbody>
</table>
</div>
                  
                  </p>
                  
                </div>
              </div>
              </div>

            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
              <a type="button" class="btn btn-success waves-effect waves-light" data-dismiss="modal">Ok
              <i class="fas fa-arrow-alt-circle-right"></i>
              </a>
             
            </div>
          </div>
          <!--/.Content-->
        </div> </div>
       

        <!-- Central Modal Medium Warning -->
 <div class="modal fade" id="AplicaCancel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true"  style="overflow-y: scroll;">
   <div class="modal-dialog modal-notify modal-warning" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Aviso</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>

       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
           <i class="fas fa-exclamation fa-4x mb-3 animated rotateIn"></i>
          
           <p>Cancelacion validada</p>
         </div>
       </div>

     </div>
     <!--/.Content-->
   </div>
 </div>
 <!-- Central Modal Medium Warning-->

 <div class="modal fade" id="EliminadoCompleto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true"  style="overflow-y: scroll;">
<div class="modal-dialog modal-notify modal-primary" role="document">
          <!--Content-->
          <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
              <p class="heading">Estatus de acciones</p>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="white-text">×</span>
              </button>
            </div>

            <!--Body-->
            <div class="modal-body">

              <div class="row">
                <div class="col-3 text-center">
                  <img  src="../Perfiles/<?echo $row['file_name']?>" alt="Perfil de usuario" class="img-fluid z-depth-1-half rounded-circle">
                  <div style="height: 10px"></div>
                  <p class="title mb-0"><?echo $row['Nombre_Apellidos']?></p>
                  <p class="text-muted " style="font-size: 13px"><?echo $row['Nombre_rol']?></p>
                </div>
            
                <div class="col-9">
                <div class="text-center">
                  <p>Se ha eliminado correctamente la informacion <br>

                  Puedes verificar los datos en la seccion "Agenda,Cancelaciones"<br>
<button class="btn btn-default btn-sm" style="background-color:#C2C7D0 !important">Cancelaciones</button>
                  </p>
                  
                </div>
              </div>
              </div>

            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
              <a type="button" class="btn btn-success waves-effect waves-light" data-dismiss="modal">Ok
              <i class="fas fa-arrow-alt-circle-right"></i>
              </a>
             
            </div>
          </div>
          <!--/.Content-->
        </div> </div>