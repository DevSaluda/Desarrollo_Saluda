function CargaProspectos(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/Prospectos.php","",function(data){
      $("#tablaProspectos").html(data);
    })

  }
  
  
  
  CargaProspectos();