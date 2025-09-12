<!-- Modal para cargar Excel -->
<div class="modal fade" id="CargarExcel" tabindex="-1" role="dialog" aria-labelledby="CargarExcelLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CargarExcelLabel">
          <i class="fas fa-file-excel text-success"></i> Cargar Inventario desde Excel
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-info">
          <i class="fas fa-info-circle"></i>
          <strong>Instrucciones:</strong> Seleccione un archivo Excel (.xlsx, .xls) o CSV (.csv) con las siguientes columnas:
          <ul class="mb-0 mt-2">
            <li><strong>Clave:</strong> Código de barras del producto</li>
            <li><strong>Nombre:</strong> Nombre del producto</li>
            <li><strong>Stock:</strong> Stock de referencia (puede ser de fecha pasada)</li>
            <li><strong>Conteo fisico:</strong> Conteo físico de referencia</li>
            <li><strong>Diferencia:</strong> Diferencia deseada (opcional, se calcula automáticamente)</li>
            <li><strong>Observaciones:</strong> Comentarios adicionales</li>
          </ul>
          <div class="alert alert-success mt-2 mb-0">
            <i class="fas fa-magic"></i>
            <strong>Función Inteligente:</strong> El sistema calculará automáticamente el conteo físico necesario para mantener la misma diferencia que tenías en el Excel, pero usando el stock actual del sistema.
          </div>
        </div>
        
        <form id="formCargarExcel" enctype="multipart/form-data">
          <div class="form-group">
            <label for="archivoExcel">
              <i class="fas fa-upload"></i> Seleccionar archivo Excel
            </label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="archivoExcel" name="archivoExcel" accept=".xlsx,.xls,.csv" required>
                <label class="custom-file-label" for="archivoExcel">Seleccionar archivo...</label>
              </div>
            </div>
            <small class="form-text text-muted">Formatos soportados: .xlsx, .xls, .csv</small>
          </div>
          
          <div class="form-group">
            <label for="tipoAjusteExcel">
              <i class="fas fa-cogs"></i> Tipo de ajuste
            </label>
            <select class="form-control" id="tipoAjusteExcel" name="tipoAjusteExcel" required>
              <option value="">Seleccione un tipo de ajuste</option>
              <option value="Ajuste de inventario">Ajuste de inventario</option>
              <option value="Inventario inicial">Inventario inicial</option>
              <option value="Ajuste por daño">Ajuste por daño</option>
              <option value="Ajuste por caducidad">Ajuste por caducidad</option>
              <option value="Ajuste por cierre de inventario">Ajuste por cierre de inventario</option>
            </select>
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="anaquelExcel">
                  <i class="fas fa-font"></i> Anaquel
                </label>
                <select class="form-control" id="anaquelExcel" name="anaquelExcel" required>
                  <option value="">Seleccione anaquel</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="repisaExcel">
                  <i class="fas fa-hashtag"></i> Repisa
                </label>
                <select class="form-control" id="repisaExcel" name="repisaExcel" required>
                  <option value="">Seleccione repisa</option>
                </select>
              </div>
            </div>
          </div>
        </form>
        
        <!-- Área de preview de datos -->
        <div id="previewDatos" style="display: none;">
          <hr>
          <h6><i class="fas fa-eye"></i> Vista previa de datos</h6>
          <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
            <table class="table table-sm table-striped" id="tablaPreview">
              <thead class="thead-dark">
                <tr>
                  <th>Clave</th>
                  <th>Nombre</th>
                  <th>Stock Excel</th>
                  <th>Conteo Físico</th>
                  <th>Diferencia</th>
                  <th>Observaciones</th>
                </tr>
              </thead>
              <tbody id="tbodyPreview">
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="fas fa-times"></i> Cancelar
        </button>
        <button type="button" class="btn btn-info" id="btnPreviewExcel" disabled>
          <i class="fas fa-eye"></i> Vista previa
        </button>
        <button type="button" class="btn btn-success" id="btnCargarExcel" disabled>
          <i class="fas fa-upload"></i> Cargar datos
        </button>
      </div>
    </div>
  </div>
</div>

<script>
// Llenar selects de anaquel y repisa para el modal
$(document).ready(function() {
    // Llenar select de anaquel
    const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('');
    alphabet.forEach(letter => {
        const option = document.createElement('option');
        option.value = letter;
        option.textContent = letter;
        document.getElementById('anaquelExcel').appendChild(option);
    });
    
    // Llenar select de repisa
    for (let i = 1; i <= 30; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.textContent = i;
        document.getElementById('repisaExcel').appendChild(option);
    }
});

// Manejar cambio de archivo
$('#archivoExcel').on('change', function() {
    const fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').html(fileName);
    
    // Habilitar botón de vista previa si se seleccionó un archivo
    if (fileName) {
        $('#btnPreviewExcel').prop('disabled', false);
    } else {
        $('#btnPreviewExcel').prop('disabled', true);
        $('#btnCargarExcel').prop('disabled', true);
        $('#previewDatos').hide();
    }
});

// Vista previa del archivo Excel
$('#btnPreviewExcel').on('click', function() {
    const formData = new FormData();
    const fileInput = document.getElementById('archivoExcel');
    
    if (!fileInput.files[0]) {
        Swal.fire('Error', 'Por favor seleccione un archivo Excel', 'error');
        return;
    }
    
    formData.append('archivoExcel', fileInput.files[0]);
    formData.append('action', 'preview');
    
    // Mostrar loading
    Swal.fire({
        title: 'Procesando archivo...',
        text: 'Por favor espere',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    $.ajax({
        url: 'Consultas/ProcesarExcelInventarioSimple.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            Swal.close();
            
            if (response.success) {
                // Mostrar datos en la tabla de preview
                mostrarPreviewDatos(response.data);
                $('#previewDatos').show();
                $('#btnCargarExcel').prop('disabled', false);
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
        error: function() {
            Swal.close();
            Swal.fire('Error', 'Error al procesar el archivo', 'error');
        }
    });
});

// Función para mostrar los datos en la tabla de preview
function mostrarPreviewDatos(datos) {
    const tbody = $('#tbodyPreview');
    tbody.empty();
    
    datos.forEach(function(fila, index) {
        const diferencia = fila.Diferencia || (fila['Conteo fisico'] - fila.Stock);
        const tr = `
            <tr>
                <td>${fila.Clave || ''}</td>
                <td>${fila.Nombre || ''}</td>
                <td>
                    <span class="badge badge-info">${fila.Stock || 0}</span>
                    <small class="text-muted d-block">(Referencia)</small>
                </td>
                <td>
                    <span class="badge badge-warning">${fila['Conteo fisico'] || 0}</span>
                    <small class="text-muted d-block">(Referencia)</small>
                </td>
                <td>
                    <span class="badge ${diferencia >= 0 ? 'badge-success' : 'badge-danger'}">${diferencia}</span>
                    <small class="text-info d-block">Se mantendrá</small>
                </td>
                <td>${fila.Observaciones || ''}</td>
            </tr>
        `;
        tbody.append(tr);
    });
}

// Cargar datos del Excel a la tabla principal
$('#btnCargarExcel').on('click', function() {
    const formData = new FormData();
    const fileInput = document.getElementById('archivoExcel');
    const tipoAjuste = $('#tipoAjusteExcel').val();
    const anaquel = $('#anaquelExcel').val();
    const repisa = $('#repisaExcel').val();
    
    if (!fileInput.files[0]) {
        Swal.fire('Error', 'Por favor seleccione un archivo Excel', 'error');
        return;
    }
    
    if (!tipoAjuste || !anaquel || !repisa) {
        Swal.fire('Error', 'Por favor complete todos los campos requeridos', 'error');
        return;
    }
    
    formData.append('archivoExcel', fileInput.files[0]);
    formData.append('action', 'cargar');
    formData.append('tipoAjuste', tipoAjuste);
    formData.append('anaquel', anaquel);
    formData.append('repisa', repisa);
    
    // Mostrar loading
    Swal.fire({
        title: 'Cargando datos...',
        text: 'Por favor espere',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    $.ajax({
        url: 'Consultas/ProcesarExcelInventarioSimple.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            Swal.close();
            
            if (response.success) {
                // Procesar cada producto del Excel
                if (response.datos && response.datos.length > 0) {
                    procesarDatosExcel(response.datos, tipoAjuste, anaquel, repisa);
                }
                
                Swal.fire({
                    title: 'Éxito',
                    text: `Se cargaron ${response.cantidad} productos correctamente`,
                    icon: 'success'
                }).then(() => {
                    // Cerrar modal y limpiar formulario
                    $('#CargarExcel').modal('hide');
                    limpiarFormularioExcel();
                });
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
        error: function() {
            Swal.close();
            Swal.fire('Error', 'Error al cargar los datos', 'error');
        }
    });
});

// Función para procesar los datos del Excel y agregarlos a la tabla principal
function procesarDatosExcel(datos, tipoAjuste, anaquel, repisa) {
    datos.forEach(function(dato) {
        // Buscar el producto en la base de datos
        $.ajax({
            url: "Consultas/escaner_articulo.php",
            type: 'POST',
            data: { codigoEscaneado: dato.Clave },
            dataType: 'json',
            success: function (data) {
                if (data && data.codigo) {
                     // Calcular el conteo físico necesario para mantener la misma diferencia
                     const stockExcel = parseFloat(dato.Stock) || 0;
                     const conteoFisicoExcel = parseFloat(dato['Conteo fisico']) || 0;
                     const diferenciaExcel = parseFloat(dato.Diferencia) || (conteoFisicoExcel - stockExcel);
                     const stockActualSistema = data.existencia || 0;
                     const conteoFisicoNecesario = stockActualSistema + diferenciaExcel;
                     
                     // Debug: mostrar cálculos
                     console.log(`Producto: ${dato.Clave}`);
                     console.log(`Stock Excel: ${stockExcel}, Conteo Excel: ${conteoFisicoExcel}, Diferencia Excel: ${diferenciaExcel}`);
                     console.log(`Stock Sistema: ${stockActualSistema}, Conteo Necesario: ${conteoFisicoNecesario}`);
                    
                    // Crear objeto artículo con los datos del Excel
                    const articulo = {
                        id: data.id,
                        codigo: data.codigo,
                        descripcion: data.descripcion,
                        cantidad: conteoFisicoNecesario, // Conteo físico calculado para mantener la diferencia
                        existencia: stockActualSistema, // Stock actual del sistema
                        stockExcel: stockExcel, // Stock del Excel para referencia
                        diferenciaExcel: diferenciaExcel, // Diferencia del Excel
                        precio: data.precio || 0,
                        preciocompra: data.preciocompra || 0,
                        tipoAjuste: tipoAjuste,
                        anaquel: anaquel,
                        repisa: repisa,
                        comentario: dato.Observaciones || '',
                        stockDelExcel: true // Marcar que viene del Excel
                    };
                    
                    // Agregar a la tabla
                    agregarArticuloDesdeExcel(articulo);
                } else {
                    console.warn('Producto no encontrado:', dato.Clave);
                }
            },
            error: function() {
                console.error('Error al buscar producto:', dato.Clave);
            }
        });
    });
}

// Función para agregar artículo desde Excel (similar a agregarArticulo pero con datos específicos)
function agregarArticuloDesdeExcel(articulo) {
    if (!articulo || !articulo.id) {
        console.warn('El artículo no es válido');
        return;
    }

    let row = $('#tablaAgregarArticulos tbody').find('tr[data-id="' + articulo.id + '"]');
    if (row.length) {
        // Si el producto ya existe, actualizar cantidad
        let cantidadActual = parseInt(row.find('.cantidad input').val());
        let nuevaCantidad = cantidadActual + parseInt(articulo.cantidad);
        if (nuevaCantidad < 0) {
            console.warn('La cantidad no puede ser negativa');
            return;
        }
        row.find('.cantidad input').val(nuevaCantidad);
        calcularDiferencia(row);
    } else {
        // Crear nueva fila
        let tr = `
            <tr data-id="${articulo.id}">
                <td class="codigo"><input class="form-control codigo-barras-input" readonly style="font-size: 0.75rem !important;" type="text" value="${articulo.codigo}" name="CodBarras[]" /></td>
                <td class="descripcion"><textarea class="form-control descripcion-producto-input" readonly style="font-size: 0.75rem !important;" name="NombreDelProducto[]">${articulo.descripcion}</textarea></td>
                <td class="cantidad"><input class="form-control cantidad-vendida-input" style="font-size: 0.75rem !important;" type="number" name="Contabilizado[]" value="${articulo.cantidad}" onchange="calcularDiferencia(this)" /></td>
                <td class="ExistenciasEnBd">
                    <div class="d-flex flex-column">
                        <input class="form-control cantidad-existencias-input" readonly style="font-size: 0.75rem !important;" type="number" name="StockActual[]" value="${articulo.existencia}" title="Stock actual del sistema" />
                        <small class="text-info" style="font-size: 0.6rem !important;">Sistema: ${articulo.existencia}</small>
                        <small class="text-muted" style="font-size: 0.6rem !important;">Excel: ${articulo.stockExcel}</small>
                    </div>
                </td>
                <td class="Diferenciaresultante"><input class="form-control cantidad-diferencia-input" style="font-size: 0.75rem  !important;" type="number" readonly name="Diferencia[]" /></td>
                <td class="preciofijo"><input class="form-control preciou-input" readonly style="font-size: 0.75rem !important;" type="number" value="${articulo.precio}" /></td>
                <td class="tipoajuste"><input class="form-control tipoajuste-input" readonly style="font-size: 0.75rem !important;" name="Tipodeajusteaplicado[]" type="text" value="${articulo.tipoAjuste}" /></td>
                <td class="anaquel"><input class="form-control anaquel-input" readonly style="font-size: 0.75rem !important;" name="AnaquelSeleccionado[]" type="text" value="${articulo.anaquel}" /></td>
                <td class="repisa"><input class="form-control repisa-input" readonly style="font-size: 0.75rem !important;" name="RepisaSeleccionada[]" type="text" value="${articulo.repisa}" /></td>
                <td class="comentario">
                    <textarea class="form-control comentario-input" style="font-size: 0.75rem !important; resize: none;" name="Comentario[]" rows="3">${articulo.comentario}</textarea>
                </td>
                <td style="display:none;" class="preciodecompra"><input class="form-control preciocompra-input" style="font-size: 0.75rem !important;" name="PrecioCompra[]" value="${articulo.preciocompra}" /></td>
                <td style="display:none;" class="precio"><input hidden id="precio_${articulo.id}" class="form-control precio" style="font-size: 0.75rem !important;" type="number" name="PrecioVenta[]" value="${articulo.precio}" onchange="actualizarImporte($(this).parent().parent());" /></td>
                <td style="display:none;"><input id="importe_${articulo.id}" class="form-control importe" name="ImporteGenerado[]" style="font-size: 0.75rem !important;" type="number" readonly /></td>
                <td style="display:none;" class="idbd"><input class="form-control" style="font-size: 0.75rem !important;" type="text" value="${articulo.id}" name="IdBasedatos[]" /></td>
                <td style="display:none;" class="ResponsableInventario"><input hidden id="VendedorFarma" type="text" class="form-control" name="AgregoElVendedor[]" readonly value="<?php echo $row['Nombre_Apellidos']; ?>" /></td>
                <td style="display:none;" class="Sucursal"><input hidden type="text" class="form-control" name="Fk_sucursal[]" readonly value="<?php echo $row['Fk_Sucursal']; ?>" /></td>
                <td style="display:none;" class="Empresa"><input hidden type="text" class="form-control" name="Sistema[]" readonly value="POS" /></td>
                <td style="display:none;" class="Empresa"><input hidden type="text" class="form-control" name="ID_H_O_D[]" readonly value="Saluda" /></td>
                <td style="display:none;" class="Fecha"><input hidden type="text" class="form-control" name="FechaInv[]" readonly value="<?php echo $fechaActual; ?>" /></td>
                <td><div class="btn-container"><button type="button" class="btn btn-danger btn-sm" onclick="eliminarFila(this);"><i class="fas fa-minus-circle fa-xs"></i></button></div></td>
            </tr>`;

         $('#tablaAgregarArticulos tbody').prepend(tr);
         let newRow = $('#tablaAgregarArticulos tbody tr:first-child');
         
         // Calcular la diferencia automáticamente
         const conteoFisico = parseFloat(articulo.cantidad);
         const stockActual = parseFloat(articulo.existencia);
         const diferencia = conteoFisico - stockActual;
         
         // Actualizar el campo de diferencia
         newRow.find('.cantidad-diferencia-input').val(diferencia);
         
         actualizarImporte(newRow);
         calcularIVA();
         actualizarSuma();
         mostrarTotalVenta();
    }
}

// Función para limpiar el formulario
function limpiarFormularioExcel() {
    $('#formCargarExcel')[0].reset();
    $('#archivoExcel').next('.custom-file-label').html('Seleccionar archivo...');
    $('#btnPreviewExcel').prop('disabled', true);
    $('#btnCargarExcel').prop('disabled', true);
    $('#previewDatos').hide();
    $('#tbodyPreview').empty();
}
</script>
