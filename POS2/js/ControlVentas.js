function CargaVentasDelDia(){


    $.post("https://controlfarmacia.com/POS2/Consultas/VentasDelDia.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();