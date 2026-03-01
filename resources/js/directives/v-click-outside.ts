import { type DirectiveBinding } from "vue";

type ClickOutsideHandler = (event: Event, el: HTMLElement, cb: () => void) => void;

const clickOutsideHandlerMap = new Map<HTMLElement, ClickOutsideHandler>();

export const vClickOutside = {
    mounted(el: HTMLElement, binding: DirectiveBinding): void {
        if (!binding.value || !(typeof binding.value == "function")) return;

        const handlerRef = (event: Event) => clickOutsideHandler(event, el, binding.value);
        clickOutsideHandlerMap.set(el, handlerRef);
        document.addEventListener("click", handlerRef);
    },
    unmounted(el: HTMLElement): void {
        const handlerRef = clickOutsideHandlerMap.get(el) as (event: Event) => ClickOutsideHandler;
        document.removeEventListener("click", handlerRef);
    },
};

function clickOutsideHandler(event: Event, el: HTMLElement, cb: () => void): void {
    if (event.target != el || !(event.target as HTMLElement).contains(el)) {
        cb();
    }
}