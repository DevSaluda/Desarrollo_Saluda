function CargaReportes(){


    $.post("https://controlfarmacia.com/POS2/Consultas/MuestraCumplePacientes.php","",function(data){
      $("#ReporteCumples").html(data);
    })

  }
  
  
  
  CargaReportes();