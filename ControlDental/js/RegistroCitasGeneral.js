function CargaSignosVitalesLibre(fecha_inicio = null, fecha_fin = null){
    // Si no se proporcionan fechas, usar año actual por defecto
    if (!fecha_inicio) {
        fecha_inicio = new Date().getFullYear() + '-01-01';
    }
    if (!fecha_fin) {
        fecha_fin = new Date().getFullYear() + '-12-31';
    }
    
    var url = "https://saludapos.com/ControlDental/Consultas/RegistroLibre.php?fecha_inicio=" + encodeURIComponent(fecha_inicio) + "&fecha_fin=" + encodeURIComponent(fecha_fin);
    
    $.get(url, "", function(data){
      $("#sv").html(data);
    });
}

function AplicarFiltroFechas(){
    var fecha_inicio = $("#fecha_inicio").val();
    var fecha_fin = $("#fecha_fin").val();
    
    if (!fecha_inicio || !fecha_fin) {
        alert("Por favor, seleccione ambas fechas");
        return;
    }
    
    if (fecha_inicio > fecha_fin) {
        alert("La fecha de inicio no puede ser mayor que la fecha de fin");
        return;
    }
    
    // Cerrar el modal
    $('#FiltraPorFechas').modal('hide');
    
    // Cargar los datos con el filtro
    CargaSignosVitalesLibre(fecha_inicio, fecha_fin);
}

// Cargar datos del año actual al iniciar
CargaSignosVitalesLibre();

  
