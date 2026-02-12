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
        <TextField 
            type="text" 
            id="average-rate" 
            label="Durchschnittspreis (in Euro)"
            v-model="form.average_rate"
        />
        <AppButton
            class="align-end"
            type="button"
            variant="primary"
            size="medium"
            @click="updateServices"
        >
            <template #text>Speichern</template>
        </AppButton>
    </div>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

import AppButton from "../presentation/AppButton.vue";
import TextField from "../presentation/TextField.vue";
import RekaCheckbox from "@/third-party/reka-ui/RekaCheckbox.vue";

const props = defineProps<{
    offersDelivery: boolean;
    pickUpOnSite: boolean;
    averageRate: string;
}>();

const form = useForm({
    offers_delivery: props.offersDelivery,
    pick_up_on_site: props.pickUpOnSite,
    average_rate: props.averageRate,
});

function updateServices(): void {
    form.patch("/artisan/profile/services");
}
</script>