function CargaVentasDelDia(){


    $.post("https://saludapos.com/AdminPOS/Consultas/VentasDelDiaPorTickets.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();