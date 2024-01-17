function  CaducanProntoProds(){


    $.post("https://saludapos.com/CEDIS/Consultas/ProductosPorVencer.php","",function(data){
      $("#TableProdCaducaPronto").html(data);
    })

  }
  
  
  
  CaducanProntoProds();