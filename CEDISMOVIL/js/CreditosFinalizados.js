function CargaCreditosFinalizados(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/CreditosFinalizados.php","",function(data){
      $("#tablaCreditosFinalizados").html(data);
    })

  }
  
  
  
  CargaCreditosFinalizados();