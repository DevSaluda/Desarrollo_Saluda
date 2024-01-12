function  TicketsCancelaciones(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/CancelacionesTicketsCompletas.php","",function(data){
      $("#TicketsCancelados").html(data);
    })

  }
  
  
  
  TicketsCancelaciones();