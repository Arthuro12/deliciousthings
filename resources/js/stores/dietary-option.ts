import { reactive } from "vue";

import { get } from "@/api";
import type { DietaryOption } from "@/types/users";

export function useDietaryOptionStore() {
    return reactive({
        isLoading: false,
        dietaryOptions: <DietaryOption[]>[],
        getDietaryOptions: async function() {
            this.isLoading = true;
            const { data } = await get<DietaryOption[]>("/api/dietary-options");
            this.dietaryOptions = data;
            this.isLoading = false;
        }
    });
} 