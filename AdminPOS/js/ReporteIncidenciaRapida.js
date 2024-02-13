function CargaReportes(){


    $.post("https://saludapos.com/AdminPOS/Consultas/IncidenciasRapidas.php","",function(data){
      $("#ReporteRapido").html(data);
    })

  }
  
  
  
  CargaReportes();