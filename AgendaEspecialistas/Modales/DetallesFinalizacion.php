<div class="modal fade" id="Final" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                  <p>Se han marcado como finalizado los horarios seleccionados <br>

                El estatus actual es:<br>
<button class="btn btn-default btn-sm" style="background-color:#80391e  !important">Vencido</button>
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
              <a type="button" href="https://controlfarmacia.com/ControldecitasV2/HorariosVencidos" class="btn btn-success waves-effect waves-light">Continuar
              <i class="fas fa-arrow-alt-circle-right"></i>
              </a>
             
            </div>
          </div>
          <!--/.Content-->
        </div> </div>