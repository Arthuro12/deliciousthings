<template>
    <div class="form__group">
        <slot name="header"></slot>
        <RekaCheckbox 
            id="offers-delivery" 
            label="Ich bitte Lieferung an" 
            v-model="offersDelivery"
        />
        <RekaCheckbox 
            id="pick-up-on-site" 
            label="Abholung vor Ort" 
            v-model="pickUpOnSite"
        />
        <TextField 
            type="text" 
            id="average-rate" 
            label="Durchschnittspreis (in Euro)"
            v-model="averageRate"
        ></TextField>
        <slot 
            name="action" 
            :data="{ 
                offersDelivery,
                pickUpOnSite,
                averageRate,
            }"
        ></slot>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";

import TextField from "../presentation/TextField.vue";
import RekaCheckbox from "@/third-party/reka-ui/RekaCheckbox.vue";

const props = defineProps<{
    offersDelivery: boolean;
    pickUpOnSite: boolean;
    averageRate: string;
}>();

const offersDelivery = ref(props.offersDelivery);
const pickUpOnSite = ref(props.pickUpOnSite);
const averageRate = ref(props.averageRate);
</script>