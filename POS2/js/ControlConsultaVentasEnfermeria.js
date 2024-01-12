function CargaVentasDelDia(){


    $.post("https://controlfarmacia.com/POS2/Consultas/VentasDelDiaDesgloseEnfermeria.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();