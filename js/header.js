// header.js - Mobile menu logic and shared header functions
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const body = document.body;

    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            body.classList.toggle('mobile-menu-active');
            
            const icon = mobileMenuBtn.querySelector('svg path');
            if (body.classList.contains('mobile-menu-active')) {
                icon.setAttribute('d', 'M6 18L18 6M6 6l12 12'); // X icon
            } else {
                icon.setAttribute('d', 'M4 6h16M4 12h16m-7 6h7'); // Hamburger
            }
        });
    }

    // Close menu when clicking links
    const navLinks = document.querySelectorAll('.main-nav a');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            body.classList.remove('mobile-menu-active');
            const icon = mobileMenuBtn.querySelector('svg path');
            if (icon) icon.setAttribute('d', 'M4 6h16M4 12h16m-7 6h7');
        });
    });

    // Admin Dropdown Toggle
    const adminDropBtn = document.querySelector('.admin-dropdown-btn');
    const adminDrop = document.querySelector('.admin-dropdown');

    if (adminDropBtn && adminDrop) {
        adminDropBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            adminDrop.classList.toggle('active');
        });

        document.addEventListener('click', function() {
            adminDrop.classList.remove('active');
        });
    }
});
