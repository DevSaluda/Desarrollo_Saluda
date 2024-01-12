function ayudabienvenida(){
    Swal.mixin({
      
      confirmButtonText: 'Siguiente &rarr;',
      cancelButtonText: 'Cerrar',
      showCancelButton: true,
     
    }).queue([
      {
        title: 'INTERFAZ DE INICIO',
        text: 'El sistema cuenta con distintas opciones para acceder, cada una esta diseñada para el area en especifico.',
        imageUrl: 'AyudaSistema/MuestraSistema.gif',
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: 'Menu de inicio',
      },
      {
        title: 'INGRESO',
        text: 'Para el ingreso al area seleccionada, simplemente oprime el boton ingresar y te redireccionara.',
        imageUrl: 'AyudaSistema/ingresoF.gif',
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: 'Menu de inicio',
      },
      
    ]).then((result) => {
      if (result.value) {
        const answers = JSON.stringify(result.value)
        Swal.fire({
          title: 'AVISO',
          text: 'Si tienes dudas puedes ponerte en contacto con soporte, o solicitar un manual de usuario digital.',
          imageUrl: 'AyudaSistema/Soporte.gif',
          imageWidth: 400,
          imageHeight: 200,
          imageAlt: 'Cerrar',
          confirmButtonText: 'Entendido!'
        })
      }
    })
    }