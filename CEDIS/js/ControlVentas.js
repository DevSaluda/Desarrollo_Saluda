function CargaVentasDelDia(){


    $.post("https://controlfarmacia.com/CEDIS/Consultas/VentasDelDia.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();