function CargaReportes(){


    $.post("https://saludapos.com/JefaturaEnfermeria/Consultas/IncidenciasRapidas.php","",function(data){
      $("#ReporteRapido").html(data);
    })

  }
  
  
  
  CargaReportes();