document.addEventListener('DOMContentLoaded', function () {

    evenListeners();

    darkMode();

    //Eliminar texto de confirmación de CRUD en admin/index.php
    setInterval(function () {
        const mensajeConfirm = document.querySelector('.alerta.exito');
        const padre = mensajeConfirm.parentElement;
        padre.removeChild(mensajeConfirm);
    }, 3500);
});

function darkMode() {
    //Preferencias del sistema si un tema OSCURO o un tema CLARO
    const prefireDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    //console.log(prefireDarkMode.matches); //Validamos si prefiere un modo OSCURO, nos retorna un booleano

    if (prefireDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    //De manera automatica si tiene hablitado esa opcion
    prefireDarkMode.addEventListener('change', function () {
        if (prefireDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function () {
        //document.body.classList.toggle('dark-mode');
        document.body.classList.toggle('dark-mode');
    });

}

function evenListeners() {

    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);

}

function navegacionResponsive() {

    const navegacion = document.querySelector('.navegacion');

    if (navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar')
    }
    //Este codigo es igual al usar los condicionales if()else
    //navegacion.classList.toggle('mostrar');
}