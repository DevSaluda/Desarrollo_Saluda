function CargaVentasDelDia(){


    $.post("https://controlfarmacia.com/POS2/Consultas/VentasDelDiaCredito.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();