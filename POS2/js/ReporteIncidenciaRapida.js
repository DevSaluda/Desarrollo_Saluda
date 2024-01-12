function CargaReportes(){


    $.post("https://controlfarmacia.com/POS2/Consultas/IncidenciasRapidas.php","",function(data){
      $("#ReporteRapido").html(data);
    })

  }
  
  
  
  CargaReportes();