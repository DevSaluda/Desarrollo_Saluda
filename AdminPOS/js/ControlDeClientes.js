function CargaVentasDelDia(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/DatosDeClientes.php","",function(data){
      $("#ListaDeClientes").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();