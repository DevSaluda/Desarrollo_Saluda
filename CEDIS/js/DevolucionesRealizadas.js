
function CargaVentasDelDia(){


    $.post("https://saludapos.com/CEDIS/Consultas/DevolucionesDelMes.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
 
  CargaVentasDelDia();