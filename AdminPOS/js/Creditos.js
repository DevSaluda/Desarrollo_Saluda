function CargaCreditos(){


    $.post("https://saludapos.com/AdminPOS/Consultas/Creditos.php","",function(data){
      $("#tablaCreditos").html(data);
    })

  }
  
  
  
  CargaCreditos();