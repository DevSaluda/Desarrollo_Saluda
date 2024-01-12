function CargaCreditos(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/Creditos.php","",function(data){
      $("#tablaCreditos").html(data);
    })

  }
  
  
  
  CargaCreditos();