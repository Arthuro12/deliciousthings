import { readonly, ref, onMounted, onUnmounted, } from "vue";

export function useMediaQuery(query: string) {
    const mql = window.matchMedia(query);
    const matches = ref(false);

    function updateMatches(): void {
        matches.value = mql.matches;
    }
   
    onMounted(() => {
        updateMatches();
        mql.addEventListener("change", updateMatches);
    });

    onUnmounted(() => {
        mql.removeEventListener("change", updateMatches);
    });

    return readonly(matches);
}