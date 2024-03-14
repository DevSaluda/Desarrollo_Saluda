function CargaTipCredi(){


    $.post("https://saludapos.com/AdminPOS/ControlDental/TiposCredito.php","",function(data){
      $("#tablaCreditos").html(data);
    })

  }
  
  
  
  CargaTipCredi();