import { readonly, } from "vue";

import { useMediaQuery, } from "./use-media-query";
import { BREAKPOINTS } from "@/constants";

export function useBreakpoints() {
    const isSmallDevice = useMediaQuery(`(max-width: ${BREAKPOINTS.MEDIUM_DEVICE - 1}px)`);
    const isAtMostMediumDevice = useMediaQuery(`(max-width: ${BREAKPOINTS.LARGE_DEVICE - 1}px)`);
    const isAtLeastLargeDevice = useMediaQuery(`(min-width: ${BREAKPOINTS.LARGE_DEVICE}px)`);

    return {
        isSmallDevice: readonly(isSmallDevice),
        isAtMostMediumDevice: readonly(isAtMostMediumDevice),
        isAtLeastLargeDevice: readonly(isAtLeastLargeDevice),
    }
}