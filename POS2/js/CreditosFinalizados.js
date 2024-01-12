function CargaCreditosFinalizados(){


    $.post("https://controlfarmacia.com/POS2/Consultas/CreditosFinalizados.php","",function(data){
      $("#tablaCreditosFinalizados").html(data);
    })

  }
  
  
  
  CargaCreditosFinalizados();