function CargaExpedientes(){


    $.post("https://saludapos.com/AdminPOS/Consultas/DatosDeExpedientes.php","",function(data){
      $("#ListaDeClientes").html(data);
    })

  }
  
  
  
  CargaExpedientes();