function CargaTipCredi(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/TiposCredito.php","",function(data){
      $("#tablaCreditos").html(data);
    })

  }
  
  
  
  CargaTipCredi();