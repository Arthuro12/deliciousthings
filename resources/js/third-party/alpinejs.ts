import Alpine from "alpinejs";

type WatchCallback<V = any, OV = any> = (value: V, oldValue: OV) => void

interface AlpineMagics {
    $watch: (key: string, callback: WatchCallback) => void;
}

type AlpineComponent<Component extends object> = Component & ThisType<Component & AlpineMagics>;

interface MobileMenu {
    open: boolean;
    init: () => void;
    toggle: () => void;
}

interface Password  {
    show: boolean;
    invalid?: boolean;
}

const mobileMenu: AlpineComponent<MobileMenu> = {
    open: false,
    init() {
        this.$watch('open', (isOpen: boolean): void => {
            const pageBody = document.body;
            if (isOpen) {
                pageBody.dataset.scrollLocked = "";
            } else {
                delete pageBody.dataset.scrollLocked;
            }
        });
    },
    toggle() {
        this.open = !this.open;
    }, 
};

const password: AlpineComponent<Password> = {
    show: false,
    invalid: undefined,
};

Alpine.data('mobileMenu', () => mobileMenu); 
Alpine.data('password', () => password); 
Alpine.start()