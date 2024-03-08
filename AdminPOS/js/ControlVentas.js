
function CargaVentasDelDia(){


    $.post("https://saludapos.com/AdminPOS/Consultas/VentasDelDia.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
 
  CargaVentasDelDia();