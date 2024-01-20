function  CaducanProntoProds(){


    $.post("https://saludapos.com/CEDISMOVIL/Consultas/ProductosPorVencer.php","",function(data){
      $("#TableProdCaducaPronto").html(data);
    })

  }
  
  
  
  CaducanProntoProds();