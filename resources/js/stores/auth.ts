import { computed, reactive } from "vue";

import type { User } from "@/types/users";

export function useAuth() {
    const auth = reactive({
        user: <User | null>null,
        setUser: function (value: User) {
            this.user = value;
        },
        isAuthenticated: function() {
            return computed(() => this.user != null).value; // We need to return the inner value in order to unwrapp it in the template.
        },
        showArtisanProfileLinks: function() {
            return computed(() => this.user?.artisan_profile != undefined).value;
        }
    });

    return auth;
}