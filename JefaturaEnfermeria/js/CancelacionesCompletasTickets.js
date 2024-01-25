function  TicketsCancelaciones(){


    $.post("https://saludapos.com/JefaturaEnfermeria/Consultas/CancelacionesTicketsCompletas.php","",function(data){
      $("#TicketsCancelados").html(data);
    })

  }
  
  
  
  TicketsCancelaciones();