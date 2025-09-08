/**
 * JavaScript para el control de ajuste de tickets
 * Desarrollo_Saluda/AdminPOS/js/ControlAjusteTickets.js
 */

$(document).ready(function() {
    // Cargar la tabla inicial
    cargarTablaAjusteTickets();
    
    // Función para cargar la tabla de ajuste de tickets
    function cargarTablaAjusteTickets() {
        $.ajax({
            url: 'Consultas/ConsultaAjusteTickets.php',
            type: 'POST',
            data: {
                accion: 'cargar_tabla'
            },
            beforeSend: function() {
                $('#TableAjusteTickets').html('<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Cargando tickets...</div>');
            },
            success: function(response) {
                $('#TableAjusteTickets').html(response);
                inicializarDataTable();
            },
            error: function() {
                $('#TableAjusteTickets').html('<div class="alert alert-danger">Error al cargar los tickets</div>');
            }
        });
    }
    
    // Función para inicializar DataTable
    function inicializarDataTable() {
        if ($.fn.DataTable) {
            $('#tablaAjusteTickets').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                },
                "order": [[0, "desc"]],
                "pageLength": 25
            });
        }
    }
    
    // Función para filtrar por sucursal
    window.filtrarPorSucursal = function(sucursal) {
        $.ajax({
            url: 'Consultas/ConsultaAjusteTickets.php',
            type: 'POST',
            data: {
                accion: 'filtrar_sucursal',
                sucursal: sucursal
            },
            beforeSend: function() {
                $('#TableAjusteTickets').html('<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Filtrando...</div>');
            },
            success: function(response) {
                $('#TableAjusteTickets').html(response);
                inicializarDataTable();
            },
            error: function() {
                $('#TableAjusteTickets').html('<div class="alert alert-danger">Error al filtrar</div>');
            }
        });
    };
    
    // Función para filtrar por fechas
    window.filtrarPorFechas = function(fechaInicio, fechaFin) {
        $.ajax({
            url: 'Consultas/ConsultaAjusteTickets.php',
            type: 'POST',
            data: {
                accion: 'filtrar_fechas',
                fechaInicio: fechaInicio,
                fechaFin: fechaFin
            },
            beforeSend: function() {
                $('#TableAjusteTickets').html('<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Filtrando...</div>');
            },
            success: function(response) {
                $('#TableAjusteTickets').html(response);
                inicializarDataTable();
            },
            error: function() {
                $('#TableAjusteTickets').html('<div class="alert alert-danger">Error al filtrar</div>');
            }
        });
    };
    
    // Función para filtrar por forma de pago
    window.filtrarPorFormaPago = function(formaPago, tipoFiltro = 'contiene') {
        $.ajax({
            url: 'Consultas/ConsultaAjusteTickets.php',
            type: 'POST',
            data: {
                accion: 'filtrar_forma_pago',
                formaPago: formaPago,
                tipoFiltro: tipoFiltro
            },
            beforeSend: function() {
                $('#TableAjusteTickets').html('<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Filtrando...</div>');
            },
            success: function(response) {
                $('#TableAjusteTickets').html(response);
                inicializarDataTable();
            },
            error: function() {
                $('#TableAjusteTickets').html('<div class="alert alert-danger">Error al filtrar</div>');
            }
        });
    };
    
    // Función para mostrar información de formas de pago
    window.mostrarInfoFormasPago = function(formasPagoString) {
        if (!formasPagoString) {
            return '<span class="text-muted">Sin información</span>';
        }
        
        var formas = [];
        if (formasPagoString.includes('|')) {
            // Múltiples formas de pago
            var partes = formasPagoString.split('|');
            partes.forEach(function(parte) {
                if (parte.includes(':')) {
                    var formayMonto = parte.split(':');
                    formas.push({
                        forma: formayMonto[0].trim(),
                        monto: parseFloat(formayMonto[1].trim())
                    });
                }
            });
        } else if (formasPagoString.includes(':')) {
            // Una forma de pago con monto
            var formayMonto = formasPagoString.split(':');
            formas.push({
                forma: formayMonto[0].trim(),
                monto: parseFloat(formayMonto[1].trim())
            });
        } else {
            // Forma de pago tradicional
            formas.push({
                forma: formasPagoString.trim(),
                monto: null
            });
        }
        
        var html = '<div class="formas-pago-info">';
        formas.forEach(function(forma) {
            var monto = forma.monto ? '$' + forma.monto.toFixed(2) : '';
            html += '<span class="badge badge-info mr-1">' + forma.forma + ' ' + monto + '</span>';
        });
        html += '</div>';
        
        return html;
    };
    
    // Función para refrescar la tabla
    window.refrescarTabla = function() {
        cargarTablaAjusteTickets();
    };
    
    // Auto-refresh cada 5 minutos
    setInterval(function() {
        cargarTablaAjusteTickets();
    }, 300000);
    
    // Función para exportar a Excel
    window.exportarAExcel = function() {
        $.ajax({
            url: 'Consultas/ExportarAjusteTickets.php',
            type: 'POST',
            data: {
                accion: 'exportar_excel'
            },
            success: function(response) {
                // Crear enlace de descarga
                var blob = new Blob([response], { type: 'application/vnd.ms-excel' });
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = 'ajuste_tickets_' + new Date().toISOString().split('T')[0] + '.xls';
                a.click();
                window.URL.revokeObjectURL(url);
            },
            error: function() {
                alert('Error al exportar los datos');
            }
        });
    };
    
    // Función para mostrar estadísticas rápidas
    window.mostrarEstadisticas = function() {
        $.ajax({
            url: 'Consultas/ConsultaAjusteTickets.php',
            type: 'POST',
            data: {
                accion: 'estadisticas'
            },
            success: function(response) {
                var stats = JSON.parse(response);
                var html = '<div class="row">';
                html += '<div class="col-md-3"><div class="card bg-primary text-white"><div class="card-body"><h5>Total Tickets</h5><h3>' + stats.totalTickets + '</h3></div></div></div>';
                html += '<div class="col-md-3"><div class="card bg-success text-white"><div class="card-body"><h5>Con Múltiples Pagos</h5><h3>' + stats.multiplesPagos + '</h3></div></div></div>';
                html += '<div class="col-md-3"><div class="card bg-info text-white"><div class="card-body"><h5>Total Vendido</h5><h3>$' + stats.totalVendido.toFixed(2) + '</h3></div></div></div>';
                html += '<div class="col-md-3"><div class="card bg-warning text-white"><div class="card-body"><h5>Última Actualización</h5><h6>' + stats.ultimaActualizacion + '</h6></div></div></div>';
                html += '</div>';
                
                $('#TableAjusteTickets').prepend(html);
            }
        });
    };
    
    // Mostrar estadísticas al cargar
    mostrarEstadisticas();
});
