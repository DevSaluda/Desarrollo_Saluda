function CargaTipCredi(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/TiposCredito.php","",function(data){
      $("#tablaCreditos").html(data);
    })

  }
  
  
  
  CargaTipCredi();