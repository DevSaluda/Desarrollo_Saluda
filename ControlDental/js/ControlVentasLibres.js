function CargaVentasDelDia(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/VentasDelDiaLibres.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();