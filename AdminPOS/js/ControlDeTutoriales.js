function CargaVentasDelDia(){


    $.post("https://saludapos.com/AdminPOS/Consultas/DatosDeTutoriales.php","",function(data){
      $("#ListaDeClientes").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();