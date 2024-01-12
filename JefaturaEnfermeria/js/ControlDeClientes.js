function CargaVentasDelDia(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/DatosDeClientes.php","",function(data){
      $("#ListaDeClientes").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();