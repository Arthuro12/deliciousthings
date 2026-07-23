import Alpine from "alpinejs";

// export type StateType<T> = infer T
// export type AlpineWatchHandle<StateType> = {
//     key: string;
//     callback: (...parameter: StateType[]) => void;
// };

// export interface AlpineComponent {
//     $watch: AlpineWatchHandle<>;
// }

const mobileMenu = {
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

Alpine.data('mobileMenu', () => mobileMenu); 
Alpine.start()