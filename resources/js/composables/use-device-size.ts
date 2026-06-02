import { readonly, ref, onMounted, onUnmounted } from "vue";

import { BREAKPOINTS } from "@/constants";

export type BreakpointRange = 'small' | 'medium';

/**
 * Checks whether the size of the user's device is within a breakpoint range.
 * 
 * @param width - The width of the user's device
 * @param range - The range to use. Default is small device breakpoint range.
 */
const isDeviceWidthInRange = (width: number, range: BreakpointRange = 'small'): boolean => {
    if (range == 'medium') return width <= BREAKPOINTS.MEDIUM_DEVICE;

    return width <= BREAKPOINTS.SMALL_DEVICE;
}

export function useDeviceSize() {
    const isSmallDevice = ref(isDeviceWidthInRange(window.innerWidth));
    const width = ref(window.innerWidth);

    function updateWidth(): void {
        width.value = window.innerWidth;
    }

    function setIsSmallDevice(): void {
        isSmallDevice.value = isDeviceWidthInRange(window.innerWidth);
    }

    onMounted(() => {
        window.addEventListener('resize', setIsSmallDevice);
        window.addEventListener('resize', updateWidth);
    });

    onUnmounted(() => {
        window.removeEventListener('resize', setIsSmallDevice);
        window.addEventListener('resize', updateWidth);
    });

    return {
        isSmallDevice: readonly(isSmallDevice),
        deviceWidth: readonly(width),
    };
}