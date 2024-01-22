function CargaReportes(){


    $.post("https://controlfarmacia.com/Enfermeria2/Consultas/IncidenciasRapidas.php","",function(data){
      $("#ReporteRapido").html(data);
    })

  }
  
  
  
  CargaReportes();