import { onMounted, onUnmounted } from "vue";

import { useBreakpoints } from "./use-breakpoints";

export function usePageDbClick() {
const { isAtMostMediumDevice, } = useBreakpoints();

    function handlePageDbClick(event: Event): void {
        event.preventDefault();
    }

    onMounted(() => {
        if (isAtMostMediumDevice.value) {
            document.body.addEventListener("dblclick", handlePageDbClick);
        }
    });

    onUnmounted(() => {
        if (isAtMostMediumDevice.value) {
            document.body.removeEventListener("dblclick", handlePageDbClick);
        }
    });
}