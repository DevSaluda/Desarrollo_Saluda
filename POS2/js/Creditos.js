function CargaCreditos(){


    $.post("https://controlfarmacia.com/POS2/Consultas/Creditos.php","",function(data){
      $("#tablaCreditos").html(data);
    })

  }
  
  
  
  CargaCreditos();