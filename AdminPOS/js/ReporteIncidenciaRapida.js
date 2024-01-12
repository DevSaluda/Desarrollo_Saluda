function CargaReportes(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/IncidenciasRapidas.php","",function(data){
      $("#ReporteRapido").html(data);
    })

  }
  
  
  
  CargaReportes();