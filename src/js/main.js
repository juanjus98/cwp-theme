import 'bootstrap';

// Si solo necesitas componentes específicos, puedes importarlos así:
// import { Dropdown, Collapse } from 'bootstrap';
//import { Dropdown } from 'bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    // Validar carga de JS
    console.log('Readdy custom JS!!');

    // Initialize all dropdowns
    /* document.querySelectorAll('.dropdown-toggle').forEach(dropdownToggle => {
        new Dropdown(dropdownToggle);
    }); */

    // Navbar fixed
    var navbar = document.querySelector('.navbar-fixed-top');
    if (navbar) {
        var sticky = navbar.offsetTop;
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > sticky) {
                navbar.classList.add('is-scrolling');
            } else {
                navbar.classList.remove('is-scrolling');
            }
        });
    }
    
});

// JavaScript personalizado
/* document.addEventListener('DOMContentLoaded', function() {
    var navbar = document.querySelector('.navbar-fixed-top');
    
    // Validar que existe el elemento con la clase navbar-fixed-top
    if (navbar) {
        var sticky = navbar.offsetTop;
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > sticky) {
                navbar.classList.add('fixed-top');
            } else {
                navbar.classList.remove('fixed-top');
            }
        });
    }
}); */