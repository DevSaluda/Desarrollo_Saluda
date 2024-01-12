function  CaducanProntoProds(){


    $.post("https://controlfarmacia.com/POS2/Consultas/ProductosPorVencer.php","",function(data){
      $("#TableProdCaducaPronto").html(data);
    })

  }
  
  
  
  CaducanProntoProds();