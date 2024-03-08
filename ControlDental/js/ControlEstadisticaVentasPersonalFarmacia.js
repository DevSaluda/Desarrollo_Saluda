function CargaVentasDelDia(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/EstadisticasVentasFarmacia.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();