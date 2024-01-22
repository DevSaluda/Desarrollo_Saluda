function CargaReportes(){


    $.post("https://saludapos.com/Enfermeria2/Consultas/IncidenciasRapidas.php","",function(data){
      $("#ReporteRapido").html(data);
    })

  }
  
  
  
  CargaReportes();