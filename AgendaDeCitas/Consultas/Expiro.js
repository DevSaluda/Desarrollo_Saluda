


function Expiro(){
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        html: '<i class="fas fa-door-closed"></i> Se ha cerrado la sesion por falta de actividad <i class="fas fa-user-clock"></i>',
        showConfirmButton :false,
        footer: '<button class="btn btn-primary" onclick="Login()" ><i class="fas fa-sign-in-alt"></i>  Ir al login</button>',
        allowOutsideClick: false
      })
 
}
function Login(){
    location.href="https://controlfarmacia.com/App/Secure/IngresoAgenda"
 }