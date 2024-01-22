function CargaVentasDelDia(){


    $.post("https://saludapos.com/POS2/Consultas/VentasDelDiaDesglose.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();