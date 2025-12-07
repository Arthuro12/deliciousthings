import { reactive } from "vue";

import { get } from "@/api";
import type { DietType } from "@/types/users";

export function useDietTypeStore() {
    return reactive({
        isLoading: false,
        dietTypes: <DietType[]>[],
        getDietTypes: async function() {
            this.isLoading = true;
            const { data } = await get<DietType[]>("/api/diet-types");
            this.dietTypes = data;
            this.isLoading = false;
        }
    });
} 