function CargaVentasDelDia(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/VentasDelDiaPorTickets.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();