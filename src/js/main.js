$(function() {
    console.log( "ready JQuery Her!" );
});

document.addEventListener('DOMContentLoaded', () => {
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