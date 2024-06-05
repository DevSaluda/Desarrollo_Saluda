
  
     <style>
        .animate__animated {
            --animate-duration: 1.5s;
        }
    </style>

    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <label for="exampleFormControlInput1">Sucursal Actual</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
                    </div>
                    <input type="text" class="form-control" disabled readonly value="<?php echo $row['Nombre_Sucursal']?>">
                </div>
                <button id="descargarBtn" class="btn btn-primary">Mostrar Mensaje</button>
                <p id="mensaje" class="mt-3"></p>
            </div>
        </div>
    </div>


    <script>
        document.getElementById('descargarBtn').addEventListener('click', function() {
            var sucursal = '<?php echo $row['Nombre_Sucursal']; ?>';
            var mensaje = document.getElementById('mensaje');
            mensaje.textContent = `¿Deseas descargar el inventario de la sucursal ${sucursal}?`;
            mensaje.classList.add('animate__animated', 'animate__fadeIn');
        });
    </script>
  