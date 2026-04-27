<template>
    <div class="form__group">
        <slot name="header"></slot>
        <RekaCheckbox 
            id="offers-delivery" 
            label="Ich bitte Lieferung an" 
            v-model="form.offers_delivery"
        />
        <RekaCheckbox 
            id="pick-up-on-site" 
            label="Abholung vor Ort" 
            v-model="form.pick_up_on_site"
        />
        <AppButton
            class="align-end"
            type="button"
            variant="primary"
            size="medium"
            @click="updatePickupMethods"
        >
            <template #text>Speichern</template>
        </AppButton>
    </div>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

import AppButton from "../presentation/AppButton.vue";
import RekaCheckbox from "@/third-party/reka-ui/RekaCheckbox.vue";

const props = defineProps<{
    offersDelivery: boolean;
    pickUpOnSite: boolean;
}>();

const form = useForm({
    offers_delivery: props.offersDelivery,
    pick_up_on_site: props.pickUpOnSite,
});

function updatePickupMethods(): void {
    form.patch("/artisan/profile/pickup-methods");
}
</script>