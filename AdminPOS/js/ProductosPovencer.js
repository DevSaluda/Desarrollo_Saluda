function  CaducanProntoProds(){


    $.post("https://saludapos.com/AdminPOS/Consultas/ProductosPorVencer.php","",function(data){
      $("#TableProdCaducaPronto").html(data);
    })

  }
  
  
  
  CaducanProntoProds();