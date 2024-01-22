function CargaReportes(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/IncidenciasRapidas.php","",function(data){
      $("#ReporteRapido").html(data);
    })

  }
  
  
  
  CargaReportes();