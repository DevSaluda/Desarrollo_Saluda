function  CargaContadoresAlmacen(){


    $.post("https://controlfarmacia.com/CEDIS/ContadorAlmacen.php","",function(data){
      $("#ContadorDeAlmacen").html(data);
    })

  }
  
  
  
  CargaContadoresAlmacen();