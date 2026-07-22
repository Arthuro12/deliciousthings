import Alpine from "alpinejs";

const mobileMenu = {
    open: false,
    toggle() {
        this.open = !this.open;
    },
};

Alpine.data('mobileMenu', () => mobileMenu); 
Alpine.start()