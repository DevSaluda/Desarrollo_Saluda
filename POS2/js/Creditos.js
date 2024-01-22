function CargaCreditos(){


    $.post("https://saludapos.com/POS2/Consultas/Creditos.php","",function(data){
      $("#tablaCreditos").html(data);
    })

  }
  
  
  
  CargaCreditos();