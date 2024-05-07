<div class="modal fade bd-example-modal-xl" id="FiltraPorPaciente" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success">
        <div class="modal-content">
            <div class="modal-header">
            <p class="heading lead">Filtra Por Nombre Paciente<i class="fas fa-credit-card"></i></p><button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h2>Buscar Paciente</h2>
                <form  method="POST" action="https://saludapos.com/ControlDental/Consultas/FiltraPorNombrePaciente.php">
                    <label for="nombre">Nombre del Paciente:</label>
                    <input type="text" id="nombre" name="nombre" required>
                    <button type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </div>
</div>
