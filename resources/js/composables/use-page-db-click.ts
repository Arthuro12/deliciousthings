import { onMounted, onUnmounted } from "vue";

import { useDeviceSize } from "./use-device-size";

export function usePageDbClick(): void {
const { isSmallDevice, } = useDeviceSize()

    function handlePageDbClick(event: Event): void {
        event.preventDefault();
    }

    onMounted(() => {
        if (isSmallDevice.value) {
            document.body.addEventListener("dblclick", handlePageDbClick);
        }
    });

    onUnmounted(() => {
        if (isSmallDevice.value) {
            document.body.removeEventListener("dblclick", handlePageDbClick);
        }
    });
}