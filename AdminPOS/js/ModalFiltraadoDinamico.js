document.addEventListener('DOMContentLoaded', function () {
    // Selecciona el formulario
    const form = document.getElementById('FiltroPorFechasForm');

    // Agrega un evento a los botones que abren el modal
    document.querySelectorAll('[data-target="#FiltroEspecificoFechaVentas"]').forEach(button => {
        button.addEventListener('click', function () {
            // Cambia el action del formulario según el botón que abrió el modal
            const action = this.getAttribute('data-action');
            form.setAttribute('action', action);
        });
    });
});