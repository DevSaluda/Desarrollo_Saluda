function CargaVentasDelDia(){


    $.post("https://controlfarmacia.com/CEDISMOVIL/Consultas/VentasDelDia.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();