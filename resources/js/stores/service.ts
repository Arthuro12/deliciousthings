import { reactive } from "vue";

import { get } from "@/api";
import type { Service } from "@/types/users";

export function useServiceStore() {
    return reactive({
        isLoading: false,
        services: <Service[]>[],
        getServices: async function () {
            this.isLoading = true;
            const { data } = await get<Service[]>("/api/services");
            this.services = data;
            this.isLoading = false;
        }
    });
};