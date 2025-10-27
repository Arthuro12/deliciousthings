import { readonly, ref, onMounted, onUnmounted } from "vue";

const MOBILE_BREAKPOINT = 767;

/**
 * Indicates whether the user is on a mobile device.
 * 
 * @param width - The width of the user's device
 */
const isSmallDevice = (width: number) => width <= MOBILE_BREAKPOINT;

export function useIsMobile() {
    const isMobile = ref(isSmallDevice(window.innerWidth));

    function setIsMobile(): void {
        isMobile.value = isSmallDevice(window.innerWidth);
    }

    onMounted(() => {
        window.addEventListener('resize', setIsMobile);
    });

    onUnmounted(() => {
        window.removeEventListener('resize', setIsMobile);
    });

    return {
        isMobile: readonly(isMobile)
    };
}