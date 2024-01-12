function CargaVentasDelDia(){


    $.post("https://controlfarmacia.com/POS2/Consultas/VentasDelDiaDesglose.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();