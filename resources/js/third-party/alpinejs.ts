import Alpine from "alpinejs";

const mobileMenu = {
    open: false,
    closeMenu() {
        this.open = false;
    },
    openMenu() {
        this.open = true;
    },
    toggle() {
        this.open = !this.open;
    },
};

Alpine.data('mobileMenu', () => mobileMenu); 
Alpine.start()