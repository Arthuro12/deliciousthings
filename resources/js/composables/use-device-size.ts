import { readonly, ref, onMounted, onUnmounted } from "vue";

export type BreakpointRange = 'small' | 'medium';

const SMALL_DEVICE_BREAKPOINT = 767;
const MEDIUM_DEVICE_BREAKPOINT = 991;

/**
 * Checks whether the size of the user's device is within a breakpoint range.
 * 
 * @param width - The width of the user's device
 * @param range - The range to use. Default is small device breakpoint range.
 */
const isDeviceWidthInRange = (width: number, range: BreakpointRange = 'small'): boolean => {
    if (range == 'medium') return width <= MEDIUM_DEVICE_BREAKPOINT;

    return width <= SMALL_DEVICE_BREAKPOINT;
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