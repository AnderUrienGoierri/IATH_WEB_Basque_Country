// header.js - Mobile menu logic and shared header functions
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const body = document.body;

    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            body.classList.toggle('mobile-menu-active');
            
            // Close all dropdowns when toggling mobile menu
            document.querySelectorAll('.header-dropdown').forEach(d => d.classList.remove('active'));
            
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

    // Generic Dropdown Toggle
    document.querySelectorAll('.header-dropdown-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const parent = this.closest('.header-dropdown');
            
            // Close other dropdowns
            document.querySelectorAll('.header-dropdown').forEach(d => {
                if (d !== parent) d.classList.remove('active');
            });
            
            parent.classList.toggle('active');
        });
    });

    document.addEventListener('click', function() {
        document.querySelectorAll('.header-dropdown').forEach(d => {
            d.classList.remove('active');
        });
    });

    // Close dropdown when an item is clicked (especially for hash links)
    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function() {
            const parent = this.closest('.header-dropdown');
            if (parent) parent.classList.remove('active');
        });
    });
});
