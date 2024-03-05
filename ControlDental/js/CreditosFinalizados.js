function CargaCreditosFinalizados(){


    $.post("https://saludapos.com/AdminPOS/Consultas/CreditosFinalizados.php","",function(data){
      $("#tablaCreditosFinalizados").html(data);
    })

  }
  
  
  
  CargaCreditosFinalizados();