import { computed } from "vue";
import type { Reactive } from "vue";

import type { Auth } from "@/types/users";

export function useAuth(auth: Reactive<Auth>) {
    const user = computed(() => auth.user);

    const isAuthenticated = computed(() => user.value != null);

    const hasArtisanProfile = computed(() => user.value?.artisan_profile != undefined);

    return {
        isAuthenticated,
        hasArtisanProfile,
    }
}