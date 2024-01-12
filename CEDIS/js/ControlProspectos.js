function CargaProspectos(){


    $.post("https://controlfarmacia.com/CEDIS/Consultas/Prospectos.php","",function(data){
      $("#tablaProspectos").html(data);
    })

  }
  
  
  
  CargaProspectos();