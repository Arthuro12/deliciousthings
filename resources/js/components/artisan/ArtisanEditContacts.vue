<template>
    <div class="form__group">
        <slot name="header"></slot>
        <TextField 
            type="text" 
            id="phone" 
            label="Telefonnummer (optional)"
            v-model="form.phone"
        />
        <TextField 
            type="text" 
            id="email" 
            label="E-Mail-Adresse"
            v-model="form.email"
        />
        <AppButton
            class="align-end"
            type="button"
            layout="text"
            variant="primary"
            @click="updateContact"
        >
            <template #text>Speichern</template>
        </AppButton>
    </div>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

import AppButton from "../presentation/AppButton.vue";
import TextField from "../presentation/TextField.vue";

const props = defineProps<{
    phone: string;
    email: string;
}>();

const form = useForm({
    phone: props.phone,
    email: props.email,
});

function updateContact(): void {
    form.patch("/artisan/profile/contact");
}
</script>