import { type Ref, onMounted, onUnmounted, } from "vue";

import { BREAKPOINTS } from "@/constants";

export function useCloseOnDekstop(isOpen: Ref<boolean>): void {
    const mql = window.matchMedia(`(width >= ${BREAKPOINTS.MEDIUM_DEVICE}px)`);

    function close(): void {
        isOpen.value = false;
    }

    function handleClose(e: MediaQueryListEvent): void {
        if (e.matches) {
            close();
        }
    }

    onMounted(() => {
        if (mql.matches) {
            close();
        }

        mql.addEventListener("change", handleClose);
    });

    onUnmounted(() => {
        mql.removeEventListener("change", handleClose);
    });
}