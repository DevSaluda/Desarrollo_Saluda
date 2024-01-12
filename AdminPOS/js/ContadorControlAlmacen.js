function  CargaContadoresAlmacen(){


    $.post("https://controlfarmacia.com/AdminPOS/ContadorAlmacen.php","",function(data){
      $("#ContadorDeAlmacen").html(data);
    })

  }
  
  
  
  CargaContadoresAlmacen();