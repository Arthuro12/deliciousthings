import { type Ref, watch, } from "vue";

import { useBreakpoints } from "./use-breakpoints";

export function useCloseOnDekstop(isOpen: Ref<boolean>): void {
    const { isAtLeastLargeDevice } = useBreakpoints();

    function close(): void {
        isOpen.value = false;
    }

    watch(isAtLeastLargeDevice, (newValue) => {
        if (newValue) {
            close();
        }
    }, { immediate: true, });
}