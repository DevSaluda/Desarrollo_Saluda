function CargaVentasDelDia(){


    $.post("https://controlfarmacia.com/POS2/Consultas/CortesDeCajaReimpresiones.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();