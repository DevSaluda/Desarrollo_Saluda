function CargaTipCredi(){


    $.post("https://saludapos.com/ControlDental/Consultas/TiposCredito.php","",function(data){
      $("#tablaCreditos").html(data);
    })

  }
  
  
  
  CargaTipCredi();