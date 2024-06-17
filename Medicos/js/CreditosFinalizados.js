function CargaCreditosFinalizados(){


    $.post("https://saludapos.com/ControlDental/Consultas/CreditosFinalizados.php","",function(data){
      $("#tablaCreditosFinalizados").html(data);
    })

  }
  
  
  
  CargaCreditosFinalizados();