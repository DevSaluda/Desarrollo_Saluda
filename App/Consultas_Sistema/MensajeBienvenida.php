<?php if($MuestraBienvenida === true) : // Si nuestra variable de control "$exibirModal" es igual a TRUE activa nuestro modal y será visible a nuestro usuario. ?>
  <script>
  $(document).ready(function()
  {
    // id de nuestro modal
    
    Swal.mixin({
      
      confirmButtonText: 'OK ',
 
    
    }).queue([
      
      {
        title: 'CONTROL FARMACIA V 1.2 ',
        text: 'DERECHOS RESERVADOS GRUPO E 2020',
        imageUrl: 'AyudaSistema/ControlFarmacia.gif',
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: 'Menu de inicio',
      },
     
    ]).then((result) => {
      if (result.value) {
        const answers = JSON.stringify(result.value)
        Swal.fire({
          title: 'AVISO.',
          text: 'Si requieres informacion adicional, haz click en el boton señalado en la imagen.',
          imageUrl: 'AyudaSistema/Ayuda.gif',
          imageWidth: 400,
          imageHeight: 200,
          imageAlt: 'Cerrar',
          confirmButtonText: 'Entendido!'
        })
      }
    })
    
  });
  </script>
  <?php endif; ?>