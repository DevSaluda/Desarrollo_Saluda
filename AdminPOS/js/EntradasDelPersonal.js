
function CargaVentasDelDia(){


  $.post("https://saludapos.com/AdminPOS/Consultas/EntradasDelPersonal.php","",function(data){
    $("#RegistrosHuellas").html(data);
  })

}


CargaVentasDelDia();