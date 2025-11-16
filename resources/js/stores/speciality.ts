import { reactive } from "vue";

import { get } from "@/api";
import type { Speciality } from "@/types/users";

export const useSpecialityStore = function() {
    return reactive({
        isLoading: false,
        specialities: <Speciality[]>[],
        getSpecialities: async function() {
            this.isLoading = true;
            const { data } = await get<Speciality[]>("/api/specialities");
            this.specialities = data;
            this.isLoading = false;
        }
    });
};