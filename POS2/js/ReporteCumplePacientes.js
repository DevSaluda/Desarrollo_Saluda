function CargaReportes(){


    $.post("https://saludapos.com/POS2/Consultas/MuestraCumplePacientes.php","",function(data){
      $("#ReporteCumples").html(data);
    })

  }
  
  
  
  CargaReportes();