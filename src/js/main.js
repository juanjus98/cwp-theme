import 'bootstrap';

// Si solo necesitas componentes específicos, puedes importarlos así:
// import { Dropdown, Collapse } from 'bootstrap';
//import { Dropdown } from 'bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    // Validar carga de JS
    console.log('DOM fully loaded and parsed');

    // Initialize all dropdowns
    document.querySelectorAll('.dropdown-toggle').forEach(dropdownToggle => {
        new Dropdown(dropdownToggle);
    });
    
});