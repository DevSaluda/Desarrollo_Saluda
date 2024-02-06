function CargaReportes(){


    $.post("https://saludapos.com/POS2/Consultas/IncidenciasRapidas.php","",function(data){
      $("#ReporteRapido").html(data);
    })

  }
  
  
  
  CargaReportes();