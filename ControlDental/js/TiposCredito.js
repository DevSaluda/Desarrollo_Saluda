function CargaTipCredi(){


    $.post("https://saludapos.com/AdminPOS/Consultas/TiposCredito.php","",function(data){
      $("#tablaCreditos").html(data);
    })

  }
  
  
  
  CargaTipCredi();