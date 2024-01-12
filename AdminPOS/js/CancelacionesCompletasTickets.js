function  TicketsCancelaciones(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/CancelacionesTicketsCompletas.php","",function(data){
      $("#TicketsCancelados").html(data);
    })

  }
  
  
  
  TicketsCancelaciones();