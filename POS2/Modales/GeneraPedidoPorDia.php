
  
      <div class="modal fade bd-example-modal-xl" id="PedidoPorDia" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
    <p class="heading lead">Filtrado de ventas por sucursal<i class="fas fa-credit-card"></i></p>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="white-text">&times;</span>
    </button>
</div>

<div class="modal-body">
    <form action="javascript:void(0)" method="post" id="Filtrapormediodesucursalconajax">
        <div class="row">
            <div class="col">
                <label for="exampleFormControlInput1">Sucursal Actual </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
                    </div>
                    <input type="text" class="form-control" disabled readonly value="<?php echo $row['Nombre_Sucursal']?>">
                </div>
            </div>

            <div class="col">
                <label for="exampleFormControlInput1">Sucursal a elegir </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
                    </div>
                    <select id="sucursal" class="form-control" name="Sucursal" required>
                        <option value="">Seleccione una Sucursal:</option>
                        <?php 
                        $query = $conn -> query ("SELECT ID_SucursalC,Nombre_Sucursal,ID_H_O_D FROM SucursalesCorre WHERE ID_H_O_D='".$row['ID_H_O_D']."'");
                        while ($valores = mysqli_fetch_array($query)) {
                            echo '<option value="'.$valores["ID_SucursalC"].'">'.$valores["Nombre_Sucursal"].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <input type="text" name="user" hidden value="<?php echo $row['Pos_ID']?>">
            </div>
        </div>
        <button type="submit" id="submit_registroarea" class="btn btn-success">Aplicar cambio de sucursal <i class="fas fa-exchange-alt"></i></button>
    </form>
</div>

<script>
document.getElementById('Filtrapormediodesucursalconajax').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevenir el envío del formulario

    // Mostrar un mensaje de confirmación
    let confirmar = confirm("¿Desea generar una nueva orden de pedido por día para su sucursal?");
    if (confirmar) {
        // Aquí puedes agregar la lógica para procesar la solicitud si el usuario confirma

        // Simular el envío del formulario con AJAX
        let formData = new FormData(this);
        fetch('ruta_al_script_php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Procesar la respuesta del servidor
            alert("La nueva orden de pedido ha sido generada.");
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Hubo un error al generar la orden de pedido.");
        });
    }
});
</script>
