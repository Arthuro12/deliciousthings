import type { Reactive } from "vue";

import type { FlashProps } from "@/types/ui";

import { computed } from "vue";

export function useAlert(flash: Reactive<FlashProps>) {
    const alertMessage = computed(() => {
        if ("info" in flash) {
            return flash.info || flash.success || flash.error || "";
        } else if ("severity" in flash) {
            return flash.message;
        }
        return "";
    });

    const showAlert = computed(() => Boolean(alertMessage.value));

    return {
        showAlert,
        alertMessage,
    }
}