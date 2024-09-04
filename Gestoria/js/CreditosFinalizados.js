function CargaCreditosFinalizados(){


    $.post("https://saludapos.com/POS2/Consultas/CreditosFinalizados.php","",function(data){
      $("#tablaCreditosFinalizados").html(data);
    })

  }
  
  
  
  CargaCreditosFinalizados();