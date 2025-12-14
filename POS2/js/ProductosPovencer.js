function  CaducanProntoProds(){


    $.post("https://saludapos.com/POS2/Consultas/ProductosPorVencer.php","",function(data){
      $("#TableProdCaducaPronto").html(data);
    })

  }
  
  
  
  CaducanProntoProds();