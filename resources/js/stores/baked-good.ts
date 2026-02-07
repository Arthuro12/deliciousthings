import { reactive } from "vue";

import { get } from "@/api";
import type { BakedGood } from "@/types/users";

export function useBakedGoodStore() {
    return reactive({
        isLoading: false,
        bakedGoods: <BakedGood[]>[],
        getBakedGoods: async function () {
            this.isLoading = true;
            const { data } = await get<BakedGood[]>("/api/baked-goods");
            this.bakedGoods = data;
            this.isLoading = false;
        }
    });
};