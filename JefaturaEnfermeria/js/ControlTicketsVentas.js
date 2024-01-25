function CargaVentasDelDia(){


    $.post("https://saludapos.com/JefaturaEnfermeria/Consultas/VentasDelDiaPorTickets.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();