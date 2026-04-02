import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";

export function useAuth() {
    const user = usePage().props.auth.user;

    const isAuthenticated = computed(() => user != null);

    const hasArtisanProfile = computed(() => user?.artisan_profile != undefined);

    return {
        isAuthenticated,
        hasArtisanProfile,
    }
}